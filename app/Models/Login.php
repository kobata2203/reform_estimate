<?php
namespace App\Models;

use PHPUnit\Util\Xml\Validator;
use App\Http\Controllers\Auth\LoginController;

class Login extends Eloquent
{
    protected $fillable = ['email', 'password'];
    protected $errors;

    public function validate(array $params)
    {
        $validator = Validator::make($params, [
            'email' => array('required','email'),
            'password'  => 'required',
        ]);

        if ($validator->passes()) {
            return true;
        } else {
            $this->errors = $validator->messages();
            return false;
        }
    }

    public function errors()
    {
        return $this->errors;
    }
}

