<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\AdminAuthController;
use App\Http\Controllers\Web\OverviewController;
use App\Http\Controllers\Web\ProvinceController;
use App\Http\Controllers\Web\CityMunicipalityController;
use App\Http\Controllers\Web\InterestController;
use App\Http\Controllers\Web\AttractionController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\ActivityController;
use App\Http\Controllers\Web\AccomodationController;
use App\Http\Controllers\Web\FoodAndDiningController;

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
    Route::get('overview', [OverviewController::class, 'viewOverview'])->name('overview');

    Route::get('provinces', [ProvinceController::class, 'list'])->name('provinces');
    Route::get('province/create', [ProvinceController::class, 'create'])->name('province.create');
    Route::post('province/store', [ProvinceController::class, 'store'])->name('province.store');
    Route::get('province/edit/{id}',[ProvinceController::class, 'edit'])->name('province.edit');
    Route::put('province/update/{id}',[ProvinceController::class, 'update'])->name('province.update');

    Route::get('cities_municipalities', [CityMunicipalityController::class, 'list'])->name('cities_municipalities');
    Route::get('city_municipality/lookup', [CityMunicipalityController::class, 'lookup'])->name('city_municipality.lookup');
    Route::get('city_municipality/create', [CityMunicipalityController::class, 'create'])->name('city_municipality.create');
    Route::post('city_municipality/store', [CityMunicipalityController::class, 'store'])->name('city_municipality.store');
    Route::get('city_municipality/edit/{id}',[CityMunicipalityController::class, 'edit'])->name('city_municipality.edit');
    Route::put('city_municipality/update/{id}',[CityMunicipalityController::class, 'update'])->name('city_municipality.update');

    Route::get('interests', [InterestController::class, 'list'])->name('interests');
    Route::get('interest/create', [InterestController::class, 'create'])->name('interest.create');
    Route::post('interest/store', [InterestController::class, 'store'])->name('interest.store');
    Route::get('interest/edit/{id}',[InterestController::class, 'edit'])->name('interest.edit');
    Route::put('interest/update/{id}',[InterestController::class, 'update'])->name('interest.update');

    Route::get('attractions', [AttractionController::class, 'list'])->name('attractions');
    Route::get('attraction/create', [AttractionController::class, 'create'])->name('attraction.create');
    Route::post('attraction/store', [AttractionController::class, 'store'])->name('attraction.store');
    Route::get('attraction/edit/{id}',[AttractionController::class, 'edit'])->name('attraction.edit');
    Route::put('attraction/update/{id}',[AttractionController::class, 'update'])->name('attraction.update');

    Route::get('events', [EventController::class, 'list'])->name('events');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('event/edit/{id}',[EventController::class, 'edit'])->name('event.edit');
    Route::put('event/update/{id}',[EventController::class, 'update'])->name('event.update');

    Route::get('activities', [ActivityController::class, 'list'])->name('activities');
    Route::get('activity/create', [ActivityController::class, 'create'])->name('activity.create');
    Route::post('activity/store', [ActivityController::class, 'store'])->name('activity.store');
    Route::get('activity/edit/{id}',[ActivityController::class, 'edit'])->name('activity.edit');
    Route::put('activity/update/{id}',[ActivityController::class, 'update'])->name('activity.update');

    Route::get('accomodations', [AccomodationController::class, 'list'])->name('accomodations');
    Route::get('accomodation/create', [AccomodationController::class, 'create'])->name('accomodation.create');
    Route::post('accomodation/store', [AccomodationController::class, 'store'])->name('accomodation.store');
    Route::get('accomodation/edit/{id}',[AccomodationController::class, 'edit'])->name('accomodation.edit');
    Route::put('accomodation/update/{id}',[AccomodationController::class, 'update'])->name('accomodation.update');

    Route::get('food_dinings', [FoodAndDiningController::class, 'list'])->name('food_dinings');
    Route::get('food_dining/create', [FoodAndDiningController::class, 'create'])->name('food_dining.create');
    Route::post('food_dining/store', [FoodAndDiningController::class, 'store'])->name('food_dining.store');
    Route::get('food_dining/edit/{id}',[FoodAndDiningController::class, 'edit'])->name('food_dining.edit');
    Route::put('food_dining/update/{id}',[FoodAndDiningController::class, 'update'])->name('food_dining.update');

    Route::get('users', [UserController::class, 'list'])->name('users');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
    Route::put('user/update/{id}',[UserController::class, 'update'])->name('user.update');
});

