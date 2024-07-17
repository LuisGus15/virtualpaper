<!-- resources/views/usuarios/index.blade.php -->

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
<div class="container">
    <h1>Lista de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn-create">Crear Usuario</a>
    @if(session()->get('success'))
        <div class="alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <ul class="user-list">
        @foreach ($usuarios as $usuario)
            <li class="user-item">
                {{ $usuario->nombre }} {{ $usuario->apellido }}
                <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn-view">Ver</a>
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-edit">Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
<div class="footer">
    <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
</div>
@endsection
