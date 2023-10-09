<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\AuditoriaInterna;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\AuditoriaInternasReportes;
use App\Models\Proceso;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EditReporteIndividual extends Component
{
    use LivewireAlert;

    protected $listeners = ['render' => 'render'];
    public $pagination = 5;
    public $clasificaciones;
    public $clausulas;
    public $id_auditoria;

    public $c_id;
    public $c_edit_id;

    public $descripcion;
    public $proceso;
    public $area;
    public $clasificacion_id;
    public $incumplimiento_requisito;
    public $no_tipo;
    public $titulo;

    public $comentarios;

    public $reporte;

    public $hallazgoAuditoriaID;

    public $view = "create";

    public function mount($clasificaciones, $clausulas, $id_auditoria)
    {
        $this->clasificaciones = $clasificaciones;
        $this->clausulas = $clausulas;
        $this->id_auditoria = $id_auditoria;

        $audit = AuditoriaInterna::find($this->id_auditoria);
        $this->reporte = AuditoriaInternasReportes::where("id_auditoria", "=", $audit->id)
            ->where("empleado_id", "=", auth()->user()->empleado->id)
            ->where("lider_id", "=", $audit->lider->id);

        if ($this->reporte->exists()) {
            $this->reporte = $this->reporte->first();
            // dd($this->reporte);
        } else {
            // dd("Crea uno nuevo");
            $this->createReporte($audit);
        }
    }


    public function render()
    {
        // $clasificaciones = $this->clasificaciones;
        // $id_auditoria = $this->id_auditoria;
        // $areas = Area::getAll();
        $procesos = Proceso::getAll();
        $datas = AuditoriaInternasHallazgos::where('auditoria_internas_id', '=', $this->id_auditoria)
            ->where("reporte_id", "=", $this->reporte->id)
            ->paginate($this->pagination);

        $clasificacionIds = $this->clasificaciones->pluck('id');

        $cuentas = AuditoriaInternasHallazgos::with('clasificacion')->whereIn('clasificacion_id', $clasificacionIds)
            ->where('auditoria_internas_id', $this->id_auditoria);

        if ($this->reporte && $this->reporte->id) {
            $cuentas->orWhere("reporte_id", "=", $this->reporte->id);
        }

        $cuentas = $cuentas->select('clasificacion_id', DB::raw('COUNT(*) as count'))
            ->groupBy('clasificacion_id')
            ->get();

        // dd($cuentas);

        return view('livewire.edit-reporte-individual', compact('procesos', 'datas', 'cuentas'))
            ->with('clasificaciones', $this->clasificaciones)
            ->with('clausulas', $this->clausulas)
            ->with('id_auditoria', $this->id_auditoria);
    }

    public function validarHallazgosCreate()
    {
        $this->validate([
            'incumplimiento_requisito' => 'required',
            'descripcion' => 'required',
            'clasificacion_id' => 'required',
            'c_id' => 'required',
        ]);
    }

    public function validarHallazgosEdit()
    {
        $this->validate([
            'incumplimiento_requisito' => 'required',
            'descripcion' => 'required',
            'clasificacion_id' => 'required',
            'c_edit_id' => 'required',
        ]);
    }

    public function modal($tipo, $id = null)
    {
        switch ($tipo) {
            case 'crear':
                $this->create();
                break;
            case 'editar':
                $this->edit($id);
                break;
            case 'borrar':
                $this->destroy($id);
                break;
            default:
                $this->create();
                break;
        }
    }

    public function createReporte($audit)
    {
        // dd($audit);

        $this->reporte = AuditoriaInternasReportes::create([
            "id_auditoria" => $audit->id,
            "empleado_id" => auth()->user()->empleado->id,
            "lider_id" => $audit->lider->id,
        ]);
    }

    public function create()
    {
        $this->view = 'create';
        $this->default();
        $this->emit('abrir-modal');
    }

    public function save()
    {
        $this->validarHallazgosCreate();
        $this->proceso = $this->proceso == '' ? null : $this->proceso;
        $model = AuditoriaInternasHallazgos::create([
            'proceso_id' => $this->proceso,
            'area_id' => auth()->user()->empleado->area_id,
            'incumplimiento_requisito' => $this->incumplimiento_requisito,
            'clasificacion_id' => $this->clasificacion_id,
            'clausula_id' => $this->c_id,
            'descripcion' => $this->descripcion,
            'auditoria_internas_id' => $this->id_auditoria,
            'no_tipo' => $this->no_tipo,
            'titulo' => $this->titulo,
            'reporte_id' => $this->reporte->id,
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

    public function edit($id)
    {
        // dd("algo");
        $this->view = 'edit';
        $hallazgo = AuditoriaInternasHallazgos::find($id);
        // dd($id, $hallazgo);
        $this->hallazgoAuditoriaID = $id;
        // // dd($model);
        $this->no_tipo = $hallazgo->no_tipo;
        $this->titulo = $hallazgo->titulo;
        $this->descripcion = $hallazgo->descripcion;
        $this->clasificacion_id = $hallazgo->clasificacion_id;
        $this->c_edit_id = $hallazgo->clausula_id;
        // $this->clasificacion_hallazgo = $hallazgo->clasificacion_hallazgo;
        $this->proceso = $hallazgo->proceso_id;
        // $this->area = $hallazgo->area_id;
        $this->incumplimiento_requisito = $hallazgo->incumplimiento_requisito;
        $this->id_auditoria = $hallazgo->auditoria_internas_id;
        $this->emit('abrir-modal');
    }

    public function update()
    {
        // dd("si llega");
        $this->validarHallazgosEdit();
        $model = AuditoriaInternasHallazgos::find($this->hallazgoAuditoriaID);
        $model->update([
            'proceso_id' => $this->proceso,
            'incumplimiento_requisito' => $this->incumplimiento_requisito,
            'clasificacion_id' => $this->clasificacion_id,
            'clausula_id' => $this->c_edit_id,
            'descripcion' => $this->descripcion,
            // 'auditoria_internas_id' => $this->id_auditoria,
            'no_tipo' => $this->no_tipo,
            'titulo' => $this->titulo,
        ]);

        $this->emit('cerrar-modal');
        $this->default();
        $this->emit('render');
        $this->alert('success', 'Bien hecho', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Editado con éxito',
        ]);
    }

    public function destroy($id)
    {
        $model = AuditoriaInternasHallazgos::find($id);
        $model->delete();
        $this->emit('render');
        $this->alert('success', 'Bien hecho', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Registro eliminado',
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
