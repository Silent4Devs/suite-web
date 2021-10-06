<?php

namespace Database\Factories;

use App\Models\Organizacion;
use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;

class SedeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sede::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sede' => $this->faker->state,
            'foto_sedes' => $this->faker->image(storage_path('app/public/sedes/imagenes'), 640, 480, 'city', false),
            'descripcion' => $this->faker->sentence(),
            'organizacion_id' => Organizacion::all()->count() ? Organizacion::all()->random()->id : null,
            'direccion' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitud' => $this->faker->longitude,
        ];
    }
}
