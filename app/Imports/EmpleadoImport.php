<?php

namespace App\Imports;

use App\Mail\EnviarCorreoBienvenidaTabantaj;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\PerfilEmpleado;
use App\Models\Puesto;
use App\Models\Role;
use App\Models\User;
use App\Traits\GeneratePassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmpleadoImport implements ToModel, WithHeadingRow, WithValidation
{
    use GeneratePassword;
    use Importable;

    private $empleados;

    private $area;

    public function model(array $row)
    {
        $antiguedad = $this->transformDate($row['ingreso']);
        $birthday = $this->transformDate($row['nacimiento']);
        $this->area = $row['area'];

        $empleado = Empleado::updateOrCreate(
            [
                'name' => ucfirst($row['nombre']),
            ],
            [
                'puesto_id' => Puesto::select('id', 'puesto')->where('puesto', $row['puesto'])->first()->id,
                'area_id' => Area::select('id', 'area')->where('area', $row['area'])->first()->id,
                'antiguedad' => $antiguedad,
                'cumpleaños' => $birthday,
                'email' => removeUnicodeCharacters($row['correo']),
                'supervisor_id' => Empleado::select('id', 'name')->where('name', $row['jefe'])->first()->id,
                'perfil_empleado_id' => PerfilEmpleado::select('id', 'nombre')->where('nombre', $row['jerarquia'])->first()->id,
                'genero' => $row['sexo'],
                'estatus' => 'alta',
            ]
        );

        if (! User::select('id', 'empleado_id')->where('empleado_id', $empleado->id)->exists()) {
            $this->createUserFromEmpleado($empleado);
        }

        return $empleado;
    }

    public function rules(): array
    {
        return [
            '*.nombre' => 'required|string|min:2|max:255',
            '*.puesto' => ['required', 'string', 'min:2', 'max:255', function ($attribute, $value, $onFailure) {
                if (! Puesto::where('puesto', $value)->exists()) {
                    $onFailure('El puesto '.$value.' no está registrado en la herramienta, registrelo e intente nuevamente');
                }
            }],
            '*.area' => ['required', 'string', 'min:2', 'max:255', function ($attribute, $value, $onFailure) {
                if (! Area::where('area', $value)->exists()) {
                    $onFailure('El área '.$value.' no está registrado en la herramienta, registrelo e intente nuevamente');
                }
            }],
            '*.ingreso' => 'required|numeric',
            '*.nacimiento' => 'required|numeric',
            '*.correo' => 'required|email',
            '*.jefe' => ['required', 'string', 'min:2', 'max:255', function ($attribute, $value, $onFailure) {
                if (! Empleado::where('name', $value)->exists()) {
                    $onFailure('El jefe inmediato '.$value.' no está registrado en la herramienta, registrelo e intente nuevamente');
                }
            }],
            '*.jerarquia' => ['required', 'string', 'min:2', 'max:255', function ($attribute, $value, $onFailure) {
                if (! PerfilEmpleado::where('nombre', $value)->exists()) {
                    $onFailure('La jerarquía '.$value.' no está registrada en la herramienta, registrela e intente nuevamente');
                }
            }],
            '*.sexo' => 'required|string|min:1|max:1|in:H,M',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.sexo.in' => 'Debe definir el :attribute solo con las letras H o M',
        ];
    }

    public function createUserFromEmpleado($empleado)
    {
        $generatedPassword = $this->generatePassword();
        $user = User::create([
            'name' => $empleado->name,
            'email' => removeUnicodeCharacters($empleado->email),
            'password' => $generatedPassword['hash'],
            // 'n_empleado' => $empleado->n_empleado,
            'empleado_id' => $empleado->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if (Role::find(4) != null) {
            User::findOrFail($user->id)->roles()->sync(4);
        }
        //Send email with generated password
        Mail::to(removeUnicodeCharacters($empleado->email))->send(new EnviarCorreoBienvenidaTabantaj($empleado, $generatedPassword['password']));

        return $user;
    }

    // public function batchSize(): int
    // {
    //     return 1000; // Only process 1000 rows from file
    // }

    // public function chunkSize(): int
    // {
    //     return 1000;
    // }

    private function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format($format);
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
