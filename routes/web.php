<?php
use App\Http\Controllers\SalespersonController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/salesperson/add', 'App\Http\Controllers\SalespersonController@add')->name('salesperson_add');
Route::post('/salesperson/add', 'App\Http\Controllers\SalespersonController@create')->name('salesperson_create');
Route::get('/salesperson/edit', 'App\Http\Controllers\SalespersonController@edit')->name('salesperson_edit');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/admin/login', 'admin/login')->name('admin/login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
Route::post('admin/logout', [App\Http\Controllers\admin\LoginController::class, 'logout']);
Route::view('/admin/register', 'admin/register')->name('admin/register');
Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);
Route::view('/admin/home', 'admin/home')->middleware('auth:admin');

Route::get('/', function () {
    // ウェブサイトのホームページ（'/'のURL）にアクセスした場合のルートです
    if (Auth::check()) {
        // ログイン状態ならば
        return redirect()->route('estimate_info.index');
        // 見積書一覧ページ（EstimateControllerのindexメソッドが処理）へリダイレクトします
    } else {
        // ログイン状態でなければ
        return redirect()->route('login');
        //　ログイン画面へリダイレクトします
    }
});

<<<<<<< HEAD
Route::get('estimate_info', 'App\Http\Controllers\EstimateController@index')->name('estimate_info.index');

=======
//Route::get('estimate_info', 'App\Http\Controllers\EstimateController@index')->name('estimate_info.index');
>>>>>>> 48147603d70d61985c04a545335cf4d8038f9305
Route::get('/estimate', [App\Http\Controllers\EstimateController::class, 'index'])->name('estimate');
Route::view('/salesperson_menu', '/salesperson_menu')->name('/salesperson_menu');
