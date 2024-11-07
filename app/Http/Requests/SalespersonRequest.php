<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalespersonRequest extends FormRequest
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
            'name'           => 'required|string|max:255',
            'department_name' => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users,email,' . $this->route('id'),
            'password'       => 'required|string|min:6',
        ];
    }

    /**
     * Get custom error messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required'           => 'Name is required.',
            'department_name.required' => 'Department name is required.',
            'email.required'          => 'Email is required.',
            'email.unique'            => 'This email is already in use.',
            'password.required'       => 'Password is required.',
            'password.min'            => 'Password must be at least 6 characters.',
        ];
    }
}
