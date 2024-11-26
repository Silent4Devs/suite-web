<?php

namespace App\Livewire\Escuela\Instructor;

use Livewire\Component;

class CourseCertificaciones extends Component
{
    public $course;

    public $habilitar_certificado;

    public function updatedHabilitarCertificado($value)
    {
        $this->habilitar_certificado = $value;
        $this->course->update([
            'certificado' => $value ? 1 : 0,
        ]);
    }

    public function mount($course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.escuela.instructor.course-certificaciones');
    }

    public function addFirma($data)
    {

        $this->course->update([
            'firma_instructor' => $data['firma_instructor'],
        ]);
    }

    public function selectCert($cert)
    {
        $this->course->update([
            'certificado' => $cert,
        ]);
    }

    public function habilitarFirma() {
        $this->course->update([
            'firma_habilitar' => !($this->course->firma_habilitar),
        ]);
    }
}
