<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin1 extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'admins';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'customer_name',
        'construction_name',
        'charger_name',
        'department_name',
        'creation_date',
        'expiration_date',
    ];

    // Define the attributes that should be hidden for arrays
    protected $hidden = [
        
        'remember_token',
    ];

    // Define the dates that should be mutated to Carbon instances
    protected $dates = [
        'email_verified_at',
    ];
}
