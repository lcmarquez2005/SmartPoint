<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abonos_proveedores', function (Blueprint $table) {
            $table->integer('id')->autoIncrement(false);
            $table->decimal('monto', 10, 2);
            $table->dateTime('fecha')->useCurrent();
            $table->unsignedBigInteger('proveedor_id');

            // Clave primaria compuesta
            $table->primary(['id', 'proveedor_id']);

            // Índices adicionales
            $table->unique('id');
            $table->index('proveedor_id', 'fk_abonospro_proveedores1_idx');

            // Llave foránea
            $table->foreign('proveedor_id')
                ->references('id')
                ->on('proveedores')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abonos_proveedores');
    }
};
