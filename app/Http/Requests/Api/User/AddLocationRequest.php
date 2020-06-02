<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseApiRequest;

/**
 * Class AddLocationRequest
 *
 * @property string title
 * @property double lat
 * @property double lng
 *
 * @package App\Http\Requests\Api\User
 * @date 2019-06-27
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class AddLocationRequest extends BaseApiRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ];
    }
}
