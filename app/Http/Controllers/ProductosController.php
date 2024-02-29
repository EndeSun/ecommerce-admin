<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductosController extends Controller
{
    public function getCategorias(){
        $arrayCategorias = Category::all();
        return view('productos/categorias', ['arrayCategorias' => $arrayCategorias]);
    }

    public function getProductos(){
        $arrayProductos = Product::all();
        return view('productos/productos', ['arrayProductos' => $arrayProductos]);
    }
    public function getProductosInformes(){
        return view('productos/productos_informes');
    }
}
