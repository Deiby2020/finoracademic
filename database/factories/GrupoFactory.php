<?php

namespace Database\Factories;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GrupoFactory extends Factory
{
    protected $model = Grupo::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
