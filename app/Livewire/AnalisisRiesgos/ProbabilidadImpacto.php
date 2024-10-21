<?php

namespace App\Livewire\AnalisisRiesgos;

use App\Models\TBProbabilidadImpactoAnalisisRiesgoModel;
use App\Models\TBTemplateAnalisisRiesgoModel;
use App\Models\TBTemplateArProbImpArModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProbabilidadImpacto extends Component
{
    public $template_id;

    public $prob_imp;

    public $min_max_id;

    public $edit = false;

    protected $listeners = [
        'renderReloadProbImp' => 'mount',
        'renderSaveProbImp' => 'save',
        'destroy',
    ];

    public $min;

    public $max;

    public $send = false;

    protected $rules = [
        'min' => 'required|int|max:2',
    ];

    protected $messages = [
        'min.required' => 'El campo minimo es requerido',
        'min.max' => 'El campo minimo no debe ser menor a 0',
    ];

    public function mount($template_id)
    {
        $this->template_id = $template_id;
        $this->prob_imp = [
            [
                'id' => 0,
                'nombre' => '',
                'color' => '#34B990',
                'valor' => 0,
            ],
            [
                'id' => 0,
                'nombre' => '',
                'color' => '#73A7D5',
                'valor' => 0,
            ],
        ];
        $this->asignarInputs();
    }

    public function asignarInputs()
    {
        $getData = TBTemplateArProbImpArModel::find($this->template_id);
        $this->min = $getData->valor_min;
        $this->max = $getData->valor_max;
        if (! $getData->getProbImp->isEmpty()) {
            $this->edit = true;
            $newCollect = [];
            foreach ($getData->getProbImp as $register) {
                array_push($newCollect, [
                    'id' => $register->id,
                    'nombre' => $register->nombre,
                    'color' => $register->color,
                    'valor' => $register->valor,
                ]);
            }
            $this->prob_imp = $newCollect;
        }

    }

    public function addInput()
    {
        $this->prob_imp[] = [
            'id' => 0,
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

        $templateAr_Es = TBTemplateArProbImpArModel::find($this->min_max_id)->update([
            'valor_min' => $this->min,
            'valor_max' => $this->max,
        ]);

        if ($this->edit) {
            $newRegisters = array_filter($this->prob_imp, function ($prob_imp) {
                return $prob_imp['id'] == 0;
            });

            $data = array_filter($this->prob_imp, function ($prob_imp) {
                return $prob_imp['id'] !== 0;
            });

            try {
                foreach ($data as $prob_imp) {
                    $registerExist = TBProbabilidadImpactoAnalisisRiesgoModel::where('id', $prob_imp['id'])->exists();
                    if ($registerExist) {
                        TBProbabilidadImpactoAnalisisRiesgoModel::find($prob_imp['id'])->update([
                            'nombre' => $prob_imp['nombre'],
                            'color' => $prob_imp['color'],
                            'valor' => $prob_imp['valor'],
                        ]);
                    }
                }
                if (! empty($newRegisters)) {
                    foreach ($newRegisters as $prob_imp) {
                        TBProbabilidadImpactoAnalisisRiesgoModel::create([
                            'nombre' => $prob_imp['nombre'],
                            'valor' => $prob_imp['valor'],
                            'color' => $prob_imp['color'],
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
                foreach ($this->prob_imp as $prob_imp) {
                    TBProbabilidadImpactoAnalisisRiesgoModel::create([
                        'nombre' => $prob_imp['nombre'],
                        'valor' => $prob_imp['valor'],
                        'color' => $prob_imp['color'],
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

        $this->dispatch('validateProb_Imp', $this->send);
    }

    public function removeInput($key)
    {
        unset($this->prob_imp[$key]);
    }

    public function destroy($id, $key)
    {
        DB::beginTransaction();
        try {
            TBProbabilidadImpactoAnalisisRiesgoModel::destroy($id);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
        }
        unset($this->prob_imp[$key]);
    }

    public function resetMinMax()
    {
        $this->min = 0;
        $this->max = 0;
    }

    public function render()
    {
        $template = TBTemplateAnalisisRiesgoModel::find($this->template_id);
        $this->min_max_id = $template->getAr_Probabilidad_Impacto->id;

        return view('livewire.analisis-riesgos.probabilidad-impacto');
    }
}
