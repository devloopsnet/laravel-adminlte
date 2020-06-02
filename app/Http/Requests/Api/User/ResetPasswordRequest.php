<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseApiRequest;
use App\Rules\JordanianNumber;

/**
 * Class ResetPasswordRequest
 *
 * @property string phone_number
 *
 * @package App\Http\Requests\Api\User
 * @date 3/8/20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class ResetPasswordRequest extends BaseApiRequest {

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
      'phone_number' => [
        'required',
        'string',
        'min:12',
        'max:12',
        new JordanianNumber(),
        'exists:users,phone_number',
      ],
    ];
  }

}
