<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Empresa;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba para crear una empresa';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Empresa::create([
            'nombre' => 'admin',
            'telefono' => 'admin',
        ]);

        $this->info('Test empresa created successfully.');
    }
}
