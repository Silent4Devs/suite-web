<?php

namespace App\Livewire;

use App\Models\RH\TipoObjetivo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TipoObjetivosCreate extends Component
{
    use WithFileUploads;

    public $nombre;

    public $fotoPerspectiva;

    // protected $rules = [
    //     'nombre' => 'required|string|max:255',
    //     'fotoPerspectiva' => 'required|mimes:jpeg,jpg,png|max:6000'
    // ];

    // protected $mesages = [
    //     'nombre.required' => 'Debes de definir un nombre para el tipo de objetivo',
    //     'nombre.max' => 'El tipo de objetivo no debe exceder los 255 carácteres',
    //     'fotoPerspectiva.mimes' => 'Formato de imágen aceptado: jpeg,jpg,png',
    //     'fotoPerspectiva.max' => 'Peso máximo de la imágen: 6 MB'
    // ];

    public function save()
    {
        $this->validate(
            [
                'fotoPerspectiva' => 'required|mimes:jpeg,jpg,png|max:6000',
                'nombre' => 'required|string|max:255',
            ],
            [
                'nombre.required' => 'Debes de definir un nombre para el tipo de objetivo',
                'nombre.max' => 'El tipo de objetivo no debe exceder los 255 carácteres',
                'fotoPerspectiva.mimes' => 'Formato de imágen aceptado: jpeg,jpg,png',
                'fotoPerspectiva.max' => 'Peso máximo de la imágen: 6 MB',
            ]
        );
        $imagen = null;
        if ($this->fotoPerspectiva) {
            Storage::makeDirectory('public/perspectivas/img'); //Crear si no existe
            $route = '/public/perspectivas/img/';
            $extension = $this->fotoPerspectiva->getClientOriginalExtension();
            $nombre_imagen = 'PERSPECTIVA'.'_'.$this->nombre.'.'.$extension;
            $this->fotoPerspectiva->storeAs($route, $nombre_imagen);
            $imagen = $nombre_imagen;
        }
        $tipo = TipoObjetivo::create([
            'nombre' => $this->nombre,
            'imagen' => $imagen,
            'created_at' => Carbon::now(),
        ]);
        if ($this->fotoPerspectiva) {
            $extension = $this->fotoPerspectiva->getClientOriginalExtension();
            $nombre_imagen = 'PERSPECTIVA'.'_'.$this->nombre.'.'.$extension;
            $tipo->update([
                'imagen' => $nombre_imagen,
            ]);
        }
        $this->dispatch('tipoObjetivoStore');
        $this->dispatch('render-tipo-objetivo-select');
    }

    public function render()
    {
        return view('livewire.tipo-objetivos-create');
    }
}
