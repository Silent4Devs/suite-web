<?php

namespace App\Livewire;

use App\Mail\CorreoCargaObjetivos;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\PerfilEmpleado;
use App\Models\PeriodoCargaObjetivos;
use App\Models\PermisosCargaObjetivos;
use App\Models\Puesto;
use App\Models\RH\Objetivo;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CargaObjetivos extends Component
{
    use LivewireAlert;

    public $empleados;

    public $areas;

    public $puestos;

    public $perfiles;

    public $total_colaboradores = 0;

    public $total_con_objetivos = 0;

    public $total_sin_objetivos = 0;

    public $total_obj_pend = 0;

    public $select_area = 0;

    public $select_puesto = 0;

    public $select_perfil = 0;

    public $select_colaborador = 0;

    public $fecha_inicio = null;

    public $fecha_fin = null;

    public $periodo_habilitado = null;

    public function mount()
    {
        $this->areas = Area::getAll()->sortBy('area');
        $this->puestos = Puesto::getAll()->sortBy('puesto');
        $this->perfiles = PerfilEmpleado::getAll()->sortBy('nombre');

        $periodo = PeriodoCargaObjetivos::first();
        $this->fecha_inicio = $periodo->fecha_inicio ?? null;
        $this->fecha_fin = $periodo->fecha_fin ?? null;
        $this->periodo_habilitado = $periodo->habilitado ?? null;
    }

    public function render()
    {
        // $this->empleados = Empleado::getaltaAllObjetivosGenerales()->sortBy('name');
        $this->empleados = Empleado::alta()->select(
            'id',
            'n_empleado',
            'name',
            'puesto_id',
            'area_id',
            'perfil_empleado_id',
            'foto'
        )->with(['objetivos', 'area:id,area', 'perfil:id,nombre', 'puestoRelacionado:id,puesto'])->get()->sortBy('name');
        $this->cuentasCero();

        if ($this->select_area != 0) {
            $this->empleados = $this->empleados->where('area_id', $this->select_area)->sortBy('name');
            $this->cuentasCero();
        }

        if ($this->select_puesto != 0) {
            $this->empleados = $this->empleados->where('puesto_id', $this->select_puesto)->sortBy('name');
            $this->cuentasCero();
        }

        if ($this->select_perfil != 0) {
            $this->empleados = $this->empleados->where('perfil_empleado_id', $this->select_perfil)->sortBy('name');
            $this->cuentasCero();
        }

        if ($this->select_colaborador != 0) {
            $this->empleados = $this->empleados->where('id', $this->select_colaborador)->sortBy('name');
            $this->cuentasCero();
        }

        $this->total_colaboradores = $this->empleados->count();

        foreach ($this->empleados as $emp) {
            if (count($emp->objetivos) > 0) {
                $this->total_con_objetivos++;

                foreach ($emp->objetivos as $emp_obj) {
                    if (isset($emp_obj->objetivo->esta_aprobado)) {
                        if ($emp_obj->objetivo->esta_aprobado == Objetivo::SIN_DEFINIR) {
                            $this->total_obj_pend++;
                            break;
                        }
                    }
                }
            } else {
                $this->total_sin_objetivos++;
            }
        }

        return view('livewire.carga-objetivos');
    }

    public function cuentasCero()
    {
        $this->total_colaboradores = 0;
        $this->total_con_objetivos = 0;
        $this->total_sin_objetivos = 0;
        $this->total_obj_pend = 0;
    }

    public function notificarCarga()
    {
        if ($this->periodo_habilitado) {
            try {
                $permisos = PermisosCargaObjetivos::select('id', 'perfil', 'permisos_asignacion', 'permiso_objetivos', 'permiso_escala')
                    ->orderBy('id')
                    ->get();

                $administrador = $permisos->where('perfil', 'Administrador')->first();
                $jefeInmediato = $permisos->where('perfil', 'Jefe Inmediato')->first();
                $colaborador = $permisos->where('perfil', 'Colaborador')->first();

                $empleados = Empleado::getAltaDataColumns();

                if ($colaborador->permisos_asignacion) {
                    $correos_colaborador = $empleados->pluck('email')->toArray();
                    $correos_colaborador = array_unique($correos_colaborador);
                }

                if ($jefeInmediato->permisos_asignacion) {
                    $correos_jefeInmediato = [];

                    foreach ($empleados as $key_jefe => $empleado) {
                        if ($empleado->es_supervisor) {
                            $correos_jefeInmediato[] = $empleado->email;
                        }
                    }

                    $correos_jefeInmediato = array_unique($correos_jefeInmediato);
                }

                if ($administrador->permisos_asignacion) {
                    $usuarios = User::getAllWithEmpleado();
                    $correos_administrador = [];

                    foreach ($usuarios as $key_usuario => $usuario) {
                        if ($usuario->is_Admin && $usuario->empleado) {
                            $correos_administrador[] = $usuario->empleado->email;
                        }
                    }

                    $correos_administrador = array_unique($correos_administrador);
                }

                // Opcional: Combina todos los correos y elimina duplicados
                $all_correos = array_unique(array_merge(
                    $correos_colaborador ?? [],
                    $correos_jefeInmediato ?? [],
                    $correos_administrador ?? []
                ));

                foreach ($all_correos as $keyCorreos => $correo) {
                    $all_correos[$keyCorreos] = removeUnicodeCharacters($correo);
                }

                // Enviar correos
                Mail::to($all_correos)->queue(new CorreoCargaObjetivos($this->fecha_inicio, $this->fecha_fin));

                $this->alert('success', 'Notificación Exitosa.', [
                    'position' => 'center',
                    'timer' => '6000',
                    'toast' => true,
                    'text' => 'Se ha notificado correctamente sobre el periodo de carga de objetivos.',
                    'showConfirmButton' => false,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Entendido',
                ]);
            } catch (\Throwable $th) {
                // throw $th;
                $this->alert('error', 'Notificación Fallida.', [
                    'position' => 'center',
                    'timer' => '6000',
                    'toast' => true,
                    'text' => 'Ha habido un error al intentar notificar a los colaboradores.',
                    'showConfirmButton' => false,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Entendido',
                ]);
            }
        } else {
            $this->alert('warning', 'Sin Periodo Habilitado.', [
                'position' => 'center',
                'timer' => '6000',
                'toast' => true,
                'text' => 'No se puede enviar ningun correo, ya que no hay ningun periodo de carga de objetivos habilitado.',
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'confirmButtonText' => 'Entendido',
            ]);
        }
    }

    public function habilitarCargaObjetivos($valor)
    {
        if ($valor) {
            if (! empty($this->fecha_inicio) && ! empty($this->fecha_fin)) {
                if ($this->fecha_inicio < $this->fecha_fin) {

                    PeriodoCargaObjetivos::create([
                        'fecha_inicio' => $this->fecha_inicio,
                        'fecha_fin' => $this->fecha_fin,
                        'habilitado' => $valor,
                    ]);

                    $this->alert('success', 'Periodo Habilitado.', [
                        'position' => 'center',
                        'timer' => '10000',
                        'toast' => true,
                        'text' => 'Se ha habilitado el periodo de carga de objetivos.',
                        'showConfirmButton' => false,
                        'onConfirmed' => '',
                        'confirmButtonText' => 'Entendido',
                    ]);
                } else {
                    $this->alert('warning', 'Fechas de periodo', [
                        'position' => 'center',
                        'timer' => '5000',
                        'toast' => true,
                        'text' => 'La fecha fin no puede ser menor a la fecha inicio.',
                        'showConfirmButton' => true,
                        'onConfirmed' => '',
                        'confirmButtonText' => 'Entendido',
                    ]);
                }
            } else {
                $this->periodo_habilitado = false;
                $this->alert('warning', 'Fechas de periodo', [
                    'position' => 'center',
                    'timer' => '5000',
                    'toast' => true,
                    'text' => 'Debe seleccionar una fecha de inicio y de fin para habilitar el periodo.',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Entendido',
                ]);
            }
        } else {
            PeriodoCargaObjetivos::first()->delete();

            $this->alert('success', 'Periodo Deshabilitado.', [
                'position' => 'center',
                'timer' => '10000',
                'toast' => true,
                'text' => 'Se ha deshabilitado el periodo de carga de objetivos.',
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'confirmButtonText' => 'Entendido',
            ]);

            $this->fecha_inicio = null;
            $this->fecha_fin = null;
        }
    }
}
