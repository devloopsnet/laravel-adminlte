<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseAdminRequest;
use App\Rules\JordanianNumber;
use Illuminate\Foundation\Http\FormRequest;
use function GuzzleHttp\Psr7\str;

/**
 * Class CreateUserRequest
 *
 * @property string first_name
 * @property string last_name
 * @property string phone_number
 * @property string email
 * @property string gender
 * @property int    wallet_balance
 * @property int    reward_points
 * @property int    status
 * @property string password
 * @property string password_confirmation
 *
 *
 * @package App\Http\Requests\Admin\User
 * @date 2/9/20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateUserRequest extends BaseAdminRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(): array {
		return [
			'first_name'     => 'required|string|min:2',
			'last_name'      => 'required|string|min:2',
			'phone_number'   => [
				'required',
				'string',
				'min:12',
				'max:12',
				new JordanianNumber,
				'unique:users,phone_number'
			],
			'email'          => 'required|email|unique:users,email',
			'gender'         => 'required|in:male,female',
			'wallet_balance' => 'required|integer|min:0',
			'reward_points'  => 'required|integer|min:0',
			'password'       => 'required|confirmed|min:6',
			'status'         => 'required|in:0,1,2'
		];
	}
}
