<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\Macroproceso;
use Illuminate\Database\Eloquent\Factories\Factory;

class MacroprocesoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Macroproceso::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $numero = 1;

        return [
            'codigo' => $this->faker->ean8,
            'nombre' => 'Macroproceso' . $numero++,
            'id_grupo' => Grupo::all()->random()->id,
            'descripcion' => $this->faker->sentence(),
        ];
    }
}
