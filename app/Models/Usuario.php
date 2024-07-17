<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario'; // Nombre correcto de la tabla

    protected $fillable = [
        'nombre', 'apellido', 'celular', 'contrasena', 'correo', 'edad', 'sexo'
    ];
}
