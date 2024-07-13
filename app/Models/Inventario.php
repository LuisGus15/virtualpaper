<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';

    protected $fillable = [
        'cantidad_disponible',
        'fecha_ultima_actualizacion',
        'producto_id',
    ];

    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
