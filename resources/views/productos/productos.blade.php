@extends('layouts.master')

@section('content-master')

<p>Pantalla de productos</p>

@foreach( $arrayProductos as $producto )
<div class="col-xs-6 col-sm-4 col-md-3 text-center">
    <!-- <a href="{{ url('/catalog/show/'. $producto->id ) }}"> -->
        <h4 style="min-height:45px;margin:5px 0 10px 0">
            {{$producto->name}}
        </h4>
    <!-- </a> -->
</div>
@endforeach

@endsection