<?php
namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Producto;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = Promocion::all();
        return view('promociones.index', compact('promociones'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('promociones.crear', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'producto_id' => 'required|exists:producto,id',
        ]);

        Promocion::create($request->all());

        return redirect()->route('promociones.index')->with('success', 'Promoción creada con éxito.');
    }

    public function edit(Promocion $promocion)
    {
        $productos = Producto::all();
        return view('promociones.editar', compact('promocion', 'productos'));
    }

    public function update(Request $request, Promocion $promocion)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'producto_id' => 'required|exists:producto,id',
        ]);

        $promocion->update($request->all());

        return redirect()->route('promociones.index')->with('success', 'Promoción actualizada con éxito.');
    }

    public function destroy(Promocion $promocion)
    {
        $promocion->delete();
        return redirect()->route('promociones.index')->with('success', 'Promoción eliminada con éxito.');
    }
}


