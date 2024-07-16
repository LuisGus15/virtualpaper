<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\DB;
// Ruta para probar la conexión a la base de datos
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Connected successfully to database ' . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return 'Could not connect to the database. Error: ' . $e->getMessage();
    }
});

// Rutas para el controlador de usuarios
Route::resource('usuarios', UsuarioController::class);

// Ruta para la página de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas para autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Ruta para la página después de iniciar sesión
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');


use Illuminate\Support\Facades\Auth;

// Rutas de autenticación
Auth::routes();

// Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});

// Otras rutas
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta de logout
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');




Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
Route::post('/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');



Route::resource('producto', ProductoController::class)->except(['show']);
Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/producto/agregar', [ProductoController::class, 'create'])->name('producto.create');
Route::post('/producto', [ProductoController::class, 'store'])->name('producto.store');
Route::get('/producto/{id}/editar', [ProductoController::class, 'edit'])->name('producto.edit');
Route::put('/producto/{id}', [ProductoController::class, 'update'])->name('producto.update');
Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');



Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.index');

