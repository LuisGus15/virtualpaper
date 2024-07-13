<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Usuario;
use App\Models\Inventario;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $usuarios = Usuario::all(); // Asegúrate de tener importado el modelo Usuario
        return view('producto.agregar', compact('categorias', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'categoria_id' => 'required|integer',
            'usuario_registrador_id' => 'required|integer',
            'proveedor_id' => 'required|integer',
        ]);

        $producto = Producto::create($request->all());

        // Crear el registro en la tabla inventario
        Inventario::create([
            'cantidad_disponible' => $request->cantidad,
            'fecha_ultima_actualizacion' => now(),
            'producto_id' => $producto->id,
        ]);

        return redirect()->route('producto.index')->with('success', 'Producto agregado exitosamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $usuarios = Usuario::all(); // Asegúrate de tener importado el modelo Usuario
        return view('producto.editar', compact('producto', 'categorias', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'categoria_id' => 'required|integer',
            'usuario_registrador_id' => 'required|integer',
            'proveedor_id' => 'required|integer',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        // Actualizar el registro en la tabla inventario
        $inventario = Inventario::where('producto_id', $id)->first();
        $inventario->update([
            'cantidad_disponible' => $request->cantidad,
            'fecha_ultima_actualizacion' => now(),
        ]);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        // Eliminar el registro en la tabla inventario
        Inventario::where('producto_id', $id)->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
