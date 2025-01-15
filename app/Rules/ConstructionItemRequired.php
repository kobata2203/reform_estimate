<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConstructionItemRequired implements Rule
{
    protected $input_data;
    protected $column_name;
    protected $construction_item;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        $input_data,
        $column_name,
        $construction_item
    )
    {
        $this->input_data = $input_data;
        $this->column_name = $column_name;
        $this->construction_item = $construction_item;
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
        // 入力値の取得
        $splits = explode('.', $attribute);
        $loop_no = $splits[1];

        // 必須要否の確認
        $res = $this->construction_item->get_required($this->input_data['item'][$loop_no], $this->input_data['construction_id'], $this->column_name);

        if(empty($this->input_data[$this->column_name][$loop_no]) && !empty($res)){
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
