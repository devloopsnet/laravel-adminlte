<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseApiRequest;

/**
 * Class SendOtpRequest
 *
 * @property string phone_number
 *
 * @package App\Http\Requests
 * @date 2019-06-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class SendOtpRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function rules(): array
    {
        return [
            'phone_number' => 'required|string|min:13|max:13'//|exists:users,phone_number',
        ];
    }
}
