<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // equivale a INT AUTO_INCREMENT PRIMARY KEY
            $table->string('nombre', 45);
            $table->string('apellido1', 45);
            $table->string('apellido2', 45)->nullable();
            $table->string('telefono', 11);
            $table->dateTime('fecha_registro')->useCurrent();
            $table->decimal('deuda', 10, 2)->nullable();
            $table->string('calle', 100)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('colonia', 100)->nullable();
            $table->string('cod_postal', 10)->nullable();
            $table->string('ciudad', 50);
            $table->string('estado', 50);
            $table->string('pais', 45)->default('Mexico');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
