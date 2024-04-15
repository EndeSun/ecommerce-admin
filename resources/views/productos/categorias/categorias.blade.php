@push('scripts')
    @vite(['resources/js/categorias.js'])
@endpush

@extends('layouts.master')

@section('content-master')
    <h1>Categorías</h1>

    <button data-bs-toggle="modal" data-bs-target="#add_category" class="btn btn-warning btn_add_category">
        Añadir nueva categoría
    </button>

    {{-- Add New Catefory Form --}}
    <div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <!-- Add new Category secction  -->
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

    {{-- Filter input form --}}
    <form id="searchForm" action="{{ url('/categorias') }}" method="POST">
        @csrf
        <div class="d-flex flex-row">
            <input class="mx-1 input-group-text" type="text" name="search" placeholder="Introduce para filtrar"
                id="search" value="{{ $search }}">
            <button class="m-0 btn btn-outline-dark" type="submit">Filtrar</button>
        </div>
    </form>

    {{-- Export Buttons --}}
    <a href="{{ route('productos.categorias.report') }}" class="mt-4 btn btn-danger" type="submit">PDF</a>
    <a href="{{ route('categorias.excel') }}" class="mt-4 btn btn-success" type="submit">EXCEL</a>

    {{-- Main Table --}}
    <table id="categoria-tabla" class="table table-striped table-borderer shadow-lg mt-4" style="width:100%">
       
        <thead>
            <tr>
                <th></th>
                <th class="text-center">
                    <p>Color de fondo</p>
                </th>

                <th>
                    <div class="d-flex flex-row align-items-center text-center justify-content-center ">
                        <p class="mb-0">Nombre</p>
                        <div class="d-flex flex-column mx-3">
                            <a href="{{ url('categorias?sort=name&order=asc') }}"><i class="fa-solid fa-caret-up"></i></a>
                            <a href="{{ url('categorias?sort=name&order=desc') }}"><i
                                    class="fa-solid fa-caret-down"></i></a>
                        </div>
                    </div>
                </th>

                <th>
                    <div class="d-flex flex-row align-items-center text-center justify-content-center ">
                        <p class="mb-0">Categoría padre</p>
                        <div class="d-flex flex-column mx-3">
                            <a href="{{ url('categorias?sort=parent_name&order=asc') }}"><i class="fa-solid fa-caret-up"></i></a>
                            <a href="{{ url('categorias?sort=parent_name&order=desc') }}"><i
                                    class="fa-solid fa-caret-down"></i></a>
                        </div>
                    </div>
                </th>
                <th>
                    <p>Editar</p>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($arrayCategorias as $categoria)
                <tr>
                    <td scope="row" class="align-middle text-center">
                        <img src="{{ asset($categoria->imagen) }}" alt="categoría" width="35rem" class="img-fluid">
                    </td>

                    {{-- Color de fondo de la imagen que se presentará en la aplicación móvil --}}
                    <td  class="text-center align-middle">
                        <div style="background-color: {{ $categoria->fondo }};" class="rounded-4 p-3">
                            <p class="mb-0">{{$categoria->fondo}}</p>
                        </div>
                    </td>

                    <td class="align-middle text-center">
                        {{ $categoria->name }}
                    </td>

                    @if ($categoria->category_id == null)
                        <td class="align-middle text-center">CATEGORÍA PRINCIPAL</td>
                    @else
                        <td class="align-middle text-center">{{ $categoria->category->name }}</td>
                    @endif
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#modal-{{ $categoria->id }}">
                            <i class="fa-solid fa-pencil">
                            </i>
                        </button>
                    </td>
                </tr>

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
    </table>

    @if (isset($sort) == false)
        {{ $arrayCategorias->links() }}
    @else
        {{ $arrayCategorias->appends(['sort' => $sort, 'order' => $order, 'search' => $search])->links() }}
    @endif
@endsection
