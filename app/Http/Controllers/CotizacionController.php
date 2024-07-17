<?php
// app/Http/Controllers/CotizacionController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Cotizacion;
use App\Models\DetalleCotizacion;
use App\Models\Producto;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::all();
        return view('cotizaciones.index', compact('cotizaciones'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('cotizaciones.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:producto,id',
            'productos.*.cantidad' => 'required|integer|min:1', // Corregido aquí
        ]);

        $cotizacion = new Cotizacion();
        $cotizacion->fecha_cotizacion = now();
        $cotizacion->usuario_id = auth()->id();
        $cotizacion->total = 0;
        $cotizacion->save();

        $total = 0;

        foreach ($request->productos as $productoData) {
            $producto = Producto::find($productoData['id']);
            $cantidad = $productoData['cantidad'];
            $precioUnitario = $producto->precio;

            $detalle = new DetalleCotizacion();
            $detalle->cantidad = $cantidad;
            $detalle->precio_unitario = $precioUnitario;
            $detalle->cotizacion_id = $cotizacion->id;
            $detalle->producto_id = $producto->id;
            $detalle->save();

            $total += $cantidad * $precioUnitario;
        }

        $cotizacion->total = $total;
        $cotizacion->save();

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización creada con éxito.');
    }

    public function show(Cotizacion $cotizacion)
    {
        $cotizacion->load('detalles.producto');
        return view('cotizaciones.show', compact('cotizacion'));
    }

    public function edit(Cotizacion $cotizacion)
    {
        $productos = Producto::all();
        return view('cotizaciones.edit', compact('cotizacion', 'productos'));
    }



    public function destroy(Cotizacion $cotizacion)
    {
        $cotizacion->delete();
        return redirect()->route('cotizaciones.index')->with('success', 'Cotización eliminada con éxito.');
    }

    public function update(Request $request, Cotizacion $cotizacion)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:producto,id',
            'productos.*.cantidad' => 'required|integer|min:1', // Corregido aquí
        ]);

        $cotizacion->fecha_cotizacion = now();
        $cotizacion->usuario_id = auth()->id();
        $cotizacion->total = 0;
        $cotizacion->save();

        $total = 0;
        $cotizacion->detalles()->delete();

        foreach ($request->productos as $productoData) {
            $producto = Producto::find($productoData['id']);
            $cantidad = $productoData['cantidad'];
            $precioUnitario = $producto->precio;

            $detalle = new DetalleCotizacion();
            $detalle->cantidad = $cantidad;
            $detalle->precio_unitario = $precioUnitario;
            $detalle->cotizacion_id = $cotizacion->id;
            $detalle->producto_id = $producto->id;
            $detalle->save();

            $total += $cantidad * $precioUnitario;
        }

        $cotizacion->total = $total;
        $cotizacion->save();

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización actualizada con éxito.');
    }


     // Métodos para cliente
     public function indexCliente()
     {
         $cotizaciones = Cotizacion::where('usuario_id', Auth::id())->with('detalles.producto')->get();
         return view('cliente.cotizaciones.index', compact('cotizaciones'));
     }
 
     public function createCliente()
     {
         $productos = Producto::all();
         return view('cliente.cotizaciones.create', compact('productos'));
     }
 
     public function storeCliente(Request $request)
     {
         $request->validate([
             'productos' => 'required|array',
             'productos.*.producto_id' => 'required|exists:producto,id',
             'productos.*.cantidad' => 'required|integer|min:1',
         ]);
 
         $cotizacion = new Cotizacion();
         $cotizacion->fecha_cotizacion = now();
         $cotizacion->usuario_id = Auth::id();
         $cotizacion->total = 0;
         $cotizacion->save();
 
         $total = 0;
 
         foreach ($request->productos as $productoData) {
             $producto = Producto::find($productoData['producto_id']);
             $cantidad = $productoData['cantidad'];
             $precioUnitario = $producto->precio;
 
             $detalle = new DetalleCotizacion();
             $detalle->cantidad = $cantidad;
             $detalle->precio_unitario = $precioUnitario;
             $detalle->cotizacion_id = $cotizacion->id;
             $detalle->producto_id = $producto->id;
             $detalle->save();
 
             $total += $cantidad * $precioUnitario;
         }
 
         $cotizacion->total = $total;
         $cotizacion->save();
 
         return redirect()->route('cliente.cotizaciones.index')->with('success', 'Cotización creada con éxito.');
     }
 
     public function showCliente($id)
     {
         $cotizacion = Cotizacion::with('detalles.producto')->where('id', $id)->where('usuario_id', Auth::id())->first();
         
         if (!$cotizacion) {
             return redirect()->route('cliente.cotizaciones.index')->with('error', 'Cotización no encontrada.');
         }
 
         return view('cliente.cotizaciones.show', compact('cotizacion'));
     }
}