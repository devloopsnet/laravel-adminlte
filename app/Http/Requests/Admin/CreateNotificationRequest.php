<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseAdminRequest;

/**
 * Class CreateNotificationRequest
 *
 * @property string send_to
 * @property array drivers
 * @property array users
 * @property string title_en
 * @property string title_ar
 * @property string body_en
 * @property string body_ar
 *
 * @package App\Http\Requests\Admin
 * @date 2019-07-16
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateNotificationRequest extends BaseAdminRequest
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
            'send_to' => 'required|string|in:all,drivers,users',
            'drivers' => 'required_if:send_to,all,drivers|array',
            'users' => 'required_if:send_to,all,users|array',
            'title_en' => 'required|string|min:7',
            'title_ar' => 'required|string|min:7',
            'body_en' => 'required|string|min:7',
            'body_ar' => 'required|string|min:7',
        ];
    }
}
