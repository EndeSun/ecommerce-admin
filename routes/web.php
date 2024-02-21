<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts/master');
});

/* Dashboard principal */
Route::get("/dashboard", function(){
    return view('maindashboard');
});

/* Módulo de clientes */
Route::get("/clientes", function(){
    return view('clientes/clientes');
});

/* Módulo de productos */
Route::get("/categorias", function(){
    return view('productos/categorias');
});

Route::get("/productos", function(){
    return view('productos/productos');
});

Route::get("/productos/informes", function(){
    return view('productos/productos_informes');
});

/* Módulo de pedidos */
Route::get("/pedidos", function(){
    return view('pedidos/pedidos');
});

Route::get("/pedidos/informes", function(){
    return view('pedidos/pedidos_informes');
});


/* Módulo de usuarios */
Route::get("/usuarios", function(){
    return view('usuarios/usuarios');
});

Route::get("/rol", function(){
    return view('usuarios/rol');
});

Route::get("/usuarios/informes", function(){
    return view('usuarios/usuarios_informes');
});





