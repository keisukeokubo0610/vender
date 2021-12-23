<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required|regex:/^[0-9a-zA-Z]*$/',
            'stock' => 'required|regex:/^[0-9a-zA-Z]*$/',
            // 'comment' => 'required',
            // 'img_path' => 'required',

        ];
    }
}
