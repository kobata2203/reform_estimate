<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'departments';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    /**
     * IDと部署名のリスト作成
     * @return array
     */
    public function getDepartmentList()
    {
        $department_all = $this->all();

        $departments = [];
        foreach ($department_all as $department) {
            $departments[$department->id] = $department->name;
        }

        return $departments;
    }
}
