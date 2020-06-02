<?php

namespace App\Http\Requests\Api\Order;

use App\Enums\OrderType;
use App\Http\Requests\BaseApiRequest;
use http\Exception\InvalidArgumentException;
use Illuminate\Validation\Rule;

/**
 * Class CreateOrderRequest
 *
 * @property string type
 * @property int location
 * @property string pickup_time
 * @property array recycle_request
 *
 * @package App\Http\Requests\Api\Order
 * @date 2019-07-03
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateOrderRequest extends BaseApiRequest
{

    /**
     * Return locations table based on order type
     *
     * @return string|null
     * @throws \InvalidArgumentException
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function locationsTable(): string
    {
        switch ($this->type) {
            case OrderType::PICKUP:
                return 'user_locations';
            case OrderType::DROP_OFF:
                return 'pickup_locations';
            default:
                throw new InvalidArgumentException('Invalid order type.');
        }
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
            'type' => 'required|numeric|in:1,2',
            'location' => [
                'required',
                'numeric',
                Rule::exists($this->locationsTable(), 'id'),
            ],
            'pickup_time' => 'date',
            'recycle_request' => 'required|array',
        ];

        foreach ($this->recycle_request as $key => $value) {
            $rules['recycle_request.' . $key . '.id'] = 'required|numeric|exists:categories,id';
            $rules['recycle_request.' . $key . '.parent_id'] = 'required|numeric|exists:categories,id';
            $rules['recycle_request.' . $key . '.amount'] = 'required|numeric';
        }

        return $rules;
    }
}
