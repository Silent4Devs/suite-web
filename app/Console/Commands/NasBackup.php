<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TransferFile extends Command
{
    protected $signature = 'transfer:file';
    protected $description = 'Transfer new files to FTP server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Verificar si la transferencia de archivos está habilitada
        if (env('ENABLE_FILE_TRANSFER', false)) {
            $localDirectory = storage_path('snapshots'); // Ruta a la carpeta local
            $remoteDirectory = env('NAS_DIRECTORY'); // Ruta a la carpeta remota en el servidor FTP

            // Obtener todos los archivos en la carpeta local
            $files = Storage::disk('snapshots')->files($localDirectory);

            foreach ($files as $file) {
                $fileName = basename($file);
                $remoteFilePath = $remoteDirectory . '/' . $fileName;

                // Verificar si el archivo ya existe en el servidor FTP
                if (!Storage::disk('ftp')->exists($remoteFilePath)) {
                    // Leer el contenido del archivo
                    $fileContent = Storage::disk('snapshots')->get($file);

                    // Subir el archivo al servidor FTP
                    Storage::disk('ftp')->put($remoteFilePath, $fileContent);

                    $this->info("File '{$fileName}' transferred successfully!");
                } else {
                    $this->info("File '{$fileName}' already exists on the FTP server.");
                }
            }
        } else {
            $this->info('File transfer is disabled.');
        }
    }
}
