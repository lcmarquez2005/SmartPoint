<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->string('cod_pro', 50)->primary();
            $table->string('nombre', 45);
            $table->decimal('cantidad', 10, 2);
            $table->decimal('precio', 10, 2);
            $table->decimal('st_minimos', 10, 2)->nullable();
            $table->decimal('st_maximos', 10, 2)->nullable();
            $table->integer('piezas')->nullable();

            // Igual que en el SQL original
            $table->unique('cod_pro');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
