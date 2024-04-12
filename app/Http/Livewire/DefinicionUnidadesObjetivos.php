<?php

namespace App\Http\Livewire;

use App\Models\RH\MetricasObjetivo;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DefinicionUnidadesObjetivos extends Component
{
    use LivewireAlert;

    public $valor_minimo_1 = 0;

    public $valor_maximo_1 = 0;

    public $definicion_1;

    public $parametros = [];

    public $minimo = null;

    public $maximo = null;

    public function addParametro1()
    {
        $this->parametros[] = '';
    }

    public function removeParametro1($keyndex)
    {
        // dd($keyndex);
        unset($this->parametros[$keyndex]);
        $this->parametros = array_values($this->parametros);
    }

    public function mount()
    {

        $unidades = MetricasObjetivo::get();

        if (isset($unidades[0]->definicion)) {
            $this->definicion_1 = $unidades[0]->definicion;
            $this->valor_minimo_1 = $unidades[0]->valor_minimo;
            $this->valor_maximo_1 = $unidades[0]->valor_maximo;

            foreach ($unidades as $key => $esc) {
                if ($key > 1) {
                    $this->parametros[$key] =
                        [
                            'definicion' => $esc->definicion,
                            'minimo' => $esc->valor_minimo ?? null,
                            'maximo' => $esc->valor_maximo ?? null,
                        ];
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.definicion-unidades-objetivos');
    }

    // public function definirLimite($limite, $valor)
    // {
    //     switch ($limite) {
    //         case 'minimo':
    //             $this->minimo = $valor;
    //             break;

    //         case 'maximo':
    //             $this->maximo = $valor;
    //             break;
    //     }
    // }

    public function submitForm($data)
    {
        // dd($data);
        $borrar = MetricasObjetivo::get();

        foreach ($borrar as $borra) {
            $borra->delete();
        }

        MetricasObjetivo::create([
            'definicion' => $data['definicion_1'],
            'color' => $data['color_estatus_1'],
        ]);

        $param_extra = $this->groupValues($data);

        if (!empty($param_extra)) {
            foreach ($param_extra as $key => $p) {
                MetricasObjetivo::create([
                    'definicion' => $p['estatus'],
                    'minimo' => $p['minimo'],
                    'maximo' => $p['minimo'],
                ]);
            }
        }

        $this->alert('success', '¡Las unidades han sido definidas con éxito!', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => true,
            'text' => 'Se ha generado el catalogo, lo puedes consultar y editar cuando lo necesites.',
        ]);
    }

    public function groupValues($values)
    {
        $groupedValues = [];

        foreach ($this->parametros as $key => $definicion) {
            $estatusKey = "estatus_arreglo_{$key}";

            if (isset($values[$estatusKey]) && !empty($values[$estatusKey])) {

                $groupedValues["group_{$key}"] = [
                    'estatus' => $values[$estatusKey],
                    'color' => $values["color_estatus_arreglo_{$key}"] ?? null,
                ];
            }
        }

        // dd($groupedValues);
        return $groupedValues;
    }
}
