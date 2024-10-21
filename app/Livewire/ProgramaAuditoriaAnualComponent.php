<?php

namespace App\Livewire;

use App\Models\AuditoriaAnual;
use App\Models\AuditoriaAnualDocumento;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProgramaAuditoriaAnualComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $documento;

    public $auditoriaAnualId;

    public function mount($auditoriaAnualId)
    {
        $this->auditoriaAnualId = $auditoriaAnualId;
    }

    public function updatedDocumento()
    {
        $this->validate([
            'documento' => 'required|mimes:jpg,pdf,png|max:10240',
        ]);
    }

    public function save()
    {
        $this->validate([
            'documento' => 'required|mimes:jpg,pdf,png|max:10240',
        ]);
        $auditoriaAnual = AuditoriaAnual::select('id', 'nombre')->find($this->auditoriaAnualId);
        $extension = $this->documento->extension();

        $nombreAuditoria = str_replace(' ', '_', $auditoriaAnual->nombre);
        $nombreArchivo = $this->auditoriaAnualId.$nombreAuditoria.".{$extension}";
        $documentoAuditoria = $this->documento->storeAs('public/programaAnualAuditoria/documentos/'.$this->auditoriaAnualId.'/', $nombreArchivo);
        AuditoriaAnualDocumento::updateOrCreate([
            'id_auditoria_anuals' => $this->auditoriaAnualId,
        ], [
            'documento' => $nombreArchivo,
        ]);

        $this->alert('success', 'Bien hecho', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Creado con éxito',
        ]);

        return redirect()->route('admin.auditoria-anuals.index');
    }

    public function render()
    {
        return view('livewire.programa-auditoria-anual-component');
    }
}
