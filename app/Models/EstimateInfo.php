<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;
use App\Htpp\Controllers\ManagerController;
use Illuminate\Http\Request;
use App\Models\ConstructionList;
use App\Models\Breakdown;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class EstimateInfo extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'estimate_info';
    protected $constructionList;
    protected $breakdown;

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_name',
        'creation_date',
        'subject_name',
        'delivery_place',
        'construction_period',
        'payment_id',
        'expiration_date',
        'remarks',
        'charger_name',
        'department_id',
    ];


    /**
     * 初期処理
     * 使用するクラスのインスタンス化
     */
    public function __construct()
    {
        parent::__construct();

        $this->breakdown = new Breakdown();
        $this->constructionList = new ConstructionList();
    }

    public function construction_name()
    {
        return $this->belongsTo('App\Models\ConstructionName');
    }

    public function breakdowns()
    {
        return $this->hasMany(Breakdown::class, 'estimate_id');
    }

    public function constructionName()
    {
        return $this->belongsTo('App\Models\ConstructionName', 'construction_id', 'id');
    }

    public function registEstimateInfo($request)
    {
        $data = [
            'customer_name' => $request->customer_name,
            'creation_date' => date('Y年m月d日'),
            'subject_name' => $request->subject_name,
            'delivery_place' => $request->delivery_place,
            'construction_period' => $request->construction_period,
            'payment_id' => $request->payment_id,
            'expiration_date' => $request->expiration_date,
            'remarks' => $request->remarks,
            'charger_name' => $request->charger_name,
            'department_id' => $request->department_id,
        ];

        $estimate_info = $this->create($data);

        if (!$estimate_info) {
            return false;
        }

        return $this->constructionList->registEstimateInfoId($request->construction_name, $estimate_info->id, $request->regist_type);
    }

    public function update_estimate_info($request, $id)
    {
        $estimate_info = $this->find($id);

        $data = [
            'customer_name' => $request->customer_name,
            'creation_date' => date('Y年m月d日'),
            'subject_name' => $request->subject_name,
            'delivery_place' => $request->delivery_place,
            'construction_period' => $request->construction_period,
            'payment_id' => $request->payment_id,
            'expiration_date' => $request->expiration_date,
            'remarks' => $request->remarks,
            'charger_name' => $request->charger_name,
            'department_id' => $request->department_id,
        ];

        $result_update = $estimate_info->fill($data)->save();

        if (!$result_update) {
            return false;
        }

        return $this->constructionList->registEstimateInfoId($request->construction_name, $id, $request->regist_type);
    }


    // 新しい見積書作成登録保存についてメソッドを追加
    public function getEstimateInfo($keyword = null)
    {
        $table = $this->table;
        $cl_table = 'construction_list';
        $d_table = 'departments';
        $ei_table = 'estimate_info';
        $cl_table_join = $cl_table . '.';
        $d_table_join = $d_table . '.';
        $ei_table_join = $ei_table . '.';

        $columns = [
            $ei_table_join . 'id',
            $ei_table_join . 'creation_date',
            $ei_table_join . 'customer_name',
            $ei_table_join . 'charger_name',
            $ei_table_join . 'department_id',
            $d_table_join . 'name',
        ];

        $query = $this->select($columns);

        $query->leftJoin($cl_table, 'estimate_info' . '.id', '=', $cl_table_join . 'estimate_info_id')
            ->leftJoin($d_table, 'estimate_info' . '.department_id', '=', $d_table_join . 'id');

        $query->where($ei_table_join . 'delete_flag', false);

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword, $ei_table_join, $cl_table_join, $d_table_join) {
                $query->where($ei_table_join . 'creation_date', 'LIKE', "%{$keyword}%")
                    ->orWhere($ei_table_join . 'customer_name', 'LIKE', "%{$keyword}%")
                    ->orWhere($cl_table_join . 'name', 'LIKE', "%{$keyword}%")
                    ->orWhere($ei_table_join . 'charger_name', 'LIKE', "%{$keyword}%")
                    ->orWhere($d_table_join . 'name', 'LIKE', "%{$keyword}%");
            });
        }

        $query->groupBy($columns, 'estimate_info.id')
            ->orderBy($ei_table_join . 'created_at', 'desc')
            ->take(20);

        return $query->get();

    }

    public function deleteEstimate($id)
    {
        $estimate = $this->findOrFail($id);

        $estimate->delete_flag = true;

        $result = $estimate->save();

        if ($result === true) {
            return $this->breakdown->deleteBreakdownByEstimateId($id);
        } else {
            return false;
        }
    }

    public function getEstimateWithDetails($id)
    {
        $estimate_info = $this->findOrFail($id);

        $breakdown = $estimate_info->breakdown;
        return [$estimate_info, $breakdown];
    }

    //内訳明細書
    public function getEstimateById($id)
    {
        return $this->find($id);
    }


    public function fetchEstimateInfoById($id)
    {
        return $this->findOrFail($id);
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'payment_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function constructions()
    {
        return $this->hasMany(ConstructionList::class, 'estimate_info_id');
    }
    //見積書の合計のため20250108
    public function constructionLists()
    {
        return $this->hasMany(ConstructionList::class);
    }

    public function estimateCalculates()
    {
        return $this->hasMany(EstimateCalculate::class);
    }

}
