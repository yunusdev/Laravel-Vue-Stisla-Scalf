<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddItemsToCartRequest extends FormRequest
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
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required',
            'items.*.product_name' => 'required',
            'items.*.quantity' => 'required',
            'items.*.size' => 'required',
            'items.*.color' => 'required',
            'items.*.product_price' => 'required',
//            'items.*.amount' => 'required',
        ];
    }
}
