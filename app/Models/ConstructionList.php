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
        'id',
        'estimate_info_id',
        'name',
    ];

    /**
     * estimate_info_idから工事名一覧を取得
     * @param $estimate_info_id
     * @return mixed
     */
    public function getEstimateInfoId($estimate_info_id)
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
    public function registEstimateInfoId($construction_name, $id)
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

    public function getConnectionLists($estimate_info) {
        $datas = [];
        foreach ($estimate_info as $item) {
            $connection_list = $this->select($this->fillable)->where('estimate_info_id', $item->id)->get();

            $datas[$item->id] = $connection_list;
        }

        return $datas;
    }

    /**
     * 内訳明細一覧画面の閲覧ボタン活性化判定
     *
     * @param $construction_list_keys　工事IDリスト
     * @return array
     */
    public function getPdfShowFlag($construction_list_ids)
    {
        $join_table = 'breakdown';
        $datas = [];

        foreach ($construction_list_ids as $item) {
            $breakdown_count_list = $this->selectRaw('count(' . $join_table . '.id) as breakdown_count')
                ->leftJoin($join_table, $this->table . '.id', '=', $join_table . '.construction_list_id')
                ->where($this->table . '.estimate_info_id', $item)
                ->groupBy($this->table . '.id')
                ->get();

            $datas[$item] = false;
            foreach ($breakdown_count_list as $breakdown_count_item) {
                if (!empty($breakdown_count_item->breakdown_count) && $breakdown_count_item->breakdown_count > 0) {
                    $datas[$item] = true;
                }
            }
        }

        return $datas;
    }

}
