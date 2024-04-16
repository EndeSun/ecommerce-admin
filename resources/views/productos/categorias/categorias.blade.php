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
                            <a href="{{ url('categorias?sort=parent_name&order=asc') }}"><i
                                    class="fa-solid fa-caret-up"></i></a>
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
                    <td class="text-center align-middle">
                        <div style="background-color: {{ $categoria->fondo }};" class="rounded-4 p-3">
                            <p class="mb-0">{{ $categoria->fondo }}</p>
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
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                    </td>
                </tr>

                {{-- Edit form for each category --}}
                <form action="{{ url('categoria/edit', ['id' => $categoria->id]) }}" method="POST"
                    enctype="multipart/form-data"> <!-- Tipo de codificación para enviar ficheros -->
                    @method('PUT')
                    @csrf

                    <div class="modal fade modal-xl modal-put" id="modal-{{ $categoria->id }}" tabindex="-1"
                        aria-labelledby="modalLabel-{{ $categoria->id }}" aria-hidden="true" modal-dialog-scrollable
                        modal-dialog-centered>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Categoría</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <!-- modal form body -->
                                <div class="modal-body">

                                    <div class="row">
                                        <figure class="col-4 col-md-2 col-lg-1">
                                            <img src="{{ asset($categoria->imagen) }}" alt="foto_categoria"
                                                width="80rem" class="img-fluid">
                                        </figure>
                                        <div class=" mb-3 col-8 col-md-10 col-lg-11 form-group">
                                            <label for="image_category_put" class="form-label">Cambiar foto de la
                                                categoría</label>
                                            <input class="form-control" type="file" name="image"
                                                id="image_category_put" accept="image/png, image/jpeg, image/jpg">
                                            <!-- Especificación del tipo de codificación -->
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- Color picker field --}}
                                        <div class="row my-4">
                                            <div
                                                class="form-group p-0 col-4 col-md-2 col-lg-1 text-center d-flex justify-content-center ">
                                                <input class="form-control border-2 h-100 w-100 colorPicker"
                                                    type="color" value="{{ $categoria->fondo }}" id="colorPicker">
                                            </div>

                                            <div class="form-group col-8 col-md-10 col-lg-11 align-items-center">
                                                <label for="colorPickerText">Seleccione el color de fondo</label>
                                                <input class="form-control colorPickerText" type="text"
                                                    value="{{ $categoria->fondo }}" name="colorPickerText"
                                                    id="colorPickerText" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name_update">Nombre</label>
                                                <input type="text" value="{{ $categoria->name }}" name="name_update"
                                                    id="name_update" class="form-control">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="category_parent_update">Categoría padre</label>
                                                <select class="form-select" name="category_parent_update"
                                                    id="category_parent_update">
                                                    @if ($categoria->category)
                                                        <option selected>{{ $categoria->category->name }}</option>
                                                        <option value="CATEGORÍA PRINCIPAL">CATEGORÍA PRINCIPAL</option>
                                                        @foreach ($arrayCategoriasAll as $categoriaAll)
                                                            @if ($categoriaAll->id !== $categoria->category->id)
                                                                <option value="{{ $categoriaAll->id }}">
                                                                    {{ $categoriaAll->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option selected>CATEGORÍA PRINCIPAL</option>
                                                        @foreach ($arrayCategoriasAll as $categoriaAll)
                                                            <option value="{{ $categoriaAll->id }}">
                                                                {{ $categoriaAll->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>

                                        {{-- Vista de subcategorías y productos contenida en ella --}}
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <p class="mb-0">Subcategorías</p>
                                                {{-- Obtener todas las subcategorias de la categoría --}}
                                                <div class="dropdown w-100">
                                                    <button class="btn btn-outline-secondary dropdown-toggle w-100"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Ver <strong>subcategorías</strong>
                                                    </button>

                                                    <ul class="dropdown-menu w-100">
                                                        @foreach ($arrayCategoriasAll as $subcategoria)
                                                            {{-- subcategoria->category_id es el parent_id de la subcategoria --}}
                                                            @if ($subcategoria->category_id === $categoria->id)
                                                                <li
                                                                    class="d-flex flex-row justify-content-between px-2 dropdown-item w-100">
                                                                    {{ $subcategoria->name }}
                                                                    {{-- TO_DO eliminar la subcategoría parámetro para eliminar: $subcategoria->id --}}
                                                                    <a class="btn btn-danger" href="#">
                                                                        <i class="fa fa-close"></i>
                                                                    </a>

                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <p class="mb-0">Productos</p>
                                                <div class="dropdown w-100">
                                                    <button class="btn btn-outline-secondary dropdown-toggle w-100"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Ver <strong>productos</strong>
                                                    </button>

                                                    <ul class="dropdown-menu w-100">
                                                        {{-- Array de productos --}}

                                                        @foreach ($arrayCategoriasAll as $subcategoria)
                                                            @foreach ($subcategoria->products as $producto)
                                                                @if ($producto->category_id === $categoria->id)
                                                                    <li
                                                                        class="d-flex flex-row justify-content-between px-2 dropdown-item w-100">
                                                                        {{ $producto->name }}
                                                                        {{-- TO_DO eliminar la subcategoría parámetro para eliminar: $subcategoria->id --}}
                                                                        <a class="btn btn-danger" href="#">
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Añadir subcategorías y productos --}}
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="subcategory_add_1">Añadir subcategorías</label>
                                                <select class="form-select" name="subcategory_add_1"
                                                    id="subcategory_add_1">

                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="products_add_1">Añadir productos</label>
                                                <select class="form-select" name="products_add_1" id="products_add_1">

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                {{-- Action buttons --}}
                                <div class="modal-footer">
                                    <button type="button"class="btn btn-secondary btn-cancel"
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
