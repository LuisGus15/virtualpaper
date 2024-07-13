<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto'; // Nombre de la tabla es singular

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'categoria_id',
        'usario_registrador_id',
        'proveedor_id'
    ];

    // Deshabilitar marcas de tiempo
    public $timestamps = false;

    public function inventario()
    {
        return $this->hasOne(Inventario::class, 'producto_id');
    }
}
