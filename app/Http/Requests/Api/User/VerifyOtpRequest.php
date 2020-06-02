<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseApiRequest;

/**
 * Class VerifyOtpRequest
 *
 * @property string otp
 *
 * @package App\Http\Requests\Api\User
 * @date 3/8/20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class VerifyOtpRequest extends BaseApiRequest {

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
      'otp' => 'required|string|min:4|max:4',
    ];
  }

}
