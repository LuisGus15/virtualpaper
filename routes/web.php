<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\DB;


// Rutas para la conexión a la base de datos
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Connected successfully to database ' . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return 'Could not connect to the database. Error: ' . $e->getMessage();
    }
});

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

Route::get('/change-theme/{themeName}', [ThemeController::class, 'changeTheme'])->name('changeTheme');

// Agrupar todas las rutas que deseas monitorear con los middlewares
Route::middleware(['auth', \App\Http\Middleware\CountPageViews::class, \App\Http\Middleware\SharePageViewCounts::class])->group(function () {
    // Rutas de recursos
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('categoria', CategoriaController::class);
    Route::resource('producto', ProductoController::class)->except(['show', 'create']);
    Route::get('/producto/agregar', [ProductoController::class, 'create'])->name('producto.create');
    Route::resource('inventario', InventarioController::class);
    Route::resource('promociones', PromocionController::class);
    Route::resource('cotizaciones', CotizacionController::class);
    Route::resource('ventas', VentaController::class);

    // Rutas adicionales
    Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
    Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.index');

    Route::get('/promociones', [PromocionController::class, 'index'])->name('promociones.index');
    Route::get('/promociones/create', [PromocionController::class, 'create'])->name('promociones.create');
    Route::post('/promociones', [PromocionController::class, 'store'])->name('promociones.store');
    Route::get('/promociones/{promocion}/edit', [PromocionController::class, 'edit'])->name('promociones.edit');
    Route::patch('/promociones/{promocion}', [PromocionController::class, 'update'])->name('promociones.update');
    Route::delete('/promociones/{promocion}', [PromocionController::class, 'destroy'])->name('promociones.destroy');

    Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('cotizaciones.index');
    Route::get('/cotizaciones/create', [CotizacionController::class, 'create'])->name('cotizaciones.create');
    Route::post('/cotizaciones', [CotizacionController::class, 'store'])->name('cotizaciones.store');
    Route::get('/cotizaciones/{cotizacion}', [CotizacionController::class, 'show'])->name('cotizaciones.show');
    Route::get('/cotizaciones/{cotizacion}/edit', [CotizacionController::class, 'edit'])->name('cotizaciones.edit');
    Route::patch('/cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])->name('cotizaciones.update');
    Route::delete('/cotizaciones/{cotizacion}', [CotizacionController::class, 'destroy'])->name('cotizaciones.destroy');

    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::patch('/ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');
    Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');
    Route::get('/ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');


    // Rutas para clientes
    Route::get('/cliente/ventas', [VentaController::class, 'indexCliente'])->name('cliente.ventas.index');
    Route::get('/cliente/ventas/create', [VentaController::class, 'createCliente'])->name('cliente.ventas.create');
    Route::post('/cliente/ventas', [VentaController::class, 'storeCliente'])->name('cliente.ventas.store');

    Route::get('/catalogo', [ProductoController::class, 'showCustomerProducts'])->name('products.customer');
    Route::get('/customer', [ProductoController::class, 'customer'])->name('productos.customer');
});
