<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\InterestController;
use App\Http\Controllers\Api\ZoneController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [UserController::class, 'getUser']);
    Route::post('/user/update_profile', [UserController::class, 'updateProfile']);

    Route::get('/interests', [InterestController::class, 'getAllInterest']);

    Route::get('my_zones', [ZoneController::class, 'getAllZones']);
    Route::get('zones/type/{id}', [ZoneController::class, 'getAllDataByZoneType']);
    Route::get('zones/type/first/{id}/{type}', [ZoneController::class, 'getDataByZoneType']);
    Route::get('zones/for_you/{limit}', [ZoneController::class, 'getForYou']);

    Route::post('logout', [AuthController::class, 'logout']);
});
