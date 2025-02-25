<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
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

    public function rules()
    {
        return [
            'name' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'email' => [
                'required',
                'string',
                'email',
                'max:30',
                Rule::unique('users', 'email')->ignore($this->route('id')),
            ],
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は20文字以内で入力してください。',
            'department_id.required' => '部署の選択は必須です。',
            'department_id.exists' => '選択した部署が存在しません。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'email.max' => 'メールアドレスは30文字以内で入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'role' => User::ROLE_ADMIN, 
        ]);
    }
}

