<?php

namespace App\Livewire;

use App\Models\RH\MetricasObjetivo;
use App\Models\RH\Objetivo;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DefinicionUnidadesObjetivos extends Component
{
    use LivewireAlert;

    public $id_1 = null;

    public $valor_minimo_1 = 0;

    public $valor_maximo_1 = 0;

    public $definicion_1;

    public $parametros = [];

    public $minimo = null;

    public $maximo = null;

    public function addUnidad()
    {
        $this->parametros[] = [
            'id' => null,
            'definicion' => null,
            'minimo' => null,
            'maximo' => null,
            'utilizado' => false,
        ];
    }

    public function removeUnidad($keyndex)
    {
        $borrarPM = MetricasObjetivo::find($this->parametros[$keyndex]['id']);
        if ($borrarPM != null) {
            $borrarPM->delete();
        }

        unset($this->parametros[$keyndex]);

        $this->alert('success', 'Unidad eliminada con éxito.', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => true,
            'text' => 'Se ha eliminado la unidad correctamente.',
        ]);
    }

    public function mount()
    {

        $unidades = MetricasObjetivo::get();
        $objetivos = Objetivo::get();

        // Crear un array de IDs de métricas utilizadas en los objetivos
        $metricasUtilizadas = $objetivos->pluck('metrica_id')->toArray();

        // Añadir la propiedad 'utilizado' a cada unidad
        foreach ($unidades as $unidad) {
            $unidad->utilizado = in_array($unidad->id, $metricasUtilizadas);
        }

        foreach ($unidades as $key => $esc) {
            $this->parametros[$key] = [
                'id' => $esc->id ?? null,
                'definicion' => $esc->definicion,
                'minimo' => $esc->valor_minimo ?? null,
                'maximo' => $esc->valor_maximo ?? null,
                'utilizado' => $esc->utilizado, // Agregar la propiedad utilizado
            ];
        }
    }

    public function render()
    {
        return view('livewire.definicion-unidades-objetivos');
    }

    public function agregarUnidad($key)
    {

        $pa = MetricasObjetivo::updateOrCreate(
            ['id' => $this->parametros[$key]['id']],
            [
                'definicion' => $this->parametros[$key]['definicion'],
                'valor_minimo' => $this->parametros[$key]['minimo'],
                'valor_maximo' => $this->parametros[$key]['maximo'],
            ]
        );

        $this->parametros[$key]['id'] = $pa->id;

        $this->alert('success', '¡La unidad ha sido definida con éxito!', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => true,
            'text' => 'Se ha generado la unidad correctamente.',
        ]);
    }
}
