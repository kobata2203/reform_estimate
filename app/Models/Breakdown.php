<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;

class Breakdown extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'breakdown';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'estimate_id',
        'construction_id',
        'construction_item',
        'specification',
        'quantity',
        'unit',
        'unit_price',
        'amount',
        'remarks2',
        'construction_name'
    ];

    public function estimate_info()
    {
        return $this->belongsTo(EstimateInfo::class, 'estimate_info_id');
    }

    public function construction_name()
    {
    return $this->belongsTo('App\Models\ConstructionName');
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'estimate_id', 'id'); // Adjust the foreign key and local key as needed
    }

    public function estimate()
{
    return $this->belongsTo(Estimate::class);
}

}
