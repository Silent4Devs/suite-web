<?php

namespace App\Http\Livewire;

use App\Models\EvidenciasTareasKanban;
use App\Models\TaskKanbanPA;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class EvidenciaTaskKanban extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $taskId;
    public $task;
    public $evidencia_textual;
    public $evidenciaFiles = [];
    protected $listeners = ['evidenciaTextualEvent'];
    public function mount($taskId)
    {
        $this->taskId = $taskId;
        $this->getTask();
        $this->evidencia_textual = $this->task->evidencia_textual;
    }

    public function evidenciaTextualEvent($data)
    {
        $this->evidencia_textual = $data;
    }

    public function getTask()
    {
        $this->task = TaskKanbanPA::with('evidencias')->find($this->taskId);
    }

    public function updatedEvidenciaFiles($archivos)
    {
        foreach ($archivos as $archivo) {
            $archivo->storeAs('public/planes-accion/kanban/tasks/' . $this->taskId, $archivo->getClientOriginalName());
            EvidenciasTareasKanban::create([
                'archivo' => $archivo->getClientOriginalName(),
                'extension' => pathinfo($archivo->getClientOriginalName(), PATHINFO_EXTENSION),
                'task_kanban_p_a_s_id' => $this->taskId
            ]);
        }
        $this->getTask();
    }

    public function save()
    {

        $this->task->update([
            'evidencia_textual' => $this->evidencia_textual
        ]);

        $this->alert('success', 'Evidencia almacenada con éxito', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->emit('cerrarModalEvidenciaTask', $this->taskId);
    }

    public function removeEvidencia($evidenciaId, $archivo)
    {
        EvidenciasTareasKanban::find($evidenciaId)->delete();
        if (Storage::exists('public/planes-accion/kanban/tasks/' . $this->taskId . '/' . $archivo)) {
            Storage::delete('public/planes-accion/kanban/tasks/' . $this->taskId . '/' . $archivo);
        }
        $this->alert('success', 'Evidencia eliminada con éxito', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->getTask();
    }

    public function abrirModalEvidenciaTarea($taskId)
    {
        $this->emit('abrirModalEvidencia', $taskId);
    }

    public function render()
    {
        return view('livewire.evidencia-task-kanban');
    }
}
