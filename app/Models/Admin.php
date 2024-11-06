<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use database\seeders\Adminseeder;


class Admin extends User
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'department_name',
        'email',
        'password',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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







