<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProdutosController;

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

Route::get('/', function () {
    return view('welcome');
});

// users
Route::get('users/new', [UsersController::class, 'create']);
Route::post('users/new', [UsersController::class, 'store'])->name('register_user');
Route::get('users/ver/{id}', [UsersController::class, 'show']);
Route::get('users/editar/{id}', [UsersController::class, 'edit']);
Route::post('users/editar/{id}', [UsersController::class, 'update'])->name('alterar_usuario');
Route::get('users/list', [UsersController::class, 'list']);
Route::get('users/excluir/{id}', [UsersController::class, 'delete']);
Route::post('users/excluir/{id}', [UsersController::class, 'destroy'])->name('excluir_usuario');

// produtos
Route::get('produtos/novo', [ProdutosController::class, 'create']);
Route::post('produtos/novo', [ProdutosController::class, 'store'])->name('cadastrar_produto');
Route::get('produtos/lista', [ProdutosController::class, 'list']);
Route::get('produtos/editar/{id}', [ProdutosController::class, 'edit']);
Route::post('produtos/editar/{id}', [ProdutosController::class, 'update'])->name('editar_produto');
Route::get('produtos/excluir/{id}', [ProdutosController::class, 'delete']);
Route::post('produtos/excluir/{id}', [ProdutosController::class, 'destroy'])->name('excluir_produto');