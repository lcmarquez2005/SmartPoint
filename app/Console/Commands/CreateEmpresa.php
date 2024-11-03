<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Empresa;

class CreateEmpresa extends Command
{
    protected $signature = 'empresa:create {nombre} {telefono}';
    protected $description = 'Crear una nueva empresa';

    public function handle()
    {
        $nombre = $this->argument('nombre');
        $telefono = $this->argument('telefono');

        $empresa = Empresa::create([
            'nombre' => $nombre,
            'telefono' => $telefono,
        ]);

        $this->info("Empresa '{$empresa->nombre}' creada exitosamente.");
    }
}
