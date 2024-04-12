@push('scripts')
    @vite(['resources/js/pedidos.js'])
@endpush

@extends('layouts.master')

@section('content-master')
    <h1>Pantalla pedidos</h1>
    <table id="pedidos-table" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Fecha de pedido</th>
                <th>Fecha de salida</th>
                <th>Fecha de entrega</th>
                <th>Método de pago</th>
                <th>Estado del pedido</th>
                <th>Estado de pago</th>
                <th>Dirección</th>
                <th>Notas del cliente</th>
                <th>ID de transacción</th>
                <th>Coste adicional</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arrayPedidos as $pedido)
                <tr>
                    <td> {{ $pedido->user_id }}</td>
                    <th>Referencia</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Descripción corta</th>
                    <th>Descripción larga</th>
                    <th>Stock</th>
                    <th>Editar</th>
                    <th>Cliente</th>
                    <th>Editar</th>
                    <th> 
                        <button data-bs-toggle="modal" data-bs-target="#modal-{{ $pedido->id }}">
                            <i class="fa-solid fa-pencil">
                            </i>
                        </button>
                    </th>

                    <!-- TO_DO pedido edit -->
                    <form action="{{ url('pedido/edit', ['id' => $pedido->id]) }}" method="POST"
                        enctype="multipart/form-data"> <!-- Tipo de codificación para enviar ficheros -->
                        @method('PUT')
                        @csrf
                        <div class="modal fade modal-xl" id="modal-{{ $pedido->id }}" tabindex="-1"
                            aria-labelledby="modalLabel-{{ $pedido->id }}" aria-hidden="true" modal-dialog-scrollable
                            modal-dialog-centered>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title fs-5" id="exampleModalLabel">Editar pedido</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <!-- Aquí va el formulario de edición -->
                                    <div class="modal-body">
                                        
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Fecha de pedido</th>
                <th>Fecha de salida</th>
                <th>Fecha de entrega</th>
                <th>Método de pago</th>
                <th>Estado del pedido</th>
                <th>Estado de pago</th>
                <th>Dirección</th>
                <th>Notas del cliente</th>
                <th>ID de transacción</th>
                <th>Coste adicional</th>
                <th>Editar</th>
            </tr>
        </tfoot>
    </table>
@endsection
