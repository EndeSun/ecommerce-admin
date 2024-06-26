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
    <div class="modal modal-add fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="row">

                            {{-- Image show --}}
                            <figure class="col-4 col-md-2 col-lg-1">
                                <img src = "{{ asset('defecto.webp') }}" alt="foto_categoria" width="80rem"
                                    class="img-fluid">
                            </figure>

                            {{-- Image input field --}}
                            <div class=" mb-3 col-8 col-md-10 col-lg-11 form-group">
                                <label for="image_category_add" class="form-label">Añadir foto de la categoría</label>
                                <input class="form-control" type="file" name="image_category_add" id="image_category_add"
                                    accept="image/png, image/jpeg, image/jpg">
                                <!-- Especificación del tipo de codificación -->
                                @error('image')
                                    @include('alert::alert')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Color picker field --}}
                            <div class="row my-4">
                                <div
                                    class="form-group p-0 col-4 col-md-2 col-lg-1 text-center d-flex justify-content-center ">
                                    <input class="form-control border-2 h-100 w-100 colorPickerAdd" type="color"
                                        id="colorPickerAdd" name="colorPickerAdd" value="#effadc">
                                </div>

                                <div class="form-group col-8 col-md-10 col-lg-11 align-items-center">
                                    <label for="colorPickerTextAdd">Seleccione el color de fondo</label>
                                    <input class="form-control colorPickerTextAdd" type="text" name="colorPickerTextAdd"
                                        id="colorPickerTextAdd" readonly value="#effadc">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name_add">Nombre</label>
                                    <input type="text" name="name_add" id="name_add" class="form-control">
                                </div>

                                <div class="form-group col-6">
                                    <label for="category_parent_add">Categoría padre</label>
                                    <select class="form-select" name="category_parent_add" id="category_parent_add">
                                        <option value="CATEGORÍA PRINCIPAL">CATEGORÍA PRINCIPAL</option>
                                        @foreach ($arrayCategoriasAll as $categoriasAll)
                                            <option value="{{ $categoriasAll->id }}">{{ $categoriasAll->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>



                        </div>

                    </div>

                    {{-- ACTION  BUTTONS --}}
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
                    <p class="mb-0">Color de fondo</p>
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

                    <th class="text-center">
                        @if ($categoria->imagen)
                            <img src="{{ asset($categoria->imagen) }}" alt="Imagen categoría" width="60rem"
                                class="img-fluid">
                        @else
                            <img src="{{ asset('defecto.webp') }}" alt="Imagen categoría" width="60rem"
                                class="img-fluid">
                        @endif
                    </th>

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
                <form action="{{ url('category/edit', ['id' => $categoria->id]) }}" method="POST"
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

                                        {{-- Image show --}}
                                        <figure class="col-4 col-md-2 col-lg-1">

                                            @if ($categoria->imagen)
                                                <img src="{{ asset($categoria->imagen) }}" alt="foto_categoria"
                                                    width="80rem" class="img-fluid">
                                            @else
                                                <img src="{{ asset('defecto.webp') }}" alt="foto por defecto"
                                                    width="80rem" class="img-fluid">
                                            @endif



                                        </figure>

                                        {{-- Image input field --}}
                                        <div class=" mb-3 col-8 col-md-10 col-lg-11 form-group">
                                            <label for="image_category_update" class="form-label">Cambiar foto de la
                                                categoría</label>
                                            <input class="form-control" type="file" name="image_category_update"
                                                id="image_category_update" accept="image/png, image/jpeg, image/jpg">
                                            <!-- Especificación del tipo de codificación -->
                                            @error('image')
                                                @include('alert::alert')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- Color picker field --}}
                                        <div class="row my-4">
                                            <div
                                                class="form-group p-0 col-4 col-md-2 col-lg-1 text-center d-flex justify-content-center ">

                                                @if ($categoria->fondo)
                                                    <input class="form-control border-2 h-100 w-100 colorPicker"
                                                        name="colorPicker" type="color"
                                                        value="{{ $categoria->fondo }}" id="colorPicker">
                                                @else
                                                    <input class="form-control border-2 h-100 w-100 colorPicker"
                                                        name="colorPicker" type="color" value="#effadc"
                                                        id="colorPicker">
                                                @endif


                                            </div>

                                            <div class="form-group col-8 col-md-10 col-lg-11 align-items-center">
                                                <label for="colorPickerText">Seleccione el color de fondo</label>

                                                @if ($categoria->fondo)
                                                    <input class="form-control colorPickerText" type="text"
                                                        value="{{ $categoria->fondo }}" name="colorPickerText"
                                                        id="colorPickerText" readonly>
                                                @else
                                                    <input class="form-control colorPickerText" type="text"
                                                        value="#effadc" name="colorPickerText" id="colorPickerText"
                                                        readonly>
                                                @endif


                                            </div>
                                        </div>

                                        {{-- Name and parent category field --}}
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
                                                        <option selected value="{{ $categoria->category->id }}">
                                                            {{ $categoria->category->name }}</option>
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
                                                                        {{-- TO_DO eliminar el producto, parámetro para eliminar: $producto->id, sería un update modificando el category_id a null --}}
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
                                                <p class="mb-0">Añadir subcategorías</p>

                                                <div class="dropdown w-100">
                                                    <button class="btn btn-outline-secondary dropdown-toggle w-100"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Añadir <strong>subcategorías</strong>
                                                    </button>

                                                    {{-- TO_DO Funcionamiento del botón: pasar por parámetro a la url para añadir: $categoryAll->id --}}

                                                    <ul class="dropdown-menu w-100">
                                                        {{-- When the category has a parent category --}}
                                                        {{-- No puede haber opción en añadir subcategorías:
                                                            * la propia categoría
                                                            * la categoría padre    
                                                        --}}
                                                        @if ($categoria->category)
                                                            @foreach ($arrayCategoriasAll as $categoriaAll)
                                                                @if ($categoriaAll->id !== $categoria->category->id && $categoriaAll->id !== $categoria->id)
                                                                    <li class="d-flex flex-row justify-content-between px-2 dropdown-item w-100"
                                                                        value="{{ $categoriaAll->id }}">
                                                                        {{ $categoriaAll->name }}
                                                                        <a class="btn btn-success" href="#">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach

                                                            {{-- We don't have any parent category --}}
                                                            {{--  No puede haber en las opciones:
                                                            * La propia categoría    
                                                        --}}
                                                        @else
                                                            @foreach ($arrayCategoriasAll as $categoriaAll)
                                                                @if ($categoriaAll->id !== $categoria->id)
                                                                    <li class="d-flex flex-row justify-content-between px-2 dropdown-item w-100"
                                                                        value="{{ $categoriaAll->id }}">
                                                                        {{ $categoriaAll->name }}
                                                                        <a class="btn btn-success" href="#">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>

                                            {{-- Añadir productos --}}

                                            <div class="form-group col-6">
                                                <p class="mb-0">Añadir Productos</p>

                                                <div class="dropdown w-100">
                                                    <button class="btn btn-outline-secondary dropdown-toggle w-100"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Añadir <strong>productos</strong>
                                                    </button>

                                                    <ul class="dropdown-menu w-100">
                                                        @foreach ($arrayCategoriasAll as $subcategoria)
                                                            @foreach ($subcategoria->products as $producto)
                                                                @if ($producto->category_id !== $categoria->id)
                                                                    <li
                                                                        class="d-flex flex-row justify-content-between px-2 dropdown-item w-100">
                                                                        {{ $producto->name }}
                                                                        {{-- TO_DO añadir el producto, parámetro para eliminar: $producto->id, sería un update modificando el category_id al valor de la categoría $categoria->id --}}
                                                                        <a class="btn btn-success" href="#">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
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
