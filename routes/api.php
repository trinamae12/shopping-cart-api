<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;

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
// Route::post('register','ApiController@register');
Route::post('users', [UserController::class, 'store']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('get-details', [ApiController::class, 'getDetails']);
    Route::get('logout', [ApiController::class, 'logout']);
});

Route::get('users', [UserController::class, 'index']);

