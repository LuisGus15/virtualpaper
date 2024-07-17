@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST" id="ventaForm">
        @csrf
        <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" name="estado" id="estado" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_venta">Fecha de Venta:</label>
            <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="usuario_id">Usuario:</label>
            <select name="usuario_id" id="usuario_id" class="form-control" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="total">Total:</label>
            <input type="text" name="total" id="total" class="form-control" readonly>
        </div>
        
        <h3>Productos</h3>
        <div id="productos-container">
            <div class="form-row producto-row">
                <div class="form-group col-md-4">
                    <label for="producto_id">Producto:</label>
                    <select name="productos[0][producto_id]" class="form-control producto-select" required>
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="productos[0][cantidad]" class="form-control cantidad-input" min="1" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="precio_unitario">Precio Unitario:</label>
                    <input type="text" name="productos[0][precio_unitario]" class="form-control precio-unitario-input" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="subtotal">Subtotal:</label>
                    <input type="text" name="productos[0][subtotal]" class="form-control subtotal-input" readonly>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-producto-btn">Eliminar</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="add-producto-btn">Agregar Producto</button>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let productoIndex = 1;

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal-input').forEach(function(subtotalInput) {
                total += parseFloat(subtotalInput.value) || 0;
            });
            document.getElementById('total').value = total.toFixed(2);
        }

        document.getElementById('add-producto-btn').addEventListener('click', function() {
            const productosContainer = document.getElementById('productos-container');
            const newProductoRow = document.createElement('div');
            newProductoRow.classList.add('form-row', 'producto-row');
            newProductoRow.innerHTML = `
                <div class="form-group col-md-4">
                    <label for="producto_id">Producto:</label>
                    <select name="productos[${productoIndex}][producto_id]" class="form-control producto-select" required>
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="productos[${productoIndex}][cantidad]" class="form-control cantidad-input" min="1" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="precio_unitario">Precio Unitario:</label>
                    <input type="text" name="productos[${productoIndex}][precio_unitario]" class="form-control precio-unitario-input" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="subtotal">Subtotal:</label>
                    <input type="text" name="productos[${productoIndex}][subtotal]" class="form-control subtotal-input" readonly>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-producto-btn">Eliminar</button>
                </div>
            `;
            productosContainer.appendChild(newProductoRow);
            productoIndex++;
        });

        document.getElementById('productos-container').addEventListener('change', function(event) {
            if (event.target.classList.contains('producto-select')) {
                const selectedOption = event.target.options[event.target.selectedIndex];
                const precio = selectedOption.getAttribute('data-precio');
                const row = event.target.closest('.producto-row');
                row.querySelector('.precio-unitario-input').value = precio;
                row.querySelector('.cantidad-input').dispatchEvent(new Event('input'));
            }
        });

        document.getElementById('productos-container').addEventListener('input', function(event) {
            if (event.target.classList.contains('cantidad-input')) {
                const row = event.target.closest('.producto-row');
                const cantidad = parseFloat(event.target.value) || 0;
                const precioUnitario = parseFloat(row.querySelector('.precio-unitario-input').value) || 0;
                const subtotal = cantidad * precioUnitario;
                row.querySelector('.subtotal-input').value = subtotal.toFixed(2);
                calculateTotal();
            }
        });

        document.getElementById('productos-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-producto-btn')) {
                const row = event.target.closest('.producto-row');
                row.remove();
                calculateTotal();
            }
        });
    });
</script>
@endsection
