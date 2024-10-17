<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateCalculate extends Model
{
    use HasFactory;

    protected $table = 'estimate_calculate';

    protected $fillable = [
        'special_discount',
        'subtotal_price',
        'consumption_tax',
        'total_price',
    ];

    // Relationship with Estimate
    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'estimate_id', 'id');
    }
}
