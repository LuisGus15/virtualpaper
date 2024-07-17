@extends('layouts.app_no_sidebar')

@section('content')
<div class="contenedor">
    <h1 class="text-center">Productos</h1>
    <div class="row justify-content-center">
        @foreach($productos as $producto)
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-4 w-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text"><strong>Precio:</strong> {{ $producto->precio }}</p>
                        <p class="card-text"><strong>Stock:</strong> {{ $producto->cantidad }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
