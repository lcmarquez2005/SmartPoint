<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->string('telefono', 11);
            $table->dateTime('fecha_registro')->useCurrent();
            $table->decimal('deuda', 10, 2)->nullable();
            $table->string('calle', 100)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('colonia', 100)->nullable();
            $table->string('cod_postal', 10)->nullable();
            $table->string('ciudad', 50);
            $table->string('estado', 50);
            $table->string('pais', 50)->default('Mexico');

            // Opcional si quieres mantener igual que el SQL original
            $table->unique('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
