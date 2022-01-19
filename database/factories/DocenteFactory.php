<?php

namespace Database\Factories;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocenteFactory extends Factory
{
    protected $model = Docente::class;

    public function definition()
    {
        return [
			'nit' => $this->faker->name,
			'nombre' => $this->faker->name,
			'apellido_paterno' => $this->faker->name,
			'apellido_materno' => $this->faker->name,
			'profesion' => $this->faker->name,
			'nacimiento' => $this->faker->name,
			'telefono' => $this->faker->name,
			'correo' => $this->faker->name,
			'genero' => $this->faker->name,
			'direccion' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
