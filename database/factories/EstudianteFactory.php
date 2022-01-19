<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstudianteFactory extends Factory
{
    protected $model = Estudiante::class;

    public function definition()
    {
        return [
			'ci' => $this->faker->name,
			'nombre' => $this->faker->name,
			'apellido_paterno' => $this->faker->name,
			'apellido_materno' => $this->faker->name,
			'nacimiento' => $this->faker->name,
			'telefono' => $this->faker->name,
			'correo' => $this->faker->name,
			'genero' => $this->faker->name,
			'ciudad' => $this->faker->name,
			'direccion' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
