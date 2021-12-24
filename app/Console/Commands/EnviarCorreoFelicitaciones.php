<?php

namespace App\Console\Commands;

use App\Models\Empleado;
use Illuminate\Console\Command;
use App\Mail\FelicitacionesMail;
use Illuminate\Support\Facades\Mail;

class EnviarCorreoFelicitaciones extends Command
{
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
        
        $empleados = Empleado::get();

        foreach($empleados as $empleado){
            Mail::to($empleado->email)->send(new FelicitacionesMail);
        }
    }
}
