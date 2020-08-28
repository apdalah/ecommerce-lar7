<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' => 'required | string | max:100',
            'abbr' => 'required | string | max:10',
            'direction' => 'required | in:rtl,ltr',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'in' => 'القيم المدخله غير صحيحه',
            'name.max' => 'يجب ان لا يزيد اسم اللغه عن 100 حرف',
            'abbr.max' => 'يجب ان لا يزيد الاختصار عن 10 احرف'
        ];
    }
}
