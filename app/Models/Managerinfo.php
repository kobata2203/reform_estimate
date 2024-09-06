<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managerinfo extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'manage_info';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_name',
        'password',
        'department_name',
    ];

}
