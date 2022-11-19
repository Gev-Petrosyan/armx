<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // user

    Route::get('/dashboard', [HomeController::class, "dashboard"])->name('dashboard');

    Route::get('/company/settings', [CompanyController::class, "settings"])->name('settings');
    Route::post('/company/settings/edit', [CompanyController::class, "update"])->name('settingsEdit');
    Route::get('/product/{id}', [ProductController::class, "show"])->name('productShow');

    Route::get('/company/products', [ProductController::class, "products"])->name('products');
    Route::post('/company/products/create', [ProductController::class, "store"])->name('productCreate');
    Route::post('/company/products/delete', [ProductController::class, "delete"])->name('productDelete');
    Route::get('/company/products/{id}/edit', [ProductController::class, "edit"])->name('productEdit');
    Route::post('/company/products/update', [ProductController::class, "update"])->name('productUpdate');
    Route::post('/company/products/getDataValidate', [ProductController::class, "getDataValidate"])->name('getDataValidate');

    // admin

    Route::get('/admin/companies', [AdminController::class, "index"])->name('adminIndex');
    Route::get('/admin/products', [AdminController::class, "products"])->name('adminProducts');
    Route::get('/admin/city', [AdminController::class, "city"])->name('adminCity');
    Route::get('/admin/category', [AdminController::class, "category"])->name('adminCategory');

});
