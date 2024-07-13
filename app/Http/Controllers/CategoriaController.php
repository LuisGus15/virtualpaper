<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categoria.index')->with('success', 'Categoría agregada exitosamente.');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categoria.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
