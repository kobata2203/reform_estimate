<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;

class EstimateController extends Controller
{
    public function index()
    {
        $estimate_info = EstimateInfo::all();
<<<<<<< HEAD
        //dd($estimate_info);
        //estimate_index.blade.php
        return view('salesperson_menu.estimate_index', compact('estimate_info'));

=======
        dd($estimate_info);
        return view('salesperson_menu.estimate_index', compact('estimate_info'));
>>>>>>> 48147603d70d61985c04a545335cf4d8038f9305
    }



    public function create()
    {
        // ここに必要な処理を追加
    }

    public function store(Request $request)
    {
        // ここに必要な処理を追加
    }
}
