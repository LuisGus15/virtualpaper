<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promocion'; // Nombre correcto de la tabla
    protected $fillable = [
        'nombre', 'descripcion', 'descuento_porcentaje', 'fecha_inicio', 'fecha_fin', 'producto_id'
    ];

    public $timestamps = false; // Deshabilitar marcas de tiempo

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

