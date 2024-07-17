<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Venta;

class PagoFacilController extends Controller
{
    public function pagar($id)
    {
        try {
            $venta = Venta::find($id);
            
            // Datos proporcionados por PagoFacil
            $lcComerceID = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda = 2;
            $lnTelefono = '77777777'; // Número de teléfono del cliente
            $lcNombreUsuario = 'Nombre del Usuario'; // Nombre del usuario
            $lnCiNit = '1234567'; // CI o NIT del usuario
            $lcCorreo = 'cliente@example.com'; // Correo del usuario

            // Otros datos necesarios para la transacción
            $lcNroPago = "UAGRM-SC-GRUPO1-" . $venta->id;
            $lnMontoClienteEmpresa = $venta->total;
            $lcUrlCallBack = route('cliente.ventas.pagar.callback');
            $lcUrlReturn = route('cliente.ventas.index');

            // Detalle del pedido
            $laPedidoDetalle = [
                [
                    'Serial' => '123456',
                    'Producto' => 'Producto de Ejemplo',
                    'Cantidad' => 1,
                    'Precio' => $venta->total,
                    'Descuento' => 0,
                    'Total' => $venta->total,
                ]
            ];

            // URL del servicio de PagoFacil
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";

            // Cliente HTTP para enviar la solicitud
            $loClient = new Client();

            // Cabecera y cuerpo de la solicitud
            $laHeader = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer 51247fae280c20410824977b0781453df59fad5b23bf2a0d14e884482f91e09078dbe5966e0b970ba696ec4caf9aa5661802935f86717c481f1670e63f35d5041c31d7cc6124be82afedc4fe926b806755efe678917468e31593a5f427c79cdf016b686fca0cb58eb145cf524f62088b57c6987b3bb3f30c2082b640d7c52907'
            ];

            $laBody = [
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
                'taPedidoDetalle' => $laPedidoDetalle
            ];

            // Envío de la solicitud
            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);

            $laResult = json_decode($loResponse->getBody()->getContents());

            if ($laResult->error === 0) {
                $laValues = explode(";", $laResult->values)[1];
                $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
                return view('cliente.ventas.pagar', compact('venta', 'laQrImage'));
            } else {
                return redirect()->route('cliente.ventas.index')->with('error', $laResult->messageSistema);
            }
        } catch (\Throwable $th) {
            return $th->getMessage() . " - " . $th->getLine();
        }
    }

    public function urlCallback(Request $request)
    {
        // Obtener los datos de la respuesta de PagoFacil
        $ventaID = $request->input('PedidoID');
        $estado = $request->input('Estado');
        $fecha = $request->input('Fecha');
        $hora = $request->input('Hora');
        $metodoPago = $request->input('MetodoPago');
        $monto = $request->input('Monto');
        $transaccionID = $request->input('TransaccionID');
        
        try {
            // Buscar la venta en la base de datos
            $venta = Venta::find($ventaID);
    
            if (!$venta) {
                throw new \Exception("Venta no encontrada");
            }
    
            // Actualizar los detalles de la venta
            $venta->estado = $estado;
            $venta->fecha_pago = $fecha . ' ' . $hora; // Combinar fecha y hora
            $venta->metodo_pago = $metodoPago;
            $venta->monto_pagado = $monto;
            $venta->transaccion_id = $transaccionID;
    
            // Guardar los cambios
            $venta->save();
    
            // Responder a PagoFacil confirmando la recepción del callback
            return response()->json(['message' => 'Pago registrado correctamente'], 200);
        } catch (\Throwable $th) {
            // Manejo de errores
            return response()->json(['message' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }
    
}
