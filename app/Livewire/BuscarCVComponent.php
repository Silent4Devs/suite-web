<?php

namespace App\Livewire;

use App\Models\Empleado;
use App\Models\ListaDocumentoEmpleado;
use App\Models\TBCatalogueTrainingModel;
use App\Models\TBEvidenceTrainingModel;
use App\Models\TBTypeCatalogueTrainingModel;
use App\Models\TBUserTrainingModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

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


    public $documents;

    public $categories;

    public $names;

    public $type_id;

    public function getCatalogueName()
    {
        $type_id = intval($this->type_id);
        foreach($this->categories as $category){
            if($category->id === $type_id){
                $this->names = $category->catalogue;
                break;
            }
        }
    }

    public function downloadEvidencie($id)
    {
        $evidenceRegister = TBEvidenceTrainingModel::findOrFail($id);
        $filePath = $evidenceRegister->ubication . '/'. $evidenceRegister->name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }
    }

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
            $this->empleados = Empleado::getaltaAll();
        } else {
            $this->area_id = $value;
            $this->empleado_id = null;
            $this->empleados = Empleado::getaltaAll()->where('area_id', $this->area_id);
        }
        $this->dispatch('tagify');
    }

    public function updatedEmpleadoId($value)
    {
        if ($value == '') {
            $this->empleado_id = null;
        } else {
            $this->empleado_id = $value;
        }
        $this->dispatch('tagify');
    }

    public function updatedGeneral()
    {
        $this->dispatch('tagify');
    }

    public function updatedCurso()
    {
        $this->dispatch('tagify');
    }

    public function updatedCertificacion()
    {
        $this->dispatch('tagify');
    }

    public function mount() {}

    public function render()
    {
        // dd($this->empleadoModel);
        // if (!$this->isPersonal) {
        //     $this->empleados = Empleado::getAltaEmpleados();
        //     dd($this->empleados);
        // }
        $empleadosCV = TBUserTrainingModel::paginate(10);
        $this->categories = TBTypeCatalogueTrainingModel::get();
        // if($this->isPersonal){
        //     $empleado_id = $empleadosCV[0]->id;
        //     $this->documents = TBUserTrainingModel::where('empleado_id',$empleado_id)->get();
        // }

        // dd($empleadosCV1[0]->empleado);
        // $empleadosCV = Empleado::alta()
        //     ->with('empleado_certificaciones', 'empleado_cursos', 'empleado_experiencia')
        //     ->when($this->empleado_id, function ($query) {
        //         $query->where('id', $this->empleado_id);
        //     })
        //     ->when($this->area_id, function ($query) {
        //         $query->where('area_id', $this->area_id);
        //     })
        //     ->when($this->certificacion, function ($query) {
        //         $certificaciones = explode(',', $this->certificacion);
        //         $query->whereHas('empleado_certificaciones', function ($subQuery) use ($certificaciones) {
        //             $subQuery->where(function ($queryArr) use ($certificaciones) {
        //                 foreach ($certificaciones as $busqueda) {
        //                     $queryArr->orWhere('nombre', 'ILIKE', "%{$busqueda}%");
        //                 }
        //             });
        //         });
        //     })
        //     ->when($this->curso, function ($query) {
        //         $query->whereHas('empleado_cursos', function ($subQuery) {
        //             $subQuery->where('curso_diploma', 'ILIKE', "%{$this->curso}%");
        //         });
        //     })
        //     ->when($this->general, function ($query) {
        //         $query->where('name', 'ILIKE', "%{$this->general}%");
        //     })
        //     ->orderByDesc('id')->cursorPaginate();

            // dd($empleadosCV->links());

            // dd($empleadosCV, $empleadosCV2);
            return view('livewire.buscar-c-v-component', [
            'empleadosCV' => $empleadosCV,
            'lista_docs' => ListaDocumentoEmpleado::getAll(),
        ]);
    }

    public function mostrarCurriculum($empleadoID)
    {
        $this->empleadoModel = Empleado::getEmpleadoCurriculum($empleadoID)->find($empleadoID);
        $this->documents = TBUserTrainingModel::where('empleado_id',$empleadoID)->get();
        $this->dispatch('tagify');
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
