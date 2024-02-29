@extends('layouts.master')

@section('content-master')

<p>Pantalla categorías</p>

<p>Aquí contendrá una tabla para rellenar las categorías</p>

@foreach( $arrayCategorias as $categoria )
<div class="col-xs-6 col-sm-4 col-md-3 text-center">
    <!-- <a href="{{ url('/catalog/show/'. $categoria->id ) }}"> -->
        <h4 style="min-height:45px;margin:5px 0 10px 0">
            {{$categoria->name}}
            {{$categoria->id}}
        </h4>
    <!-- </a> -->
</div>
@endforeach

@endsection