<?php
use App\Http\Controllers\SalespersonController;
use App\Http\Controllers\SalespersonMenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminController1;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


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

//最初はここに飛ぶ(名前をaction_indexからgetLoginに)
Route::get('auth/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
//POSTされたときはこっち
Route::post('auth/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth_login');
Route::get('/auth/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('auth_logout');

// Authentication Routes
Auth::routes();


//管理者用ログイン
Route::get('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'showLoginForm'])->name('admin_login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login'])->name('admin_login');
Route::get('/admin/logout', [App\Http\Controllers\admin\LoginController::class, 'logout'])->name('admin_logout');
Route::view('/admin/register', 'admin/register')->name('admin/register');
Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);

//営業者用メニュー画面
Route::get('/menu', [App\Http\Controllers\MenuController::class, 'menu'])->name('menu');
Route::post('/menu', [App\Http\Controllers\MenuController::class, 'menu'])->name('menu');

// Estimate Routes
Route::get('/estimate/index', [App\Http\Controllers\EstimateController::class, 'index'])->name('estimate.index');
Route::get('/estimate/create', [App\Http\Controllers\EstimateController::class, 'create'])->name('estimate.create');
Route::post('/estimate/store', [App\Http\Controllers\EstimateController::class, 'store'])->name('estimate.store');
Route::get('/estimate/edit/{id}', [App\Http\Controllers\EstimateController::class, 'edit'])->name('estimate.edit');
Route::post('/estimate/update/{id}', [App\Http\Controllers\EstimateController::class, 'update'])->name('estimate.update');
Route::get('/estimate/delete/{id}', [App\Http\Controllers\EstimateController::class, 'delete'])->name('estimate.delete');
Route::get('/breakdown/create/{id}', [App\Http\Controllers\BreakdownController::class, 'create'])->name('breakdown.create');
Route::post('/breakdown/store', [App\Http\Controllers\BreakdownController::class, 'store'])->name('breakdown.store');

//20241114(営業者用の内訳明細書)
Route::get('/estimate/index/{id}', [SalespersonController::class, 'itemView'])->name('salesperson.show');
//(営業者用の御見積書)
Route::get('/showestimate/{id}', [SalespersonController::class, 'showestimate'])->name('showestimate');

//管理者用内訳明細書作成
//Route::get('/adminbreakdown/create/{id}', [App\Http\Controllers\AdminBreakdownController::class, 'create'])->name('adminbreakdown.create');
//Route::post('/breakdown/store', [App\Http\Controllers\AdminBreakdownController::class, 'store'])->name('breakdown.store');


Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId);
});

//営業者一覧
Route::get('/salesperson', [SalespersonController::class, 'index'])->name('salesperson.index');
Route::get('/salesperson/edit/{id}', [SalespersonController::class, 'edit'])->name('salesperson.edit');
Route::post('/salesperson/update/{id}', [SalespersonController::class, 'update'])->name('salesperson.update');
Route::get('/salesperson/delete/{id}', [SalespersonController::class, 'delete'])->name('salesperson.delete');

//営業者登録処理
Route::get('/salesperson/create', [SalespersonController::class, 'create'])->name('salesperson.create');
Route::post('/salesperson/store', [SalespersonController::class, 'store'])->name('salesperson.store');

//管理者一覧
Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
Route::get('/manager/edit/{id}', [ManagerController::class, 'edit'])->name('manager.edit');
Route::post('/manager/update/{id}', [ManagerController::class, 'update'])->name('manager.update');
Route::get('/manager/delete/{id}', [ManagerController::class, 'delete'])->name('manager.delete');

//管理者登録処理
Route::get('/manager/create', [ManagerController::class, 'create'])->name('manager.create');
Route::post('/manager/store', [ManagerController::class, 'store'])->name('manager.store');


// //for viewing 御　見　積　書
Route::get('/managers/{id}', [ManagerController::class, 'show'])->name('managers.show');


// Route::get('/managers/{id}', [ManagerController::class, 'show'])->name('managers.show');
Route::get('/manager/show/{id}', [ManagerController::class, 'show'])->name('managers.show');
// Define route for displaying the 'item' view
Route::get('/manager/item/{id}', [ManagerController::class, 'itemView'])->name('manager.item');
Route::post('/update-discount/{id}/{construction_id}', [ManagerController::class, 'updateDiscount'])->name('updateDiscount');

#pdfを表示
Route::get('/manager_menu/pdftrail1/{id}/{construction_list_id}', [ManagerController::class, 'generateBreakdown'])->name('generatebreakdown');

//営業用編集必要です。
Route::get('/manager_menu/pdftrail1/{id}', [ManagerController::class, 'generateBreakdown'])->name('generatebreakdowns');
// Route::get('/estimates', [EstimateController::class, 'indexView'])->name('estimate.index');
Route::get('/estimates2/{estimate_id}', [ManagerController::class, 'generateppdf'])->name('generateppdf');
Route::get('/managers/pdf/{id}', [ManagerController::class, 'generateCover'])->name('generatecover');











