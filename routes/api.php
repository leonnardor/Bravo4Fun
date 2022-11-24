<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CartController;

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

Route::post('/login', 'App\Http\Controllers\Api\AuthController@loginUser');
Route::post('/register', 'App\Http\Controllers\Api\AuthController@createUser');

Route::get('/categories', 'App\Http\Controllers\Api\CategoryController@index');
route::get('/categories/{id}', 'App\Http\Controllers\Api\CategoryController@show');

Route::get('/products', 'App\Http\Controllers\Api\ProductController@index');
Route::get('/products/{id}', 'App\Http\Controllers\Api\ProductController@show');
Route::get('/products/category/{id}', 'App\Http\Controllers\Api\ProductController@getProductsByCategory');
Route::get('/products/search/{name}', 'App\Http\Controllers\Api\ProductController@searchProducts');

Route::post('/cart', 'App\Http\Controllers\Api\CartController@create');
Route::get('/cart', 'App\Http\Controllers\Api\CartController@index');
Route::get('/cart/{id}', 'App\Http\Controllers\Api\CartController@show');
Route::put('/cart/{id}', 'App\Http\Controllers\Api\CartController@update');
Route::delete('/cart/{id}', 'App\Http\Controllers\Api\CartController@destroy');














