@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de Cotización</h1>
    <p><strong>Fecha de Cotización:</strong> {{ $cotizacion->fecha_cotizacion }}</p>
    <p><strong>Total:</strong> {{ $cotizacion->total }}</p>
    <h2>Productos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cotizacion->detalles as $detalle)
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
