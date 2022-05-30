<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empleado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['H', 'M']);

        return [
            'name' => $this->faker->name($gender),
            'foto' => $this->faker->image(storage_path('app/public/empleados/imagenes'), 640, 480, 'people', false),
            'puesto' => $this->faker->jobTitle,
            'antiguedad' => $this->faker->dateTime('now', null),
            'estatus' => 'alta',
            'email' => $this->faker->unique()->email,
            'telefono' => $this->faker->phoneNumber,
            'genero' => $gender,
            'n_empleado' => $this->faker->unique()->randomNumber(),
            'supervisor_id' => Empleado::alta()->get()->count() ? Empleado::alta()->get()->random()->id : null,
            'area_id' => Area::all()->random()->id,
            'sede_id' => Sede::all()->random()->id,
        ];
    }
}
