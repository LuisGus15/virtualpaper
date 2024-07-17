@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Promoción</h1>
    <form action="{{ route('promociones.update', ['promocion' => $promocion->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $promocion->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $promocion->descripcion }}</textarea>
        </div>
        <div class="form-group">
            <label for="descuento_porcentaje">Descuento (%):</label>
            <input type="number" name="descuento_porcentaje" id="descuento_porcentaje" class="form-control" value="{{ $promocion->descuento_porcentaje }}">
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $promocion->fecha_inicio }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $promocion->fecha_fin }}" required>
        </div>
        <div class="form-group">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $promocion->producto_id == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
<div class="footer">
    <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
</div>
@endsection
