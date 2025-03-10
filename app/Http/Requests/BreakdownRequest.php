<?php

namespace App\Http\Requests;

use App\Models\Breakdown;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ConstructionItem;
use App\Rules\ConstructionItemRequired;

class BreakdownRequest extends FormRequest
{
    protected $construction_item;
    protected $breakdown;
    public function __construct(
        ConstructionItem $constructionItem,
        Breakdown $breakdown
    )
    {
        $this->construction_item = $constructionItem;
        $this->breakdown = $breakdown;
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
            'estimate_id'   => 'required',
            'item.*'        => 'required|max:30',
            'maker.*'       => [new ConstructionItemRequired($this->all(), 'maker', $this->construction_item), 'max:30'],
            'series_name.*' => [new ConstructionItemRequired($this->all(), 'series_name', $this->construction_item), 'max:30'],
            'item_number.*' => [new ConstructionItemRequired($this->all(), 'item_number', $this->construction_item), 'max:30'],
            'quantity.*'    => 'required|integer|min:1|max:20',
            'unit.*'        => 'required|max:5',
            'unit_price.*'  => 'required|integer|min:1|max:9999999',
            'amount.*'      => 'required|integer|min:1|max:9999999',
            'remarks.*'     => [new ConstructionItemRequired($this->all(), 'remarks', $this->construction_item), 'max:30'],
        ];
    }
}
