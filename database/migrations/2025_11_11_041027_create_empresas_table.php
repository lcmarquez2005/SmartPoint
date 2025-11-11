<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('telefono', 11);

            // Opcional, igual que el SQL original
            $table->unique('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
