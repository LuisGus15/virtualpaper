<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad_disponible');
            $table->date('fecha_ultima_actualizacion');
            $table->foreignId('producto_id')->constrained('producto')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventario');
    }
}


