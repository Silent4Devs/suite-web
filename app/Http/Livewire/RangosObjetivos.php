<?php

namespace App\Http\Livewire;

use App\Models\RH\CatalogoRangosObjetivos;
use App\Models\RH\RangosObjetivos as RHRangosObjetivos;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RangosObjetivos extends Component
{
    use LivewireAlert;

    public $nombre = null;

    public $descripcion = null;

    public $color_estatus_1 = '#34B990';

    public $color_estatus_2 = '#73A7D5';

    public $estatus_1;

    public $estatus_2;

    public $valor_estatus_1;

    public $valor_estatus_2;

    public $descripcion_parametros_1;

    public $descripcion_parametros_2;

    public $parametros = [];

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
    }

    public function render()
    {
        return view('livewire.rangos-objetivos');
    }

    public function submitForm($data)
    {
        // dd($data);
        $catalogo = CatalogoRangosObjetivos::create([
            'nombre_catalogo' => $data['nombre'],
            'descripcion' => $data['descripcion'],
        ]);

        RHRangosObjetivos::create([
            'catalogo_rangos_id' => $catalogo->id,
            'parametro' => $data['estatus_1'],
            'valor' => $data['valor_estatus_1'],
            'color' => $data['color_estatus_1'],
            'descripcion' => $data['descripcion_parametros_1'],
        ]);

        RHRangosObjetivos::create([
            'catalogo_rangos_id' => $catalogo->id,
            'parametro' => $data['estatus_2'],
            'valor' => $data['valor_estatus_2'],
            'color' => $data['color_estatus_2'],
            'descripcion' => $data['descripcion_parametros_2'],
        ]);

        $param_extra = $this->groupValues($data);

        if (! empty($param_extra)) {
            foreach ($param_extra as $key => $p) {
                RHRangosObjetivos::create([
                    'catalogo_rangos_id' => $catalogo->id,
                    'parametro' => $p['estatus'],
                    'valor' => $p['valor'],
                    'color' => $p['color'],
                    'descripcion' => $p['descripcion'],
                ]);
            }
        }

        $this->alert('success', '¡El Catalogo ha sido creado con éxito!', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => true,
            'text' => 'Se ha generado el catalogo, lo puedes consultar y editar cuando lo necesites.',
        ]);

        return redirect(route('admin.rangos.index'));
    }

    public function groupValues($values)
    {
        $groupedValues = [];

        foreach ($this->parametros as $key => $parametro) {
            $estatusKey = "estatus_arreglo_{$key}";
            $valorKey = "valor_estatus_arreglo_{$key}";
            $descripcionKey = "descripcion_parametros_arreglo_{$key}";

            if (
                isset($values[$estatusKey]) && isset($values[$valorKey]) &&
                ! empty($values[$estatusKey]) && ! empty($values[$valorKey])
            ) {
                $groupedValues["group_{$key}"] = [
                    'estatus' => $values[$estatusKey],
                    'valor' => $values[$valorKey],
                    'color' => $values["color_estatus_arreglo_{$key}"] ?? null,
                    'descripcion' => $values[$descripcionKey],
                ];
            }
        }

        // dd($groupedValues);
        return $groupedValues;
    }
}
