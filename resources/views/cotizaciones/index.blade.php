@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cotizaciones</h1>
    <a href="{{ route('cotizaciones.create') }}" class="btn btn-primary">Crear Cotización</a>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Fecha de Cotización</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cotizaciones as $cotizacion)
            <tr>
                <td>{{ $cotizacion->fecha_cotizacion }}</td>
                <td>{{ $cotizacion->total }}</td>
                <td>
                    <a href="{{ route('cotizaciones.show', $cotizacion->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('cotizaciones.edit', $cotizacion->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('cotizaciones.destroy', $cotizacion->id) }}" method="POST" style="display:inline;">
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
