@push('scripts')
    @vite(['resources/js/productos.js']);
@endpush

@extends('layouts.master')

@section('content-master')

<h1>Pantalla de productos</h1>



<table id="product-table" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Descripción corta</th>
                <th>Descripción larga</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $arrayProductos as $producto )
            <tr>
                <td><img src="{{ asset($producto->imagen) }}" alt="Producto" width="35rem"
                    class="img-fluid"></td>
                <td>{{$producto->reference}}</td>
                <td>{{$producto->name}}</td>
                <td>{{$producto->price}}</td>
                <td>{{$producto->discount}}</td>
                <td>{{$producto->description_short}}</td>
                <td>{{$producto->description_large}}</td>
                <td>{{$producto->stock}}</td>
            </tr>

            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Stock</th>
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Descripción corta</th>
                <th>Descripción larga</th>
                <th>Stock</th>
            </tr>
        </tfoot>
    </table>

@endsection