<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseApiRequest;
use App\Rules\JordanianNumber;

/**
 * Class UserLoginRequest
 *
 * @property string phone_number
 * @property string password
 * @property string firebase_token
 *
 * @package App\Http\Requests
 * @date 2019-06-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UserLoginRequest extends BaseApiRequest {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function authorize(): bool {
    return TRUE;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function rules(): array {
    return [
      'phone_number' => [
        'required',
        'string',
        'min:12',
        'max:12',
        new JordanianNumber(),
      ],
      'password' => 'required|string|min:6',
      'firebase_token' => 'required|string',
    ];
  }

}
