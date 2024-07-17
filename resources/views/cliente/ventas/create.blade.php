@extends('layouts.app_no_sidebar')

@section('content')
<div class="container">
    <h1>Realizar Compra</h1>
    <form action="{{ route('cliente.ventas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="producto">Producto</label>
            <select name="productos[0][producto_id]" id="producto" class="form-control">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="productos[0][cantidad]" id="cantidad" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Comprar</button>
    </form>
</div>
@endsection
