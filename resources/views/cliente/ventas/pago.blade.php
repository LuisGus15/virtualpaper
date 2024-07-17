@extends('layouts.app_no_sidebar')

@section('content')
<div class="container">
    <h1>Pagar Venta ID: {{ $venta->id }}</h1>
    <p><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta }}</p>
    <p><strong>Total:</strong> {{ $venta->total }}</p>
    <p><strong>Estado:</strong> {{ $venta->estado }}</p>

    @if(isset($qrImage))
        <div id="qr-code">
            <img src="{{ $qrImage }}" alt="Código QR">
        </div>
    @else
        <p>No se pudo generar el código QR. Intente nuevamente más tarde.</p>
    @endif
</div>
@endsection
