<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $numero = 1;

        return [
            'area' => 'Area ' . $numero++,
            'id_grupo' => Grupo::all()->random()->id,
            'id_reporta' => Area::all()->count() ? Area::all()->random()->id : null,
            'descripcion' => $this->faker->sentence(),
        ];
    }
}
