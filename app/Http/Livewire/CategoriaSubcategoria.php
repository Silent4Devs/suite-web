<?php

namespace App\Http\Livewire;

use App\Models\SubcategoriaActivo;
use App\Models\Tipoactivo;
use Livewire\Component;

class CategoriaSubcategoria extends Component
{
    // protected $listeners = ['render-Modal-subcategoria' => 'render'];
    public $categorias;

    public $subcategorias;

    public $categoria;

    public $activo;

    public $subcategoria;

    public $categoriasSeleccionado;

    public $subcategoriaSeleccionado;

    public $selectedState = null;

    public function mount($categoriasSeleccionado, $subcategoriaSeleccionado)
    {
        // dd($subcategoriaSeleccionado);
        $this->subcategorias = collect();
        $this->categoriasSeleccionado = $categoriasSeleccionado;
        $this->subcategoriaSeleccionado = $subcategoriaSeleccionado;
    }

    public function render()
    {
        $this->categorias = Tipoactivo::select('id', 'tipo')->get();

        return view('livewire.categoria-subcategoria');
    }

    public function updatedCategoria($value)
    {
        if (is_null($value)) {
            $this->subcategorias = SubcategoriaActivo::select('id', 'subcategoria')->where('categoria_id', $value)->get();
        }
    }
}
