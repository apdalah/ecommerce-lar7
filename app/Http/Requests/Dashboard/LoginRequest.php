<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required | email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'البريد الالكترونى مطلوب',
            'email.email' => 'برجاء ادخال بريد الكترونى صالح',
            'password.required' => 'كلمة المرور مطلوبه',
        ];
    }
}
