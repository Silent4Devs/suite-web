<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Sede;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $empleados = Empleado::factory(7)->create();
        // foreach ($empleados as $idx => $empleado) {
        //     if ($idx != 0) {
        //         $empleado->update([
        //             'supervisor_id' => Empleado::where('name','s')->random()->id,
        //         ]);
        //     }
        // }
        $empleados = [
            [
                'name' => 'Cesar Gabriel Borre Gonzalez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista de Contenido')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 1,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Tania Michelle Garcia Aguillón',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista de Diseño')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 2,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Adrian Orrante Mandujano',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Arquitecto De Soluciones')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 3,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Alejandra Ivonne Vela Saldaña',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista Sr. Alianzas Estratégicas')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 4,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Jenifer Ashanti Vazquez Fuentes',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Asistente')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 5,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Miguel Angel Gaspar Galicia',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Líder de Innovación y Desarrollo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5578233000',
                'extension' => '151',
                'telefono_movil' => '5572480010',
                'n_empleado' => 6,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Maria Fernanda Hernandez Zuñiga',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista Gestión de Talento')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 7,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Rut Miranda Garza',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista Gestión de Talento')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 8,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Lezly Dialid Cerón Rodríguez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Pentest Jr.')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 9,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'David Adrian Orozco Parada',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Inteligencia del Negocio')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 10,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Diana Evelyn Ibañez Diaz',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Inteligencia del Negocio')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 11,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Brenda Liliana Gonzalez Garcia',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee De Operaciones')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 12,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Emmanuel Alanis Rodriguez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Ingeniero en Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 13,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Enrique Daniel Villanueva Gonzalez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Ingeniero en Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 14,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Luis Antonio Pedroza Hernández',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Ingeniero en Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 15,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Omar Alejandro Barrientos Alcantara',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Ingeniero en Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 16,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Yediael Ceja Martinez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Consultor Junior')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5578233000',
                'extension' => null,
                'telefono_movil' => null,
                'extension' => '146',
                'n_empleado' => 17,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Alejandro Said Pacheco Salas',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Consultor Junior')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5578233000',
                'extension' => '146',
                'telefono_movil' => null,
                'n_empleado' => 18,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Araceli Herrejon Lopez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Desarrollo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 19,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Carlos Enrique Sanchez Flores',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'ITMS')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 21,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Elliot Cejudo Gastelum',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Desarrollo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 22,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Juan Jesus Baena Guzmán',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'ITSM')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 23,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Juan Manuel Hoyos Trejo',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'ITSM')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 24,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Julio Alfredo Gomez Santos',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Desarrollo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 25,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Leonardo Martinez Reyes',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'ITSM')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 26,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Nancy Paola Martinez Orozco',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'ITSM')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 27,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Rubén Moreno Figueroa',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Desarrollo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 28,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Abraham Domínguez Melquiades',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee de Ciberinteligencia')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 29,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Alan Rivera Lopez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Gerente Comercial IP')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 30,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Alfredo Ramírez Olivera',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Gerente De Arquitectura')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 31,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Arlen Raymundo Rodriguez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Líder Comercial de Gobierno')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 32,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Josele Espinosa Garcia',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Gerente Comercial IP / Gobierno')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 33,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Gerardo Daniel Hernandez Mendoza',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Soporte Nivel 1')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 34,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Jorge Luis Chávez Sánchez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Líder SOC')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 35,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Nancy Ayala Alvarado',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Supervisor Operativo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 36,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Pedro Andres Garcia Diaz',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Soporte Técnico Interno')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 37,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Francisco Javier Bernal Segura',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista de Contabilidad')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 38,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Maria Del Carmen Ruiz Mendez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista de Contabilidad')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 39,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Elvira Rivera Mendoza',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista de Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 40,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Carlos Fernando Cruz Avalos',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Soporte y BI')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 41,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Felipe De Jesús Riofrio León',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'ITSM Y Cognitive Services')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 42,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Mauricio Navarro Marín',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 43,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Alain Cruz Pasaflores',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 44,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'José Jonathan Rodriguez Palacios',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Consultor Junior')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 45,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Ángel Jesús Beltran Acosta',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Director Sr. Innovación y Nuevos Productos')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 46,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Daniela Castro Rivas',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Asistente de Dirección')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 47,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Eligio Rangel Castillo',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Operativo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 48,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Gerardo Garibay Aymes',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Director Jr. Comercial')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 49,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Hector Reyes Rivera',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Operativo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 50,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Juan Francisco Curiel Morales',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Gerente De Operaciones')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 51,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Lourdes Del Pilar Abadía Velasco',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Director Jr. de Finanzas y Administración')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 52,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Marco Antonio Luna Robles',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Líder de Consultoría Estratégica')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5578233000',
                'extension' => '158',
                'telefono_movil' => null,
                'n_empleado' => 53,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Monica Adriana Soto Barrios',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Operativo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 54,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Oscar Francisco Castro Careaga',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Líder de Servicios de Ciberinteligencia')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 55,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Melissa Bustos Cervantes',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 56,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Arely Santillán Martínez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Coordinador de Gestión de Talento')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 57,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Gilberto Miranda Maltos',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Control Documental')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 58,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Ma. Del Rosario Palomero Rivero',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Líder de Entrega de Servicios')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 59,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Jenny Kalid Flores Montaño',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Líder de Contraloría')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 60,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Benito López Mejia',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee Desarrollador Web')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 61,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Omar Alejandro Perez Garcia',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee Desarrollador Web')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 62,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Rosa Gabriela Esperanza Angela Sushet Lizy Uzi Flores Moreno',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee Desarrollador Web')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 63,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Uriel Santiago Reyes Paredes',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee Desarrollador Web')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5578233000',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 64,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Eugenia Elizabeth Gomez Lima',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista De Calidad')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 65,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Juana Judith Balderas León',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Operativo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 66,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Leticia Landeros Huerta',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Project Manager Servicios')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 67,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Nancy Ivette Delgadillo Alburquerque',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Especialista')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 68,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Enrique Ivan Caliz Morales',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Consultor Senior')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 69,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Erika Denisse Rosales Arellano',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Especialista de Consultoría Estratégica')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 70,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Adilen Mendoza Candela',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista de Contabilidad')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 71,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Hector Hernandez Islas',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 72,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Julio Alberto Mendieta Mariles',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 73,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Leonardo Favio Garduño Miranda',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Automatización')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 74,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Luis Adolfo Gomez Munive',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 75,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Ricardo Jerez De La Cruz',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 76,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Amado Valdemar Leonel Rodriguez Vargas',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Monitoreo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 77,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Karen Maraí Rodriguez Gálvez',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista De Innovación Y Desarrollo')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 78,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Luis Fernando Jonathan Vargas Osornio',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee Desarrollador Web')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5578233000',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 79,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Mariana Gallegos Illescas',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Trainee')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 80,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Arturo Cabrera De Anda',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Pentest Sr.')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 81,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Gabriela Peralta Diaz',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Analista de Ciberinteligencia')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 82,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Gustavo Alberto Rojas Lucio',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Especialista Ciberinteligencia')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 83,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Angel Rubén Beltran Araujo',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Director Sr. Nuevos Productos')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 84,
                'genero' => 'H',
                'sede_id' => Sede::all()->random()->id,
            ], [
                'name' => 'Layla Esperanza Delgadillo Aguilar',
                'foto' => null,
                'puesto_id' => Puesto::where('puesto', 'Director(a) General')->first()->id,
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'email' => 'correotest@silent4business.com',
                'area_id' => Area::all()->random()->id,
                'created_at' => Carbon::now(),
                'telefono' => '5555555555',
                'extension' => null,
                'telefono_movil' => null,
                'n_empleado' => 85,
                'genero' => 'M',
                'sede_id' => Sede::all()->random()->id,
            ],
        ];

        Empleado::insert($empleados);

        $lista_empleados = Empleado::all();

        foreach ($lista_empleados as $idx => $empleado) {
            switch ($empleado->name) {
                case 'Cesar Gabriel Borre Gonzalez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Alejandra Ivonne Vela Saldaña')->first()->id,
                    ]);
                    break;
                case 'Tania Michelle Garcia Aguillón':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Alejandra Ivonne Vela Saldaña')->first()->id,
                    ]);
                    break;
                case 'Adrian Orrante Mandujano':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Alfredo Ramírez Olivera')->first()->id,
                    ]);
                    break;
                case 'Alejandra Ivonne Vela Saldaña':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Ángel Jesús Beltran Acosta')->first()->id,
                    ]);
                    break;
                case 'Jenifer Ashanti Vazquez Fuentes':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Ángel Jesús Beltran Acosta')->first()->id,
                    ]);
                    break;
                case 'Miguel Angel Gaspar Galicia':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Ángel Jesús Beltran Acosta')->first()->id,
                    ]);
                    break;
                case 'Maria Fernanda Hernandez Zuñiga':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Arely Santillán Martínez')->first()->id,
                    ]);
                    break;
                case 'Rut Miranda Garza':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Arely Santillán Martínez')->first()->id,
                    ]);
                    break;
                case 'Lezly Dialid Cerón Rodríguez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Arturo Cabrera De Anda')->first()->id,
                    ]);
                    break;
                case 'David Adrian Orozco Parada':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Carlos Fernando Cruz Avalos')->first()->id,
                    ]);
                    break;
                case 'Diana Evelyn Ibañez Diaz':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Carlos Fernando Cruz Avalos')->first()->id,
                    ]);
                    break;
                case 'Brenda Liliana Gonzalez Garcia':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Elvira Rivera Mendoza')->first()->id,
                    ]);
                    break;
                case 'Emmanuel Alanis Rodriguez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Elvira Rivera Mendoza')->first()->id,
                    ]);
                    break;
                case 'Enrique Daniel Villanueva Gonzalez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Elvira Rivera Mendoza')->first()->id,
                    ]);
                    break;
                case 'Luis Antonio Pedroza Hernández':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Elvira Rivera Mendoza')->first()->id,
                    ]);
                    break;
                case 'Omar Alejandro Barrientos Alcantara':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Elvira Rivera Mendoza')->first()->id,
                    ]);
                    break;
                case 'Yediael Ceja Martinez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Enrique Ivan Caliz Morales')->first()->id,
                    ]);
                    break;
                case 'Alejandro Said Pacheco Salas':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Erika Denisse Rosales Arellano')->first()->id,
                    ]);
                    break;
                case 'Araceli Herrejon Lopez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Carlos Enrique Sanchez Flores':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Elliot Cejudo Gastelum':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Juan Jesus Baena Guzmán':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Juan Manuel Hoyos Trejo':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Julio Alfredo Gomez Santos':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Leonardo Martinez Reyes':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Nancy Paola Martinez Orozco':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Rubén Moreno Figueroa':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Felipe De Jesús Riofrio León')->first()->id,
                    ]);
                    break;
                case 'Abraham Domínguez Melquiades':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Gabriela Peralta Diaz')->first()->id,
                    ]);
                    break;
                case 'Alan Rivera Lopez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Gerardo Garibay Aymes')->first()->id,
                    ]);
                    break;
                case 'Alfredo Ramírez Olivera':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Gerardo Garibay Aymes')->first()->id,
                    ]);
                    break;
                case 'Arlen Raymundo Rodriguez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Gerardo Garibay Aymes')->first()->id,
                    ]);
                    break;
                case 'Josele Espinosa Garcia':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Gerardo Garibay Aymes')->first()->id,
                    ]);
                    break;
                case 'Gerardo Daniel Hernandez Mendoza':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Hector Reyes Rivera')->first()->id,
                    ]);
                    break;
                case 'Jorge Luis Chávez Sánchez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Hector Reyes Rivera')->first()->id,
                    ]);
                    break;
                case 'Nancy Ayala Alvarado':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Hector Reyes Rivera')->first()->id,
                    ]);
                    break;
                case 'Pedro Andres Garcia Diaz':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Hector Reyes Rivera')->first()->id,
                    ]);
                    break;
                case 'Francisco Javier Bernal Segura':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Jenny Kalid Flores Montaño')->first()->id,
                    ]);
                    break;
                case 'Maria Del Carmen Ruiz Mendez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Jenny Kalid Flores Montaño')->first()->id,
                    ]);
                    break;
                case 'Elvira Rivera Mendoza':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Jorge Luis Chávez Sánchez')->first()->id,
                    ]);
                    break;
                case 'Carlos Fernando Cruz Avalos':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Juan Francisco Curiel Morales')->first()->id,
                    ]);
                    break;
                case 'Felipe De Jesús Riofrio León':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Juan Francisco Curiel Morales')->first()->id,
                    ]);
                    break;
                case 'Mauricio Navarro Marín':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Juan Francisco Curiel Morales')->first()->id,
                    ]);
                    break;
                case 'Alain Cruz Pasaflores':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Juana Judith Balderas León')->first()->id,
                    ]);
                    break;
                case 'José Jonathan Rodriguez Palacios':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Karen Maraí Rodriguez Gálvez')->first()->id,
                    ]);
                    break;
                case 'Ángel Jesús Beltran Acosta':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Daniela Castro Rivas':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Eligio Rangel Castillo':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Gerardo Garibay Aymes':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Hector Reyes Rivera':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Juan Francisco Curiel Morales':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Lourdes Del Pilar Abadía Velasco':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Marco Antonio Luna Robles':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Monica Adriana Soto Barrios':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Oscar Francisco Castro Careaga':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Melissa Bustos Cervantes':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Leticia Landeros Huerta')->first()->id,
                    ]);
                    break;
                case 'Arely Santillán Martínez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Lourdes Del Pilar Abadía Velasco')->first()->id,
                    ]);
                    break;
                case 'Gilberto Miranda Maltos':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Lourdes Del Pilar Abadía Velasco')->first()->id,
                    ]);
                    break;
                case 'Ma. Del Rosario Palomero Rivero':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Lourdes Del Pilar Abadía Velasco')->first()->id,
                    ]);
                    break;
                case 'Jenny Kalid Flores Montaño':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Lourdes Del Pilar Abadía Velasco')->first()->id,
                    ]);
                    break;
                case 'Benito López Mejia':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Luis Fernando Jonathan Vargas Osornio')->first()->id,
                    ]);
                    break;
                case 'Omar Alejandro Perez Garcia':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Luis Fernando Jonathan Vargas Osornio')->first()->id,
                    ]);
                    break;
                case 'Rosa Gabriela Esperanza Angela Sushet Lizy Uzi Flores Moreno':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Luis Fernando Jonathan Vargas Osornio')->first()->id,
                    ]);
                    break;
                case 'Uriel Santiago Reyes Paredes':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Luis Fernando Jonathan Vargas Osornio')->first()->id,
                    ]);
                    break;
                case 'Eugenia Elizabeth Gomez Lima':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Ma. Del Rosario Palomero Rivero')->first()->id,
                    ]);
                    break;
                case 'Juana Judith Balderas León':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Ma. Del Rosario Palomero Rivero')->first()->id,
                    ]);
                    break;
                case 'Leticia Landeros Huerta':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Ma. Del Rosario Palomero Rivero')->first()->id,
                    ]);
                    break;
                case 'Nancy Ivette Delgadillo Alburquerque':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Ma. Del Rosario Palomero Rivero')->first()->id,
                    ]);
                    break;
                case 'Enrique Ivan Caliz Morales':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Marco Antonio Luna Robles')->first()->id,
                    ]);
                    break;
                case 'Erika Denisse Rosales Arellano':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Marco Antonio Luna Robles')->first()->id,
                    ]);
                    break;
                case 'Adilen Mendoza Candela':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Maria Del Carmen Ruiz Mendez')->first()->id,
                    ]);
                    break;
                case 'Hector Hernandez Islas':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Mauricio Navarro Marín')->first()->id,
                    ]);
                    break;
                case 'Julio Alberto Mendieta Mariles':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Mauricio Navarro Marín')->first()->id,
                    ]);
                    break;
                case 'Leonardo Favio Garduño Miranda':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Mauricio Navarro Marín')->first()->id,
                    ]);
                    break;
                case 'Luis Adolfo Gomez Munive':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Mauricio Navarro Marín')->first()->id,
                    ]);
                    break;
                case 'Ricardo Jerez De La Cruz':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Mauricio Navarro Marín')->first()->id,
                    ]);
                    break;
                case 'Amado Valdemar Leonel Rodriguez Vargas':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Mauricio Navarro Marín')->first()->id,
                    ]);
                    break;
                case 'Karen Maraí Rodriguez Gálvez':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Miguel Angel Gaspar Galicia')->first()->id,
                    ]);
                    break;
                case 'Luis Fernando Jonathan Vargas Osornio':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Miguel Angel Gaspar Galicia')->first()->id,
                    ]);
                    break;
                case 'Mariana Gallegos Illescas':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Nancy Ivette Delgadillo Alburquerque')->first()->id,
                    ]);
                    break;
                case 'Arturo Cabrera De Anda':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Oscar Francisco Castro Careaga')->first()->id,
                    ]);
                    break;
                case 'Gabriela Peralta Diaz':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Oscar Francisco Castro Careaga')->first()->id,
                    ]);
                    break;
                case 'Gustavo Alberto Rojas Lucio':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Oscar Francisco Castro Careaga')->first()->id,
                    ]);
                    break;
                case 'Angel Rubén Beltran Araujo':
                    $empleado->update([
                        'supervisor_id' => Empleado::where('name', 'Layla Esperanza Delgadillo Aguilar')->first()->id,
                    ]);
                    break;
                case 'Layla Esperanza Delgadillo Aguilar':
                    $empleado->update([
                        'supervisor_id' => null,
                    ]);
                    break;
                default:

                    break;
            }
        }
    }
}
