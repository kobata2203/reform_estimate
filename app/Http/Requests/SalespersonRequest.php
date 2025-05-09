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
            'name' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'email' => 'required|string|email|max:30|unique:users,email,' . $this->route('id'),
            'password' => 'required|string|min:6|max:32',
        ];
    }
}
