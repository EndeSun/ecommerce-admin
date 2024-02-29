@push('scripts')
@vite(['resources/scss/clientes.scss'])
@endpush


@extends('layouts.master')

@section('content-master')
<h1>Clientes</h1>

<button data-bs-toggle="modal" data-bs-target="#add_client" class="btn btn-warning btn_add_client">
    Añadir nuevo cliente
</button>

<div class="modal fade" id="add_client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="exampleModalLabel">Añadir nuevo cliente</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ url('clientes/post')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

        </div>
      </form>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Dirección</th>
            <th scope="col">Importe comprado</th>
            <th scope="col">Editar</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($arrayUsers as $user)
        <tr>
            <th scope="row"><img
                    src="{{asset($user->image)}}"
                    alt="Imagen perfil" width="35rem" class="img-fluid"></th>
            <td>{{$user->name}}</td>
            <td>{{$user->mail}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->street}} {{$user->city}} {{$user->state}} {{$user->CP}}</td>
            <td>
                {{ $user->orders->sum('orders_product_sum_price') }} €
            </td>
            <td>
                <button data-bs-toggle="modal" data-bs-target="#modal-{{$user->id}}">
                    <i class="fa-solid fa-pencil">
                    </i>
                </button>
            </td>
        </tr>

        <!-- Modal de edición de cada usuario -->
        <form action="{{ url('clientes/edit', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data"> <!-- Tipo de codificación para enviar ficheros -->
        @method('PUT')
        @csrf
        <div class="modal fade modal-xl" id="modal-{{$user->id}}" tabindex="-1" aria-labelledby="modalLabel-{{$user->id}}"
            aria-hidden="true" modal-dialog-scrollable modal-dialog-centered>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Aquí va el formulario de edición -->
                    <div class="modal-body">
                        <div class="row">
                            <figure class="col-4 col-md-2 col-lg-1">
                                <img src="{{asset($user->image)}}" alt="foto_perfil_cliente" width="80rem" class="img-fluid">
                            </figure>
                            <div class="mb-3 col-8 col-md-10 col-lg-11 form-group">
                                <label for="image" class="form-label">Cambiar foto de pefil</label>
                                <input class="form-control" type="file" name="image" accept="image/png, image/jpeg, image/jpg"> <!-- Especificación del tipo de codificación -->
                                @error('image')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Nombre</label>
                                <input type="text" value="{{$user->name}}" name="name" id="name" class="form-control">
                            </div>

                            <div class="form-group col-6">
                                <label for="surname">Apellidos</label>
                                <input type="text" value="{{$user->surname}}" name="surname" id="surname" class="form-control">
                            </div>
                        </div>

                    
                        <div class="form-group">
                            <label for="mail">Correo</label>
                            <input type="email" value="{{$user->mail}}" name="mail" id="mail" class="form-control">
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                    <label for="street" class="form-label">Calle</label>
                                    <input type="text" value="{{$user->street}}" name="street" class="form-control" id="street">
                            </div>
                            <div class="form-group col-6">
                                    <label for="city" class="form-label">Ciudad</label>
                                    <input type="text" value="{{$user->city}}" name="city" class="form-control" id="city">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                    <label for="state" class="form-label">Provincia</label>
                                    <input type="text" value="{{$user->state}}" name="state" class="form-control" id="state">
                            </div>

                            <div class="form-group col-6">
                                    <label for="CP" class="form-label">CP</label>
                                    <input type="text" value="{{$user->CP}}" name="CP" class="form-control" id="CP">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        @endforeach
    </tbody>
</table>

@endsection