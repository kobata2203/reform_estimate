<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;

class EstimateController extends Controller
{
    public function index()
    {
        $estimate_info = EstimateInfo::get();

        return view('estimate_info', compact('estimate_info'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }
}
