<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegister extends FormRequest
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
     */
    public function rules()
    {
        return [
            'username' => 'required|min:8|unique:user,username',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:user,email',
            'gender' => 'required'
        ];

    }

    public function messages()
    {
        return [

        ];
    }
}
