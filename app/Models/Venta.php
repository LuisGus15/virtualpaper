<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'estado', 'fecha_venta', 'total', 'usuario_id'
    ];

    public $timestamps = false; // Deshabilitar marcas de tiempo

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}

