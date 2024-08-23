<?php

namespace App\Livewire;

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
        $this->parametros[] =
            [
                'parametro' => '',
                'valor' => null,
                'color_estatus' => '#000000',
            ];
    }

    public function removeParametro1($keyndex)
    {
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
        }

        if (isset($escalas[1]->parametro)) {
            $this->estatus_2 = $escalas[1]->parametro;
            $this->color_estatus_2 = $escalas[1]->color;
            $this->valor_estatus_2 = $escalas[1]->valor;
        }

        foreach ($escalas as $key => $esc) {
            if ($key > 1) {
                $this->parametros[] = [
                    'parametro' => $esc->parametro,
                    'color_estatus' => $esc->color,
                    'valor' => $esc->valor,
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.definicion-escalas-objetivos');
    }

    public function submitForm($data)
    {
        // Recopilar todos los datos en un solo arreglo
        $escalas = [
            [
                'parametro' => $data['estatus_1'],
                'color' => $data['color_estatus_1'],
                'valor' => $data['valor_estatus_1'],
            ],
            [
                'parametro' => $data['estatus_2'],
                'color' => $data['color_estatus_2'],
                'valor' => $data['valor_estatus_2'],
            ],
        ];

        foreach ($this->parametros as $parametro) {
            $escalas[] = [
                'parametro' => $parametro['parametro'],
                'color' => $parametro['color_estatus'],
                'valor' => $parametro['valor'],
            ];
        }

        // Validar que los campos 'parametro' no estén vacíos y que 'valor' no sea null
        foreach ($escalas as $escala) {
            if (empty($escala['parametro']) || $escala['valor'] === null) {
                $this->alert('error', 'Parámetro no puede estar vacío y valor no puede ser null', [
                    'position' => 'center',
                    'timer' => 5000,
                    'toast' => true,
                    'text' => 'Por favor, asegúrese de completar todos los campos de parámetro y valor.',
                ]);

                return;
            }
        }

        // Verificar si hay valores duplicados
        $valores = array_column($escalas, 'valor');
        if (count($valores) !== count(array_unique($valores))) {
            $this->alert('error', 'Los valores no deben repetirse', [
                'position' => 'center',
                'timer' => 5000,
                'toast' => true,
                'text' => 'Por favor, asegúrese de que todos los valores sean únicos.',
            ]);

            return;
        }

        // Ordenar las escalas por el valor
        usort($escalas, function ($a, $b) {
            return $a['valor'] <=> $b['valor'];
        });

        // Borrar registros existentes
        EscalasMedicionObjetivos::truncate();

        // Guardar las escalas ordenadas
        foreach ($escalas as $escala) {
            EscalasMedicionObjetivos::create($escala);
        }

        $this->alert('success', '¡Las escalas han sido definidas con éxito!', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => true,
            'text' => 'Se ha generado el catálogo, lo puedes consultar y editar cuando lo necesites.',
        ]);
    }

    public function groupValues($values)
    {
        $groupedValues = [];

        foreach ($this->parametros as $key => $parametro) {
            $estatusKey = "estatus_arreglo_{$key}";

            if (isset($values[$estatusKey]) && ! empty($values[$estatusKey])) {
                $groupedValues[] = [
                    'estatus' => $values[$estatusKey],
                    'color' => $values["color_estatus_arreglo_{$key}"] ?? null,
                    'valor' => $values["valor_estatus_arreglo_{$key}"] ?? null,
                ];
            }
        }

        return $groupedValues;
    }
}
