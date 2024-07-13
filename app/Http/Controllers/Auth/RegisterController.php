<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::loginUsingId($user->id);

        return redirect('/home');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuario'],
            'contrasena' => ['required', 'string', 'min:8', 'confirmed'],
            'edad' => ['required', 'integer'],
            'celular' => ['required', 'string', 'max:255'],
            'sexo' => ['required', 'string', 'max:1'],
            'rol' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        $id = DB::table('usuario')->insertGetId([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'correo' => $data['correo'],
            'contrasena' => Hash::make($data['contrasena']),
            'edad' => $data['edad'],
            'celular' => $data['celular'],
            'sexo' => $data['sexo'],
            'rol' => $data['rol'],
        ]);

        return DB::table('usuario')->where('id', $id)->first();
    }
}
