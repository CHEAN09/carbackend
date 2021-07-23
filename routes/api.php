<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;

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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::post('/cars/search', [CarsController::class, 'search']);
    Route::post('/cars', [CarsController::class, 'store']);
    Route::get('/cars', [CarsController::class, 'index']);

    Route::group(['middleware'=>'owner'], function(){ 
        Route::get('/cars/{cars}', [CarsController::class, 'show']);
        Route::put('/cars/{cars}', [CarsController::class, 'update']);
        Route::delete('/cars/{cars}', [CarsController::class, 'destroy']);
    });
});

