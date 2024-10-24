<?php

namespace App\Http\Controllers\admin;           //修正

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Admin;                           //修正
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;            //追記

class RegisterController extends Controller
{
    use RegistersUsers;


    protected $redirectTo = '/admin/home';      //修正


    public function __construct()
    {
        $this->middleware('guest:admin');       //修正
    }


    protected function guard()                  //追記
    {                                           //追記
        return Auth::guard('admin');            //追記
    }                                           //追記


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],     //修正
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    
    protected function create(array $data)
    {
        return Admin::create([                  //修正
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
