@extends('layouts.master')

@section('content-master')

<p>Pantalla usuarios</p>

@foreach ($arrayUsers as $user )
    <h4>{{$user->email}}</h4>    
@endforeach

@endsection