<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;

class Breakdown extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'breakdown';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'estimate_id',
        'construction_id',
        'construction_item',
        'specification',
        'quantity',
        'unit',
        'unit_price',
        'amount',
        'remarks',
        'construction_name',
    ];

    public function estimate_info()
    {
        return $this->belongsTo(EstimateInfo::class, 'estimate_info_id');
    }

    public function construction_name()
    {
    return $this->belongsTo('App\Models\ConstructionName');
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'estimate_id', 'id');
    }

    public function estimate()
    {
        return $this->belongsTo(Estimate::class,'estimate_id','id');
    }

    public function regist_breakdown($request)
    {
        $datas = [];

        for($i=1; $i <= $request->construction_loop_count; $i++) {
            $data = [];
            $data['estimate_id'] = $request->estimate_id;
            $data['construction_id'] = $request->construction_id;
            $data['construction_item'] = $request->construction_item[$i];
            $data['specification'] = $request->specification[$i];
            $data['quantity'] = $request->quantity[$i];
            $data['unit'] = $request->unit[$i];
            $data['unit_price'] = $request->unit_price[$i];
            $data['amount'] = $request->amount[$i];
            $data['remarks'] = $request->remarks2[$i];

            $datas[] = $data;
        }

        return $this->insert($datas);
    }

    public static function getBreakdownsByEstimateId($estimateId)
{
    return self::where('estimate_id', $estimateId)->get();
}

//内訳明細書
// Breakdown.php
public function getBreakdownByEstimateId($estimateId)
{
    return $this->where('estimate_id', $estimateId)->get();
}

// for updateDiscount method on ManagerController
// Breakdown.php
public function breakdownByEstimateId($estimateId)
{
    return $this->where('estimate_id', $estimateId)->get();
}

//pdf method on the ManagerController
public function fetchBreakdownsByEstimateId($estimateId)
    {
        return $this->where('estimate_id', $estimateId)->get();
    }

    //PDFshow on ManagerController
    public function fetchingBreakdownsByEstimateId($estimateId)
{
    return $this->where('estimate_id', $estimateId)->get();
}

}
