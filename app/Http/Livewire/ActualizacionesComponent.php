<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Process\Process;
class ActualizacionesComponent extends Component
{

    public function RevisarActualizaciones()
    {
        // Get the base path of your Laravel project
        $basePath = base_path();

        // Set the working directory for the process
        $process = Process::fromShellCommandline('ls');
        $process->setWorkingDirectory($basePath); // Replace 'your_command' with the command you want to execute
        $process->run();

        // Check if the command executed successfully
        if ($process->isSuccessful()) {
            dd($process->getOutput());
        } else {
            dd($process->getErrorOutput());
        }
    }

    public function render()
    {
        return view('livewire.actualizaciones-component');
    }
}
