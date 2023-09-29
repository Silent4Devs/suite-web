<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\Proceso;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class ReporteIndividual extends Component
{
    use LivewireAlert;

    protected $listeners = ['render' => 'render'];
    public $pagination = 5;
    public $clasificaciones;
    public $clausulas;
    public $id_auditoria;

    public $descripcion;
    public $proceso;
    public $area;
    public $clasificacion_id;
    public $incumplimiento_requisito;
    public $no_tipo;
    public $titulo;

    public function mount($clasificaciones, $clausulas, $id_auditoria)
    {
        $this->clasificaciones = $clasificaciones;
        $this->clausulas = $clausulas;
        $this->id_auditoria = $id_auditoria;
    }

    public function render()
    {
        // $clasificaciones = $this->clasificaciones;
        // $id_auditoria = $this->id_auditoria;
        // $areas = Area::getAll();
        $procesos = Proceso::getAll();
        $datas = AuditoriaInternasHallazgos::where('auditoria_internas_id', '=', $this->id_auditoria)
            ->paginate($this->pagination);

        $clasificacionIds = $this->clasificaciones->pluck('id');

        $cuentas = AuditoriaInternasHallazgos::with('clasificacion')->whereIn('clasificacion_id', $clasificacionIds)
            ->where('auditoria_internas_id', $this->id_auditoria)
            ->select('clasificacion_id', DB::raw('COUNT(*) as count'))
            ->groupBy('clasificacion_id')
            ->get();

        // dd($cuentas);

        return view('livewire.reporte-individual', compact('procesos', 'datas', 'cuentas'))
            ->with('clasificaciones', $this->clasificaciones)
            ->with('clausulas', $this->clausulas)
            ->with('id_auditoria', $this->id_auditoria);
    }

    public function validarHallazgos()
    {
        $this->validate([
            'incumplimiento_requisito' => 'required',
            'descripcion' => 'required',
            'clasificacion_id' => 'required',
        ]);
    }

    public function create()
    {
        $this->default();
        $this->emit('abrir-modal');
    }

    public function save()
    {

        // dd("si llega");
        $this->validarHallazgos();
        $this->proceso = $this->proceso == '' ? null : $this->proceso;
        // $this->area = $this->area == '' ? null : $this->area;
        // dd($this->area);
        $model = AuditoriaInternasHallazgos::create([
            'proceso_id' => $this->proceso,
            'area_id' => auth()->user()->empleado->area_id,
            'incumplimiento_requisito' => $this->incumplimiento_requisito,
            'clasificacion_id' => $this->clasificacion_id,
            'descripcion' => $this->descripcion,
            'auditoria_internas_id' => $this->id_auditoria,
            'no_tipo' => $this->no_tipo,
            'titulo' => $this->titulo,
        ]);

        $this->reset('descripcion', 'incumplimiento_requisito', 'clasificacion_id', 'proceso', 'area');
        $this->emit('render');
        $this->emit('cerrar-modal');
        $this->alert('success', 'Bien hecho', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Creado con éxito',
        ]);
    }

    public function default()
    {
        $this->descripcion = '';
        $this->proceso = '';
        // $this->area = '';
        $this->clasificacion_id = '';
        $this->incumplimiento_requisito = '';
        $this->no_tipo = '';
        $this->titulo = '';

        // $this->view = 'create';
    }
}
