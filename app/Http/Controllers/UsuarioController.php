<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|unique:usuario,correo',
            'contrasena' => 'required',
            'edad' => 'required|integer',
            'celular' => 'required',
            'sexo' => 'required',
            'rol' => 'required',
        ]);

        $usuario = new Usuario([
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'correo' => $request->get('correo'),
            'contrasena' => bcrypt($request->get('contrasena')),
            'edad' => $request->get('edad'),
            'celular' => $request->get('celular'),
            'sexo' => $request->get('sexo'),
            'rol' => $request->get('rol'),
        ]);

        $usuario->save();
        return redirect('/usuarios')->with('success', 'Usuario guardado!');
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|unique:usuario,correo,'.$id,
            'contrasena' => 'nullable',
            'edad' => 'required|integer',
            'celular' => 'required',
            'sexo' => 'required',
            'rol' => 'required',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->nombre = $request->get('nombre');
        $usuario->apellido = $request->get('apellido');
        $usuario->correo = $request->get('correo');
        if ($request->get('contrasena')) {
            $usuario->contrasena = bcrypt($request->get('contrasena'));
        }
        $usuario->edad = $request->get('edad');
        $usuario->celular = $request->get('celular');
        $usuario->sexo = $request->get('sexo');
        $usuario->rol = $request->get('rol');
        $usuario->save();

        return redirect('/usuarios')->with('success', 'Usuario actualizado!');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect('/usuarios')->with('success', 'Usuario eliminado!');
    }
}
