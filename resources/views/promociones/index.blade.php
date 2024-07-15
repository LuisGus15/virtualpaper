@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Promociones</h1>
    <a href="{{ route('promociones.create') }}" class="btn btn-primary">Crear Promoción</a>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Descuento (%)</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promociones as $promocion)
            <tr>
                <td>{{ $promocion->nombre }}</td>
                <td>{{ $promocion->descripcion }}</td>
                <td>{{ $promocion->descuento_porcentaje }}</td>
                <td>{{ $promocion->fecha_inicio }}</td>
                <td>{{ $promocion->fecha_fin }}</td>
                <td>{{ $promocion->producto->nombre }}</td>
                <td>
                    <a href="{{ route('promociones.edit', $promocion->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('promociones.destroy', $promocion->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
