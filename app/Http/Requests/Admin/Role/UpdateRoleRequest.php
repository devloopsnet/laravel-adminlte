<?php

namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\BaseAdminRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRoleRequest
 *
 * @property string role_name
 * @property array  permissions
 *
 * @package App\Http\Requests\Admin
 * @date 2019-06-25
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateRoleRequest extends BaseAdminRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function rules(): array {
        return [
            'role_name'     => [
                'required',
                'string',
                'min:5',
                Rule::unique( 'roles', 'name' )->ignore( $this->role_name, 'name' ),
            ],
            'permissions'   => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ];
    }
}
