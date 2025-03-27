<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;

class ConstructionName extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'construction_name';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'construction_id';

    protected $fillable = [
        'construction_id',
        'construction_name',
    ];

    public function estimate_info()
    {
        return $this->belongsTo('App\Models\EstimateInfo');
    }

    public function breakdown()
    {
        return $this->hasMany('App\Models\Breakdown');
    }

    //breakdowncreate メソッド　EstimateController
    public static function getById($id)
    {
        return self::find($id);
    }

    public function getByCconstructionName($construction_name)
    {
        $items = $this->select($this->fillable)
            ->where('construction_name', $construction_name)
            ->get()->first();

        if(!empty($items->construction_id)) {
            return $items->construction_id;
        } else {
            return null;
        }
    }
}
