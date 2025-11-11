<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalles_surtidos', function (Blueprint $table) {
            $table->string('cod_pro', 50);
            $table->unsignedBigInteger('surtido_id');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('precio_compra', 10, 2);

            // Clave primaria compuesta
            $table->primary(['surtido_id', 'cod_pro']);

            // Índices
            $table->index('surtido_id', 'fk_detallesurtir_surtir_idx');
            $table->index('cod_pro', 'fk_detallesurtir_productos1_idx');

            // Llaves foráneas
            $table->foreign('surtido_id')
                ->references('id')
                ->on('surtidos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('cod_pro')
                ->references('cod_pro')
                ->on('productos')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalles_surtidos');
    }
};
