<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clientes')->insert([
            'nombre' => 'Luis',
            'apellido1' => 'Marquez',
            'telefono' => '5512345678',
            'ciudad' => 'CDMX',
            'estado' => 'CDMX',
        ]);
        
        Cliente::factory()->count(3)->create();
    }
}
