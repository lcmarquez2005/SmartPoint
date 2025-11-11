<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->integer('id')->autoIncrement(false);
            $table->dateTime('fecha')->useCurrent();
            $table->string('tipo', 100);
            $table->decimal('monto', 10, 2);
            $table->string('descripcion', 100)->nullable();
            $table->unsignedBigInteger('usuario_id');

            // Clave primaria compuesta
            $table->primary(['id', 'usuario_id']);

            // Índices adicionales
            $table->unique('id');
            $table->index('usuario_id', 'fk_transaccioncaja_usuarios1_idx');

            // Llave foránea
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
