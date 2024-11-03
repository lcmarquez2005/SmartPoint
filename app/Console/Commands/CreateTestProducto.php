<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Producto;

class CreateTestProducto extends Command
{
    // Nombre y descripción del comando
    protected $signature = 'producto:create-test';
    protected $description = 'Crea un producto de prueba en la base de datos';

    /**
     * Ejecuta el comando.
     */
    public function handle()
    {
        // Crear un producto de prueba con valores predeterminados
        $producto = Producto::create([
            'cod_pro' => 'TEST123',
            'nombre' => 'Producto de Prueba',
            'cantidad' => 10,
            'precio' => 99.99,
            'st_minimos' => 0.00,
            'st_maximos' => 20.00,
            'piezas' => 10.00,
        ]);

        // Muestra un mensaje de éxito
        $this->info('Producto de prueba creado con éxito: ' . $producto->nombre);
    }
}
