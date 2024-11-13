<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;
use Illuminate\Http\Request;
use App\Models\ConstructionList;

class EstimateInfo extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'estimate_info';
    protected $constructionList;

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_name',
        'creation_date',
        'subject_name',
        'delivery_place',
        'construction_period',
        'payment_id',
        'expiration_date',
        'remarks',
        'charger_name',
        'department_name',
    ]; // Add all relevant columns here

    /**
     * 初期処理
     * 使用するクラスのインスタンス化
     */
    public function __construct()
    {
        $this->constructionList = new ConstructionList();
    }

    public function construction_name()
    {
    return $this->belongsTo('App\Models\ConstructionName');
    }

    public function breakdown()
    {
    return $this->hasMany('App\Models\Breakdown');
    }

//    public function getConstructionList();
    public function regist_estimate_info($request)
    {
        $datas = [
            'customer_name' => $request->customer_name,
            'creation_date' => date('Y年m月d日'),
            'subject_name' => $request->subject_name,
            'delivery_place' => $request->delivery_place,
            'construction_period' => $request->construction_period,
            'payment_id' => $request->payment_id,
            'expiration_date' => $request->expiration_date,
            'remarks' => $request->remarks,
            'charger_name' => $request->charger_name,
            'department_name' => $request->department_name,
        ];

        $estimate_info = $this->create($datas);

        if(!$estimate_info) {
            return false;
        }

        $const_datas = [];
        foreach ($request->construction_name as $value) {
            $const_data = [];
            $const_data['name'] = $value;
            $const_data['estimate_info_id'] = $estimate_info->id;

            $const_datas[] = $const_data;
        }

        return $this->constructionList->insert($const_datas);

    }

//    public function getConstructionList();
    public function edit_estimate_info($request)
    {
        $datas = [
            'customer_name' => $request->customer_name,
            'creation_date' => date('Y年m月d日'),
            'subject_name' => $request->subject_name,
            'delivery_place' => $request->delivery_place,
            'construction_period' => $request->construction_period,
            'payment_id' => $request->payment_id,
            'expiration_date' => $request->expiration_date,
            'remarks' => $request->remarks,
            'charger_name' => $request->charger_name,
            'department_name' => $request->department_name,
        ];

        $estimate_info = $this->create($datas);

        if(!$estimate_info) {
            return false;
        }

        $const_datas = [];
        foreach ($request->construction_name as $value) {
            $const_data = [];
            $const_data['name'] = $value;
            $const_data['estimate_info_id'] = $estimate_info->id;

            $const_datas[] = $const_data;
        }

        return $this->constructionList->insert($const_datas);

    }
}
