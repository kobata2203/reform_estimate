<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Return true to authorize the request
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6',
            'department_name' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '管理者名は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.unique' => 'そのメールアドレスはすでに使用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは6文字以上でなければなりません。',
            'department_name.required' => '部署名は必須です。',
        ];
    }
}
