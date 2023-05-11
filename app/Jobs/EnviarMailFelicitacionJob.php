<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\FelicitacionesMail;
use App\Models\Empleado;
use Carbon\Carbon;

class EnviarMailFelicitacionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $nombre, $correodestinatario, $cumplehoy;

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
        $cumplehoy = Carbon::now();
        $cumplehoy->toDateString();
        // dd($cumplehoy);
        $cumpleañeros = Empleado::alta()
        ->whereMonth('cumpleaños', '=', $cumplehoy->format('m'))
        ->whereDay('cumpleaños', '=', $cumplehoy->format('d'))
        ->get();

        $imgtab = public_path("img\icono_tabantaj.png");
        $imgpastel = public_path('img\Pastel.png');

        if($cumpleañeros != null){
            foreach($cumpleañeros as $cumpleañero)
            {
                $nombre = $cumpleañero->name;
                $correodestinatario = $cumpleañero->email;

                $email = new FelicitacionesMail($nombre, $correodestinatario, $imgpastel, $imgtab);
                Mail::to($correodestinatario)->send($email);
                // Mail::to('victor.rodriguez@becarios.silent4business.com')->send($email);
                // echo $nombre.'<br>';
                // echo $correodestinatario.'<br>';
            }
        }
        //
    }
}
