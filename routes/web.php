<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminActionController;

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

Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordPage'])->middleware('guest')->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendEmailVerification'])->middleware('guest')->name('password.email');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.update');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPasswordToken'])->middleware('guest')->name('password.reset');

Route::get('/', [HomeController::class, "welcome"])->name("welcome");
Route::get('/dashboard', [HomeController::class, "dashboard"])->name('dashboard');
Route::get('/dashboard/category/{category}', [HomeController::class, "dashboardWithCategory"])->name('dashboardWithCategory');
Route::post('/company/products/getDataValidate', [ProductController::class, "getDataValidate"])->name('getDataValidate');
Route::get('/product/category/{category}', [ProductController::class, "subcategory"])->name('subcategory');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // user

    Route::get('/company/settings', [CompanyController::class, "settings"])->name('settings');
    Route::post('/company/settings/edit', [CompanyController::class, "update"])->name('settingsEdit');
    Route::get('/product/{id}', [ProductController::class, "show"])->name('productShow');

    Route::get('/company/products', [ProductController::class, "products"])->name('products');
    Route::post('/company/products/create', [ProductController::class, "store"])->name('productCreate');
    Route::post('/company/products/delete', [ProductController::class, "delete"])->name('productDelete');
    Route::get('/company/products/{id}/edit', [ProductController::class, "edit"])->name('productEdit');
    Route::post('/company/products/update', [ProductController::class, "update"])->name('productUpdate');

    // admin

    Route::get('/admin/companies', [AdminController::class, "index"])->name('adminIndex');
    Route::get('/admin/products', [AdminController::class, "products"])->name('adminProducts');
    Route::get('/admin/city', [AdminController::class, "city"])->name('adminCity');
    Route::get('/admin/category', [AdminController::class, "category"])->name('adminCategory');

    // admin actions

    Route::get('/admin/company/edit/{id}', [AdminActionController::class, "editCompany"])->name('editCompany');
    Route::get('/admin/product/edit/{id}', [AdminActionController::class, "editProduct"])->name('editProduct');
    Route::get('/admin/city/edit/{id}', [AdminActionController::class, "editCity"])->name('editCity');
    Route::get('/admin/category/edit/{id}', [AdminActionController::class, "editCategory"])->name('editCategory');

    Route::get('/admin/company/delete/{id}', [AdminActionController::class, "deleteCompany"])->name('deleteCompany');
    Route::get('/admin/product/delete/{id}', [AdminActionController::class, "deleteProduct"])->name('deleteProduct');
    Route::get('/admin/city/delete/{id}', [AdminActionController::class, "deleteCity"])->name('deleteCity');
    Route::get('/admin/category/delete/{id}', [AdminActionController::class, "deleteCategory"])->name('deleteCategory');

    Route::post('/admin/company/update', [AdminActionController::class, "updateCompany"])->name('updateCompany');
    Route::post('/admin/city/update', [AdminActionController::class, "updateCity"])->name('updateCity');
    Route::post('/admin/category/update', [AdminActionController::class, "updateCategory"])->name('updateCategory');

    Route::get('/admin/company/add', [AdminActionController::class, "addCompany"])->name('addCompany');
    Route::get('/admin/product/add', [AdminActionController::class, "addProduct"])->name('addProduct');
    Route::get('/admin/city/add', [AdminActionController::class, "addCity"])->name('addCity');
    Route::get('/admin/category/add', [AdminActionController::class, "addCategory"])->name('addCategory');

    Route::post('/admin/company/create', [AdminActionController::class, "createCompany"])->name('createCompany');
    Route::post('/admin/city/create', [AdminActionController::class, "createCity"])->name('createCity');
    Route::post('/admin/category/create', [AdminActionController::class, "createCategory"])->name('createCategory');

});
