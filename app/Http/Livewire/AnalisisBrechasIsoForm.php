<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\EvaluacionAnalisisBrechas;
use App\Models\Iso27\AnalisisBrechasIso;
use App\Models\Norma;
use App\Models\ParametrosEvaluacionAnalisisBrechas;
use App\Models\PreguntasEvaluacionanalisisBrechas;
use App\Models\SeccionesEvaluacionAnalisisBrechas;
use App\Models\TemplateAnalisisdeBrechas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AnalisisBrechasIsoForm extends Component
{
    public $analisis_id;

    public $name;

    public $fecha;

    public $id_elaboro = '';

    public $norma = 'iso27001';

    private $norma_id = 1;

    public $selectedCard = null;

    public $view = 'create';

    protected $listeners = ['destroy'];

    public $imagenID;

    public function mount()
    {
    }

    public function render()
    {
        $this->fecha = Carbon::now()->format('d-m-y');
        $empleados = Empleado::getaltaAll();
        $analisis_brechas = AnalisisBrechasIso::get();
        $templates = TemplateAnalisisdeBrechas::where('top', true)->get();
        $normas = Norma::get();
        $this->imagenID = asset('img\alert_template_analisis_brechas_id.png');

        return view('livewire.analisis-brechas-iso-form', compact('empleados', 'analisis_brechas', 'templates', 'normas'));
    }

    private function resetInput()
    {
        $this->name = null;
        $this->id_elaboro = '';
    }

    public function save()
    {
        if ($this->selectedCard) {
            // $template_general = TemplateAnalisisdeBrechas::with('parametros')
            // ->with('secciones')
            // ->find($this->selectedCard);
            // dd($template_general);
            $this->evaluacion();

            $this->resetInput();
            $this->emit('limpiarNameInput');

            return;
        }

        $this->emit('selectedCardAlert');
    }

    public function SelectCard($index)
    {
        if ($this->selectedCard === $index) {
            $this->selectedCard = null;
        } else {
            $this->selectedCard = $index;
        }
    }

    public function edit($id)
    {
        $analisis_brechas = AnalisisBrechasIso::find($id);
        $this->name = $analisis_brechas->nombre;
        $fecha = strtotime($analisis_brechas->fecha);
        $this->fecha = date('d-m-y', $fecha);
        $this->id_elaboro = $analisis_brechas->empleado->id;
        $this->view = 'edit';
        $this->analisis_id = $id;
    }

    public function update()
    {
        $analisis_brechas = AnalisisBrechasIso::find($this->analisis_id);
        $analisis_brechas->update([
            'nombre' => $this->name,
            'fecha' => $this->fecha,
            'id_elaboro' => $this->id_elaboro,
        ]);
    }

    public function destroy($id)
    {
        AnalisisBrechasIso::destroy($id);
    }

    public function evaluacion()
    {

        DB::beginTransaction();

        try {

            $analisisBrechaIso = AnalisisBrechasIso::create([
                'nombre' => $this->name,
                'fecha' => $this->fecha,
                'porcentaje_implementacion' => 0,
                'id_elaboro' => $this->id_elaboro,
                'estatus' => 1,
                'norma_id' => $this->norma_id,
            ]);

            $template_general = TemplateAnalisisdeBrechas::with('parametros')
                ->with('secciones')
                ->find($this->selectedCard);

            $parametros_generales = $template_general->parametros;
            $secciones_generales = $template_general->secciones;

            $evaluacion = EvaluacionAnalisisBrechas::create([
                'analisis_brechas_id' => $analisisBrechaIso->id,
                'nombre_evaluacion' => $template_general->nombre_template,
                'norma_id' => $template_general->norma_id,
                'descripcion' => $template_general->descripcion,
                'no_secciones' => $template_general->no_secciones,
            ]);

            foreach ($parametros_generales as $parametro_general) {
                ParametrosEvaluacionAnalisisBrechas::create([
                    'evaluacion_id' => $evaluacion->id,
                    'estatus' => $parametro_general->estatus,
                    'color' => $parametro_general->color,
                    'valor' => $parametro_general->valor,
                    'descripcion' => $parametro_general->descripcion,
                ]);
            }

            foreach ($secciones_generales as $seccion_general) {

                $seccion = SeccionesEvaluacionAnalisisBrechas::create([
                    'evaluacion_id' => $evaluacion->id,
                    'numero_seccion' => $seccion_general->numero_seccion,
                    'descripcion' => $seccion_general->descripcion,
                    'porcentaje_seccion' => $seccion_general->porcentaje_seccion,
                ]);

                $preguntas_generales = $seccion_general->preguntas;

                foreach ($preguntas_generales as $pregunta_general) {
                    PreguntasEvaluacionanalisisBrechas::create([
                        'seccion_id' => $seccion->id,
                        'pregunta' => $pregunta_general->pregunta,
                        'numero_pregunta' => $pregunta_general->numero_pregunta,
                    ]);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollback();
        }
    }

    public function analisis($id)
    {
        // $test2 = AnalisisBrechasIso::with('evaluacionTemplateAnalisisBrechas')->find($id);
        // dd($test2);

        // return redirect()->route('admin.formulario',$test2->evaluacionTemplateAnalisisBrechas->id);
        return redirect()->route('admin.formulario', $id);

        // dd($test2->evaluacionTemplateAnalisisBrechas->id);

    }
}
