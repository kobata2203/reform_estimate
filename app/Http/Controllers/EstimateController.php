<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;

class EstimateController extends Controller
{
    public function index()
    {
        $estimate_info = EstimateInfo::all();

        return view('estimate_info.index', compact('estimate_info'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        
    }
}
