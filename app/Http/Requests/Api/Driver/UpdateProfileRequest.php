<?php

namespace App\Http\Requests\Api\Driver;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class UpdateProfileRequest
 *
 * @property string name
 * @property string email
 * @property UploadedFile avatar
 *
 * @package App\Http\Requests\Api\Driver
 * @date 2019-07-15
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateProfileRequest extends BaseApiRequest
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
            'name' => 'required|min:6|string',
            'email' => 'required|email',
            'avatar' => 'image',
        ];
    }
}
