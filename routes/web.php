<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\AdminAuthController;
use App\Http\Controllers\Web\Auth\UserAuthController;
use App\Http\Controllers\Web\OverviewController;
use App\Http\Controllers\Web\ProvinceController;
use App\Http\Controllers\Web\CityMunicipalityController;
use App\Http\Controllers\Web\InterestController;
use App\Http\Controllers\Web\AttractionController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\ActivityController;
use App\Http\Controllers\Web\AccommodationController;
use App\Http\Controllers\Web\FoodAndDiningController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\ForgotPasswordController;
use App\Http\Controllers\Web\GCITourController;
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
    if(Auth::guard('admin')->check()) {
        return redirect()->route('admin.overview');
    } else {
        return redirect()->route('admin.login');

    }
})->name('home');

Route::get('admin/login', [AdminAuthController::class, 'viewLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'saveLogin'])->name('admin.login.post');

Route::get('admin/forgot_password', [AdminAuthController::class, 'viewForgotPasswordPage']);


Route::view('user/success_verification_message', 'misc.success_verification_message')->name('user.success_verification_message');
Route::get('/user/verify_email', [UserAuthController::class, 'verifyEmail']);

Route::post('/forgot_password', [ForgotPasswordController::class, 'sendForgotPassword']);

Route::group(['prefix'=> 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin', 'auth:admin', 'check.admin_exist']], function(){
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('overview', [OverviewController::class, 'viewOverview'])->name('overview');

    Route::get('provinces', [ProvinceController::class, 'list'])->name('provinces');
    Route::get('province/create', [ProvinceController::class, 'create'])->name('province.create');
    Route::post('province/store', [ProvinceController::class, 'store'])->name('province.store');
    Route::get('province/edit/{id}',[ProvinceController::class, 'edit'])->name('province.edit');
    Route::put('province/update/{id}',[ProvinceController::class, 'update'])->name('province.update');
    Route::delete('province/delete', [ProvinceController::class, 'destroy'])->name('province.destroy');

    Route::get('cities_municipalities', [CityMunicipalityController::class, 'list'])->name('cities_municipalities');
    Route::get('city_municipality/lookup', [CityMunicipalityController::class, 'lookup'])->name('city_municipality.lookup');
    Route::get('city_municipality/create', [CityMunicipalityController::class, 'create'])->name('city_municipality.create');
    Route::post('city_municipality/store', [CityMunicipalityController::class, 'store'])->name('city_municipality.store');
    Route::get('city_municipality/edit/{id}',[CityMunicipalityController::class, 'edit'])->name('city_municipality.edit');
    Route::put('city_municipality/update/{id}',[CityMunicipalityController::class, 'update'])->name('city_municipality.update');
    Route::delete('city_municipality/delete', [CityMunicipalityController::class, 'destroy'])->name('city_municipality.destroy');

    Route::get('gci_tours', [GCITourController::class, 'list'])->name('gci_tours');
    Route::get('gci_tour/create', [GCITourController::class, 'create'])->name('gci_tour.create');
    Route::post('gci_tour/store', [GCITourController::class, 'store'])->name('gci_tour.store');
    Route::get('gci_tour/edit/{id}',[GCITourController::class, 'edit'])->name('gci_tour.edit');
    Route::put('gci_tour/update/{id}',[GCITourController::class, 'update'])->name('gci_tour.update');
    Route::delete('gci_tour/delete', [GCITourController::class, 'destroy'])->name('gci_tour.destroy');

    Route::get('interests', [InterestController::class, 'list'])->name('interests');
    Route::get('interest/create', [InterestController::class, 'create'])->name('interest.create');
    Route::post('interest/store', [InterestController::class, 'store'])->name('interest.store');
    Route::get('interest/edit/{id}',[InterestController::class, 'edit'])->name('interest.edit');
    Route::put('interest/update/{id}',[InterestController::class, 'update'])->name('interest.update');
    Route::delete('interest/delete', [InterestController::class, 'destroy'])->name('interest.destroy');

    Route::get('attractions', [AttractionController::class, 'list'])->name('attractions');
    Route::get('attraction/create', [AttractionController::class, 'create'])->name('attraction.create');
    Route::post('attraction/store', [AttractionController::class, 'store'])->name('attraction.store');
    Route::get('attraction/edit/{id}',[AttractionController::class, 'edit'])->name('attraction.edit');
    Route::put('attraction/update/{id}',[AttractionController::class, 'update'])->name('attraction.update');
    Route::delete('attraction/delete', [AttractionController::class, 'destroy'])->name('attraction.destroy');

    Route::get('events', [EventController::class, 'list'])->name('events');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('event/edit/{id}',[EventController::class, 'edit'])->name('event.edit');
    Route::put('event/update/{id}',[EventController::class, 'update'])->name('event.update');
    Route::delete('event/delete', [EventController::class, 'destroy'])->name('event.destroy');

    Route::get('activities', [ActivityController::class, 'list'])->name('activities');
    Route::get('activity/create', [ActivityController::class, 'create'])->name('activity.create');
    Route::post('activity/store', [ActivityController::class, 'store'])->name('activity.store');
    Route::get('activity/edit/{id}',[ActivityController::class, 'edit'])->name('activity.edit');
    Route::put('activity/update/{id}',[ActivityController::class, 'update'])->name('activity.update');
    Route::delete('activity/delete', [ActivityController::class, 'destroy'])->name('activity.destroy');

    Route::get('accommodations', [AccommodationController::class, 'list'])->name('accommodations');
    Route::get('accommodation/create', [AccommodationController::class, 'create'])->name('accommodation.create');
    Route::post('accommodation/store', [AccommodationController::class, 'store'])->name('accommodation.store');
    Route::get('accommodation/edit/{id}',[AccommodationController::class, 'edit'])->name('accommodation.edit');
    Route::put('accommodation/update/{id}',[AccommodationController::class, 'update'])->name('accommodation.update');
    Route::delete('accommodation/delete', [AccommodationController::class, 'destroy'])->name('accommodation.destroy');

    Route::get('food_dinings', [FoodAndDiningController::class, 'list'])->name('food_dinings');
    Route::get('food_dining/create', [FoodAndDiningController::class, 'create'])->name('food_dining.create');
    Route::post('food_dining/store', [FoodAndDiningController::class, 'store'])->name('food_dining.store');
    Route::get('food_dining/edit/{id}',[FoodAndDiningController::class, 'edit'])->name('food_dining.edit');
    Route::put('food_dining/update/{id}',[FoodAndDiningController::class, 'update'])->name('food_dining.update');
    Route::delete('food_dining/delete', [FoodAndDiningController::class, 'destroy'])->name('food_dining.destroy');

    Route::get('users', [UserController::class, 'list'])->name('users');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
    Route::put('user/update/{id}',[UserController::class, 'update'])->name('user.update');
    Route::delete('user/delete', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('admins', [AdminController::class, 'list'])->name('admins');
    Route::get('admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('admin/edit/{id}',[AdminController::class, 'edit'])->name('admin.edit');
    Route::put('admin/update/{id}',[AdminController::class, 'update'])->name('admin.update');
    Route::delete('admin/delete', [AdminController::class, 'destroy'])->name('admin.destroy');

});


