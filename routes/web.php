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
Route::get('/salesperson/add', 'App\Http\Controllers\SalespersonController@add')->name('salesperson_add');
Route::post('/salesperson/add', 'App\Http\Controllers\SalespersonController@create')->name('salesperson_create');
Route::get('/salesperson/edit', 'App\Http\Controllers\SalespersonController@edit')->name('salesperson_edit');

//最初はここに飛ぶ(名前をaction_indexからgetLoginに)
Route::get('auth/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('auth/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth_login');

// Authentication Routes
Auth::routes();
// Admin Routes
Route::get('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'showLoginForm'])->name('admin_login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login'])->name('admin_login');
Route::post('admin/logout', [App\Http\Controllers\admin\LoginController::class, 'logout']);
Route::view('/admin/register', 'admin/register')->name('admin/register');
Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);

Route::get('/salesperson_menu', [App\Http\Controllers\SalespersonMenuController::class, 'salesperson_menu'])->name('salesperson_menu');
Route::post('/salesperson_menu', [App\Http\Controllers\SalespersonMenuController::class, 'salesperson_menu'])->name('salesperson_menu');

// Estimate Routes
Route::get('/estimate/index', [App\Http\Controllers\EstimateController::class, 'index'])->name('estimate.index');
Route::get('/estimate/create', [App\Http\Controllers\EstimateController::class, 'create'])->name('estimate.create');
Route::post('/estimate/store', [App\Http\Controllers\EstimateController::class, 'store'])->name('estimate.store');
Route::get('/estimate/edit/{id}', [App\Http\Controllers\EstimateController::class, 'edit'])->name('estimate.edit');
Route::post('/estimate/update/{id}', [App\Http\Controllers\EstimateController::class, 'update'])->name('estimate.update');
Route::get('/estimate/delete/{id}', [App\Http\Controllers\EstimateController::class, 'delete'])->name('estimate.delete');
Route::get('/breakdown/create/{id}', [App\Http\Controllers\BreakdownController::class, 'create'])->name('breakdown.create');
Route::post('/breakdown/store', [App\Http\Controllers\BreakdownController::class, 'store'])->name('breakdown.store');

//20241114
Route::get('/estimate/index/{id}', [SalespersonController::class, 'itemView'])->name('estimatesales');
Route::get('/showestimate/{id}', [SalespersonController::class, 'showestimate'])->name('showestimate');
Route::get('/manager_estimate', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager_estimate');
Route::resource('managers', ManagerController::class);
Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salespersons.index');
Route::get('/manager/{id}/delete', [ManagerController::class, 'delete'])->name('manager.delete');

//for the 営業者登録画面
Route::view('/salesperson/add', 'salesperson_add/index')->name('salesperson_add.index');
Route::view('/manager/add', 'manager_add/index')->name('manager_add.index');
Route::get('/salespersons/list', [SalespersonController::class, 'list'])->name('salespersons.list');

Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId);
});

//added now 20240920
Route::get('/salesperson/add', [SalespersonController::class, 'add'])->name('salesperson.add');
Route::post('/salesperson/create', [SalespersonController::class, 'create'])->name('salesperson.create');

Route::get('/admin/register', [ManagerController::class, 'create'])->name('admin.register');
Route::post('/admin/store', [ManagerController::class, 'store'])->name('admin.store');

//for 営業者一覧へ
Route::get('/salespersons/show', [SalespersonController::class, 'index'])->name('manager_index.index');
Route::get('/admins', [ManagerController::class, 'admin_index'])->name('admins.index');
Route::get('/managers', [ManagerController::class, 'index'])->name('manager_index.index');
Route::resource('salespersons', SalespersonController::class);
Route::resource('managers', ManagerController::class);
Route::get('/salespersons/show', [SalespersonController::class, 'edit'])->name('manager_index.index');

Route::get('/managers', [ManagerController::class, 'index'])->name('managers.index');
Route::get('/admin/{id}/edit', 'App\Http\Controllers\ManagerController@edit')->name('admins.edit');
Route::put('/admin/{admin}', 'App\Http\Controllers\ManagerController@update')->name('admin.update');

//営業一覧画面
Route::put('/manage/{manage}', 'App\Http\Controllers\SalespersonController@update')->name('user.update');

//Salesperson Routes
Route::get('edit/{id}', 'SalespersonController@edit');
Route::get('/salesperson/edit/{id}', [SalespersonController::class, 'edit']);

//Routes for the 管理者メニュー画面
Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salesperson.index');
Route::get('/salespersons/{id}/edit', [SalespersonController::class, 'edit'])->name('salesperson.edit');
Route::put('/salespersons/{id}', [SalespersonController::class, 'update'])->name('salesperson.update');
Route::delete('/salespersons/{id}', [SalespersonController::class, 'destroy'])->name('salesperson.destroy');
Route::get('/manager_menu2', [SalespersonController::class, 'index'])->name('manager_menu.index');
Route::get('/manager_menu', [App\Http\Controllers\SalespersonController::class, 'manager_menu'])->name('manager_menu');
Route::post('/manager_menu', [App\Http\Controllers\SalespersonController::class, 'manager_menu'])->name('manager_menu');
Route::get('/salesperson/{id}', [SalespersonController::class, 'show'])->name('salesperson.show');

//for viewing 御　見　積　書
Route::get('/managers/{id}', [ManagerController::class, 'show'])->name('managers.show');
Route::get('/manager/item/{id}', [ManagerController::class, 'itemView'])->name('manager.item');
Route::post('/update_discount/{id}', [ManagerController::class, 'updateDiscount'])->name('updateDiscount');


#to print pdf
Route::get('/manager_menu/pdftrail1/{id}', [ManagerController::class, 'generateBreakdown'])->name('generatebreakdown');
Route::get('/estimates', [EstimateController::class, 'indexView'])->name('estimate.index');
Route::get('/estimates2/{estimate_id}', [ManagerController::class, 'generateppdf'])->name('generateppdf');
Route::get('/managers/pdf/{id}', [ManagerController::class, 'generateCover'])->name('generatecover');

