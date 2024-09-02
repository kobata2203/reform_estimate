<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;

class EstimateController extends Controller
{
    public function index()
    {
        $estimate_info = EstimateInfo::all();
        dd($estimate_info);
        return view('estimate_index.blade.php', compact('estimate_info'));
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
