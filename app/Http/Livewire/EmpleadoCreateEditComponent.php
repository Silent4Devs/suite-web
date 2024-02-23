<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\PerfilEmpleado;
use App\Models\Puesto;
use App\Models\RH\EntidadCrediticia;
use App\Models\RH\TipoContratoEmpleado;
use App\Models\Sede;
use Livewire\Component;

class EmpleadoCreateEditComponent extends Component
{
    public $name;

    public $n_registro;

    public $foto;

    public $puesto;

    public $antiguedad;

    public $estatus;

    public $email;

    public $telefono;

    public $extension;

    public $telefono_movil;

    public $genero;

    public $n_empleado;

    public $supervisor_id;

    public $area_id;

    public $sede_id;

    public $direccion;

    public $cumpleaños;

    public $resumen;

    public $puesto_id = 0;

    public $perfil_empleado_id;

    public $tipo_contrato_empleados_id;

    public $terminacion_contrato;

    public $renovacion_contrato;

    public $esquema_contratacion;

    public $proyecto_asignado;

    public $domicilio_personal;

    public $telefono_casa;

    public $correo_personal;

    public $estado_civil;

    public $NSS;

    public $CURP;

    public $RFC;

    public $lugar_nacimiento;

    public $nacionalidad;

    public $entidad_crediticias_id;

    public $numero_credito;

    public $descuento;

    public $banco;

    public $cuenta_bancaria;

    public $clabe_interbancaria;

    public $centro_costos;

    public $salario_bruto;

    public $salario_diario;

    public $salario_diario_integrado;

    public $salario_base_mensual;

    public $pagadora_actual;

    public $periodicidad_nomina;

    public $empleados;

    public $ceo_exists;

    public $areas;

    public $sedes;

    public $experiencias;

    public $educacions;

    public $cursos;

    public $documentos;

    public $certificaciones;

    public $puestos;

    public $perfiles;

    public $tipoContratoEmpleado;

    public $entidadesCrediticias;

    public $empleado;

    public function mount()
    {

    }

    public function render()
    {
        $this->empleados = Empleado::getaltaAll();
        $this->ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $this->areas = Area::getAll();
        $this->sedes = Sede::getAll();
        $this->puestos = Puesto::getAll();
        $this->perfiles = PerfilEmpleado::getAll();
        $this->tipoContratoEmpleado = TipoContratoEmpleado::getAll();
        $this->entidadesCrediticias = EntidadCrediticia::select('id', 'entidad')->get();

        return view('livewire.empleado-create-edit-component');
    }

    public function store()
    {
        Empleado::create([
            'name' => $this->name,
            'area_id' => $this->area_id,
            'puesto_id' => $this->puesto_id,
            'perfil_empleado_id' => $this->perfil_empleado_id,
            'supervisor_id' => $this->supervisor_id,
            'antiguedad' => $this->antiguedad,
            'estatus' => $this->estatus,
            'email' => removeUnicodeCharacters($this->email),
            'telefono' => $this->telefono,
            'genero' => $this->genero,
            'n_empleado' => $this->n_empleado,
            'n_registro' => $this->n_registro,
            'sede_id' => $this->sede_id,
            'resumen' => $this->resumen,
            'cumpleaños' => $this->cumpleaños,
            'direccion' => $this->direccion,
            'telefono_movil' => $this->telefono_movil,
            'extension' => $this->extension,
            'cumpleaños' => $this->cumpleaños,
            'direccion' => $this->direccion,
            'tipo_contrato_empleados_id' => $this->tipo_contrato_empleados_id,
            'terminacion_contrato' => $this->terminacion_contrato,
            'renovacion_contrato' => $this->renovacion_contrato,
            'esquema_contratacion' => $this->esquema_contratacion,
            'proyecto_asignado' => $this->proyecto_asignado,
            'domicilio_personal' => $this->domicilio_personal,
            'telefono_casa' => $this->telefono_casa,
            'correo_personal' => $this->correo_personal,
            'estado_civil' => $this->estado_civil,
            'NSS' => $this->NSS,
            'CURP' => $this->CURP,
            'RFC' => $this->RFC,
            'lugar_nacimiento' => $this->lugar_nacimiento,
            'nacionalidad' => $this->nacionalidad,
            'entidad_crediticias_id' => $this->entidad_crediticias_id,
            'numero_credito' => $this->numero_credito,
            'descuento' => $this->descuento,
            'banco' => $this->banco,
            'cuenta_bancaria' => $this->cuenta_bancaria,
            'clabe_interbancaria' => $this->clabe_interbancaria,
            'centro_costos' => $this->centro_costos,
            'salario_bruto' => $this->salario_bruto,
            'salario_diario' => $this->salario_diario,
            'salario_diario_integrado' => $this->salario_diario_integrado,
            'salario_base_mensual' => $this->salario_base_mensual,
            'pagadora_actual' => $this->pagadora_actual,
            'periodicidad_nomina' => $this->periodicidad_nomina,
        ]);
    }
}
