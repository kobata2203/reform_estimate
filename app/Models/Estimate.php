<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;

    protected $table = 'estimates';
    

    protected $fillable = [
        'issued_date',
        'customer_name',
        'work_name',
        'salesperson',
        'department',
        'estimate_id',
        'construction_name',
        'construction_id',
        'construction_item',
        'specification',
        'quantity',
        'unit',
        'unit_price',
        'amount',
        'remarks'
    ];
    public function breakdown()
    {
        return $this->hasMany(Breakdown::class);  // Adjust based on your actual table/model
    }
}
