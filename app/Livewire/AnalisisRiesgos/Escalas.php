<?php

namespace App\Livewire\AnalisisRiesgos;

use App\Models\TBEscalaAnalisisRiesgoModel;
use App\Models\TBTemplateAnalisisRiesgoModel;
use App\Models\TBTemplateAr_EscalaArModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Escalas extends Component
{
    public $template_id;

    public $escalas;

    public $min_max_id;

    public $registerDelete = [];

    public $edit = false;

    protected $listeners = [
        'renderReloadEscala' => 'mount',
        'renderSaveEscala' => 'save',
        'destroy',
    ];

    public $min;

    public $max;

    public $send = false;

    protected $rules = [
        'min' => 'required|int|min:0',
        'max' => 'required|int|min:0',
        'escalas.*.nombre' => 'required|string',

    ];

    protected $messages = [
        'min.required' => 'El campo minimo es requerido',
        'max.required' => 'El campo máximo es requerido',
        'min.min' => 'El campo minimo no debe ser menor a 0',
        'min.max' => 'El campo máximo no debe ser menor a 0',
        'escalas.*.nombre.required' => 'El campo es requerido',
    ];

    public function mount($template_id)
    {
        $this->template_id = $template_id;
        $this->escalas = [
            ['id' => 0, 'is_accept' => false, 'nombre' => '', 'color' => '#34B990', 'valor' => 0],
            [
                'id' => 0,
                'is_accept' => false,
                'nombre' => '',
                'color' => '#73A7D5',
                'valor' => 0,
            ],
        ];
        $this->asignarInputs();
    }

    public function asignarInputs()
    {
        $getData = TBTemplateAr_EscalaArModel::find($this->template_id);
        $this->min = $getData->valor_min;
        $this->max = $getData->valor_max;
        if (! $getData->getEscalas->isEmpty()) {
            $this->edit = true;
            $newCollect = [];
            foreach ($getData->getEscalas as $register) {
                array_push($newCollect, [
                    'id' => $register->id,
                    'is_accept' => $register->riesgo_aceptable,
                    'nombre' => $register->nombre,
                    'color' => $register->color,
                    'valor' => $register->valor,
                ]);
            }
            $this->escalas = $newCollect;
        }
    }

    public function addInput()
    {
        $this->escalas[] = [
            'id' => 0,
            'is_accept' => false,
            'nombre' => '',
            'color' => '',
            'valor' => 0,
        ];
    }

    public function save()
    {
        $this->send = false;
        $this->validate($this->rules, $this->messages);

        DB::beginTransaction();

        $templateAr_Es = TBTemplateAr_EscalaArModel::find($this->min_max_id)->update([
            'valor_min' => $this->min,
            'valor_max' => $this->max,
        ]);

        if ($this->edit) {
            $newRegisters = array_filter($this->escalas, function ($escala) {
                return $escala['id'] == 0;
            });

            $data = array_filter($this->escalas, function ($escala) {
                return $escala['id'] !== 0;
            });

            try {
                foreach ($data as $escala) {
                    $registerExist = TBEscalaAnalisisRiesgoModel::where('id', $escala['id'])->exists();
                    if ($registerExist) {
                        TBEscalaAnalisisRiesgoModel::find($escala['id'])->update([
                            'nombre' => $escala['nombre'],
                            'color' => $escala['color'],
                            'valor' => $escala['valor'],
                            'riesgo_aceptable' => $escala['is_accept'],
                        ]);
                    }
                }
                if (! empty($newRegisters)) {
                    foreach ($newRegisters as $escala) {
                        TBEscalaAnalisisRiesgoModel::create([
                            'nombre' => $escala['nombre'],
                            'valor' => $escala['valor'],
                            'color' => $escala['color'],
                            'riesgo_aceptable' => $escala['is_accept'],
                            'min_max_id' => $this->min_max_id,
                        ]);
                    }
                }
                DB::commit();
                $this->send = true;
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollback();
            }
        } else {
            try {
                foreach ($this->escalas as $escala) {
                    TBEscalaAnalisisRiesgoModel::create([
                        'nombre' => $escala['nombre'],
                        'valor' => $escala['valor'],
                        'color' => $escala['color'],
                        'riesgo_aceptable' => $escala['is_accept'],
                        'min_max_id' => $this->min_max_id,
                    ]);
                }
                DB::commit();
                $this->send = true;
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollback();
            }
        }

        $this->dispatch('validateEscala', send: $this->send);
    }

    public function removeInput($key)
    {
        unset($this->escalas[$key]);
    }

    public function destroy($id, $key)
    {
        DB::beginTransaction();
        try {
            TBEscalaAnalisisRiesgoModel::destroy($id);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
        }
        unset($this->escalas[$key]);
    }

    public function resetMinMax()
    {
        $this->min = 0;
        $this->max = 0;
    }

    public function render()
    {
        $template = TBTemplateAnalisisRiesgoModel::find($this->template_id);
        $this->min_max_id = $template->getAr_Escala->id;

        return view('livewire.analisis-riesgos.escalas');
    }
}
