<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SellerController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [ApiController::class, 'login']);
Route::post('users', [UserController::class, 'store']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('get-details', [ApiController::class, 'getDetails']);

    //Admin routes
    Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function(){
        Route::get('/', [AdminController::class, 'index']);
        Route::get('users', [UserController::class, 'index']);
    });

    //Seller routes
    Route::group(['prefix'=>'seller', 'middleware'=>'seller'], function(){
        Route::get('/', [SellerController::class, 'index']);
    });

    //Customer routes
    Route::group(['prefix'=>'customer', 'middleware'=>'customer'], function(){
        Route::get('/', [CustomerController::class, 'index']);
    });

    Route::delete('logout', [ApiController::class, 'logout']);
});

