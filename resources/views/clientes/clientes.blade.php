@push('scripts')
    @vite(['resources/js/clientes.js'])
@endpush


@extends('layouts.master')
@section('content-master')
    <h1>Clientes</h1>

    <!-- Button add new client -->
    <button data-bs-toggle="modal" data-bs-target="#add_client" class="btn btn-warning btn_add_client">
        Añadir nuevo cliente
    </button>

    {{-- Add New Client Form --}}
    <div class="modal fade" id="add_client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                {{-- ADD NEW CLIENT FORM --}}
                <form action="{{ url('clientes/post') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="exampleModalLabel">Añadir nuevo cliente</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name_add">Nombre</label>
                                <input type="text" name="name_add" id="name_add" class="form-control">
                            </div>

                            <div class="form-group col-6">
                                <label for="surname_add">Apellidos</label>
                                <input type="text" name="surname_add" id="surname_add" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_add">Contraseña</label>
                            <input type="password" name="password_add" id="password_add" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="email_add">Correo</label>
                            <input type="email" name="email_add" id="email_add" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="phone_add">Teléfono</label>
                            <input type="number" name="phone_add" id="phone_add" class="form-control">
                        </div>

                        <div class="row">
                            <div class="form-group col-7">
                                <label for="state_add">Provincia</label>
                                <input type="text" name="state" id="state_add" class="form-control">
                            </div>

                            <div class="form-group col-5">
                                <label for="city_add">Ciudad</label>
                                <input type="text" name="city_add" id="city_add" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-10">
                                <label for="street_add">Calle</label>
                                <input type="text" name="street_add" id="street_add" class="form-control">
                            </div>

                            <div class="form-group col-2">
                                <label for="CP_add">CP</label>
                                <input type="text" name="CP_add" id="CP_add" class="form-control">
                            </div>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Agregar cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Filter input form --}}
    <form id="searchForm" action="{{ url('/clientes') }}" method="POST">
        @csrf
        <div class="d-flex flex-row">
            <input class="mx-1 input-group-text" type="text" name="search" placeholder="Introduce para filtrar"
                id="search" value="{{ $search }}">
            <button class="m-0 btn btn-outline-dark" type="submit">Filtrar</button>
        </div>
    </form>

    {{-- Export buttons --}}
    <a href="{{ route('clientes.report') }}" class="mt-4 btn btn-danger" type="submit">PDF</a>
    <a href="{{ route('clientes.excel') }}" class="mt-4 btn btn-success" type="submit">EXCEL</a>



    <!-- Main table -->
    <table id="clientes-tabla" class="table table-striped table-borderer shadow-lg mt-4" style="width:100%">

        <thead class="bg-info">
            <tr>
                <th></th>
                <th>
                    <div class="d-flex flex-row align-items-center text-center justify-content-center">
                        <p class="mb-0">Nombre</p>
                        <div class="d-flex flex-column mx-3">
                            <a href="{{ url('clientes?sort=name&order=asc') }}"><i class="fa-solid fa-caret-up"></i></a>
                            <a href="{{ url('clientes?sort=name&order=desc') }}"><i
                                    class="fa-solid fa-caret-down"></i></a>
                        </div>
                    </div>
                </th>

                <th>
                    <div class="d-flex flex-row align-items-center text-center justify-content-center">
                        <p class="mb-0">Correo</p>
                        <div class="d-flex flex-column mx-3">
                            <a href="{{ url('clientes?sort=email&order=asc') }}"><i class="fa-solid fa-caret-up"></i></a>
                            <a href="{{ url('clientes?sort=email&order=desc') }}"><i
                                    class="fa-solid fa-caret-down"></i></a>
                        </div>
                    </div>
                </th>

                <th class="text-center">
                    <p>Teléfono</p>
                </th>

                <th class="text-center">
                    <p>Dirección</p>
                </th>

                <th class="text-center">
                    <p>Importe comprado</p>
                </th>

                <th class="text-center">
                    <p>Editar</p>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($arrayUsers as $user)
                <tr>
                    <th class="text-center">
                        @if ($user->image)
                            <img src="{{ asset($user->image) }}" alt="Imagen perfil" width="60rem"
                                class="img-fluid rounded-circle">
                        @else
                            <img src="{{ asset('defecto.webp') }}" alt="Imagen de perfil por defecto" width="60rem"
                                class="img-fluid rounded-circle">
                        @endif
                    </th>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->phone }}</td>
                    <td class="text-center">{{ $user->street }} {{ $user->city }} {{ $user->state }}
                        {{ $user->CP }}</td>
                    <td class="text-center">
                        {{ $user->orders->sum('orders_product_sum_price') }} €
                    </td>

                    <td class="text-center">
                        <button data-bs-toggle="modal" data-bs-target="#modal-{{ $user->id }}">
                            <i class="fa-solid fa-pencil">
                            </i>
                        </button>
                    </td>
                </tr>

                <!-- Modal de edición de cada usuario -->
                <form action="{{ url('clientes/edit', ['id' => $user->id]) }}" method="POST"
                    enctype="multipart/form-data"> <!-- Tipo de codificación para enviar ficheros -->
                    @method('PUT')
                    @csrf

                    <div class="modal fade modal-xl" id="modal-{{ $user->id }}" tabindex="-1"
                        aria-labelledby="modalLabel-{{ $user->id }}" aria-hidden="true" modal-dialog-scrollable
                        modal-dialog-centered>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar cliente</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <!-- Update FORM -->
                                <div class="modal-body">

                                    {{-- Image form --}}
                                    <div class="row">
                                        <figure class="col-4 col-md-2 col-lg-1">
                                            <img src="{{ asset($user->image) }}" alt="foto_perfil_cliente"
                                                width="80rem" class="img-fluid">
                                        </figure>

                                        {{-- <figure class="col-4 col-md-2 col-lg-1">
                                            <img id="imagenSeleccionada" alt="Imagen seleccionada" style="max-height: 300px;">
                                        </figure> --}}

                                        <div class="mb-3 col-8 col-md-10 col-lg-11 form-group">
                                            <label for="image" class="form-label">Cambiar foto de pefil</label>
                                            <input class="form-control" type="file" name="image" id="image"
                                                accept="image/png, image/jpeg, image/jpg">

                                            <!-- Especificación del tipo de codificación -->
                                            @error('image')
                                                @include('alert::alert')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="name_update">Nombre</label>
                                            <input type="text" value="{{ $user->name }}" name="name_update"
                                                id="name_update" class="form-control">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="surname_update">Apellidos</label>
                                            <input type="text" value="{{ $user->surname }}" name="surname_update"
                                                id="surname_update" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="emailPost_update">Correo</label>
                                        <input type="email" value="{{ $user->email }}" name="emailPost_update"
                                            id="emailPost_update" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_update">Teléfono</label>
                                        <input type="number" value="{{ $user->phone }}" name="phone_update"
                                            id="phone_update" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label for="state_update" class="form-label">Provincia</label>
                                            <input type="text" value="{{ $user->state }}" name="state_update"
                                                class="form-control" id="state_update">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="city_update" class="form-label">Ciudad</label>
                                            <input type="text" value="{{ $user->city }}" name="city_update"
                                                class="form-control" id="city_update">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-10">
                                            <label for="street_update" class="form-label">Calle</label>
                                            <input type="text" value="{{ $user->street }}" name="street_update"
                                                class="form-control" id="street_update">
                                        </div>
                                        <div class="form-group col-2">
                                            <label for="CP_update" class="form-label">CP</label>
                                            <input type="text" value="{{ $user->CP }}" name="CP_update"
                                                class="form-control" id="CP_update">
                                        </div>
                                    </div>
                                </div>

                                {{-- Botones del formulario de edición --}}
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn btn-secondary"data-bs-dismiss="modal">Cancelar</button>
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
        {{ $arrayUsers->links() }}
    @else
        {{ $arrayUsers->appends(['sort' => $sort, 'order' => $order, 'search' => $search])->links() }}
    @endif
@endsection
