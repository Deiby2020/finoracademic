<?php

namespace Database\Factories;

use App\Models\MaestroOferta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MaestroOfertaFactory extends Factory
{
    protected $model = MaestroOferta::class;

    public function definition()
    {
        return [
			'cupo' => $this->faker->name,
			'fkid_materia' => $this->faker->name,
			'fkid_docente' => $this->faker->name,
			'fkid_grupo' => $this->faker->name,
			'fkid_horario' => $this->faker->name,
			'fkid_modulo' => $this->faker->name,
			'fkid_aula' => $this->faker->name,
        ];
    }
}
