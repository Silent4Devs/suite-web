<?php

namespace App\Http\Livewire;

use App\Models\RH\TipoObjetivo;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EvTrimestralConfigCategorias extends Component
{
    use LivewireAlert;

    public $tipos;

    public $categoria = [];

    public function mount()
    {
        $this->tipos = TipoObjetivo::getAll();
        // dd($this->tipos);
        if (!empty($this->tipos)) {
            foreach ($this->tipos as $tipo) {
                $this->categoria[] = [
                    'id' => $tipo->id,
                    'nombre' => $tipo->nombre,
                    'descripcion' => $tipo->descripcion,
                ];
            }
            // dd($this->categoria);
        } else {
            $this->categoria = ['', '', ''];
        }
    }

    public function addCategoria()
    {
        // Add an additional empty position
        $this->categoria[] = [
            'id' => null,
            'nombre' => null,
            'descripcion' => null,
        ];
    }

    public function removeCategoria($keyIndex, $id_borrar)
    {
        TipoObjetivo::find($id_borrar)->tipoObjetivoOcupado($id_borrar);
        dd($id_borrar);
        unset($this->categoria[$keyIndex]);
        $this->categoria = array_values($this->categoria);
    }

    public function render()
    {
        return view('livewire.ev-trimestral-config-categorias');
    }

    public function submitForm($data)
    {
        dd($data);
    }

    public function editRegistro($entrada, $campo, $id_edit = null)
    {
        // dd($entrada, $campo, $id_edit);
        if (empty($id_edit) && $campo != "nombre") {
            $this->alert('warning', '¡Crear Categoría!', [
                'position' => 'center',
                'timer' => '5000',
                'toast' => true,
                'text' => 'Primero debes asignar un nombre a la nueva categoría.',
                'width' => '500',
            ]);
        } else {
            TipoObjetivo::updateOrCreate(
                ['id' => $id_edit],
                [$campo => $entrada]
            );
        }
    }
}
