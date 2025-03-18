<?php

use App\Http\Controllers\SalespersonController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Admin\AuthAdminController;
use App\Http\Controllers\Auth\Sales\AuthSaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::middleware('sales')->group(function () {
    Route::get('/sales/logout', [AuthSaleController::class, 'logout'])->name('sales_logout');
});
Route::prefix('sales')->middleware('guest:sales')->group(function () {
    Route::get('/login', [AuthSaleController::class, 'showLoginForm'])->name('sales_login');
    Route::post('/login', [AuthSaleController::class, 'login']);
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/logout', [AuthAdminController::class, 'logout'])->name('admin_logout');
});
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('admin_login');
    Route::post('/login', [AuthAdminController::class, 'login']);
});

Route::middleware('auto-logout')->group(function () {

    Route::middleware('admin_or_sales')->group(function () {
        Route::get('/menu', [App\Http\Controllers\MenuController::class, 'menu'])->name('menu');
        Route::post('/menu', [App\Http\Controllers\MenuController::class, 'menu']);

        Route::get('/estimate/index', [App\Http\Controllers\EstimateController::class, 'index'])->name('estimate.index');
        Route::get('/estimate/create', [App\Http\Controllers\EstimateController::class, 'create'])->name('estimate.create');
        Route::post('/estimate/store', [App\Http\Controllers\EstimateController::class, 'store'])->name('estimate.store');
        Route::get('/estimate/edit/{id}', [App\Http\Controllers\EstimateController::class, 'edit'])->name('estimate.edit');
        Route::post('/estimate/update/{id}', [App\Http\Controllers\EstimateController::class, 'update'])->name('estimate.update');
        Route::get('/estimate/delete/{id}', [App\Http\Controllers\EstimateController::class, 'delete'])->name('estimate.delete');
        Route::get('/breakdown/create/{id}', [App\Http\Controllers\BreakdownController::class, 'create'])->name('breakdown.create');
        Route::post('/breakdown/store', [App\Http\Controllers\BreakdownController::class, 'store'])->name('breakdown.store');

        Route::get('/estimate/index/{id}', [SalespersonController::class, 'itemView'])->name('salesperson.show');
        Route::get('/showestimate/{id}', [SalespersonController::class, 'showestimate'])->name('showestimate');

        Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
            return $request->user()->downloadInvoice($invoiceId);
        });

        Route::get('/salesperson', [SalespersonController::class, 'index'])->name('salesperson.index');
        Route::get('/salesperson/edit/{id}', [SalespersonController::class, 'edit'])->name('salesperson.edit');
        Route::post('/salesperson/update/{id}', [SalespersonController::class, 'update'])->name('salesperson.update');
        Route::get('/salesperson/delete/{id}', [SalespersonController::class, 'delete'])->name('salesperson.delete');

        Route::get('/salesperson/create', [SalespersonController::class, 'create'])->name('salesperson.create');
        Route::post('/salesperson/store', [SalespersonController::class, 'store'])->name('salesperson.store');

        Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
        Route::get('/manager/edit/{id}', [ManagerController::class, 'edit'])->name('manager.edit');
        Route::post('/manager/update/{id}', [ManagerController::class, 'update'])->name('manager.update');
        Route::get('/manager/delete/{id}', [ManagerController::class, 'delete'])->name('manager.delete');
        Route::get('/manager/create', [ManagerController::class, 'create'])->name('manager.create');
        Route::post('/manager/store', [ManagerController::class, 'store'])->name('manager.store');
        Route::get('/manager/show/{id}', [SalespersonController::class, 'showCover'])->name('managers.show');
        Route::post('/update-discount/{id}/{construction_id}', [SalespersonController::class, 'updateDiscount'])->name('updateDiscount');

        Route::get('/manager_menu/pdftrail1/{id}/{construction_list_id}', [SalespersonController::class, 'generateBreakdown'])->name('generatebreakdown');

        Route::get('/managers/pdf/{id}', [SalespersonController::class, 'generateCover'])->name('generatecover');
    });

});
