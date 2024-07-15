@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Cotización</h1>
    <form action="{{ route('cotizaciones.store') }}" method="POST">
        @csrf
        <div id="productos-container">
            <div class="form-group">
                <label for="producto_id">Producto:</label>
                <select name="productos[0][id]" class="form-control">
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="productos[0][cantidad]" class="form-control" min="1">
            </div>
        </div>
        <button type="button" id="add-product" class="btn btn-secondary">Agregar Producto</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script>
    document.getElementById('add-product').addEventListener('click', function() {
        const container = document.getElementById('productos-container');
        const index = container.children.length;
        const newProduct = `
            <div class="form-group">
                <label for="producto_id">Producto:</label>
                <select name="productos[${index}][id]" class="form-control">
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="productos[${index}][cantidad]" class="form-control" min="1">
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newProduct);
    });
</script>
@endsection
