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
        'maker',
        'series_name',
        'item_number',
        'quantity',
        'unit',
        'remarks',
    ];

    public function estimate_info()
    {
        return $this->belongsTo('App\Models\EstimateInfo');
    }

    public function breakdown()
    {
        return $this->hasMany('App\Models\Breakdown');
    }

    public function getItemsByConstractionId($id)
    {
        $items = $this->select($this->fillable)->where('construction_id', $id)->get();

        return $items;
    }

    public function get_required($item, $construction_id, $column_name)
    {
        $required = $column_name. '_required';
        $where = [
            ['construction_id', '=', $construction_id],
            ['item', '=', $item],
        ];

        $data = $this->select($required)->where($where)->first();

        if(!empty($data->$required)) {
            $res = $data->$required;
        } else {
            $res = false;
        }

        return $res;
    }
}
