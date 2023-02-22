<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
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
            'customer_name' => [
                'required',
                'max:255',
            ],
            'customer_address' => [
                'required',
                'max:255',
            ],
            'customer_contact' => [
                'required',
                'max:11',
                'min:10',
            ],
            'price' => [
                'required',
                'integer'
            ],
            'discount_price' => [
                'required',
                'integer'
            ],
            'applied_voucher' => [
                Rule::exists('vouchers', 'id'),
            ],
            'order_items_list' => [
                'required',
                'string'
            ]
        ];
    }
}
