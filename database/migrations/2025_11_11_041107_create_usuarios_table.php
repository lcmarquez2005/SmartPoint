<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // crea un BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('username', 100)->unique();
            $table->string('password', 255);
            $table->string('rol', 45)->nullable();
            $table->unsignedBigInteger('empresa_id');

            // Clave primaria compuesta

            // Índices adicionales
            $table->index('empresa_id', 'fk_usuarios_config1_idx');

            // Relación con empresas
            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
