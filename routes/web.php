<?php
use App\Http\Controllers\SalespersonController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminController1;

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

// Authentication Routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admin Routes
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


// Estimate Routes
//Route::get('estimate_info', 'App\Http\Controllers\EstimateController@index')->name('estimate_info.index');
Route::get('/estimate', [App\Http\Controllers\EstimateController::class, 'index'])->name('estimate');
Route::get('/estimate/create', [App\Http\Controllers\EstimateController::class, 'create'])->name('estimate.create');
Route::post('/estimate/store', [App\Http\Controllers\EstimateController::class, 'store'])->name('estimate.store');

//salesperson Menu
Route::view('/salesperson_menu', '/salesperson_menu')->name('salesperson_menu');

Route::get('/salesperson_menu', [App\Http\Controllers\SalespersonMenuController::class, 'salesperson_menu'])->name('salesperson_menu');
Route::post('/salesperson_menu', [App\Http\Controllers\SalespersonMenuController::class, 'salesperson_menu'])->name('salesperson_menu');

Route::get('/manager_menu', [App\Http\Controllers\ManagerMenuController::class, 'manager_menu'])->name('manager_menu');
Route::post('/manager_menu', [App\Http\Controllers\ManagerMenuController::class, 'manager_menu'])->name('manager_menu');

//THis route is fot the manager_index/view page
Route::get('/manager_estimate', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager_estimate');
Route::resource('managers', ManagerController::class);

Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salespersons.index');


//Salesperson Routes
Route::get('/salespersons', [ManagerController::class, 'index'])->name('manager_index.index');
Route::get('/salespersons/create', [SalespersonController::class, 'create'])->name('salespersons.create');
Route::post('/salespersons', [SalespersonController::class, 'store'])->name('salespersons.store');
Route::get('/salespersons/{id}/edit', [SalespersonController::class, 'edit'])->name('salespersons.edit');


//for the ichiran menu 画面へ [ Admin Resource Routes]

Route::resource('admins', AdminController::class);

Route::get('/manager-menu', function () {
    return view('manager_menu.index');
})->name('manager_menu.index');



Route::get('/salespersons/list', [SalespersonController::class, 'list'])->name('salespersons.list');

//additional
// For the first case (admin list and search functionality)
Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admins', [AdminController::class, 'store'])->name('admin.store');







// Define routes for the admin management
Route::get('/estimate/admins', [AdminController1::class, 'index'])->name('estimate.index');
Route::get('/estimate/admins/create', [AdminController1::class, 'create'])->name('estimate.create');
Route::post('/estimate/admins', [AdminController1::class, 'store'])->name('estimate.store');
Route::get('/estimate/admins/{id}', [AdminController1::class, 'show'])->name('estimate.show');

Route::get('estimate/pdf/{id}', [AdminController1::class, 'pdf'])->name('estimate.pdf');


// // Show details with view functionality
// Route::get('/estimate/admins/{id}', [AdminController1::class, 'show'])->name('estimate.show');

// // PDF-specific route
// Route::get('estimate/admins/{id}/pdf', [AdminController1::class, 'pdf'])->name('estimate.pdf');
