<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlertasControlDocumentoComponent extends Component
{
    public $show_success_alert;

    public $message_success;

    public $show_error_alert;

    public $message_error;

    protected $listeners = [
        'showSuccessAlert',
        'showErrorAlert',
    ];

    public function mount()
    {
        $this->show_success_alert = false;
        $this->message_success = '';
        $this->show_error_alert = false;
        $this->message_error = '';
    }

    public function render()
    {
        return view('livewire.alertas-control-documento-component');
    }

    public function showSuccessAlert($mensaje)
    {
        $this->message_error = '';
        $this->message_success = $mensaje;
        $this->show_error_alert = false;
        $this->show_success_alert = true;
    }

    public function showErrorAlert($mensaje)
    {
        $this->message_success = '';
        $this->message_error = $mensaje;
        $this->show_success_alert = false;
        $this->show_error_alert = true;
    }
}
