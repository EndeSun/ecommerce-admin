<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PedidosController extends Controller
{
    public function getPedidos(){
        $arrayPedidos = Order::all();
        return view('pedidos/pedidos', ['arrayPedidos' => $arrayPedidos]);
    }

    public function getPedidosInformes(){
        return view('pedidos/pedidos_informes');
    }


}
