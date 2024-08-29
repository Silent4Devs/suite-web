<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\ListaDocumentoEmpleado;
use App\Models\TBCatalogueTrainingModel;
use App\Models\TBEvidenceTrainingModel;
use App\Models\TBTypeCatalogueTrainingModel;
use App\Models\TBUserTrainingModel;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class BuscarCVComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isPersonal;

    public $empleadoModel;

    public $documents;

    public $categories;

    public $names;

    public $employedCv;

    public $catalog;

    public $areas;

    public $employess;

    public $issuingCompanies;

    public $normas;

    public $type_id;

    public $name_id;

    public $area_id;

    public $employ_id;

    public $issuingCompanyId;

    public $normaId;

    public function resetFilter()
    {
        // $this->reset(
        $this->type_id = null;
        $this->name_id = null;
        $this->area_id = null;
        $this->employ_id = null;
        $this->issuingCompanyId = null;
        $this->normaId = null;
        // );

        $this->employedCv = $this->catalog;
        $this->names = null;
    }

    public function filterNorma()
    {
        $this->filters();
    }

    public function filterIssuingCompany()
    {
        $this->filters();
    }

    public function filterEmploy()
    {
        // dd($this->employ_id);
        $this->filters();
    }

    public function filterArea()
    {
        $this->filters();
    }

    public function filterName()
    {
        $this->filters();
    }

    public function getCatalogueName()
    {
        $type_id = intval($this->type_id);
        foreach ($this->categories as $category) {
            if ($category->id === $type_id) {
                $this->names = $category->catalogue;
                break;
            }
        }

        $this->name_id = null;
        $this->filters();

    }

    public function filters()
    {
        $query = TBUserTrainingModel::query();
        if ($this->type_id) {
            $query->where('type_id', $this->type_id);
        }

        if ($this->name_id) {
            $query->where('name_id', $this->name_id);
        }

        if ($this->area_id) {
            $query->whereHas('empleado', function ($query) {
                $query->where('area_id', $this->area_id);
            });
        }

        if ($this->employ_id) {
            $query->whereHas('empleado', function ($query) {
                $query->where('id', $this->employ_id);
            });
        }

        if ($this->issuingCompanyId) {
            $query->whereHas('getName', function ($query) {
                $query->where('issuing_company', 'LIKE', '%'.$this->issuingCompanyId.'%');
            });
        }

        if ($this->normaId) {
            $query->whereHas('getName', function ($query) {
                $query->where('norma', 'LIKE', '%'.$this->normaId.'%');
            });
        }

        $this->employedCv = $query->get();
    }

    public function downloadEvidencie($id)
    {
        $evidenceRegister = TBEvidenceTrainingModel::findOrFail($id);
        $filePath = $evidenceRegister->ubication.'/'.$evidenceRegister->name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }
    }

    public function mount($isPersonal)
    {
        $this->isPersonal = $isPersonal;
        if (! $this->isPersonal) {
            $this->employedCv = TBUserTrainingModel::get();
            $this->catalog = $this->employedCv;
            $this->categories = TBTypeCatalogueTrainingModel::get();
            $this->areas = Area::get();
            $this->issuingCompanies = collect();
            $this->employess = Empleado::getaltaAll();
            $this->issuingCompanies = TBCatalogueTrainingModel::select('issuing_company')
                ->distinct()
                ->pluck('issuing_company');
            $this->normas = TBCatalogueTrainingModel::select('norma')
                ->distinct()
                ->pluck('norma');
        }
    }

    public function render()
    {

        return view('livewire.buscar-c-v-component');
        // 'empleadosCV' => $empleadosCV,
        //     'lista_docs' => ListaDocumentoEmpleado::getAll(),
        // ]
        // );
    }

    public function mostrarCurriculum($empleadoID)
    {
        $this->empleadoModel = Empleado::getEmpleadoCurriculum($empleadoID)->find($empleadoID);
        $this->documents = TBUserTrainingModel::where('empleado_id', $empleadoID)->get();
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
