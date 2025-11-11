<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 45)->nullable();
            $table->string('fecha', 45)->nullable();

            // Igual que el SQL original
            $table->unique('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devoluciones');
    }
};
