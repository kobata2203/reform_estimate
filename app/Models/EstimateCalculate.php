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

    public static function getEstimateCalculateByEstimateId($estimateId)
{
    return self::where('estimate_id', $estimateId)->first();
}

// EstimateCalculate.php
public function getDiscountByEstimateIds($id)
{
    return $this->where('estimate_id', $id)->first()->special_discount ?? 0;
}

//内訳明細書
// EstimateCalculate.php
public function getOrCreateEstimateCalculate($id)
{
    return $this->firstOrNew(['estimate_id' => $id]);
}

public function updateEstimateCalculate($estimateCalculate, $subtotal, $tax, $grandTotal)
{
    $estimateCalculate->subtotal_price = $subtotal;
    $estimateCalculate->consumption_tax = $tax;
    $estimateCalculate->total_price = $grandTotal;

    return $estimateCalculate->save();
}

// updateDiscount on ManagerController
public function createOrGetEstimateCalculate($id)
{
    return $this->firstOrNew(['estimate_id' => $id]);
}

public function estimateCalculateUpdate($estimateCalculate, $subtotal, $tax, $grandTotal)
{
    $estimateCalculate->subtotal_price = $subtotal;
    $estimateCalculate->consumption_tax = $tax;
    $estimateCalculate->total_price = $grandTotal;

    return $estimateCalculate->save();
}


//PDFshow on the ManagerController
public function fetchEstimateCalculateByEstimateId($estimateId)
{
    return $this->where('estimate_id', $estimateId)->first();
}

//show method on the ManagerCOntroller
// EstimateCalculate.php
public static function getDiscountByEstimateId($estimateId)
{
    $estimateCalculate = self::where('estimate_id', $estimateId)->first();
    return $estimateCalculate ? $estimateCalculate->special_discount : 0;
}

}
