<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserStatus;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Http\Requests\Api\User\ResetPasswordRequest;
use App\Http\Requests\Api\User\VerifyOtpRequest;
use App\Jobs\SendNewPassword;
use App\Jobs\SendOtp;
use Exception;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\User\UserLoginRequest;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\Api
 * @date 2019-06-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UsersController extends ApiController {

  /**
   * Return api logged user
   *
   * @return \Illuminate\Http\JsonResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function me(): JsonResponse {
    return JsonResponse::create(
      [
        'status' => 1,
        'user' => $this->getUser(),
      ]
    );
  }

  /**
   * Handle api request for user registration
   *
   * @param \App\Http\Requests\Api\User\RegisterRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function register(RegisterRequest $request): JsonResponse {
    if (!$request->failed()) {
      try {
        /**
         * @var $User User
         */
        $User = User::query()->create(
          [
            'fb_id' => $request->fb_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => (string) UserStatus::INACTIVE,
            'firebase_token' => $request->firebase_token,
            'wallet' => 0.0,
            'points' => 0,
          ]
        );

        SendOtp::dispatch($User);

        if ($User !== NULL) {
          return JsonResponse::create(
            [
              'status' => 1,
              'user_id' => $User->id,
            ]
          );
        }

        return JsonResponse::create(
          [
            'status' => 0,
            'error' => __('Could not proccess your request, please try again later.'),
          ]
        );
      } catch (Exception $exception) {
        return JsonResponse::create(
          [
            'status' => 0,
            'error' => $exception->getMessage(),
          ]
        );
      }
    }
    return JsonResponse::create(
      [
        'status' => 0,
        'error' => $request->errors()->first(),
      ]
    );
  }

  /**
   * Handle api request for otp verification
   *
   * @param \App\Models\User $user
   * @param \App\Http\Requests\Api\User\VerifyOtpRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function verifyOtp(User $user, VerifyOtpRequest $request): JsonResponse {
    if (!$request->failed()) {
      if ($user->getOtp() === $request->otp) {
        $user->status = (string) UserStatus::ACTIVE;
        $user->save();

        return JsonResponse::create(
          [
            'status' => 1,
          ]
        );
      }

      return JsonResponse::create(
        [
          'status' => 0,
          'error' => __('Invalid OTP.'),
        ]
      );
    }

    return JsonResponse::create(
      [
        'status' => 0,
        'error' => $request->errors()->first(),
      ]
    );
  }

  /**
   * Handle api request for resending otp code
   *
   * @param \App\Models\User $user
   *
   * @return \Illuminate\Http\JsonResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function resendOtp(User $user): JsonResponse {
    SendOtp::dispatch($user);
    return JsonResponse::create(
      [
        'status' => 1,
      ]
    );
  }

  /**
   * Handle facebook social login request
   *
   * @param string $fbId
   *
   * @return \Illuminate\Http\JsonResponse|null
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function socialLogin(string $fbId): ?JsonResponse {
    try {
      $User = User::withFacebookId($fbId)->firstOrFail();
      $User->firebase_token = request()->get('firebase_token');
      $User->save();
      return JsonResponse::create(
        [
          'status' => 1,
          'user' => $User,
          'access_token' => ($User->token() ?? $User->createToken('facebookToken'))->accessToken,
        ]
      );
    } catch (Exception $exception) {
      return JsonResponse::create(
        [
          'status' => 0,
        ]
      );
    }
  }

  /**
   * Log user in, in case the phone number doesn't exist, create a new user and inform the api
   *
   * @param UserLoginRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function login(UserLoginRequest $request): JsonResponse {
    if (!$request->failed()) {
      /**
       * @var $User User
       */
      $User = User::withPhoneNumber($request->phone_number)->get()->first();
      $Response = [
        'status' => 1,
      ];

      if ($User === NULL) {
        return JsonResponse::create(
          [
            'status' => 0,
            'error' => __('Phone number not registered.'),
          ]
        );
      }

      if ((int) $User->status === UserStatus::INACTIVE) {
        SendOtp::dispatch($User);
        return JsonResponse::create(
          [
            'status' => 2,
            'user_id' => $User->id,
          ]
        );
      }

      try {
        $http = new Client();
        $response = $http->post(env('APP_URL') . '/oauth/token', [
          'form_params' => [
            'grant_type' => 'password',
            'client_id' => env('API_CLIENT_ID'),
            'client_secret' => env('API_CLIENT_SECRET'),
            'username' => $User->phone_number,
            'password' => $request->password,
            'scope' => '*',
            'provider' => 'users',
          ],
          //'verify' => false,
        ]);

        $AccessTokenResponse = json_decode((string) $response->getBody(), TRUE);
        $User->firebase_token = $request->firebase_token;
        $Response['access_token'] = $AccessTokenResponse;
        $Response['user'] = $User;

        return JsonResponse::create($Response);
      } catch (ClientException $e) {
        switch ($e->getCode()) {
          case 400:
          case 401:
            return JsonResponse::create(
              [
                'status' => 0,
                'error' => __('Your credentials are incorrect. Please try again'),
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
              ]
            );
          default:
            return JsonResponse::create(
              [
                'status' => 0,
                'error' => __('Something went wrong, please try again.'),
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
              ]
            );
        }
      }
    }

    return JsonResponse::create(
      [
        'status' => 0,
        'error' => $request->errors()->first(),
      ]
    );
  }

  /**
   * Handle api password reset request
   *
   * @param \App\Http\Requests\Api\User\ResetPasswordRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function resetPassword(ResetPasswordRequest $request): JsonResponse {
    if (!$request->failed()) {
      /**
       * @var $User User
       */
      $User = User::withPhoneNumber($request->phone_number)->first();
      $NewPassword = Str::random(6);
      $User->password = Hash::make($NewPassword);
      $User->save();
      SendNewPassword::dispatch($User, $NewPassword);

      return JsonResponse::create(
        [
          'status' => 1,
        ]
      );
    }

    return JsonResponse::create(
      [
        'status' => 0,
        'error' => $request->errors()->first(),
      ]
    );
  }

}
