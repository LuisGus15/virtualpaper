@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Producto</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('producto.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required>{{ $producto->descripcion }}</textarea>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="{{ $producto->precio }}" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $producto->cantidad }}" required>
            </div>
            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="usuario_registrador_id">Usuario Registrador</label>
                <select class="form-control" id="usuario_registrador_id" name="usuario_registrador_id" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $producto->usuario_registrador_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->id }} - {{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="proveedor_id">Proveedor</label>
                <select class="form-control" id="proveedor_id" name="proveedor_id" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $producto->proveedor_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->id }} - {{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
@endsection
