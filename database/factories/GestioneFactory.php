<?php

namespace Database\Factories;

use App\Models\Gestione;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GestioneFactory extends Factory
{
    protected $model = Gestione::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
			'fecha_ini' => $this->faker->name,
			'fecha_fin' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
