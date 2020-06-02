<?php

namespace App\Http\Requests\Api\User;

use App\Enums\UserType;
use App\Http\Requests\BaseApiRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class UpdateInformationRequest
 *
 * @property string name
 * @property int gender
 *
 * @property string land_line
 * @property string contact_person
 * @property string email
 *
 * @property int user_type
 *
 * @property UploadedFile image
 *
 * @package App\Http\Requests\UsersApi
 * @date 2019-06-23
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateInformationRequest extends BaseApiRequest
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
            'user_type' => 'required|numeric|in:0,1,2',
            'name' => 'required|string|min:5',
            'gender' => 'required_if:user_type,' . UserType::NORMAL . '|in:1,2',
            'land_line' => 'required_if:user_type,' . UserType::CORPORATE . '|string|min:7|numeric',
            'contact_person' => 'required_if:user_type,' . UserType::CORPORATE . '|string|min:5',
            'email' => 'required_if:user_type,' . UserType::CORPORATE . '|email',
            'image' => 'image',
        ];
    }
}
