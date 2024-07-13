<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::with('producto')->get();
        return view('inventario.index', compact('inventarios'));
    }
}
