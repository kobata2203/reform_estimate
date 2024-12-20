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
        'item',
        'maker',
        'series_name',
        'item_number',
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

    public function getBreakdownList($estimate_id)
    {
        $items = $this->select($this->fillable)->where('estimate_id', $estimate_id)->get();

        return $items;

    }

    /**
     * 内訳明細の初期処理用ダミーデータをセット
     * @return array
     */
    public function setDummyData($old = null)
    {
        $item = [];
        if (is_array($old)) {
            foreach ($old as $key => $old_item) {
                if (in_array($key, $this->fillable)) {
                    if (is_array($old_item)) {
                        foreach ($old_item as $old_item_key => $value) {
                            $item[$old_item_key][$key] = $value;
                        }
                    }
                }
            }

            $datas = json_decode(json_encode($item));
        } else {
            foreach ($this->fillable as $field) {
                $item[$field] = null;
            }

            $datas[] = (object) $item;
        }

        return $datas;
    }

    public function registBreakdown($request)
    {
        try {
            // 既存データの削除
            $where = [
                ['estimate_id', '=', $request->estimate_id],
                ['construction_list_id', '=', $request->construction_list_id],
            ];

            $this->where($where)->delete();

            $datas = [];

            $loop_count = count($request->item);
            for ($i = 0; $i < $loop_count; $i++) {
                $data = [];
                $data['estimate_id'] = $request->estimate_id;
                $data['construction_list_id'] = $request->construction_list_id;
                $data['item'] = $request->item[$i];
                $data['maker'] = $request->maker[$i];
                $data['series_name'] = $request->series_name[$i];
                $data['item_number'] = $request->item_number[$i];
                $data['quantity'] = $request->quantity[$i];
                $data['unit'] = $request->unit[$i];
                $data['unit_price'] = $request->unit_price[$i];
                $data['amount'] = $request->amount[$i];
                $data['remarks'] = $request->remarks[$i];

                $datas[] = $data;
            }

            return $this->insert($datas);
        } catch (\Throwable $th) {
            throw $th;
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

    // public static function getBreakdownsByEstimateId($estimateId)
    // {
    //     return self::where('estimate_id', $estimateId)->get();
    // }

    //内訳明細書
    // Breakdown.php
    // public function getBreakdownByEstimateId($estimateId)
    // {
    //     return $this->where('estimate_id', $estimateId)->get();
    // }

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

    public static function getTotalAmountByEstimateId($estimateId)
    {
        $breakdown = self::where('estimate_id', $estimateId)->get();
        $totalAmount = $breakdown->sum('amount'); // Summing up directly in the query
        return $totalAmount;
    }

    public static function getByEstimateId($estimateId)
    {
        return self::where('estimate_id', $estimateId)->get();
    }


    //pdf method on the ManagerController
    public function getBreakdownsByEstimateId($estimateId)
    {
        return $this->where('estimate_id', $estimateId)->get();
    }
//20241219
    public function constructionList()
    {
        return $this->belongsTo(ConstructionList::class, 'construction_list_id');
    }

}
