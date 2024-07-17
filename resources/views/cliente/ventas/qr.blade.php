@extends('layouts.app_no_sidebar')

@section('content')
<div class="container">
    <h1>Código QR para el Pago</h1>
    @if ($qrImage)
        <img src="{{ $qrImage }}" alt="Código QR para el Pago">
    @else
        <p>No se pudo generar el código QR. Por favor, inténtalo nuevamente.</p>
    @endif
</div>
@endsection
