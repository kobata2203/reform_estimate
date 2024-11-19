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

    /**
     * estimate_info_idから工事名一覧を取得
     * @param $estimate_info_id
     * @return mixed
     */
    public function find_estimate_info_id($estimate_info_id)
    {
        $items = $this->select($this->fillable)->where('estimate_info_id', $estimate_info_id)->get();

        return $items;

    }

    /**
     * 工事名一覧を登録
     * @param $construction_name
     * @param $id
     * @return true
     */
    public function regist_estimate_info_id($construction_name, $id)
    {
        if(count($construction_name) < 0) {
            return true;
        }

        $datas = [];
        foreach ($construction_name as $value) {
            $data = [];
            $data['name'] = $value;
            $data['estimate_info_id'] = $id;

            $datas[] = $data;
        }

        return $this->insert($datas);
    }

    public function findConnectionLists($estimate_info) {
        $datas = [];
        foreach ($estimate_info as $item) {
            $connectionList = $this->select('name')->where('estimate_info_id', $item->id)->get();

            $data = [];
            foreach ($connectionList as $value) {
                $data[] = $value['name'];
            }

            $datas[$item->id] = $data;
        }

        return $datas;
    }
}
