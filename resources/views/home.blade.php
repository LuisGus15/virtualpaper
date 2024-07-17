@extends('layouts.app')

@section('content')
    <h1>Bienvenido</h1>
    <p>Has iniciado sesión correctamente.</p>
    <a href="{{ url('/logout') }}">Cerrar sesión</a>
@endsection
