@push('scripts')
    @vite(['resources/js/rol.js'])
@endpush

@extends('layouts.master')

@section('content-master')

<p>Pantalla rol de usuarios</p>

@foreach ($arrayUsers as $user )
    <h4>{{$user->rol}}</h4>    
@endforeach




@endsection