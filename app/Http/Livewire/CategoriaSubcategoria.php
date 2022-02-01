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
    public $subcategoria;
    public $categoriaSelect = 4;

    public $selectedState = null;

    public function mount()
    {
        $this->categorias = Tipoactivo::select('id', 'tipo')->get();
        $this->subcategorias = collect();
    }

    public function render()
    {
        return view('livewire.categoria-subcategoria',['categoriaSelect'=>$this->categoriaSelect]);
    }

    public function updatedCategoria($value)
    {
        if (!is_null($value)) {
            $this->subcategorias = SubcategoriaActivo::select('id', 'subcategoria')->where('categoria_id', $value)->get();
        }
    }
}
