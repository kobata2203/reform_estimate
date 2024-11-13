<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionList extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'construction_list';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'estimate_info_id',
        'name',
    ];


    public function find_estimate_info_id($estimate_info_id) {
        $items = $this->select($this->fillable)->where('estimate_info_id', $estimate_info_id)->get();

        return $items;

    }
}
