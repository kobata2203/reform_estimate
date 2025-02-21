<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AuthSaleRequest extends FormRequest
{
    public function __construct()
    {
        $this->user = new User();
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
            //'id'         => 'required',
            //'name.*'     => 'required',
            //'department_name.*' => 'required',
            'email.*'     => 'required|max:30',
            'password.*'  => 'required|min:8|max:10',
        ];
    }

    public function isSale(): bool
    {
        return $this->user->where('email', $this->input('email'))
                          ->where('role', User::ROLE_SALES)
                          ->exists();
    }
}
