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

    public function construction_name()
    {
    return $this->belongsTo('App\Models\ConstructionName');
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'estimate_id', 'id'); // Adjust the foreign key and local key as needed
    }

    public function estimate()
    {
        return $this->belongsTo(Estimate::class,'estimate_id','id');
    }

    public function get_breakdown_list($estimate_id)
    {
        $items = $this->select($this->fillable)->where('construction_id', $estimate_id)->get();

        return $items;

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
            $data['remarks'] = $request->remarks[$i];

            $datas[] = $data;
        }

        return $this->insert($datas);
    }

    public function update_breakdown($request)
    {
        $datas = [];

        try {
            DB::beginTransaction();

            for($i=1; $i <= $request->construction_loop_count; $i++) {
                $data = [];
                $data['construction_item'] = $request->construction_item[$i];
                $data['specification'] = $request->specification[$i];
                $data['quantity'] = $request->quantity[$i];
                $data['unit'] = $request->unit[$i];
                $data['unit_price'] = $request->unit_price[$i];
                $data['amount'] = $request->amount[$i];
                $data['remarks'] = $request->remarks[$i];

//                $datas[] = $data;

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

            dd($e->getMessage());
            throw $e;
        }
    }

}
