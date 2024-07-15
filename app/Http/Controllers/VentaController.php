<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('usuario')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::all();
        $usuarios = Usuario::all();
        return view('ventas.create', compact('productos', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estado' => 'required',
            'fecha_venta' => 'required|date',
            'usuario_id' => 'required|exists:usuario,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:producto,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
        ]);
    
        $total = 0;
        foreach ($request->productos as $producto) {
            $total += $producto['cantidad'] * Producto::find($producto['producto_id'])->precio;
        }
    
        $venta = Venta::create([
            'estado' => $request->estado,
            'fecha_venta' => $request->fecha_venta,
            'usuario_id' => $request->usuario_id,
            'total' => $total,
        ]);
    
        foreach ($request->productos as $producto) {
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto['producto_id'],
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => Producto::find($producto['producto_id'])->precio,
            ]);
        }
    
        return redirect()->route('ventas.index')->with('success', 'Venta creada con éxito.');
    }
    

    public function show(Venta $venta)
    {
        $venta->load('detalles.producto', 'usuario');
        return view('ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        $productos = Producto::all();
        $usuarios = Usuario::all();
        return view('ventas.edit', compact('venta', 'productos', 'usuarios'));
    }

    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'estado' => 'required',
            'fecha_venta' => 'required|date',
            'usuario_id' => 'required|exists:usuario,id',
            'total' => 'required|numeric|min:0',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:producto,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        $venta->update([
            'estado' => $request->estado,
            'fecha_venta' => $request->fecha_venta,
            'usuario_id' => $request->usuario_id,
            'total' => $request->total,
        ]);

        $venta->detalles()->delete();

        foreach ($request->productos as $producto) {
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto['producto_id'],
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio_unitario'],
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito.');
    }

    public function destroy(Venta $venta)
    {
        $venta->detalles()->delete();
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito.');
    }
}
