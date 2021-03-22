<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order.total_amount' => 'required',
            'order.sub_total_amount' => 'required',
            'order.delivery_fee' => 'required',
            'order.number_of_items' => 'required',
            'order.name' => 'required',
            'order.email' => 'required',
            'order.phone' => 'required',
            'order.country' => 'required',
            'order.state' => 'required',
            'order.lga' => 'required',
            'order.address' => 'required',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required',
            'items.*.product_name' => 'required',
            'items.*.quantity' => 'required',
            'items.*.size' => 'required',
            'items.*.color' => 'required',
            'items.*.product_price' => 'required',
        ];
    }
}
