<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;
use App\Models\ConstructionName;
use App\Models\ConstructionItem;
use App\Models\Breakdown;
use Illuminate\Support\Facades\DB;

class EstimateController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $estimate_info = EstimateInfo::query();

        if (!empty($keyword)) {
            $estimate_info = $estimate_info->where('creation_date', 'LIKE', "%{$keyword}%")
                ->orWhere('customer_name', 'LIKE', "%{$keyword}%")
                ->orWhere('construction_name', 'LIKE', "%{$keyword}%")
                ->orWhere('charger_name', 'LIKE', "%{$keyword}%")
                ->orWhere('department_name', 'LIKE', "%{$keyword}%")
                ->get();
        } else {
            $estimate_info = $estimate_info->get();
        }

        return view('salesperson_menu.estimate_index', compact('estimate_info', 'keyword'));
    }

    public function create()
    {
        $construction_name = ConstructionName::all();
        //dd($construction_name);
        return view('cover.index',compact('construction_name'));
    }

    public function store(Request $request,ConstructionName $construction_name)
    {
        DB::beginTransaction();

        //$request->validate([
            //'customer_name' => 'required',
            //'creation_date' => 'required',
            //'subject_name' => 'required',
            //'delivery_place' => 'required',
            //'construction_period' => 'required',
            //'payment_type' => 'required',
            //'expiration_date' => 'required',
            //'charger_name' => 'required',
            //'department_name' => 'required',
        //]);

        $construction_name=([[
            'construction_id' => '1',
            'construction_name' => '外壁塗装工事a',
            'loop_count' => '10'
        ],[
            'construction_id' => '2',
            'construction_name' => '外壁塗装工事b',
            'loop_count' => '11'
        ],[
            'construction_id' => '3',
            'construction_name' => '外壁重ね張り工事',
            'loop_count' => '10'
        ],[
            'construction_id' => '4',
            'construction_name' => '浴室改修工事　※タイルのみ',
            'loop_count' => '6'
        ],[
            'construction_id' => '5',
            'construction_name' => '浴室改修工事　※バスナフローレのみ',
            'loop_count' => '5'
        ],[
            'construction_id' => '6',
            'construction_name' => '浴室改修工事　※タイル・浴槽',
            'loop_count' => '7'
        ],[
            'construction_id' => '7',
            'construction_name' => '浴室改修工事　※バスナ・浴槽',
            'loop_count' => '7'
        ],[
            'construction_id' => '8',
            'construction_name' => '浴室改修工事　※タイル・浴槽・壁',
            'loop_count' => '8'
        ],[
            'construction_id' => '9',
            'construction_name' => '浴室改修工事　※バスナ・浴槽・壁',
            'loop_count' => '8'
        ],[
            'construction_id' => '10',
            'construction_name' => 'システムバス工事',
            'loop_count' => '12'
        ],[
            'construction_id' => '11',
            'construction_name' => '屋根重ね張り工事',
            'loop_count' => '10'
        ],[
            'construction_id' => '12',
            'construction_name' => '屋根葺き替え工事　※瓦→他',
            'loop_count' => '13'
        ],[
            'construction_id' => '13',
            'construction_name' => '屋根葺き替え工事　※他→他',
            'loop_count' => '12'
        ],[
            'construction_id' => '14',
            'construction_name' => '屋根葺き替え工事　※瓦→瓦',
            'loop_count' => '13'
        ],[
            'construction_id' => '15',
            'construction_name' => '調湿材工事',
            'loop_count' => '4'
        ],[
            'construction_id' => '16',
            'construction_name' => '基礎補強工事　※ベタ基礎の場合',
            'loop_count' => '5'
        ],[
            'construction_id' => '17',
            'construction_name' => '基礎補強工事　※土の場合',
            'loop_count' => '6'
        ],[
            'construction_id' => '18',
            'construction_name' => 'アラミド基礎補強工事　※ベタ基礎の場合',
            'loop_count' => '6'
        ],[
            'construction_id' => '19',
            'construction_name' => 'アラミド基礎補強工事　※土の場合',
            'loop_count' => '7'
        ]]);

        //$construction_id = $request->input('contruction_id');
        $construction_name = ConstructionName::all();

        $estimate_info = new EstimateInfo();
        //$estimate_info->join('estimate_info', 'construction_name.construction_name', '=', 'estimate_info.construction_name');
        //$estimate_info->$id = id();
        $estimate_info->creation_date = date("Y年m月d日");
        $estimate_info->customer_name = $request->customer_name;
        $estimate_info->subject_name = $request->subject_name;
        $estimate_info->delivery_place = $request->delivery_place;
        $estimate_info->construction_period = $request->construction_period;
        $estimate_info->payment_type = $request->payment_type;
        $estimate_info->expiration_date = $request->expiration_date;
        $estimate_info->remarks = $request->remarks;
        $estimate_info->charger_name = $request->charger_name;
        $estimate_info->department_name = $request->department_name;
        $estimate_info->construction_id = $request->construction_id;
        //$estimate_info->construction_id = $construction_id;
        //dd($estimate_info);
        $estimate_info->construction_name = $request->construction_name;
        //$estimate_info->construction_id = $request->construction_id;
        dd($estimate_info);
        $estimate_info->save();

        DB::commit();

        return redirect('estimate');
    }

    public function breakdown_create(EstimateInfo $estimate_info,ConstructionName $construction_name ,$id)
    {
        $estimate_info = EstimateInfo::find($id);

        //$construction_item = ConstructionItem::all();

        //$construction_name = ConstructionName::find();
        //dd($estimate_info);
        return view('breakdown.breakdown_create', ['id' => $id],['estimate_info' => $estimate_info],['construction_name' => $construction_name]);
    }

    public function breakdown_store(Request $request ,EstimateInfo $estimate_info)
    {
        //$estimate_info = EstimateInfo::find($id);

        //$j = 0;
        $j = count($request['construction_item']);
        //dd($j);
        for($i = 1;$i < $j;$i++){
        $breakdown = new Breakdown;
        //dd($i);
        //echo($request->construction_id);
        //dd($request->estimate_id);
        $breakdown->estimate_id = $request->estimate_id;
        $breakdown->construction_id = $request->construction_id;
        //dd($request->construction_item);
        $_request = $request->toArray();
        //dd($_request['construction_item'][$i]);
        $breakdown->construction_item = $_request['construction_item'][$i];
        $breakdown->specification = $_request['specification'][$i];
        $breakdown->quantity = $_request['quantity'][$i];
        $breakdown->unit = $_request['unit'][$i];
        $breakdown->unit_price = $_request['unit_price'][$i];
        $breakdown->amount = $_request['amount'][$i];
        $breakdown->remarks2 = $_request['remarks2'][$i];
        //dd($breakdown);
        $breakdown->save();
        }


        //DB::commit();

        return redirect('estimate');
    }

    public function indexView()
    {
        $estimates = EstimateInfo::with('breakdowns')->get();
        return view('estimate.index', compact('estimates'));
    }

    // public function show($id)
    // {
    //     // Fetch the breakdown record using the provided ID
    //     $table  = EstimateInfo::findOrFail($id); // Make sure to handle this properly if the record doesn't exist

    //     // Return the view with breakdown data
    //     return view('manager_menu.show', compact('breakdown'));
    // }


}
