<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
       
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto');
    }
}




