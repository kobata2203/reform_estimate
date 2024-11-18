<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;
use Illuminate\Support\Facades\DB;

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
    ];

    public function estimate_info()
    {
        return $this->belongsTo(EstimateInfo::class, 'estimate_info_id');
    }

    //changing estimates table to breakdown
    public function estimateCalculate()
    {
        return $this->hasMany(EstimateCalculate::class, 'estimate_id', 'id');
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
        return $this->belongsTo(Estimate::class, 'estimate_id', 'id');
    }

    public function get_breakdown_list($estimate_id)
    {
        $items = $this->select($this->fillable)->where('construction_id', $estimate_id)->get();

        return $items;

    }

    public function regist_breakdown($request)
    {
        $datas = [];

        for ($i = 1; $i <= $request->construction_loop_count; $i++) {
            $data = [];
            $data['estimate_id'] = $request->estimate_id;
            $data['construction_id'] = $request->construction_id;
            $data['construction_item'] = $request->construction_item[$i];
            $data['specification'] = $request->specification[$i];
            $data['quantity'] = $request->quantity[$i];
            $data['unit'] = $request->unit[$i];
            $data['unit_price'] = $request->unit_price[$i];
            $data['amount'] = $request->amount[$i];
            $data['remarks'] = $request->remarks[$i];

            $datas[] = $data;
        }

        return $this->insert($datas);
    }

    public function update_breakdown($request)
    {
        try {
            DB::beginTransaction();

            for ($i = 1; $i <= $request->construction_loop_count; $i++) {
                $data = [];
                $data['construction_item'] = $request->construction_item[$i];
                $data['specification'] = $request->specification[$i];
                $data['quantity'] = $request->quantity[$i];
                $data['unit'] = $request->unit[$i];
                $data['unit_price'] = $request->unit_price[$i];
                $data['amount'] = $request->amount[$i];
                $data['remarks'] = $request->remarks[$i];

                $where = array(
                    'estimate_id' => $request->estimate_id,
                    'construction_id' => $request->construction_id,
                );
                DB::table('breakdown')->where($where)->update($data);
            }

            DB::commit();

            return true;
        } catch (\Throwable $e) {
            DB::rollback();

            throw $e;
        }
    }


    /**
     * 見積書単位での削除処理
     * @param $estimate_id
     * @return false|void
     * @throws \Throwable
     */
    public function deleteBreakdownByEstimateId($estimate_id)
    {
        try {
            $this->where('estimate_id', $estimate_id)
                ->update(['delete_flag' => true]);

            return true;
        } catch (\Throwable $e) {
            throw $e;
        }
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


    //show method on ManagerController p2
    // Breakdown.php
    public static function getTotalAmountByEstimateId($estimateId)
    {
        $breakdown = self::where('estimate_id', $estimateId)->get();
        $totalAmount = $breakdown->sum('amount'); // Summing up directly in the query
        return $totalAmount;
    }


    //nocalculation
    // In Breakdown.php model
    public static function getByEstimateId($estimateId)
    {
        return self::where('estimate_id', $estimateId)->get();
    }

}
