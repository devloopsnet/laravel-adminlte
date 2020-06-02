<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseApiRequest;
use App\Rules\JordanianNumber;

/**
 * Class RegisterRequest
 *
 * @property string fb_id
 * @property string first_name
 * @property string last_name
 * @property string phone_number
 * @property string gender
 * @property string email
 * @property string firebase_token
 * @property string password
 *
 * @package App\Http\Requests\Api\User
 * @date 3/7/20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class RegisterRequest extends BaseApiRequest {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool {
    return TRUE;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(): array {
    return [
      'fb_id' => 'string',
      'first_name' => 'required|string|min:2',
      'last_name' => 'required|string|min:2',
      'email' => 'required|email|unique:users,email',
      'phone_number' => [
        'required',
        'string',
        'min:12',
        'max:12',
        new JordanianNumber(),
        'unique:users,phone_number',
      ],
      'date_of_birth' => 'required|date',
      'firebase_token' => 'required|string',
      'password' => 'required|min:6|confirmed',
    ];
  }

}
