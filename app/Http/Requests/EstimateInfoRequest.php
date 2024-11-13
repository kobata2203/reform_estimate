<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SpecificationRequired;

class EstimateInfoRequest extends FormRequest
{
    public function __construct(){}

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
            'customer_name'       => 'required|max:20',
            'charger_name'        => 'required|max:12',
            'subject_name'        => 'required|max:50',
            'delivery_place'      => 'required|max:50',
            'construction_period' => 'required|max:5',
            'payment_id'          => 'required',
            'expiration_date'     => 'required|max:5',
            'department_id'       => 'required',
            'remarks'             => 'required|max:100',
            'construction_name.*' => 'required|max:30',
        ];
    }
}
