<?php
use App\Http\Controllers\SalespersonController;
use App\Http\Controllers\EstimateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::post('/salesperson/edit', 'App\Http\Controllers\SalespersonController@edit')->name('manager_index.edit');
Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salespersons.index');
//remove if necessery
// Route to show the form to create a new salesperson
Route::get('/salespersons/create', [SalespersonController::class, 'createForm'])->name('salespersons.create');

// Route to handle the form submission for creating a new salesperson
Route::post('/salespersons', [SalespersonController::class, 'create'])->name('salespersons.store');

// Route to show the form to edit an existing salesperson
Route::get('/salespersons/{id}/edit', [SalespersonController::class, 'editForm'])->name('salespersons.edit');

// Route to handle the form submission for updating an existing salesperson
Route::put('/salespersons/{id}', [SalespersonController::class, 'edit'])->name('salespersons.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/admin/login', 'admin/login')->name('admin/login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
Route::post('admin/logout', [App\Http\Controllers\admin\LoginController::class,'logout']);
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
Route::get('estimate_index.blade.php', 'App\Http\Controllers\EstimateController@index')->name('estimate_index');
Route::view('/salesperson_menu', '/salesperson_menu')->name('/salesperson_menu');
