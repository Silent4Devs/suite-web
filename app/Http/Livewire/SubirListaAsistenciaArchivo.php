<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubirListaAsistenciaArchivo extends Component
{
    use WithFileUploads;

    public $lista;

    public $mostrarLista = false;

    public $recurso;

    protected $listeners = ['render'];

    public function mount($recurso)
    {
        $this->recurso = $recurso;
    }

    public function save()
    {
        $this->validate([
            'lista' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:10000', // 1MB Max
        ], [
            'lista.required' => 'Tienes que seleccionar un archivo',
        ]);
        $archivo = 'Lista_Asistencia.'.$this->lista->extension();
        $this->lista->storeAs("public/capacitaciones/listas/{$this->recurso->id}_capacitacion/", $archivo);

        $this->recurso->update([
            'lista_asistencia' => $archivo,
        ]);
        $this->emit('listaGuardada');
    }

    public function remove()
    {
        $eliminado = Storage::disk('capacitaciones')->delete("listas/{$this->recurso->id}_capacitacion/".$this->recurso->lista_asistencia);
        if ($eliminado) {
            $this->recurso->update([
                'lista_asistencia' => null,
            ]);
            $this->emit('listaEliminada', ['estatus' => 200, 'mensaje' => 'La lista de asistencia ha sido eliminada']);
        } else {
            $this->emit('listaEliminada', ['estatus' => 500, 'mensaje' => 'No se pudo eliminar el archivo']);
        }
    }

    public function render()
    {
        if ($this->recurso->lista_asistencia != null) {
            $this->mostrarLista = true;
        }

        return view('livewire.subir-lista-asistencia-archivo', [
            'mostrarLista' => $this->mostrarLista,
        ]);
    }
}
