@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inventario</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad Disponible</th>
                    <th>Fecha de Última Actualización</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventarios as $inventario)
                    <tr>
                        <td>{{ $inventario->producto->nombre }}</td>
                        <td>{{ $inventario->cantidad_disponible }}</td>
                        <td>{{ $inventario->fecha_ultima_actualizacion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
    </div>

@endsection
