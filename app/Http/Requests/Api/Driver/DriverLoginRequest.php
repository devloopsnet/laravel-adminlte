<?php

namespace App\Http\Requests\Api\Driver;

use App\Http\Requests\BaseApiRequest;

/**
 * Class DriverLoginRequest
 *
 * @property string email
 * @property string password
 * @property string firebase_token
 *
 * @package App\Http\Requests\Api\Driver
 * @date 2019-07-08
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class DriverLoginRequest extends BaseApiRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6',
            'firebase_token' => 'required|string',
        ];
    }
}
