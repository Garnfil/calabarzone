<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\AdminAuthController;
use App\Http\Controllers\Web\OverviewController;
use App\Http\Controllers\Web\ProvinceController;

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

Route::get('admin/login', [AdminAuthController::class, 'viewLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'saveLogin'])->name('admin.login.post');

Route::get('admin/forgot_password', [AdminAuthController::class, 'viewForgotPasswordPage']);

Route::group(['prefix'=> 'admin', 'as' => 'admin.'], function(){
    Route::get('overview', [OverviewController::class, 'viewOverview']);

    Route::get('provinces', [ProvinceController::class, 'list'])->name('provinces');
    Route::get('province/create', [ProvinceController::class, 'create'])->name('province.create');
    Route::post('province/store', [ProvinceController::class, 'store'])->name('province.store');
});


