@extends('layouts.app_no_sidebar')

@section('content')
<div class="container">
    <h1>Detalle de Venta</h1>
    <p><strong>ID Venta:</strong> {{ $venta->id }}</p>
    <p><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta }}</p>
    <p><strong>Total:</strong> {{ $venta->total }}</p>
    <p><strong>Estado:</strong> {{ $venta->estado }}</p>
    <h2>Productos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalles as $detalle)
            <tr>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ $detalle->precio_unitario }}</td>
                <td>{{ $detalle->cantidad * $detalle->precio_unitario }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
