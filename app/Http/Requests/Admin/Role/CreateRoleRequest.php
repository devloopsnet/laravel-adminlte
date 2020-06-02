<?php

namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\BaseAdminRequest;

/**
 * Class CreateRoleRequest
 *
 * @property string role_name
 * @property array permissions
 *
 * @package App\Http\Requests\Admin
 * @date 2019-06-25
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateRoleRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function rules(): array
    {
        return [
            'role_name' => 'required|string|min:5|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ];
    }
}
