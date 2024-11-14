<?php

namespace App\Http\Requests;

use App\Models\Breakdown;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ConstructionItem;
use App\Rules\SpecificationRequired;

class BreakdownRequest extends FormRequest
{
    protected $constructionItem;
    protected $breakdown;
    public function __construct()
    {
        $this->constructionItem = new ConstructionItem();
        $this->breakdown = new Breakdown();
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
            'estimate_id'         => 'required',
            'construction_id'     => 'required',
            'construction_item.*' => 'required',
            'specification.*'     => [new SpecificationRequired($this->all()), 'max:30'],
            'quantity.*'          => 'required|integer|min:1|max:20',
            'unit.*'              => 'required|max:5',
            'unit_price.*'        => 'required|integer|min:1|max:9999999',
            'amount.*'            => 'required|integer|min:1',
            'remarks2.*'          => 'max:30',
        ];
    }
}
