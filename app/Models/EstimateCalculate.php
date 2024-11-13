<?php

namespace App\Models;

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
    //added forchanging foreignid  from estimate to breakdown
    public function breakdown()
    {
        return $this->belongsTo(Breakdown::class, 'estimate_id', 'id');
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
    public static function getDiscountByEstimateId($estimateId)
    {
        $estimateCalculate = self::where('estimate_id', $estimateId)->first();
        return $estimateCalculate ? $estimateCalculate->special_discount : 0;
    }

    // In EstimateCalculate.php model
    public static function getOrCreateByEstimateId($estimateId)
    {
        return self::firstOrNew(['estimate_id' => $estimateId]);
    }

    public function updateCalculations($subtotal, $tax, $total)
    {
        $this->subtotal_price = $subtotal;
        $this->consumption_tax = $tax;
        $this->total_price = $total;
        $this->save();
    }
    //managercontroller pdf method for showing into pdf
    public static function fetchCalculationByEstimateId($estimate_id)
    {
        return self::where('estimate_id', $estimate_id)->first();
    }


}
