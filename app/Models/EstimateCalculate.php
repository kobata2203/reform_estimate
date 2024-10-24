<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateCalculate extends Model
{
    // Define the table associated with the model
    protected $table = 'estimate_calculate';

    // Define the fillable fields
    protected $fillable = [
        'estimate_id',
        'subtotal_price',
        'special_discount',
        'consumption_tax',
        'total_price',
    ];

    // Relationship with Estimate
    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'id', 'id');
    }

    public function estimate2()
    {
        return $this->belongsTo(Estimate::class, 'estimate_id', 'id');
    }
}
