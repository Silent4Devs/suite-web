<?php

namespace App\Http\Livewire;

// use App\Models\RH\TipoObjetivo;
use App\Models\CategoriaObjetivosDesempeno;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EvTrimestralConfigCategorias extends Component
{
    use LivewireAlert;

    public $tipos;

    public $categoria = [];

    public function mount()
    {
        $this->tipos = CategoriaObjetivosDesempeno::get();
        // dd($this->tipos);
        if (isset($this->tipos[0]->nombre)) {
            foreach ($this->tipos as $tipo) {
                $this->categoria[] = [
                    'id' => $tipo->id,
                    'nombre' => $tipo->nombre,
                    'descripcion' => $tipo->descripcion,
                    'ocupado' => $tipo->tipo_ocupado,
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
            'ocupado' => false,
        ];
    }

    public function removeCategoria($keyIndex, $id_borrar = null)
    {
        if (!empty($id_borrar)) {
            $tipo = CategoriaObjetivosDesempeno::find($id_borrar);
            $tipo->delete();
        }

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

    public function editRegistro($entrada, $campo, $id_edit = null, $key)
    {
        // dd($entrada, $campo, $id_edit, $key);
        if ($id_edit == null && $campo != "nombre") {
            $this->alert('warning', '¡Crear Categoría!', [
                'position' => 'center',
                'timer' => '5000',
                'toast' => true,
                'text' => 'Primero debes asignar un nombre a la nueva categoría.',
                'width' => '500',
            ]);
        } else {
            $nuevotipo = CategoriaObjetivosDesempeno::updateOrCreate(
                ['id' => $id_edit],
                [$campo => $entrada]
            );
            // dd($nuevotipo);
            $this->categoria[$key]['id'] = $nuevotipo->id;
            $this->categoria[$key][$campo] = $entrada;

            $this->alert('success', 'Cambio Guardado', [
                'position' => 'top-right',
                'timer' => '3000',
                'toast' => true,
                'text' => 'Se guardo correctamente',
                'width' => '250',
            ]);

            // dd($nuevotipo, $this->categoria[$key]);
        }
    }
}
