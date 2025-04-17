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
            'name' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'email' => [
                'required',
                'string',
                'email',
                'max:30',
                Rule::unique('users', 'email')->ignore($this->route('id')),
            ],
            'password' => 'required|string|min:6|max:32',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'role' => User::ROLE_ADMIN,
        ]);
    }
}
