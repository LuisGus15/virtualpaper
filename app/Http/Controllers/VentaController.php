<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client;

class VentaController extends Controller
{
    // Métodos para administrador

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

    public function indexCliente()
    {
        $ventas = Venta::where('usuario_id', Auth::id())->with('detalles.producto')->get();
        return view('cliente.ventas.index', compact('ventas'));
    }

    public function createCliente()
    {
        $productos = Producto::all();
        return view('cliente.ventas.create', compact('productos'));
    }

    public function storeCliente(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:producto,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
        ]);

        $total = 0;
        foreach ($request->productos as $producto) {
            $total += $producto['cantidad'] * Producto::find($producto['producto_id'])->precio;
        }

        $venta = Venta::create([
            'estado' => 'Pendiente',
            'fecha_venta' => now(),
            'usuario_id' => Auth::id(),
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

        return redirect()->route('cliente.ventas.index')->with('success', 'Compra realizada con éxito.');
    }

    public function showCliente($id)
    {
        $venta = Venta::with('detalles.producto')->where('id', $id)->where('usuario_id', Auth::id())->first();
        
        if (!$venta) {
            return redirect()->route('cliente.ventas.index')->with('error', 'Venta no encontrada.');
        }

        return view('cliente.ventas.show', compact('venta'));
        
    }


    ///pago facil

    public function pagar($id)
    {
        $venta = Venta::find($id);
    
        // Datos necesarios para PagoFacil
        $lcComerceID = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
        $lnMoneda = 2;
        $lnTelefono = '77777777'; // número de teléfono del cliente
        $lcNombreUsuario = 'Nombre del Usuario';
        $lnCiNit = '1234567';
        $lcNroPago = 'UAGRM-SC-GRUPO1-' . $venta->id;
        $lnMontoClienteEmpresa = $venta->total;
        $lcCorreo = 'cliente@example.com';
        $lcUrlCallBack = route('cliente.ventas.pagar.callback');
        $lcUrlReturn = route('cliente.ventas.index');
    
        // Detalles del pedido
        $taPedidoDetalle = [
            [
                'Serial' => '123456',
                'Producto' => 'Producto de Ejemplo',
                'Cantidad' => 1,
                'Precio' => $venta->total,
                'Descuento' => 0,
                'Total' => $venta->total,
            ]
        ];
    
        $client = new \GuzzleHttp\Client();
    
        $requestData = [
            "tcCommerceID" => $lcComerceID,
            "tnMoneda" => $lnMoneda,
            "tnTelefono" => $lnTelefono,
            'tcNombreUsuario' => $lcNombreUsuario,
            'tnCiNit' => $lnCiNit,
            'tcNroPago' => $lcNroPago,
            "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
            "tcCorreo" => $lcCorreo,
            'tcUrlCallBack' => $lcUrlCallBack,
            "tcUrlReturn" => $lcUrlReturn,
            'taPedidoDetalle' => $taPedidoDetalle,
        ];
    
        try {
            $response = $client->post('https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'json' => $requestData,
            ]);
    
            $result = json_decode($response->getBody()->getContents());
    
            if (isset($result->success) && $result->success) {
                $qrImage = "data:image/png;base64," . json_decode(explode(";", $result->values)[1])->qrImage;
                return view('cliente.ventas.pagar', compact('venta', 'qrImage'));
            } else {
                // Depuración para verificar la respuesta de la API
                dd($result);
                return redirect()->route('cliente.ventas.index')->with('error', 'No se pudo generar el QR.');
            }
        } catch (\Exception $e) {
            // Manejo de excepción para depurar cualquier error
            dd($e->getMessage());
            return redirect()->route('cliente.ventas.index')->with('error', 'Ocurrió un error al intentar generar el QR.');
        }
    }
    
    
    
    }
    
    
