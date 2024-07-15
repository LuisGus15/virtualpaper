@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-primary">Crear Venta</a>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha de Venta</th>
                <th>Total</th>
                <th>ID Usuario</th>
                <th>Nombre Usuario</th>
                <th>Apellido Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->fecha_venta }}</td>
                <td>{{ $venta->total }}</td>
                <td>{{ $venta->usuario_id }}</td>
                <td>{{ $venta->usuario->nombre }}</td>
                <td>{{ $venta->usuario->apellido }}</td>
                <td>
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
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
