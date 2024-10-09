<?php
use App\Http\Controllers\SalespersonController;

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
Route::get('/estimate/breakdown_create/{id}', [App\Http\Controllers\EstimateController::class, 'breakdown_create'])->name('estimate.breakdown_create');
Route::post('/estimate/breakdown_store', [App\Http\Controllers\EstimateController::class, 'breakdown_store'])->name('estimate.breakdown_store');

//salesperson Menu
//Route::view('/salesperson_menu', '/salesperson_menu')->name('salesperson_menu');

Route::get('/salesperson_menu', [App\Http\Controllers\SalespersonMenuController::class, 'salesperson_menu'])->name('salesperson_menu');
Route::post('/salesperson_menu', [App\Http\Controllers\SalespersonMenuController::class, 'salesperson_menu'])->name('salesperson_menu');



//THis route is fot the manager_index/view page
Route::get('/manager_estimate', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager_estimate');
Route::resource('managers', ManagerController::class);

Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salespersons.index');





//for the ichiran menu 画面へ [ Admin Resource Routes]

//Route::resource('admins', AdminController::class);

//Route::get('/manager-menu', function () {
//return view('manager_menu.index');
//})->name('manager_menu.index');

//for the 営業者登録画面
Route::view('/salesperson/add', 'salesperson_add/index')->name('salesperson_add.index');
Route::view('/manager/add', 'manager_add/index')->name('manager_add.index');

Route::get('/salespersons/list', [SalespersonController::class, 'list'])->name('salespersons.list');

//additional
// For the first case (admin list and search functionality)
//Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
//Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.create');
//Route::post('/admins', [AdminController::class, 'store'])->name('admin.store');







// Define routes for the admin management
//Route::get('/estimate/admins', [AdminController1::class, 'index'])->name('estimate.index');
//Route::get('/estimate/admins/create', [AdminController1::class, 'create'])->name('estimate.create');
//Route::post('/estimate/admins', [AdminController1::class, 'store'])->name('estimate.store');
//Route::get('/estimate/admins/{id}', [AdminController1::class, 'show'])->name('estimate.show');

//Route::get('estimate/pdf/{id}', [AdminController1::class, 'pdf'])->name('estimate.pdf');


// // Show details with view functionality
// Route::get('/estimate/admins/{id}', [AdminController1::class, 'show'])->name('estimate.show');

// // PDF-specific route
// Route::get('estimate/admins/{id}/pdf', [AdminController1::class, 'pdf'])->name('estimate.pdf');


Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId);
});


//added now 20240920
Route::get('/salesperson/add', [SalespersonController::class, 'add'])->name('salesperson.add');
Route::post('/salesperson/create', [SalespersonController::class, 'create'])->name('salesperson.create');




// Admin registration routes
Route::get('/admin/register', [ManagerController::class, 'create'])->name('admin.register');
Route::post('/admin/store', [ManagerController::class, 'store'])->name('admin.store');

//for 営業者一覧へ
Route::get('/salespersons/show', [SalespersonController::class, 'index'])->name('manager_index.index');





Route::get('/admins', [ManagerController::class, 'admin_index'])->name('admins.index');
route::get('/managers', [ManagerController::class, 'index'])->name('manager_index.index');
route::resource('salespersons', SalespersonController::class);
// route::resource('admins', ManagerController::class);
route::resource('managers', ManagerController::class);




Route::get('/salespersons/show', [SalespersonController::class, 'edit'])->name('manager_index.index');


Route::get('/managers', [ManagerController::class, 'index'])->name('managers.index');
Route::get('/admin/{id}/edit', 'App\Http\Controllers\ManagerController@edit')->name('admins.edit');
Route::put('/admin/{admin}', 'App\Http\Controllers\ManagerController@update')->name('admin.update');

route::resource('salespersons', SalespersonController::class);



//営業一覧画面
Route::put('/manage/{manage}', 'App\Http\Controllers\SalespersonController@update')->name('user.update');



//Salesperson Routes
Route::get('edit/{id}', 'SalespersonController@edit');
Route::get('/salesperson/edit/{id}', [SalespersonController::class, 'edit']);


// Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salesperson.index');
// Route::get('/salespersons/{id}/edit', [SalespersonController::class, 'edit'])->name('salesperson.edit');
// Route::put('/salespersons/{id}', [SalespersonController::class, 'update'])->name('salesperson.update');
// Route::delete('/salespersons/{id}', [SalespersonController::class, 'destroy'])->name('salesperson.destroy');

//Routes for the 管理者メニュー画面
Route::get('/salespersons', [SalespersonController::class, 'index'])->name('salesperson.index');
Route::get('/salespersons/{id}/edit', [SalespersonController::class, 'edit'])->name('salesperson.edit');
Route::put('/salespersons/{id}', [SalespersonController::class, 'update'])->name('salesperson.update');
Route::delete('/salespersons/{id}', [SalespersonController::class, 'destroy'])->name('salesperson.destroy');
Route::get('/manager_menu2', [SalespersonController::class, 'index'])->name('manager_menu.index');


Route::get('/manager_menu', [App\Http\Controllers\SalespersonController::class, 'manager_menu'])->name('manager_menu');
Route::post('/manager_menu', [App\Http\Controllers\SalespersonController::class, 'manager_menu'])->name('manager_menu');
Route::get('/salesperson/{id}', [SalespersonController::class, 'show'])->name('salesperson.show');

// //for viewing 御　見　積　書
// Route::get('/managers/{id}', [ManagerController::class, 'show'])->name('managers.show');
// // Route::get('/managers/{id}', [ManagerController::class, 'show'])->name('managers.show');
// // Define route for displaying the 'item' view
// Route::get('/manager/item', [ManagerController::class, 'itemView'])->name('manager.item');



// Route::get('/managers/{id}', [ManagerController::class, 'show'])->name('managers.show');
Route::get('/managers/{id}', [ManagerController::class, 'show'])->name('managers.show');
// Define route for displaying the 'item' view
Route::get('/manager/item/{id}', [ManagerController::class, 'itemView'])->name('manager.item');

//togenerate pdf

#to view pdf
// Route::get('manager-estimate/pdf', [ManagerController::class, 'generatePDF'])->name('generate_pdf');

#to print pdf
// Route::get('/print-pdf', [ManagerController::class, 'printPDF'])->name('pdf.print');
// Route::get('/manager/pdf', [ManagerController::class, 'getpdf'])->name('pdf.print1');
// Route::get('/manager_menu/pdftrail/{id}', [ManagerController::class, 'pdfget'])->name('Pdftrail');
Route::get('/manager_menu/pdftrail1/{id}', [ManagerController::class, 'pdf'])->name('showPdftrail');
Route::get('/estimates', [EstimateController::class, 'indexView'])->name('estimate.index');
Route::get('/estimates2/{estimate_id}', [ManagerController::class, 'generateppdf'])->name('generateppdf');
Route::get('/managers/pdf/{id}', [ManagerController::class, 'PDFshow'])->name('managers.pdfshow');



// Generate PDF route
Route::get('/estimate/pdf/{id}', [ManagerController::class, 'generatefpdi'])->name('generatefpdi');

