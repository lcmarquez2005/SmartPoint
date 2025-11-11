<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::firstOrCreate(
            ['username' => 'root'],
            [
                'password' => Hash::make('123456'),
                'rol' => 'root',
                'empresa_id' => 1, // o una empresa específica si prefieres
            ]
        );

        // Usa empresas ya existentes
        $empresas = \App\Models\Empresa::all();

        foreach ($empresas as $empresa) {
            Usuario::factory()->count(1)->create([
                'empresa_id' => $empresa->id
            ]);
        }
    }
}
