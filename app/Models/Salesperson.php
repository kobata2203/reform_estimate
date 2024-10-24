<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SalespersonController;

class Salesperson extends Model
{
    use HasFactory;

    protected $table = 'salesperson'; // Ensure this matches the table name in your migration



    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
