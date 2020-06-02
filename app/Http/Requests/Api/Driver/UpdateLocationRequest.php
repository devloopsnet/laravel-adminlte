<?php

namespace App\Http\Requests\Api\Driver;

use App\Http\Requests\BaseApiRequest;

/**
 * Class UpdateLocationRequest
 *
 * @property double lat
 * @property double lng
 *
 * @package App\Http\Requests\Api\Driver
 * @date 2019-07-12
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateLocationRequest extends BaseApiRequest
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
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ];
    }
}
