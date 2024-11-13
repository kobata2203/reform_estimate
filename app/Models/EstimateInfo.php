<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EstimateInfo extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'estimate_info';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_name',
        'creation_date',
        'construction_id',
        'construction_name',
        'delivery_place',
        'construction_period',
        'subject_name',
        'payment_type',
        'expiration_date',
        'remarks',
        'charger_name',
        'department_name',
    ]; // Add all relevant columns here

    public function construction_name()
    {
        return $this->belongsTo('App\Models\ConstructionName');
    }

    public function breakdowns()
    {
        return $this->hasMany(Breakdown::class, 'estimate_id');
    }



    public function constructionName()
    {
        return $this->belongsTo('App\Models\ConstructionName', 'construction_id', 'id');
    }


    public function regist_estimate_info($request)
    {


        $estimate_info = new EstimateInfo();

        $estimate_info->creation_date = date("Y年m月d日");
        $estimate_info->customer_name = $request->customer_name;
        $estimate_info->subject_name = $request->subject_name;
        $estimate_info->delivery_place = $request->delivery_place;
        $estimate_info->construction_period = $request->construction_period;
        $estimate_info->payment_type = $request->payment_type;
        $estimate_info->expiration_date = $request->expiration_date;
        $estimate_info->remarks = $request->remarks;
        $estimate_info->charger_name = $request->charger_name;
        $estimate_info->department_name = $request->department_name;
        $estimate_info->construction_id = $request->construction_id;

        $estimate_info->save();
    }


    // 新しい見積書作成登録保存についてメソッドを追加
    public static function getEstimateInfo($keyword = null)
    {
        $query = self::where('delet_flag', false);

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('creation_date', 'LIKE', "%{$keyword}%")
                    ->orWhere('customer_name', 'LIKE', "%{$keyword}%")
                    //   ->orWhere('construction_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('charger_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('department_name', 'LIKE', "%{$keyword}%");
            });
        }

        return $query->get();
    }

    public function deleteEstimate($id)
    {
        // Find the estimate record by ID
        $estimate = $this->findOrFail($id);

        // Update the delete_flag to true
        $estimate->delet_flag = true;

        // Save the changes to the database
        $estimate->save();
    }

    // EstimateInfo.php
    public function getEstimateWithDetails($id)
    {
        // Fetch the estimate info by ID
        $estimate_info = $this->findOrFail($id);

        // Fetch related breakdown data
        $breakdown = $estimate_info->breakdown;
        return [$estimate_info, $breakdown];
    }

    //内訳明細書
    public function getEstimateById($id)
    {
        return $this->find($id);
    }

    //pdf method on the ManagerController
    public function fetchEstimateInfoById($id)
    {
        return $this->findOrFail($id);
    }

    //PDFshow on ManagerController
    public function fetchingEstimateInfoById($id)
    {
        return $this->findOrFail($id);
    }

    //breakdown_create メソッド　EstimateController
    public static function getById($id)
    {
        return self::find($id);
    }


    public static function idGet($id)
    {
        return self::find($id);
    }


    //show method on the ManagerController p2
    public static function getEstimateByIde($id)
    {
        return self::findOrFail($id);
    }
}
