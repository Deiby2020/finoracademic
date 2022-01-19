<?php

namespace Database\Factories;

use App\Models\Horario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HorarioFactory extends Factory
{
    protected $model = Horario::class;

    public function definition()
    {
        return [
			'hora_entrada' => $this->faker->name,
			'hora_salida' => $this->faker->name,
			'dia' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
