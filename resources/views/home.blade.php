@extends('layouts.app')

@section('content')
    <h1>Bienvenido</h1>
    <p>Has iniciado sesión correctamente.</p>
    <a href="{{ url('/logout') }}">Cerrar sesión</a>
    <div class="footer">
        <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
    </div>
@endsection
