<?php

namespace App\Http\Livewire\Escuela;

use App\Models\Escuela\UsuariosCursos;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class EstudiantesEdit extends Component
{
    public $student;

    public function mount($student)
    {
        $this->student = $student;
    }

    public function destroy($id)
    {
        UsuariosCursos::destroy($id);
        // Alert::toast('El rol fue eliminado exitosamente', 'success');
        $this->emit('UserStore');
    }

    public function render()
    {
        return view('livewire.estudiantes-edit');
    }
}
