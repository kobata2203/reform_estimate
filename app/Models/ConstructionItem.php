<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;

class ConstructionItem extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'construction_item';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item',
    ];

    public function estimate_info()
    {
    return $this->belongsTo('App\Models\EstimateInfo');
    }

    public function breakdown()
    {
    return $this->hasMany('App\Models\Breakdown');
    }
}
