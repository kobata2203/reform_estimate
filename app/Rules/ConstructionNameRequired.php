<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConstructionNameRequired implements Rule
{
    protected $regist_type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        $regist_type
    )
    {
        $this->regist_type = $regist_type;
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
        if($this->regist_type ==  config('util.regist_type_create') && empty($value)) {
            return false;
        } elseif ($this->regist_type ==  config('util.regist_type_edit') || !empty($value)) {
            return true;
        } else {
            return false;
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
