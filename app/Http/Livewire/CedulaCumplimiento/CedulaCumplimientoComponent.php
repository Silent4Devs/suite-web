<?php

namespace App\Http\Livewire\CedulaCumplimiento;

use App\Models\Katbol\CedulaCumplimiento;
use App\Models\Katbol\CierreContrato;
use App\Models\Katbol\EntregaMensual;
use App\Models\Katbol\Factura;
use App\Models\Katbol\NivelesServicio;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CedulaCumplimientoComponent extends Component
{
    use LivewireAlert;

    public $contrato_id;

    public $cedula_id;

    public $elaboro;

    public $reviso;

    public $autorizo;

    public $cumple;

    public $show_contrato;

    public $view = 'create';

    protected $listeners = [
        'recargar-cumplimiento' => 'render',
        'triggerDeleteCumplimiento' => 'confirmDelete',
    ];

    protected $rules = [
        'elaboro' => 'required',
        'reviso' => 'required',
        'autorizo' => 'required',
    ];

    public function mount($contrato_id, $show_contrato)
    {
        $this->contrato_id = $contrato_id;
        $this->show_contrato = $show_contrato;
        $this->cumple = true;
    }

    public function render()
    {
        $facturas = Factura::select('no_factura', 'concepto', 'hallazgos_comentarios', 'cumple')->where('contrato_id', '=', $this->contrato_id)->get();
        $cedulas = CedulaCumplimiento::with('contrato')->where('contrato_id', '=', $this->contrato_id)->get();
        /*$nivel = "
        select ns.id,
        ns.nombre,
        ns.periodo_evaluacion,
        ns.unidad,
        ns.meta
        , AVG(es.promedio) as p_general
        from niveles_servicio ns, evaluacion_servicio es
        where ns.id = es.servicio_id
        and ns.contrato_id = '$this->contrato_id'
        and ns.deleted_at is null
        group by ns.id";
        $niveles_servicio = DB::SELECT($nivel);*/

        $niveles_servicio = NivelesServicio::join('evaluacion_servicio', 'niveles_servicio.id', '=', 'evaluacion_servicio.servicio_id')
        ->where('contrato_id', '=', $this->contrato_id)
        ->select([
            'niveles_servicio.*',
            DB::raw('ROUND(AVG(CAST(evaluacion_servicio.promedio AS NUMERIC)), 2) as p_general'),
        ])
        ->groupBy('niveles_servicio.id')
        ->get();

        // dd($niveles_servicio->evaluacion_servicio->promedio);

        $entregables = EntregaMensual::select(
            'entregas_mensuales.contrato_id',
            'entregas_mensuales.id as entrega_id',
            'entregas_mensuales.nombre_entregable',
            'entregas_mensuales.plazo_entrega_termina',
            'entregas_mensuales.entrega_real',
            'entregas_mensuales.no as no_entrega',
            'entregas_mensuales.observaciones',
            'entregas_mensuales.cumplimiento as cumple',
            'contratos.id as contrato_id',
            'contratos.proveedor_id',
            'proveedores.nombre_comercial',
            'proveedores.id as proveedor_id'
        )
            ->join('contratos', 'entregas_mensuales.contrato_id', '=', 'contratos.id')
            ->join('proveedores', 'proveedores.id', '=', 'contratos.proveedor_id')
            ->where('contratos.id', '=', $this->contrato_id)
            ->get();

        $cierre_contratos = CierreContrato::where('contrato_id', $this->contrato_id)
            ->get();
        $this->dispatchBrowserEvent('cedulaEventChanged');

        return view('livewire.cedula-cumplimiento.cedula-cumplimiento-component', compact(
            'facturas',
            'cedulas',
            'niveles_servicio',
            'entregables',
            'cierre_contratos'
        ));
    }

    public function store()
    {
        $this->cumple = $this->cumple == null ? false : $this->cumple;
        $this->validate();

        $cedula_cumplimiento = CedulaCumplimiento::where('contrato_id', '=', $this->contrato_id)->get();

        if (count($cedula_cumplimiento) == 0) {
            CedulaCumplimiento::create([
                'contrato_id' => $this->contrato_id,
                'elaboro' => $this->elaboro,
                'reviso' => $this->reviso,
                'autorizo' => $this->autorizo,
                'cumple' => $this->cumple,
            ]);
            $this->default();
            $this->alert('success', 'Registro añadido!');
            $this->dispatchBrowserEvent('cedulaEventChanged');
        } else {
            $this->default();
            $this->alert('error', 'Solo se puede regisrar una cedula de cumplimiento por contrato');
        }
    }

    public function edit($id)
    {
        $cedula = CedulaCumplimiento::find($id);

        $this->cedula_id = $cedula->id;
        $this->contrato_id = $cedula->contrato_id;
        $this->elaboro = $cedula->elaboro;
        $this->reviso =
            $cedula->reviso;
        $this->autorizo =
            $cedula->autorizo;
        $this->cumple =
            $cedula->cumple;
        $this->view = 'edit';
    }

    public function update()
    {
        $this->cumple = $this->cumple == null ? false : $this->cumple;
        $this->validate();
        $cedula_cumplimiento = CedulaCumplimiento::find($this->cedula_id);
        // dd();
        $elaboro_second = $this->elaboro;
        $cedula_cumplimiento->update([
            'elaboro' => $this->elaboro,
            'reviso' => $this->reviso,
            'autorizo' => $this->autorizo,
            'cumple' => $this->cumple,
        ]);
        //$this->emit('renderHistorico');
        $this->default();
        $this->alert('success', 'Registro actualizado!');
        $this->dispatchBrowserEvent('cedulaEventChanged');
    }

    public function confirmDelete($cedula_id)
    {
        $this->dispatchBrowserEvent('confirmDeleteCedulaEvent', ['cedula_id' => $cedula_id]);
    }

    public function destroy($id)
    {
        CedulaCumplimiento::destroy($id);
        $this->alert('success', 'Registro eliminado!');
    }

    public function default()
    {
        $this->elaboro = '';
        $this->reviso = '';
        $this->autorizo = '';
        $this->cumple = true;
        $this->dispatchBrowserEvent('cedulaEventChanged');
        $this->view = 'create';
    }
}
