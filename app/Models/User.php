<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Auth\UserController;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     *
     */

     protected $table = 'users'; // Specify the table name if different
     protected $fillable = [
        'name',
        'department_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
