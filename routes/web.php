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

//Route::get('estimate_info', 'App\Http\Controllers\EstimateController@index')->name('estimate_info.index');
Route::get('/estimate', [App\Http\Controllers\EstimateController::class, 'index'])->name('estimate');
Route::get('/estimate/create', [App\Http\Controllers\EstimateController::class, 'create'])->name('estimate.create');
Route::post('/estimate/store', [App\Http\Controllers\EstimateController::class, 'store'])->name('estimate.store');

Route::get('/salesperson_menu', [App\Http\Controllers\SalespersonMenuController::class, 'salesperson_menu'])->name('salesperson_menu');
Route::post('/salesperson_menu', [App\Http\Controllers\SalespersonMenuController::class, 'salesperson_menu'])->name('salesperson_menu');

//THis route is fot the manager_index/view page

Route::resource('managers', ManagerController::class);

Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salespersons.index');


//remove if necessery
Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salespersons.index');
Route::get('/salespersons/create', [SalespersonController::class, 'create'])->name('salespersons.create');
Route::post('/salespersons', [SalespersonController::class, 'store'])->name('salespersons.store');
Route::get('/salespersons/{id}/edit', [SalespersonController::class, 'edit'])->name('salespersons.edit');

//additional
