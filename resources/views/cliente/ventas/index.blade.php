@extends('layouts.app_no_sidebar')

@section('content')
<div class="container">
    <h1>Mis Ventas</h1>
    <a href="{{ route('cliente.ventas.create') }}" class="btn btn-primary">Realizar Compra</a>
    <div class="mt-3">
        @foreach($ventas as $venta)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Venta ID: {{ $venta->id }}</h5>
                    <p class="card-text">Fecha: {{ $venta->fecha_venta }}</p>
                    <p class="card-text">Total: {{ $venta->total }}</p>
                    <p class="card-text">Estado: {{ $venta->estado }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
