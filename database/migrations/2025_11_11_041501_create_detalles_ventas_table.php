<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalles_ventas', function (Blueprint $table) {
            $table->string('cod_pro', 50);
            $table->unsignedBigInteger('venta_id');
            $table->decimal('cantidad', 10, 2);
            $table->unsignedBigInteger('devolucion_id')->nullable();

            // Clave primaria compuesta
            $table->primary(['cod_pro', 'venta_id']);

            // Índices adicionales
            $table->index('venta_id', 'fk_detalle_ventas1_idx');
            $table->index('cod_pro', 'fk_detalles_productos1_idx');
            $table->index('devolucion_id', 'fk_detalles_ventas_devoluciones1_idx');

            // Llaves foráneas
            $table->foreign('venta_id')
                ->references('id')
                ->on('ventas')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('cod_pro')
                ->references('cod_pro')
                ->on('productos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('devolucion_id')
                ->references('id')
                ->on('devoluciones')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalles_ventas');
    }
};
