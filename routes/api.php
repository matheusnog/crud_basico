<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ProdutosController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\InputsController;
use App\Http\Controllers\Api\SalesController;

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

// users
Route::get('/users', [UsersController::class, 'getAll']);
Route::get('/users/{id}', [UsersController::class, 'get']);
Route::post('/users', [UsersController::class, 'post']);
Route::put('/users/{id}', [UsersController::class, 'put']);
Route::delete('/users/{id}', [UsersController::class, 'delete']);

// produtos
Route::get('/produtos', [ProdutosController::class, 'getAll']);
Route::get('/produtos/{id}', [ProdutosController::class, 'get']);
Route::post('/produtos', [ProdutosController::class, 'post']);
Route::delete('/produtos/{id}', [ProdutosController::class, 'delete']);

// products
Route::post('/products', [ProductsController::class, 'post']);
Route::get('/products', [ProductsController::class, 'getAll']);
Route::get('/products/teste', [ProductsController::class, 'getAllTeste']); //usado na view all para teste
Route::get('/products/{id}', [ProductsController::class, 'get']);
Route::delete('/products/{id}', [ProductsController::class, 'delete']);
Route::put('/products/{id}', [ProductsController::class, 'put']);

// inputs
Route::get('/inputs', [InputsController::class, 'getAll']);
Route::post('/inputs', [InputsController::class, 'post']);
Route::delete('/inputs/{id}', [InputsController::class, 'delete']);
Route::put('/inputs/{id}', [InputsController::class, 'put']);

// sales
Route::get('/sales', [SalesController::class, 'getAll']);
Route::post('/sales', [SalesController::class, 'post']);