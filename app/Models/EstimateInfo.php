<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;

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

    public function estimate_info()
    {
    return $this->belongsTo('App\Models\ConstructionName');
    }

    public function breakdown()
    {
    return $this->hasMany('App\Models\Breakdown');
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
}
