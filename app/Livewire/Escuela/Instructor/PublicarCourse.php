<?php

namespace App\Livewire\Escuela\Instructor;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PublicarCourse extends Component
{
    use LivewireAlert;

    public $course;

    public $status_id = '';

    public function mount($course)
    {
        $this->course = $course;
    }

    public function updatedStatusId($statusId)
    {
        $this->course->status = $statusId;
        $this->course->save();
        $this->render_alerta('success', 'Estatus actualizado exitosamente');
    }

    public function render()
    {
        if ($this->course) {
            $this->status_id = $this->course->status;
        }

        return view('livewire.escuela.instructor.publicar-course');
    }

    public function render_alerta($type, $message)
    {
        $this->alert($type, $message, [
            'position' => 'top-end',
            'timer' => '4000',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }
}
