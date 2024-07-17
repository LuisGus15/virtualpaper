<!-- resources/views/cliente/cotizaciones/index.blade.php -->
@extends('layouts.app_no_sidebar')

@section('content')
<div class="container">
    <h1>Mis Cotizaciones</h1>
    <a href="{{ route('cliente.cotizaciones.create') }}" class="btn btn-primary">Crear Cotización</a>
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
                    <a href="{{ route('cliente.cotizaciones.show', $cotizacion->id) }}" class="btn btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
