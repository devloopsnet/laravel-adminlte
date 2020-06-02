<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseAdminRequest;
use App\Models\User;
use App\Rules\JordanianNumber;

/**
 * Class UpdateUserRequest
 *
 * @property string first_name
 * @property string last_name
 * @property string phone_number
 * @property string email
 * @property string gender
 * @property int wallet_balance
 * @property int reward_points
 * @property int status
 * @property string password
 * @property string password_confirmation
 * @property User user
 *
 * @package App\Http\Requests\Admin
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateUserRequest extends BaseAdminRequest {

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function rules(): array {
    return [
      'first_name' => 'required|string|min:2',
      'last_name' => 'required|string|min:2',
      'phone_number' => [
        'required',
        'string',
        'min:12',
        'max:12',
        new JordanianNumber(),
        'unique:users,phone_number,' . $this->user->id,
      ],
      'email' => 'required|email|unique:users,email,' . $this->user->id,
      'gender' => 'required|in:male,female',
      'wallet_balance' => 'required|integer|min:0',
      'reward_points' => 'required|integer|min:0',
      'password' => 'confirmed',
      'status' => 'required|in:0,1,2',
    ];
  }

}
