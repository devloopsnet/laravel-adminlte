<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseAdminRequest;


/**
 * Class LoginRequest
 *
 * @property string email
 * @property string password
 *
 * @package App\Http\Requests\Admin
 * @date 2019-06-23
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class LoginRequest extends BaseAdminRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function authorize(): bool {
        return admin() === null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function rules(): array {
        return [
            'email'    => 'required|email|exists:admins,email',
            'password' => 'required|min:6',
        ];
    }
}
