<?php

namespace App\Http\Livewire\Visitantes;

use App\Exports\Visitantes\VisitanteExport;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Visitantes\RegistrarVisitante;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class BitacoraAccesos extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = [
        'confirmarSalida',
    ];

    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;

    public $colaborador = '';

    public $area = '';

    public $rangoFechas = '';

    public $fechaInicio;

    public $fechaFin;

    public $empleados;

    public $areas;

    public $textoFiltro;

    public $search = '';

    public $total = 0;

    public $tipoVista = 'bitacora';

    public $visitanteID;

    protected $queryString = [
        'colaborador' => ['except' => ''],
        'area' => ['except' => ''],
        'fechaInicio' => ['except' => ''],
        'fechaFin' => ['except' => ''],
        'perPage' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function updatedRangoFechas($value)
    {
        $rango = explode(' to ', $this->rangoFechas);
        $this->fechaInicio = $rango[0];
        $this->fechaFin = $rango[1];
    }

    public function mount($tipoVista = 'bitacora')
    {
        $this->tipoVista = $tipoVista;
    }

    public function render()
    {
        $this->empleados = Empleado::getIdNameAll();
        $this->areas = Area::getAll();
        $model = $this->getQueryFilter();
        $visitantes = $model->fastPaginate($this->perPage);
        $this->total = $model->count();
        $this->obtenerTexto($this->total, $visitantes->count());

        return view('livewire.visitantes.bitacora-accesos', compact('visitantes'));
    }

    public function search()
    {
        $this->render();
    }

    public function getQueryFilter()
    {
        $query = RegistrarVisitante::with(['empleado' => function ($query) {
            $query->select('id', 'name');
        }], ['area' => function ($q) {
            $q->select('id', 'area');
        }], 'dispositivos')->when($this->colaborador, function ($q1) {
            $q1->orWhere('empleado_id', $this->colaborador);
        })->when($this->area, function ($q2) {
            $q2->orWhere('area_id', $this->area);
        })->when($this->fechaInicio, function ($q2) {
            $q2->orWhereBetween('created_at', [$this->fechaInicio, $this->fechaFin]);
        })->when($this->fechaFin, function ($q2) {
            $q2->orWhereBetween('fecha_salida', [$this->fechaFin, $this->fechaFin]);
        })->when($this->search, function ($q2) {
            $q2->orWhere('nombre', 'ILIKE', "%{$this->search}%")->orWhere('apellidos', 'ILIKE', "%{$this->search}%")->orWhere('email', 'ILIKE', "%{$this->search}%")->orWhere('telefono', 'ILIKE', "%{$this->search}%")->orWhere('celular', 'ILIKE', "%{$this->search}%")->orWhere('empresa', 'ILIKE', "%{$this->search}%");
        });
        if ($this->tipoVista == 'autorizar') {
            $query->where('autorizado', false);
        }
        $query->orderByDesc('created_at');

        return $query;
    }

    public function exportarExcel()
    {
        $model = $this->getQueryFilter();

        return Excel::download(new VisitanteExport($model->get()), 'Reporte de Visitantes '.now()->format('d-m-Y h:i A').'.xlsx');
    }

    public function default()
    {
        $this->colaborador = '';
        $this->area = '';
        $this->rangoFechas = '';
        $this->fechaInicio = '';
        $this->fechaFin = '';
        $this->perPage = 5;
    }

    private function obtenerTexto($total, $paginados)
    {
        if ($this->colaborador != '' || $this->area != '' || $this->rangoFechas != '') {
            $this->textoFiltro = "Mostrando {$paginados} de {$total} resultados filtrados";
        } else {
            $this->textoFiltro = "Mostrando {$paginados} de {$total} resultados";
        }
    }

    public function limpiarFiltro($tipo)
    {
        $this->$tipo = '';
        if ($tipo == 'rangoFechas') {
            $this->fechaInicio = '';
            $this->fechaFin = '';
        }
    }

    public function autorizarSalida($visitanteID)
    {
        $this->visitanteID = $visitanteID;
        $this->alert('success', '¿Autorizar Salida?', [
            'position' => 'center',
            'timer' => '10000',
            'toast' => false,
            'timerProgressBar' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmarSalida',
            'confirmButtonText' => 'Autorizar',
        ]);
    }

    public function confirmarSalida()
    {
        $visitante = RegistrarVisitante::find($this->visitanteID);
        $visitante->update([
            'autorizado' => true,
            'fecha_salida' => Carbon::now(),
        ]);
        $this->alert('success', 'Bien Hecho!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Has autorizado la salida del visitante',
        ]);
    }
}
