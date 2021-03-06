<?php

namespace App\Http\Requests\Shop\Cart;

use App\Http\Requests\Request;

class CartAddRequest extends Request
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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'options' => 'array'
        ];
    }
}
