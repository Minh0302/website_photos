<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\v1\IndexController;

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

// Route::get('/dashboard', [AdminController::class, 'view_dashboard']);
// Route::get('/category', [AdminController::class, 'view_category']);
// Route::get('/brand', [AdminController::class, 'view_brand']);

// Route::get('/', function() {
//     return view('welcome');
// });
// Auth::routes();
// Route::get('{path}',[HomeController::class, 'index']);
Route::get('/{any}', function() {
    return view('home');
})->where('any', '.*');
