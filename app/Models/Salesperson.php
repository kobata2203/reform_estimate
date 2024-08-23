<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SalespersonController;

class Salesperson extends Model
{
    protected $fillable = ['id', 'name', 'department_name','password'];
}
