<?php

namespace Database\Factories;

use App\Models\Cuenta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CuentaFactory extends Factory
{
    protected $model = Cuenta::class;

    public function definition()
    {
        return [
			'nro_cuenta' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'fecha_apertura' => $this->faker->name,
			'saldo' => $this->faker->name,
			'tipo_moneda' => $this->faker->name,
			'fkid_cliente' => $this->faker->name,
        ];
    }
}
