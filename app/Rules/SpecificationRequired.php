<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\ConstructionItem;

class SpecificationRequired implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($input_data)
    {
        $this->input_data = $input_data;
        $this->constructionItem = new ConstructionItem();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        dd($this->input_data);
        // 入力値の取得
        $splits = explode('.', $attribute);
        $loop_no = $splits[1];

        // 必須要否の確認
        $res = $this->constructionItem->get_required($this->input_data['construction_item'][$loop_no]);

        if(empty($input_data['specification'][$loop_no]) && !empty($res)){
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.required');
    }
}
