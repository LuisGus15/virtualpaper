@extends('layouts.app')

@section('content')
    <h6>Bienvenido</h6>
    <p>Ahora estamos en la parte del Home</p>
    <p>Has iniciado sesión correctamente.</p>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
    <div class="footer">
        <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
    </div>
@endsection
