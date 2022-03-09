<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', 'ProductController')->middleware('auth:sanctum');
Route::resource('categories', 'CategoryController')->middleware('auth:sanctum');

Route::post('sanctum/token', 'UserTokenController');
