<?php

namespace App\Http\Livewire;

use App\Models\RH\CatalogoRangosObjetivos;
use App\Models\RH\RangosObjetivos as RHRangosObjetivos;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditRangosObjetivos extends Component
{
    use LivewireAlert;

    public $cat_id;

    public $nombre = null;

    public $descripcion = null;

    public $color_estatus_1 = '';

    public $color_estatus_2 = '';

    public $estatus_1;

    public $estatus_2;

    public $valor_estatus_1;

    public $valor_estatus_2;

    public $descripcion_parametros_1;

    public $descripcion_parametros_2;

    public $parametros = [];

    public function addParametro1()
    {
        $this->parametros[] =
            [
                'color' => '#ffffff',
                'parametro' => '',
                'valor' => null,
                'descripcion' => '',
            ];
    }

    public function removeParametro1($keyndex)
    {
        // dd($keyndex);
        unset($this->parametros[$keyndex]);
        $this->parametros = array_values($this->parametros);
    }

    public function mount($cat_id)
    {
        $catalogo = CatalogoRangosObjetivos::with('rangos')->find($cat_id);
        $this->cat_id = $cat_id;
        $this->asignarInputs($catalogo);
    }

    public function render()
    {
        return view('livewire.edit-rangos-objetivos');
    }

    public function submitForm($data)
    {
        // dd($data);
        $catalogo = CatalogoRangosObjetivos::find($this->cat_id);
        $catalogo->update([
            'nombre_catalogo' => $data['nombre'],
            'descripcion' => $data['descripcion'],
        ]);

        $borrarColores = RHRangosObjetivos::where('catalogo_rangos_id', '=', $catalogo->id)->delete();

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

        $this->alert('success', '¡El Catalogo ha sido editado con éxito!', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => true,
            'text' => 'Se ha editado el catalogo de rangos, lo puedes consultar y editar cuando lo necesites.',
        ]);

        return redirect(route('admin.rangos.index'));
    }

    public function asignarInputs($catalogo)
    {
        // dd($catalogo);
        $this->nombre = $catalogo->nombre_catalogo;

        $this->descripcion = $catalogo->descripcion;

        $posicion_array = 0;

        foreach ($catalogo->rangos as $key => $parametro) {
            // dd($catalogo, $parametro);
            $posicion = $key + 1;

            if ($posicion <= 2) {
                // Construct the variable name by concatenating $posicion to $estatus_
                $estatus_variable_name = 'estatus_'.$posicion;
                $valor_estatus_name = 'valor_estatus_'.$posicion;
                $descripcion_parametros_name = 'descripcion_parametros_'.$posicion;
                $color_estatus_name = 'color_estatus_'.$posicion;
                // dd($parametro, $posicion);
                $this->$estatus_variable_name = $parametro->parametro;
                $this->$valor_estatus_name = $parametro->valor;
                $this->$descripcion_parametros_name = $parametro->descripcion;
                $this->$color_estatus_name = $parametro->color;
            } else {

                $this->parametros[$posicion_array] =
                    [
                        'color' => $parametro->color,
                        'parametro' => $parametro->parametro,
                        'valor' => $parametro->valor,
                        'descripcion' => $parametro->descripcion,
                    ];

                $posicion_array++;
            }
        }
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
