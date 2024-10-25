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

    public function estimate_info()
    {
    return $this->belongsTo('App\Models\ConstructionName');
    }

    public function breakdown()
    {
    return $this->hasMany('App\Models\Breakdown');
    }

}
