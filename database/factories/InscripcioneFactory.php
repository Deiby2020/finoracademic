<?php

namespace Database\Factories;

use App\Models\Inscripcione;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InscripcioneFactory extends Factory
{
    protected $model = Inscripcione::class;

    public function definition()
    {
        return [
			'fkid_gestion' => $this->faker->name,
			'fkid_estudiante' => $this->faker->name,
        ];
    }
}
