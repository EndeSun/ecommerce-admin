@extends('layouts.master')
@section('content-master')
    <h1>Productos</h1>
    <button data-bs-toggle="modal" data-bs-target="#add_product" class="btn btn-warning btn_add_product">
        Añadir nuevo producto
    </button>

    <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <!-- TO_DO añadir la url de crear el producto -->
                <form action="{{ url('product/post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="exampleModalLabel">Añadir nuevo producto</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            <div class="form-group col-6">
                                <label for="surname">Apellidos</label>
                                <input type="text" name="surname" id="surname" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Agregar producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arrayProductos as $producto)
                <tr>
                    <td><img src="{{ asset($producto->imagen) }}" alt="Producto" width="35rem" class="img-fluid"></td>
                    <td>{{ $producto->reference }}</td>
                    <td>{{ $producto->name }}</td>
                    <td>{{ $producto->price }}</td>
                    <td>{{ $producto->discount }}</td>
                    <td>{{ $producto->description_short }}</td>
                    <td>{{ $producto->description_large }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#modal-{{ $producto->id }}">
                            <i class="fa-solid fa-pencil">
                            </i>
                        </button>
                    </td>

                    <form action="{{ url('producto/edit', ['id' => $producto->id]) }}" method="POST"
                        enctype="multipart/form-data"> <!-- Tipo de codificación para enviar ficheros -->
                        @method('PUT')
                        @csrf
                        <div class="modal fade modal-xl" id="modal-{{ $producto->id }}" tabindex="-1"
                            aria-labelledby="modalLabel-{{ $producto->id }}" aria-hidden="true" modal-dialog-scrollable
                            modal-dialog-centered>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <!-- Aquí va el formulario de edición -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <figure class="col-4 col-md-2 col-lg-1">
                                                <img src="{{ asset($producto->image) }}" alt="foto_producto" width="80rem"
                                                    class="img-fluid">
                                            </figure>
                                            <div class="mb-3 col-8 col-md-10 col-lg-11 form-group">
                                                <label for="image" class="form-label">Cambiar foto del producto</label>
                                                <input class="form-control" type="file" name="image"
                                                    accept="image/png, image/jpeg, image/jpg">
                                                <!-- Especificación del tipo de codificación -->
                                                @error('image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="name">Nombre</label>
                                                <input type="text" value="{{ $producto->name }}" name="name"
                                                    id="name" class="form-control">
                                            </div>
                                        </div>
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
                <th>Stock</th>
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Descripción corta</th>
                <th>Descripción larga</th>
                <th>Stock</th>
                <th>Editar</th>
            </tr>
        </tfoot>
    </table>

@endsection
