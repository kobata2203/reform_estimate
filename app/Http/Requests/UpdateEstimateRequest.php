<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstimateRequest extends FormRequest
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

     //ManagerController updateDiscount
    public function rules()
    {
        return [
            'special_discount' => 'required|numeric|min:0', // Ensure it's a valid number
        ];
    }

    public function messages()
    {
        return [
            'special_discount.required' => '割引額は必須です。',
            'special_discount.numeric' => '割引額は数字で入力してください。',
            'special_discount.min' => '割引額は0以上である必要があります。',
        ];
    }
}

