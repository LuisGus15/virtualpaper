<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToProductoTable extends Migration
{
    public function up()
    {
        Schema::table('producto', function (Blueprint $table) {
            $table->timestamps(); // Esta línea añade created_at y updated_at
        });
    }

    public function down()
    {
        Schema::table('producto', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}



