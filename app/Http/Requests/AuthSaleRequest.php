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

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
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
