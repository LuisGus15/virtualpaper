@extends('layouts.app_no_sidebar')

@section('content')
<div class="container">
    <h1>Pagar Venta</h1>
    <p><strong>ID Venta:</strong> {{ $venta->id }}</p>
    <p><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta }}</p>
    <p><strong>Total:</strong> {{ $venta->total }}</p>
    <p><strong>Estado:</strong> {{ $venta->estado }}</p>
    <h2>Escanea el Código QR para Pagar</h2>
    <div>
        <img src="{{ $laQrImage }}" alt="Código QR para Pago">
    </div>
</div>
@endsection
