<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'email' => 'required|email|max:255' ,
            'password' => 'required|regex:/^[0-9a-zA-Z]*$/',
            
            // 'password' => 'required|regex:/^[a-zA-Z0-9-]+$/' ,
        ];
    }
}
