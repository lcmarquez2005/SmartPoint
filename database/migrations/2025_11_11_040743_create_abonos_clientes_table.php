<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abonos_clientes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement(false); // No usamos id() porque la PK es compuesta
            $table->decimal('monto', 10, 2);
            $table->dateTime('fecha')->useCurrent();
            $table->unsignedBigInteger('cliente_id');

            // Clave primaria compuesta
            $table->primary(['id', 'cliente_id']);

            // Índices y restricciones adicionales
            $table->unique('monto');
            $table->unique('id');
            $table->index('cliente_id', 'fk_abonos_clientes1_idx');

            // Llave foránea
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abonos_clientes');
    }
};
