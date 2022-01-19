<?php

namespace Database\Factories;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AulaFactory extends Factory
{
    protected $model = Aula::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
