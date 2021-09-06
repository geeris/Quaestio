<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StarterQuestionRequest extends FormRequest
{
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
            'starterQuestion' => 'min:5|unique:question,text',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
