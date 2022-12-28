<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => [
                'required',
                'max:255',
            ],
            'publisher_id' => [
                'required',
                'max:30',
                Rule::exists('publishers', 'id')
            ],
            'category_id' => [
                'required',
                'max:30',
                Rule::exists('categories', 'id')
            ],
            'author_name' => [
                'required',
                'max:30'
            ],
            'pages' => [
                'required',
            ],
            'type' => [
                'required',
                'max:30',
            ],
        ];
    }
}
