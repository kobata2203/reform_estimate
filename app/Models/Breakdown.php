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

    public function estimateInfo()
    {
        return $this->belongsTo(EstimateInfo::class, 'estimate_id');
    }


    public function estimate_info()
    {
        return $this->belongsTo(EstimateInfo::class, 'estimate_info_id');
    }

    //changing estimates table to breakdown
    public function estimateCalculate()
    {
        return $this->hasMany(EstimateCalculate::class, 'estimate_id', 'id');
        // return $this->hasMany(EstimateCalculate::class, 'construction_list_id', 'id');
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

    public function getBreakdownList($construction_list_id)
    {
        $items = $this->select($this->fillable)->where('construction_list_id', $construction_list_id)->get();

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
            $keys = array_keys($request->item);

            foreach ($keys  as $value) {
                $data = [];
                $data['estimate_id'] = $request->estimate_id;
                $data['construction_list_id'] = $request->construction_list_id;
                $data['item'] = $request->item[$value];
                $data['maker'] = $request->maker[$value];
                $data['series_name'] = $request->series_name[$value];
                $data['item_number'] = $request->item_number[$value];
                $data['quantity'] = $request->quantity[$value];
                $data['unit'] = $request->unit[$value];
                $data['unit_price'] = $request->unit_price[$value];
                $data['amount'] = $request->amount[$value];
                $data['remarks'] = $request->remarks[$value];

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

    public function breakdownByEstimateId($estimateId)
    {
        return $this->where('estimate_id', $estimateId)->get();
    }

    public function fetchBreakdownsByEstimateId($estimateId)
    {
        return $this->where('estimate_id', $estimateId)->get();
    }

    public function fetchingBreakdownsByEstimateId($estimateId)
    {
        return $this->where('estimate_id', $estimateId)->get();
    }

    public static function getTotalAmountByEstimateId($estimateId)
    {
        $breakdown = self::where('estimate_id', $estimateId)->get();
        $totalAmount = $breakdown->sum('amount');
        return $totalAmount;
    }

    public static function getByEstimateId($id)
    {
        return self::where('estimate_id', $id)->get();
    }

    public function getBreakdownsByEstimateId($estimateId)
    {
        return $this->where('estimate_id', $estimateId)->get();
    }

    public function constructionList()
    {
        return $this->belongsTo(ConstructionList::class, 'construction_list_id');
    }

    public function getBreakdownsByConstructionId($construction_list_id)
    {
        return $this->where('construction_list_id', $construction_list_id)->get();
    }

    //estimate_idとconstruction_list_idで分けてbreakdownのデータを表示
    public function scopeByConstructionAndEstimate($query, $constructionId, $estimateId)
    {
        return $query->where('construction_list_id', $constructionId)
            ->where('estimate_id', $estimateId)
            ->whereHas('constructionList', function ($query) use ($estimateId) {
                $query->where('estimate_info_id', $estimateId);
            });
    }

    public function breakdownByEstimateIdAndConstructionId($estimate_id, $construction_list_id)
    {
        return $this->where('estimate_id', $estimate_id)
            ->where('construction_list_id', $construction_list_id)
            ->get();
    }



}
