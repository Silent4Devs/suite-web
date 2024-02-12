<?php

namespace App\Jobs;

use App\Mail\FelicitacionesMail;
use App\Models\CorreoCumpleanos;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarMailFelicitacionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $nombre;

    protected $correodestinatario;

    protected $cumplehoy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->nombre = $nombre;
        // $this->correodestinatario = $correodestinatario;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cumplehoy = Carbon::today();
        $cumplehoy->toDateString();
        // dd($cumplehoy);
        $cumpleañeros = Empleado::alta()
            ->whereMonth('cumpleaños', '=', $cumplehoy->format('m'))
            ->whereDay('cumpleaños', '=', $cumplehoy->format('d'))
            ->get();

        $imgtab = public_path("img\icono_tabantaj.png");
        $imgpastel = public_path('img\pastel.png');

        if ($cumpleañeros != null) {
            foreach ($cumpleañeros as $cumpleañero) {
                $filtro = CorreoCumpleanos::where('empleado_id', $cumpleañero->id)
                    ->whereDate('fecha_envio', '=', $cumpleañero->cumpleaños);
                if ($filtro->exists() == false) {
                    // dd("Si aparece");
                    $empcump = CorreoCumpleanos::firstOrCreate([
                        'empleado_id' => $cumpleañero->id,
                        'fecha_envio' => $cumpleañero->cumpleaños,
                        'enviado' => false,
                    ]);
                    // dd("Si crea el registro");
                    $nombre = $cumpleañero->name;
                    $correodestinatario = $cumpleañero->email;

                    $email = new FelicitacionesMail($nombre, $correodestinatario, $imgpastel, $imgtab);
                    Mail::to(removeUnicodeCharacters($correodestinatario))->queue($email);
                    // dd('Si manda el correo');
                    $empcump->update([
                        'enviado' => true,
                    ]);
                } else {
                    //No hace nada
                }
            }
        }
    }
}
