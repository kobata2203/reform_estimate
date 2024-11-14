<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;
use Illuminate\Http\Request;
use App\Models\ConstructionList;
use Illuminate\Support\Facades\DB;

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


    public function regist_estimate_info($request)
    {
        $data = [
            'customer_name' => $request->customer_name,
            'creation_date' => date('Y年m月d日'),
            'subject_name' => $request->subject_name,
            'delivery_place' => $request->delivery_place,
            'construction_period' => $request->construction_period,
            'payment_id' => $request->payment_id,
            'expiration_date' => $request->expiration_date,
            'remarks' => $request->remarks,
            'charger_name' => $request->charger_name,
            'department_id' => $request->department_id,
        ];

        $estimate_info = $this->create($data);

        if(!$estimate_info) {
            return false;
        }

        return $this->constructionList->regist_estimate_info_id($request->construction_name, $estimate_info->id);
    }

    public function update_estimate_info($request, $id)
    {
        $estimate_info = $this->find($id);

        $data = [
            'customer_name' => $request->customer_name,
            'creation_date' => date('Y年m月d日'),
            'subject_name' => $request->subject_name,
            'delivery_place' => $request->delivery_place,
            'construction_period' => $request->construction_period,
            'payment_id' => $request->payment_id,
            'expiration_date' => $request->expiration_date,
            'remarks' => $request->remarks,
            'charger_name' => $request->charger_name,
            'department_id' => $request->department_id,
        ];

        $result_update = $estimate_info->fill($data)->save();

        if(!$result_update) {
            return false;
        }

        return $this->constructionList->regist_estimate_info_id($request->construction_name, $id);
    }
}
