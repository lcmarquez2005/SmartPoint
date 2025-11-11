<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id(); // crea un campo 'id' autoincremental y PRIMARY KEY
            $table->string('metodo_pago', 45)->nullable();
            $table->decimal('total', 10, 2);
            $table->dateTime('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            // Relaciones
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('usuario_id');

            // Claves foráneas
            $table->foreign('cliente_id')
                  ->references('id')
                  ->on('clientes')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            // Índices opcionales (como en tu SQL)
            $table->index('cliente_id', 'fk_ventas_clientes1_idx');
            $table->index('usuario_id', 'fk_ventas_usuarios1_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
