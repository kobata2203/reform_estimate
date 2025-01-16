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


    public function rules()
    {
        return [
            'special_discount' => 'nullable|numeric|max:1000000',
        ];
    }
    public function messages()
    {
        return [
            'special_discount.required' => config('message.regist_complete'),
            'special_discount.numeric' => config('message.update_fail'),
            'special_discount.max' => 'お値引き金額は1,000,000円を超えることはできません。',
        ];
    }


}
