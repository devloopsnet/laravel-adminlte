<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseUserRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginRequest
 *
 * @property string username
 * @property string password
 *
 * @package App\Http\Requests\User
 * @date 12/1/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class LoginRequest extends BaseUserRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return Auth::guard( 'user' )->user() === null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'username' => 'required|min:3',//|exists:users,username',
            'password' => 'required'
        ];
    }
}
