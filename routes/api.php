<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;

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

Route::prefix('v1')->group(function (){
    Route::apiResource('products', 'App\Http\Controllers\Api\v1\IndexController');
    // Route::apiResource('products/{product_id}', 'App\Http\Controllers\Api\v1\IndexController')->only(['destroy']);
    // Route::apiResource('products/user', 'App\Http\Controllers\Api\v1\ProductController')->only(['show','store','update','destroy']);
    Route::apiResource('products/user/{user_id}', 'App\Http\Controllers\Api\v1\ProductController')->only(['index']);
    Route::apiResource('products/user', 'App\Http\Controllers\Api\v1\ProductController')->only(['store']);
    Route::apiResource('profile/user/{user_id}', 'App\Http\Controllers\Api\v1\UserController')->only(['index']);
    Route::apiResource('profile/user', 'App\Http\Controllers\Api\v1\UserController')->only(['update']);
    Route::apiResource('profile/users', 'App\Http\Controllers\Api\v1\AllUserController');
    //search
    Route::post('products/search', 'App\Http\Controllers\Api\v1\HandleProductController@search');
    //related
    Route::get('products/related/{product_id}', 'App\Http\Controllers\Api\v1\HandleProductController@product_related');
    // deleted
    Route::delete('product/delete/{product_id}', 'App\Http\Controllers\Api\v1\HandleProductController@destroy');
    Route::delete('product/restore/{product_id}', 'App\Http\Controllers\Api\v1\HandleProductController@restore');
    Route::get('product/deleted', 'App\Http\Controllers\Api\v1\HandleProductController@show_deleted');
    Route::post('register', 'App\Http\Controllers\Api\v1\AuthController@register');
    Route::post('login', 'App\Http\Controllers\Api\v1\AuthController@login');
    Route::group(['middleware'=>'jwt.verify'], function (){
        Route::get('user', 'App\Http\Controllers\Api\v1\AuthController@getUser');
    });
});
