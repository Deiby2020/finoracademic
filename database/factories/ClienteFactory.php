<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
			'ci' => $this->faker->name,
			'nombre' => $this->faker->name,
			'apellido_paterno' => $this->faker->name,
			'apellido_materno' => $this->faker->name,
			'genero' => $this->faker->name,
			'estado_civil' => $this->faker->name,
			'telefono' => $this->faker->name,
			'correo' => $this->faker->name,
			'ciudad' => $this->faker->name,
			'direccion' => $this->faker->name,
        ];
    }
}
