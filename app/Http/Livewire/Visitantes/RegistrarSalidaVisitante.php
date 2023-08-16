<?php

namespace App\Http\Livewire\Visitantes;

use App\Mail\Visitantes\SolicitudSalidaVisitante;
use App\Models\Visitantes\RegistrarVisitante;
use App\Models\Visitantes\ResponsableVisitantes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RegistrarSalidaVisitante extends Component
{
    use LivewireAlert;

    public $visitante;

    public $firma;

    public $tipo;

    protected $listeners = ['registrarSalida'];

    // protected $rules = [
    //     'visitante' => 'nullable',
    //     'firma' => 'required'
    // ];

    public function mount(?RegistrarVisitante $visitante, $tipo = null)
    {
        $this->visitante = $visitante;
        $this->tipo = $tipo;
    }

    protected $messages = [
        'visitante.required' => 'Seleccione un visitante',
        'firma.required' => 'Ingrese la firma',
    ];

    public function render()
    {
        return view('livewire.visitantes.registrar-salida-visitante');
    }

    public function limpiarFirma()
    {
        $this->firma = null;
        $this->emit('limpiarFirma', $this->visitante->id);
    }

    public function registrarSalida()
    {
        $validateFirma = ResponsableVisitantes::first()->firma_requerida ? 'required' : 'nullable';
        $this->validate([
            'visitante' => 'nullable',
            'firma' => $validateFirma,
        ]);
        $registroVisitante = RegistrarVisitante::find($this->visitante->id);
        $registroVisitante->update([
            'fecha_salida' => Carbon::now(),
            'firma' => $this->firma,
            'registro_salida' => true,
        ]);
        $this->alert('success', 'Bien Hecho ' . $registroVisitante->nombre . ', has registrado tu salida correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->visitantes = RegistrarVisitante::where('registro_salida', false)->get();
        $responsable_model = ResponsableVisitantes::with('empleado')->first();
        $responsable = $responsable_model->empleado;
        Mail::to(removeUnicodeCharacters($responsable->email))->send(new SolicitudSalidaVisitante($registroVisitante, $responsable));
        $this->emitTo('visitantes.registrar-salida', 'salidaRegistrada', $this->visitante->id);
        if ($this->tipo == 'full') {
            $this->emit('salidaRegistradaSelf');
        }
        $this->emit('closeModal', $this->visitante);
    }
}
