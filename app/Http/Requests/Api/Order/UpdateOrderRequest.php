<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\BaseApiRequest;

/**
 * Class DriverUpdateOrderRequest
 *
 * @property array items
 *
 * @package App\Http\Requests\Api\Driver
 * @date 2019-07-09
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UpdateOrderRequest extends BaseApiRequest
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
        $rules = [
            'items' => 'required|array',
        ];

        foreach ($this->items as $key => $value) {
            $rules['items.' . $key . '.id'] = 'required|numeric|exists:order_items,id';
            $rules['items.' . $key . '.amount'] = 'required|numeric';
        }

        return $rules;
    }
}
