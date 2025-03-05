<?php

namespace App\Livewire\Visitantes;

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

    public $visitantes;

    public $firma;

    public $tipo;

    protected $listeners = ['registrarSalida', 'openModal'];

    protected $rules = [
        'visitante' => 'nullable',
        'firma' => 'required'
    ];

    public function mount($visitanteId, $tipo = null)
    {
        // Cargar el visitante desde la base de datos usando el ID
        $this->visitante = RegistrarVisitante::find($visitanteId);

        if (!$this->visitante) {
            // Manejar el caso en que el visitante no existe
            session()->flash('error', 'Visitante no encontrado.');
            return;
        }

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
    // public function openModal($visitanteId)
    // {
    //     $this->visitante = RegistrarVisitante::find($visitanteId);

    //     if ($this->visitante) {

    //         $this->dispatch('openModal', ['visitanteId' => $this->visitante->id]);
    //     }
    // }

    public function limpiarFirma()
    {
        $this->firma = null;
        $this->dispatch('limpiarFirma', visitante: $this->visitante->id);
    }
    // public function closeModal()
    // {
    //     if ($this->visitante) {
    //         $visitanteId = $this->visitante->id; // Guarda el ID antes de limpiar
    //         $this->visitante = null;
    //         $this->dispatch('closeModal', ['id' => $visitanteId]); // ✅ Enviamos el ID
    //     } else {
    //         $this->dispatch('closeModal', ['id' => null]); // Para manejar errores
    //         }
    //     }

    public function registrarSalida()
    {
        $validateFirma = ResponsableVisitantes::first()->firma_requerida ? 'required' : 'nullable';

        // Validación (puedes habilitar si es necesario)
        // $this->validate([
        //     'visitante' => 'nullable',
        //     'firma' => $validateFirma,
        // ]);

        // Buscar y actualizar el registro del visitante
        $registroVisitante = RegistrarVisitante::find($this->visitante->id);
        if (!$registroVisitante) {
            $this->alert('error', 'No se encontró el visitante', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        $registroVisitante->update([
            'fecha_salida' => Carbon::now(),
            'firma' => $this->firma,
            'registro_salida' => true,
        ]);

        // Mostrar mensaje de éxito
        $this->alert('success', 'Bien Hecho ' . $registroVisitante->nombre . ', has registrado tu salida correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);

        // Actualizar la lista de visitantes que no han registrado su salida
        $this->visitantes = RegistrarVisitante::where('registro_salida', false)->get();

        // Envío de correo (opcional, comentado)
        // $responsable_model = ResponsableVisitantes::with('empleado')->first();
        // $responsable = $responsable_model->empleado;
        // Mail::to(removeUnicodeCharacters($responsable->email))->queue(new SolicitudSalidaVisitante($registroVisitante, $responsable));

        // Disparar eventos de Livewire
        $this->dispatch('salidaRegistrada', ['id' => $this->visitante->id])->to('visitantes.registrar-salida');

        if ($this->tipo == 'full') {
            $this->dispatch('salidaRegistradaSelf');
        }

        // Cerrar modal después de registrar la salida
        $this->dispatch('closeModal', $this->visitante->id);

        return redirect()->route('visitantes.presentacion');
    }
}
