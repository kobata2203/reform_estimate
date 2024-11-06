<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Admin;

class LoginRequest extends FormRequest
{
    public function __construct()
    {
        $this->user = new User();
        $this->admin = new Admin();
    }

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
        // デフォルト外のバリデートは独自処理を作成して呼び出す
        return [
            'id'         => 'required',
            'name.*'     => 'required',
            'department_name.*' => 'required',
            'email.*'     => 'required|max:30',
            'password.*'  => 'required|min:8|max:10',
        ];
    }
}
