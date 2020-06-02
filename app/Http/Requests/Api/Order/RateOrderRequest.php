<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\BaseApiRequest;

/**
 * Class RateOrderRequest
 *
 * @property double rating
 * @property string comment
 *
 * @package App\Http\Requests\Api\Order
 * @date 2019-07-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class RateOrderRequest extends BaseApiRequest
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
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'string|max:256',
        ];
    }
}
