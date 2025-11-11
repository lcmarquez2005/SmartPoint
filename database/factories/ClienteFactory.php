<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    // Modelo asociado a la factory
    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido1' => $this->faker->lastName,
            'apellido2' => $this->faker->lastName,
            'telefono' => $this->faker->numerify('##########'),
            'fecha_registro' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'deuda' => $this->faker->randomFloat(2, 0, 10000),
            'calle' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'colonia' => $this->faker->citySuffix,
            'cod_postal' => $this->faker->postcode,
            'ciudad' => $this->faker->city,
            'estado' => $this->faker->state,
            'pais' => $this->faker->country,
        ];
    }
}
