<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\BaseApiRequest;

/**
 * Class RateOrderUserRequest
 *
 * @property double quality_rate
 * @property double quantity_rate
 * @property double behaviour_rate
 * @property string comment
 *
 * @package App\Http\Requests\Api\Order
 * @date 2019-07-22
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class RateOrderUserRequest extends BaseApiRequest
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
            'quality_rate' => 'required|numeric|min:1|max:5',
            'quantity_rate' => 'required|numeric|min:1|max:5',
            'behaviour_rate' => 'required|numeric|min:1|max:5',
            'comment' => 'string',
        ];
    }
}
