@extends('layouts.app_no_sidebar')

@section('content')
<div class="container">
    <h1>Mis Compras</h1>
    <a href="{{ route('cliente.ventas.create') }}" class="btn btn-primary">Realizar Compra</a>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Venta ID</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->fecha_venta }}</td>
                <td>{{ $venta->total }}</td>
                <td>{{ $venta->estado }}</td>
                <td>
                    <a href="{{ route('cliente.ventas.show', $venta->id) }}" class="btn btn-info">Ver</a>
                    @if($venta->estado == 'Pendiente')
                        <a href="{{ route('cliente.ventas.pagar', $venta->id) }}" class="btn btn-success">Pagar</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
