<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_venta'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'cantidad', 'precio_unitario', 'venta_id', 'producto_id'
    ];

    public $timestamps = false; // Deshabilitar marcas de tiempo

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
