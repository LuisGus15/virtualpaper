<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\VentaController;


// Rutas para la conexión a la base de datos
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

// Rutas para categorías
Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
Route::post('/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');

// Rutas para productos
Route::resource('producto', ProductoController::class)->except(['show']);
Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/producto/agregar', [ProductoController::class, 'create'])->name('producto.create');
Route::post('/producto', [ProductoController::class, 'store'])->name('producto.store');
Route::get('/producto/{id}/editar', [ProductoController::class, 'edit'])->name('producto.edit');
Route::put('/producto/{id}', [ProductoController::class, 'update'])->name('producto.update');
Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

// Ruta para inventario
Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.index');

// Rutas para promociones
//Route::resource('promociones', PromocionController::class);
// Rutas para promociones
Route::get('/promociones', [PromocionController::class, 'index'])->name('promociones.index');
Route::get('/promociones/create', [PromocionController::class, 'create'])->name('promociones.create');
Route::post('/promociones', [PromocionController::class, 'store'])->name('promociones.store');
Route::get('/promociones/{promocion}/edit', [PromocionController::class, 'edit'])->name('promociones.edit');
Route::patch('/promociones/{promocion}', [PromocionController::class, 'update'])->name('promociones.update');
Route::delete('/promociones/{promocion}', [PromocionController::class, 'destroy'])->name('promociones.destroy');


//Route::resource('cotizaciones', CotizacionController::class);

Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('cotizaciones.index');
Route::get('/cotizaciones/create', [CotizacionController::class, 'create'])->name('cotizaciones.create');
Route::post('/cotizaciones', [CotizacionController::class, 'store'])->name('cotizaciones.store');
Route::get('/cotizaciones/{cotizacion}', [CotizacionController::class, 'show'])->name('cotizaciones.show');
Route::get('/cotizaciones/{cotizacion}/edit', [CotizacionController::class, 'edit'])->name('cotizaciones.edit');
Route::patch('/cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])->name('cotizaciones.update');
Route::delete('/cotizaciones/{cotizacion}', [CotizacionController::class, 'destroy'])->name('cotizaciones.destroy');




// Rutas para ventas
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
Route::patch('/ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');
Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');
Route::get('/ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');