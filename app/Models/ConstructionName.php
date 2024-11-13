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

    public function get_target_construction_name()
    {
        $construction_name = ConstructionName::all();

        return $construction_name;
    }

    //create method in EstimateController
    // ConstructionName.php (Model)
    public function get_construction_name()
    {

        return $this->all();
    }

    //breakdowncreate メソッド　EstimateController
    public static function getById($id)
    {
        return self::find($id);
    }

}
