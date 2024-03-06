@push('scripts')
    @vite(['resources/scss/categorias.scss', 'resources/js/categorias.js'])
@endpush

@extends('layouts.master')

@section('content-master')
    <h1>Categorías</h1>

    <button data-bs-toggle="modal" data-bs-target="#add_category" class="btn btn-warning btn_add_category">
        Añadir nueva categoría
    </button>


    <div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Add new Category secction  -->
                <!-- TO_DO: añadir el método de category/post y en web.route.php -->
                <form action="{{ url('category/post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="exampleModalLabel">Añadir nueva categoría</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Agregar categoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table id="categoria-tabla" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Color de fondo</th>
                <th>Nombre</th>
                <th>Categoría padre</th>
                <th>Editar</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($arrayCategorias as $categoria)
                <tr>
                    <td scope="row">
                        <img src="{{ asset($categoria->imagen) }}" alt="categoría" width="35rem"
                            class="img-fluid">
                    </td>
                    <td style="background-color: {{ $categoria->fondo }};"></td>
                    <td>{{ $categoria->name }}</td>

                    @if ($categoria->category_id == null)
                        <td>CATEGORÍA PRINCIPAL</td>
                    @else
                        <td>{{ $categoria->category->name }}</td>
                    @endif
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#modal-{{ $categoria->id }}">
                            <i class="fa-solid fa-pencil">
                            </i>
                        </button>
                    </td>
                </tr>
                <!-- Modal de edición de cada categoria TO_DO:implementar el método y añadir al web.route.php -->
                <form action="{{ url('categoria/edit', ['id' => $categoria->id]) }}" method="POST"
                    enctype="multipart/form-data"> <!-- Tipo de codificación para enviar ficheros -->
                    @method('PUT')
                    @csrf
                    <div class="modal fade modal-xl" id="modal-{{ $categoria->id }}" tabindex="-1"
                        aria-labelledby="modalLabel-{{ $categoria->id }}" aria-hidden="true" modal-dialog-scrollable
                        modal-dialog-centered>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Categoría</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <!-- Aquí va el formulario de edición -->
                                <div class="modal-body">

                                    <div class="row">
                                        <figure class="col-4 col-md-2 col-lg-1">
                                            <img src="{{ asset($categoria->imagen) }}" alt="foto_categoria" width="80rem"
                                                class="img-fluid">
                                        </figure>
                                        <div class="mb-3 col-8 col-md-10 col-lg-11 form-group">
                                            <label for="image" class="form-label">Cambiar foto de la categoría</label>
                                            <input class="form-control" type="file" name="image"
                                                accept="image/png, image/jpeg, image/jpg">
                                            <!-- Especificación del tipo de codificación -->
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Color de fondo</th>
                <th>Nombre</th>
                <th>Categoría padre</th>
                <th>Editar</th>
            </tr>
        </tfoot>
    </table>
@endsection
