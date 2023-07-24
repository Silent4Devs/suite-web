<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\ListaDocumentoEmpleado;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class BuscarCVComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $areas;
    public $empleado_id;
    public $area_id;
    public $empleado_experiencia;
    public $empleado_educacion;
    public $empleado_certificaciones;
    public $empleado_cursos;
    public $foto_organizacion;
    public $empleados;
    public $isPersonal;
    public $curriculums;

    public $empresaExperiencia;
    public $puestoExperiencia;
    public $descripcionExperiencia;
    public $certificacion;
    public $curso;
    public $empleadoModel;
    public $general;
    public $lista_docs;

    protected $queryString = [
        'area_id' => ['except' => ''],
        'empleado_id' => ['except' => ''],
        'empresaExperiencia' => ['except' => ''],
        'puestoExperiencia' => ['except' => ''],
        'descripcionExperiencia' => ['except' => ''],
        'certificacion' => ['except' => ''],
        'curso' => ['except' => ''],
        'general' => ['except' => ''],
    ];

    public function clean()
    {
        $this->empleado_id = '';
        $this->area_id = '';
        $this->empleados = Empleado::getAltaEmpleados();
        //$this->conteo = '';
        $this->callAlert('info', 'Los filtros se han restablecido', true, 'La información volvio a su estado original');
    }

    public function updatedAreaId($value)
    {
        if ($value == '') {
            $this->area_id = null;
            $this->empleados = Empleado::alta()->get();
        } else {
            $this->area_id = $value;
            $this->empleado_id = null;
            $this->empleados = Empleado::alta()->where('area_id', $this->area_id)->get();
        }
        $this->emit('tagify');
    }

    public function updatedEmpleadoId($value)
    {
        if ($value == '') {
            $this->empleado_id = null;
        } else {
            $this->empleado_id = $value;
        }
        $this->emit('tagify');
    }

    public function updatedGeneral()
    {
        $this->emit('tagify');
    }

    public function updatedCurso()
    {
        $this->emit('tagify');
    }

    public function updatedCertificacion()
    {
        $this->emit('tagify');
    }

    public function mount()
    {
        if (!$this->isPersonal) {
            $this->empleados = Empleado::getAltaEmpleados();
        }
    }

    public function render()
    {
        $cacheKey = 'empleadosCV_data_'. Auth::user()->id;
        $empleadosCV = Cache::remember('empleadosCV_data_'.$cacheKey, 3600 * 60, function () {
        return Empleado::alta()->with('empleado_certificaciones', 'empleado_cursos', 'empleado_experiencia')
            ->when($this->empleado_id, function ($q3) {
                $q3->where('id', $this->empleado_id);
            })
            ->when($this->area_id, function ($q4) {
                $q4->where('area_id', $this->area_id);
            })
            ->when($this->certificacion, function ($q) {
                $q->whereHas('empleado_certificaciones', function ($query) {
                    $certificaciones = explode(',', $this->certificacion);
                    $query->where(function ($queryArr) use ($certificaciones) {
                        foreach ($certificaciones as $busqueda) {
                            $queryArr->orWhere('nombre', 'ILIKE', "%{$busqueda}%");
                        }
                    });
                });
            })
            ->when($this->curso, function ($qCurso) {
                $qCurso->whereHas('empleado_cursos', function ($queryCurso) {
                    $queryCurso->where('curso_diploma', 'ILIKE', "%{$this->curso}%");
                });
            })
            ->when($this->general, function ($qGeneral) {
                $qGeneral->where('name', 'ILIKE', "%{$this->general}%");
            })

            ->paginate(21);
        $this->empleado = null;
        /*   ->with([
                'empleado_experiencia' => function ($q1) {
                    $q1->where('empresa', 'ILIKE', $this->empresaExperiencia)
                        ->orWhere('puesto', 'ILIKE', $this->puestoExperiencia)
                        ->orWhere('descripcion', 'ILIKE', $this->descripcionExperiencia);
                },
                'empleado_certificaciones' => function ($q5) {
                    $q5->where('nombre', 'LIKE', $this->certificacion);
                },
                'empleado_cursos' => function ($q2) {
                    $q2->where('curso_diploma', 'ILIKE', $this->curso);
                }
            ])*/
        /*$empleadoget = Empleado::select('*')->with('empleado_experiencia');

        if (!$this->isPersonal) {
            if ($this->area_id != '') {
                if (Empleado::where('area_id', '=', $this->area_id)->count() > 0) {
                    $this->empleados = Empleado::where('area_id', '=', $this->area_id)->get();
                    $this->callAlert('success', 'La información se actualizo correctamente', true);
                } else {
                    $this->callAlert('warning', 'No se encontro registro con esta area', false, 'las opciones de busqueda se restablecieron');
                    $this->area_id = '';
                    $this->empleado_id = '';
                    $this->empleados = Empleado::select('id', 'area_id', 'name')->get();
                }
            }
        }
        if ($this->empleado_id != '') {
            if (Empleado::where('id', '=', $this->empleado_id)->count() > 0) {
                $empleadoget->where('id', '=', $this->empleado_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con este empleado', false, 'las opciones de busqueda se restablecieron');
                $this->empleado_id = '';
                $this->empleados = Empleado::select('id', 'area_id', 'name')->get();
            }
        }*/
        $this->lista_docs = ListaDocumentoEmpleado::getAll();
        return view('livewire.buscar-c-v-component', [
            // 'empleadoget' => $empleadoget->get()->first(),
            'empleadosCV' => $empleadosCV,
        ]);
    }

    public function mostrarCurriculum($empleadoID)
    {
        $this->empleadoModel = Empleado::alta()->with('empleado_certificaciones', 'empleado_cursos', 'empleado_experiencia')->find($empleadoID);
        $this->emit('tagify');
    }

    public function callAlert($tipo, $mensaje, $bool, $test = '')
    {
        $this->alert($tipo, $mensaje, [
            'position' =>  'top-end',
            'timer' =>  2500,
            'toast' =>  true,
            'text' =>  $test,
            'confirmButtonText' =>  'Entendido',
            'cancelButtonText' =>  '',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  $bool,
        ]);
    }
}
