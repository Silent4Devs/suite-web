<?php

namespace App\Http\Livewire;

use App\Models\Puesto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ConsultaPerfilComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $areas;

    public $competencias;

    public $language;

    public $contactos;

    public $herramientas;

    public $responsabilidades;

    public $reporto;

    public $puestos;

    public $empleado_id;

    public $area_id;

    public $competencia_id;

    public $reporto_id;

    public $puesto_id;

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

    public $puestoModel;

    public $general;

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
        $this->puestos = Puesto::select('id', 'id_area', 'id_reporta', 'puesto')->get();
        $this->callAlert('info', 'Los filtros se han restablecido', true, 'La información volvio a su estado original');
    }

    public function updatedAreaId($value)
    {
        if ($value == '') {
            $this->area_id = null;
            $this->reporta_id = null;
            $this->puestos = Puesto::getAll();
        } else {
            $this->area_id = $value;
            $this->empleado_id = null;
            $this->reporta_id = null;
            $this->puestos = Puesto::where('area_id', $this->area_id)->get();
        }
        $this->emit('tagify');
    }

    public function updatedPuestoId($value)
    {
        if ($value == '') {
            $this->puesto_id = null;
        } else {
            $this->puesto_id = $value;
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
        if (! $this->isPersonal) {
            $this->puestos = Puesto::select('id', 'id_area', 'id_reporta', 'puesto')->get();
        }
    }

    public function render()
    {
        $perfilesInfo = Puesto::with(['area', 'competencias' => function ($q) {
            $q->with('competencia');
        }])->when($this->puesto_id, function ($q3) {
            $q3->where('id', $this->puesto_id);
        })
            ->when($this->area_id, function ($q4) {
                $q4->where('id_area', $this->area_id);
            })
            ->when($this->area_id, function ($q4) {
                $q4->where('id_area', $this->area_id);
            })
            ->when($this->reporto_id, function ($q5) {
                $q5->where('id_reporto', $this->reporto_id);
            })
            ->when($this->general, function ($qGeneral) {
                $qGeneral->where('puesto', 'ILIKE', "%{$this->general}%");
            })

            ->fastPaginate(21);

        $this->puesto = null;

        return view('livewire.consulta-perfil-component', [
            'perfilesInfo' => $perfilesInfo,
        ]);
    }

    public function mostrarPuestos($puestoID)
    {
        $this->puestoModel = Puesto::with(['contactos', 'area', 'certificados', 'language' => function ($q) {
            $q->with('language');
        }])->find($puestoID);
        $this->emit('tagify');
    }

    public function callAlert($tipo, $mensaje, $bool, $test = '')
    {
        $this->alert($tipo, $mensaje, [
            'position' => 'top-end',
            'timer' => 2500,
            'toast' => true,
            'text' => $test,
            'confirmButtonText' => 'Entendido',
            'cancelButtonText' => '',
            'showCancelButton' => false,
            'showConfirmButton' => $bool,
        ]);
    }
}
