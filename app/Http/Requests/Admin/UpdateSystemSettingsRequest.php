<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseAdminRequest;

/**
 * Class UpdateSystemSettingsRequest
 *
 * @property string user_percentage
 * @property double cash_out_threshold
 * @property double minimum_order_weight
 *
 * @package App\Http\Requests\Admin
 * @date 2019-07-13
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateSystemSettingsRequest extends BaseAdminRequest
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

        ];
    }
}
