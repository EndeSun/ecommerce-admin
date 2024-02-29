@extends('layouts.master')

@section('content-master')

<p>Pantalla pedidos</p>

@foreach( $arrayPedidos as $pedido )
<div class="col-xs-6 col-sm-4 col-md-3 text-center">
    <!-- <a href="{{ url('/catalog/show/'. $pedido->id ) }}"> -->
        <h4 style="min-height:45px;margin:5px 0 10px 0">
            Cliente: {{$pedido->user_id}}
        </h4>
    <!-- </a> -->
</div>
@endforeach

@endsection