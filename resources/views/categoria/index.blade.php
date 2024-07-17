@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestión de Categorías</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('categoria.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Categoría</button>
        </form>

        <h2 class="mt-4">Categorías Existentes</h2>
        <ul class="list-group">
            @foreach($categorias as $categoria)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $categoria->nombre }}
                    <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="footer">
        <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
    </div>
@endsection
