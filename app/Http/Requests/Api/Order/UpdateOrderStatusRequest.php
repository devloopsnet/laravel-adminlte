<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\BaseApiRequest;

/**
 * Class DriverUpdateOrderStatusRequest
 *
 * @property int status
 *
 * @package App\Http\Requests\Api\Driver
 * @date 2019-07-09
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateOrderStatusRequest extends BaseApiRequest
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
            'status' => 'required|numeric|in:2,3,4',
        ];
    }
}
