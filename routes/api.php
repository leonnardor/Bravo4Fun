<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\OrdersController;

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



Route::post('/login', 'App\Http\Controllers\Api\AuthController@loginUser'); // Rota para login
Route::post('/register', 'App\Http\Controllers\Api\AuthController@createUser'); // Rota para cadastro
 
Route::get('/categories', 'App\Http\Controllers\Api\CategoryController@index'); // Rota para listar categorias
route::get('/categories/{id}', 'App\Http\Controllers\Api\CategoryController@show'); // Rota para listar categoria por id

Route::get('/products', 'App\Http\Controllers\Api\ProductController@index'); // Rota para listar produtos
Route::get('/products/{id}', 'App\Http\Controllers\Api\ProductController@show'); // Rota para listar produto por id
Route::get('/products/category/{id}', 'App\Http\Controllers\Api\ProductController@getProductsByCategory'); // Rota para listar produtos por categoria 
Route::get('/products/search/{name}', 'App\Http\Controllers\Api\ProductController@searchProducts'); // Rota para buscar produtos por nome

Route::get('/cart/{id}', 'App\Http\Controllers\Api\CartController@show'); // Rota para listar carrinho por id
Route::post('/cart', 'App\Http\Controllers\Api\CartController@store'); // Rota para criar carrinho
Route::delete('/cart/{id}', 'App\Http\Controllers\Api\CartController@destroy'); // Rota para deletar carrinho


Route::get('/orders', 'App\Http\Controllers\Api\OrdersController@getMyOrders'); // Rota para listar pedidos
Route::post('/orders/new', 'App\Http\Controllers\Api\OrdersController@createOrder'); // Rota para criar pedido
// ROTA PRA FINALIZAR PEDIDO
Route::post('/orders/finish', 'App\Http\Controllers\Api\OrdersController@finishOrder'); // Rota para finalizar pedido


Route::get('/user', 'App\Http\Controllers\Api\AuthController@show');


















