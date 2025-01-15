<?php
namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Validator;



class Login extends Model
{
    protected $fillable = ['email', 'password'];
    protected $errors;

    public function validate(array $params)
    {
        $validator = Validator::make($params, [
            'email' => array('required', 'email'),
            'password' => 'required',
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

