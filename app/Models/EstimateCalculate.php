<?php

namespace App\Models;

use App\Models\Breakdown;
use Illuminate\Database\Eloquent\Model;

class EstimateCalculate extends Model
{

    protected $table = 'estimate_calculate';

    protected $fillable = [
        'estimate_id',
        'subtotal_price',
        'special_discount',
        'consumption_tax',
        'total_price',
        'construction_list_id'
    ];


    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'id', 'id');
    }

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

    //内訳明細書
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

    public function createOrgetEstimateCalculate($estimate_id, $construction_id)
    {
        return $this->firstOrNew(['estimate_id' => $estimate_id, 'construction_list_id' => $construction_id]);
    }

    public function estimateCalculateUpdate($estimateCalculate, $subtotal, $tax, $grandTotal)
    {

        $estimateCalculate->subtotal_price = $subtotal;
        $estimateCalculate->consumption_tax = $tax;
        $estimateCalculate->total_price = $grandTotal;

        return $estimateCalculate->save();
    }

    public function fetchEstimateCalculateByEstimateId($estimateId)
    {
        return $this->where('estimate_id', $estimateId)->first();
    }


    public static function getDiscountByEstimateId($estimateId)
    {
        $estimateCalculate = self::where('estimate_id', $estimateId)->first();
        return $estimateCalculate ? $estimateCalculate->special_discount : 0;
    }

    public static function getOrCreateByEstimateAndConstructionId($estimateId)
    {
        return self::firstOrNew([
            'estimate_id' => $estimateId
        ]);
    }

    public function updateCalculations($subtotal, $tax, $total)
    {
        $this->subtotal_price = $subtotal;
        $this->consumption_tax = $tax;
        $this->total_price = $total;
        $this->save();
    }

    public static function fetchCalculationByEstimateIdAndConstructionId($estimate_id, $construction_list_id)
    {
        return self::where('estimate_id', $estimate_id)
            ->where('construction_list_id', $construction_list_id)
            ->first();
    }

    public function constructionList()
    {
        return $this->belongsTo(ConstructionList::class, 'construction_list_id');
    }

    public function construction()
    {
        return $this->belongsTo(ConstructionList::class, 'construction_list_id');
    }

    public function getByConstructionListId($construction_list_id)
    {
        return self::where('construction_list_id', $construction_list_id)->get();
    }
    public static function getDiscountByEstimateIdAndConstructionId($estimateId, $constructionListId)
    {
        $estimateCalculate = self::where('estimate_id', $estimateId)
            ->where('construction_list_id', $constructionListId)
            ->first();
        return $estimateCalculate ? $estimateCalculate->special_discount : 0;
    }


}
