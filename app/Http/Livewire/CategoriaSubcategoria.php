<?php

namespace App\Http\Livewire;

use App\Models\SubcategoriaActivo;
use App\Models\Tipoactivo;
use Livewire\Component;

class CategoriaSubcategoria extends Component
{
    public $categorias;
    public $subcategorias;
    public $categoria;
    public $subcategoria;

    public $selectedState = null;

    public function mount()
    {
        $this->categorias = Tipoactivo::select('id', 'tipo')->get();
        $this->subcategorias = collect();
    }

    public function render()
    {
        return view('livewire.categoria-subcategoria');
    }

    public function updatedCategoria($value)
    {
        if (!is_null($value)) {
            $this->subcategorias = SubcategoriaActivo::select('id', 'subcategoria')->where('categoria_id', $value)->get();
        }
    }

}
