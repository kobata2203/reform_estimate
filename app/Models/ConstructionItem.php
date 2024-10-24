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

    public function get_target_items($id)
    {
        $items = $this->select('item_id', 'item')->where('construction_id', $id)->get();

        return $items;
    }


    public function get_required($id)
    {
        $item = $this->select('breakdown_required')->where('item_id', $id)->first();

        return $item->breakdown_required;
    }
}
