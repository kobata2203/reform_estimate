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
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($this->route('id')),
            ],
            'password' => 'required|string|min:8',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'role' => User::ROLE_ADMIN,
        ]);
    }
}
