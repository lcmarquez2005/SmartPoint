<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Empresa;
use App\Models\Usuario;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'username' => $this->faker->userName(),
            'password' => Hash::make('123456'), // contraseña por defecto
            'rol' => $this->faker->randomElement(['admin', 'empleado']),
            'empresa_id' => Empresa::factory(), // crea una empresa asociada si no existe
        ];
    }
}
