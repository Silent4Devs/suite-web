<?php

namespace App\Console\Commands;

use App\Mail\FelicitacionesMail;
use App\Models\CorreoCumpleanos;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarCorreoFelicitaciones extends Command
{
    protected $nombre;
    protected $correodestinatario;
    protected $cumplehoy;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:felicitaciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Felicitar empleados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cumplehoy = Carbon::today();
        $cumplehoy->toDateString();
        // dd($cumplehoy);
        $cumpleañeros = Empleado::getaltaAll()
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
                    Mail::to($correodestinatario)->send($email);
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
