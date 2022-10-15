<?php

namespace App\Http\Requests\admin;

use App\Rules\customer\numberPhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class adminRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullName'      => 'required|max:30',
            'name'          => 'required|unique:users|max:15',
            'email'         => 'required|unique:users|email:rfc,dns|max:25',
            'Numberphone'   => ['required',
                                'numeric',
                                'digits_between:10,13',
                                new numberPhoneRule()],
            'password'      => 'required',
            'roles'         => 'required',
        ];
    }


    /**
    * Get the validation messages that apply to the request.
    *
    * @return array
    */
    public function messages()
    {
        return [
           'roles.required' => 'Choose a role.',
        ];
    }
}
