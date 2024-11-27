<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;
use App\Htpp\Controllers\ManagerController;
use Illuminate\Http\Request;
use App\Models\ConstructionList;
use App\Models\Breakdown;
use Illuminate\Support\Facades\DB;

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
        'department_name',
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


    public function regist_estimate_info($request)
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

        if(!$estimate_info) {
            return false;
        }

        return $this->constructionList->regist_estimate_info_id($request->construction_name, $estimate_info->id);
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

        if(!$result_update) {
            return false;
        }

        return $this->constructionList->regist_estimate_info_id($request->construction_name, $id);
    }


    // 新しい見積書作成登録保存についてメソッドを追加
    public static function getEstimateInfo($keyword = null)
    {
        $query = self::where('delete_flag', false);

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('creation_date', 'LIKE', "%{$keyword}%")
                    ->orWhere('customer_name', 'LIKE', "%{$keyword}%")
                    //   ->orWhere('construction_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('charger_name', 'LIKE', "%{$keyword}%");
                    //->orWhere('department_name', 'LIKE', "%{$keyword}%");
            });
        }

        return $query->get();
    }

    public function deleteEstimate($id)
    {
        // Find the estimate record by ID
        $estimate = $this->findOrFail($id);

        // Update the delete_flag to true
        $estimate->delete_flag = true;

        // Save the changes to the database
        $result = $estimate->save();

        if($result === true) {
            return $this->breakdown->deleteBreakdownByEstimateId($id);
        } else {
            return false;
        }
    }

    // EstimateInfo.php
    public function getEstimateWithDetails($id)
    {
        // Fetch the estimate info by ID
        $estimate_info = $this->findOrFail($id);

        // Fetch related breakdown data
        $breakdown = $estimate_info->breakdown;
        return [$estimate_info, $breakdown];
    }

    //内訳明細書
    public function getEstimateById($id)
    {
        return $this->find($id);
    }

    //pdf method on the ManagerController
    public function fetchEstimateInfoById($id)
    {
        return $this->findOrFail($id);
    }

    //PDFshow on ManagerController
    public function fetchingEstimateInfoById($id)
    {
        return $this->findOrFail($id);
    }

    //breakdown_create メソッド　EstimateController
    public static function getById($id)
    {
        return self::find($id);
    }


    public static function idGet($id)
    {
        return self::find($id);
    }


    //show method on the ManagerController p2
    public static function getEstimateByIde($id)
    {
        return self::findOrFail($id);
    }
}
