<?php

namespace App\Http\Requests\Admin\Admin;

use App\Http\Requests\BaseAdminRequest;

/**
 * Class CreateAdminRequest
 *
 * @property string name
 * @property string email
 * @property string password
 * @property array  roles
 *
 * @package App\Http\Requests\Admin
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateAdminRequest extends BaseAdminRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function rules(): array {
        return [
            'name'     => 'required|string|min:5',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:6',
            'roles'    => 'required|array',
            'roles.*'  => 'exists:roles,name',
        ];
    }
}
