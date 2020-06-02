<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseAdminRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class UpdateAppSettingsRequest
 *
 * @property string support_email
 * @property string mobile_phone
 * @property string land_line
 * @property string ios_app_url
 * @property string android_app_url
 * @property string twitter_account
 * @property string facebook_account
 * @property string instagram_account
 * @property string youtube_account
 * @property string linkedin_account
 * @property string brief
 * @property string address
 * @property string faq
 * @property string brief_ar
 * @property string address_ar
 * @property string faq_ar
 * @property UploadedFile privacy_policy
 * @property UploadedFile terms_conditions
 *
 * @package App\Http\Requests\Admin
 * @date 2019-07-13
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateAppSettingsRequest extends BaseAdminRequest
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
            /*'support_email' => 'email',
            'mobile_phone' => 'numeric',
            'land_line' => 'numeric',
            'address' => 'string',
            'address_ar' => 'string',
            'brief' => 'string',
            'brief_ar' => 'string',
            'faq' => 'string',
            'faq_ar' => 'string',
            'twitter_account' => 'string|url',
            'facebook_account' => 'string|url',
            'instagram_account' => 'string|url',
            'privacy_policy' => 'file',
            'terms_conditions' => 'file',*/
        ];
    }
}
