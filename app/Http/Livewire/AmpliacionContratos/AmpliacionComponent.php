<?php

namespace App\Http\Livewire\AmpliacionContratos;

use App\Functions\FormatearFecha;
use App\Models\ContractManager\AmpliacionContrato;
use App\Models\ContractManager\Contrato;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AmpliacionComponent extends Component
{
    use LivewireAlert;

    public $contrato_id;

    public $ampliacion_id;

    public $importe;

    public $monto_total_ampliado;

    public $fecha_inicio;

    public $fecha_fin;

    public $fecha_fin_contrato;

    public $show_contrato; // En formulario de edit se está en vista de consulta entonces es true

    public $view = 'create';

    public function mount($contrato_id, $show_contrato)
    {
        $this->contrato_id = $contrato_id;
        $this->show_contrato = $show_contrato;
    }

    public function render()
    {
        $ampliaciones = AmpliacionContrato::with('contrato')->where('contrato_id', '=', $this->contrato_id)->get();

        return view('livewire.ampliacion-contratos.ampliacion-component', [
            'ampliaciones' => $ampliaciones,
        ]);
    }

    public function store()
    {
        $this->importe = $this->importe == null ? '$0.00' : $this->importe;
        $this->validate([
            'contrato_id' => 'required',
            'importe' => ['required', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
            'fecha_inicio' => 'required|after:fecha_fin_contrato',
            'fecha_fin' => 'required|after:fecha_inicio',
        ], [
            'importe.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
        ]);

        //Contrato
        $contrato = Contrato::find($this->contrato_id);
        $monto_pago = $contrato->monto_pago;
        $contrato_ampliado = AmpliacionContrato::where('contrato_id', '=', $this->contrato_id)->get();
        if ($contrato->contrato_ampliado) {
            //Ampliación
            if (count($contrato_ampliado) == 0) {
                $importe_decimal = preg_replace('([$,])', '', $this->importe);

                $monto_pago_ampliado = $monto_pago + $importe_decimal;

                $formatoFecha = new FormatearFecha;
                $fecha_inicial_formateada = $formatoFecha->formatearFecha($this->fecha_inicio, 'd-m-Y', 'Y-m-d');
                $fecha_final_formateada = $formatoFecha->formatearFecha($this->fecha_fin, 'd-m-Y', 'Y-m-d');

                AmpliacionContrato::create([
                    'contrato_id' => $this->contrato_id,
                    'importe' => $importe_decimal,
                    'monto_total_ampliado' => $monto_pago_ampliado,
                    'fecha_inicio' => $fecha_inicial_formateada,
                    'fecha_fin' => $fecha_final_formateada,
                ]);

                $this->default();
                $this->dispatchBrowserEvent('contentChanged');
                $this->alert('success', 'Registro añadido!');
            } else {
                $this->default();
                $this->alert('error', 'Este contrato ya cuenta con una ampliación');
            }
        } else {
            $this->default();
            $this->alert('error', 'Ampliación no autorizada!');
        }
    }

    public function edit($id)
    {
        $ampliacion = AmpliacionContrato::find($id);

        $formatoFecha = new FormatearFecha;
        // dd(date('d-m-Y', strtotime($ampliacion->fecha_inicio)));

        // $fecha_inicial_formateada = $formatoFecha->formatearFecha($ampliacion->fecha_inicio, 'Y-m-d', 'd-m-Y');
        $fecha_inicial_formateada = Carbon::parse($ampliacion->fecha_inicio)->format('d-m-Y');
        $fecha_final_formateada = Carbon::parse($ampliacion->fecha_fin)->format('d-m-Y');
        // $fecha_final_formateada = $formatoFecha->formatearFecha($ampliacion->fecha_fin, 'Y-m-d', 'd-m-Y');

        $this->ampliacion_id = $ampliacion->id;
        $this->contrato_id = $ampliacion->contrato_id;
        $this->importe = $ampliacion->importe;
        $this->fecha_inicio = $fecha_inicial_formateada;
        $this->fecha_fin = $fecha_final_formateada;

        $this->view = 'edit';
    }

    public function update()
    {
        $this->importe = str_contains($this->importe, '$') ? $this->importe : '$'.$this->importe;
        $this->validate([
            'contrato_id' => 'required',
            'importe' => ['required', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
            'fecha_inicio' => 'required|after_or_equal:fecha_fin_contrato',
            'fecha_fin' => 'required|after:fecha_inicio',
        ], [
            'importe.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
        ]);

        //Contrato
        $contrato = Contrato::find($this->contrato_id);
        $monto_pago = $contrato->monto_pago;
        $contrato_ampliado = AmpliacionContrato::find($this->ampliacion_id);
        if ($contrato->contrato_ampliado) {
            //Ampliación
            $importe_decimal = preg_replace('([$,])', '', $this->importe);

            $monto_pago_ampliado = $monto_pago + $importe_decimal;

            $formatoFecha = new FormatearFecha;
            $fecha_inicial_formateada = $formatoFecha->formatearFecha($this->fecha_inicio, 'd-m-Y', 'Y-m-d');
            $fecha_final_formateada = $formatoFecha->formatearFecha($this->fecha_fin, 'd-m-Y', 'Y-m-d');

            $contrato_ampliado->update([
                'contrato_id' => $this->contrato_id,
                'importe' => $importe_decimal,
                'monto_total_ampliado' => $monto_pago_ampliado,
                'fecha_inicio' => $fecha_inicial_formateada,
                'fecha_fin' => $fecha_final_formateada,
            ]);

            $this->default();
            $this->dispatchBrowserEvent('contentChanged');
            $this->alert('success', 'Registro actualizado!');
        } else {
            $this->default();
            $this->alert('error', 'Ampliación no autorizada!');
        }
    }

    public function destroy($id)
    {
        AmpliacionContrato::destroy($id);
        $this->alert('success', 'Registro eliminado!');
    }

    public function default()
    {
        $this->importe = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'create';
    }
}
