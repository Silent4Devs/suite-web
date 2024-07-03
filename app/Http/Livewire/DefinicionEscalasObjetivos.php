<?php

namespace App\Http\Livewire;

use App\Models\EscalasMedicionObjetivos;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DefinicionEscalasObjetivos extends Component
{
    use LivewireAlert;

    public $color_estatus_1 = '#34B990';

    public $color_estatus_2 = '#73A7D5';

    public $estatus_1;

    public $estatus_2;

    public $parametros = [];

    public $minimo = null;

    public $maximo = null;

    public $valor_estatus_1;

    public $valor_estatus_2;

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
        $escalas = EscalasMedicionObjetivos::get();

        if (isset($escalas[0]->parametro)) {
            $this->estatus_1 = $escalas[0]->parametro;
            $this->color_estatus_1 = $escalas[0]->color;
            $this->valor_estatus_1 = $escalas[0]->valor;

            $this->estatus_2 = $escalas[1]->parametro;
            $this->color_estatus_2 = $escalas[1]->color;
            $this->valor_estatus_2 = $escalas[1]->valor;
            // dd($escalas);
            foreach ($escalas as $key => $esc) {
                if ($key > 1) {
                    $this->parametros[$key] =
                        [
                            'parametro' => $esc->parametro,
                            'color_estatus' => $esc->color,
                            'valor' => $esc->valor,
                        ];
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.definicion-escalas-objetivos');
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
        $borrar = EscalasMedicionObjetivos::get();

        foreach ($borrar as $borra) {
            $borra->delete();
        }

        EscalasMedicionObjetivos::create([
            'parametro' => $data['estatus_1'],
            'color' => $data['color_estatus_1'],
            'valor' => $data['valor_estatus_1'],
        ]);

        EscalasMedicionObjetivos::create([
            'parametro' => $data['estatus_2'],
            'color' => $data['color_estatus_2'],
            'valor' => $data['valor_estatus_2'],
        ]);

        $param_extra = $this->groupValues($data);

        if (! empty($param_extra)) {
            foreach ($param_extra as $key => $p) {
                EscalasMedicionObjetivos::create([
                    'parametro' => $p['estatus'],
                    'color' => $p['color'],
                    'valor' => $p['valor'],
                ]);
            }
        }

        $this->alert('success', '¡Las escalas han sido definidas con éxito!', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => true,
            'text' => 'Se ha generado el catalogo, lo puedes consultar y editar cuando lo necesites.',
        ]);
    }

    public function groupValues($values)
    {
        $groupedValues = [];

        foreach ($this->parametros as $key => $parametro) {
            $estatusKey = "estatus_arreglo_{$key}";

            if (isset($values[$estatusKey]) && ! empty($values[$estatusKey])) {

                $groupedValues["group_{$key}"] = [
                    'estatus' => $values[$estatusKey],
                    'color' => $values["color_estatus_arreglo_{$key}"] ?? null,
                    'valor' => $values["valor_estatus_arreglo_{$key}"] ?? null,
                ];
            }
        }

        // dd($groupedValues);
        return $groupedValues;
    }
}
