<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managerinfo extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'managers';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password', 'department_name',
    ];

}
