<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateThemesTable extends Migration
{
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('text_color');
            $table->timestamps();
        });

        DB::table('themes')->insert([
            [
                'name' => 'Adulto',
                'primary_color' => '#000000',
                'secondary_color' => '#555555',
                'text_color' => '#FFFFFF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Joven',
                'primary_color' => '#1E90FF',
                'secondary_color' => '#87CEEB',
                'text_color' => '#FFFFFF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Niño',
                'primary_color' => '#FFD700',
                'secondary_color' => '#FFA500',
                'text_color' => '#000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
