<?php

namespace App\Jobs;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\MatrizRequisitosNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class MatrizRequisitosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $matriz;

    protected $tipo_consulta;

    protected $tabla;

    protected $slug;

    public function __construct($matriz, $tipo_consulta, $tabla, $slug)
    {
        $this->matriz = $matriz;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $lista = ListaDistribucion::with('participantes')->where('modelo', 'MatrizRequisitoLegale')->first();

        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            Notification::send($user, new MatrizRequisitosNotification($this->matriz, $this->tipo_consulta, $this->tabla, $this->slug));
        }
    }
}
