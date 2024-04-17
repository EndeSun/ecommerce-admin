<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductosController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'getHome']);

Route::group(['middleware' => 'auth'], function() {
/* Dashboard principal */
Route::get("/dashboard", [DashboardController::class, 'getDashboard']);

/* Módulo de clientes */
Route::any("/clientes", [ClientController::class, 'getClients'])->name('arrayUsers'); 
Route::any("/clientes/reportPDF", [ClientController::class, 'exportPDF'])->name('clientes.report'); 
Route::any("/clientes/reportExcel", [ClientController::class, 'exportExcel'])->name('clientes.excel'); 


Route::put('/clientes/edit/{id}', [ClientController::class, 'putEditClient']);
Route::post('/clientes/post', [ClientController::class, 'postClient']);


/* Módulo de productos - categorias*/
Route::any("/categorias", [ProductosController::class, 'getCategorias'])->name('arrayCategorias'); //📍
Route::any("/categorias/reportPDF", [ProductosController::class, 'exportPDFCategorias'])->name('productos.categorias.report'); //📍
Route::any("/categorias/reportExcel", [ProductosController::class, 'exportExcelCategorias'])->name('categorias.excel'); //📍

Route::put('/category/edit/{id}', [ProductosController::class, 'putCategory']);
Route::post('/category/post', [ProductosController::class, 'postCategory']);


Route::get("/productos", [ProductosController::class, 'getProductos']); //✅
Route::get("/productos/informes", [ProductosController::class, 'getProductosInformes']);

/* Módulo de pedidos */
Route::get("/pedidos", [PedidosController::class, 'getPedidos']); //✅🟥
Route::get("/pedidos/informes", [PedidosController::class, 'getPedidosInformes']);

/* Módulo de usuarios */
Route::get("/usuarios", [UsuariosController::class, 'getUsuarios']);//✅🟥
Route::get("/rol", [UsuariosController::class, 'getUsuariosRol']);//✅🟥
Route::get("/usuarios/informes", [UsuariosController::class, 'getUsuariosInformes']);

});

Auth::routes();
