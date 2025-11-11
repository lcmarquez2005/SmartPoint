<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surtidos', function (Blueprint $table) {
            $table->unsignedBigInteger('id'); // PRIMARY KEY auto-incremental → ya es UNIQUE
            $table->string('metodo_pago', 45)->nullable();
            $table->decimal('total', 10, 2);
            $table->dateTime('fecha')->useCurrent();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('proveedor_id');

            // Clave primaria compuesta
            $table->primary(['id', 'usuario_id', 'proveedor_id']);

            // Índices adicionales
            $table->index('proveedor_id', 'fk_surtir_proveedor1_idx');
            $table->index('usuario_id', 'fk_surtir_usuarios1_idx');

            // Llaves foráneas
            $table->foreign('proveedor_id')
                ->references('id')
                ->on('proveedores')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surtidos');
    }
};
