<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Exception;

class TransferFile extends Command
{
    protected $signature = 'transfer:file';
    protected $description = 'Transfer new files to FTP server';

    protected $maxRetries = 6; // Maximum number of retries for each file

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Verificar si la transferencia de archivos está habilitada
        if (env('ENABLE_NAS_TRANSFER', false)) {
            $localDirectory = storage_path('snapshots'); // Ruta a la carpeta local
            $remoteDirectory = env('NAS_DIRECTORY'); // Ruta a la carpeta remota en el servidor FTP

            // Obtener todos los archivos en la carpeta local, incluyendo subdirectorios
            $files = Storage::disk('snapshots')->allFiles();
            $this->info('Local Directory: ' . $localDirectory);
            $this->info('Remote Directory: ' . $remoteDirectory);
            $this->info('Files to be transferred: ' . json_encode($files));

            foreach ($files as $file) {
                $fileName = basename($file);
                $remoteFilePath = $remoteDirectory . '/' . $file;
                $this->info("Processing file: '{$file}'");

                // Verificar si el archivo ya existe en el servidor FTP
                if (!Storage::disk('ftp')->exists($remoteFilePath)) {
                    $this->transferFile($file, $remoteFilePath, $fileName);
                } else {
                    $this->info("File '{$fileName}' already exists on the FTP server.");
                }
            }
        } else {
            $this->info('File transfer is disabled.');
        }
    }

    protected function transferFile($localFilePath, $remoteFilePath, $fileName)
    {
        $attempts = 0;

        while ($attempts < $this->maxRetries) {
            try {
                $fileContent = Storage::disk('snapshots')->get($localFilePath);

                // Crear directorios en el servidor FTP si no existen
                $remoteDirectoryPath = dirname($remoteFilePath);
                if (!Storage::disk('ftp')->exists($remoteDirectoryPath)) {
                    Storage::disk('ftp')->makeDirectory($remoteDirectoryPath, 0755, true, true);
                }

                // Subir el archivo al servidor FTP
                Storage::disk('ftp')->put($remoteFilePath, $fileContent);

                $this->info("File '{$fileName}' transferred successfully!");
                break; // Exit the loop if the transfer is successful

            } catch (Exception $e) {
                $attempts++;
                $this->error("Failed to transfer file '{$fileName}' (attempt {$attempts}): " . $e->getMessage());

                if ($attempts >= $this->maxRetries) {
                    $this->error("Max retries reached for file '{$fileName}'. Skipping.");
                } else {
                    $this->info("Retrying transfer for file '{$fileName}'...");
                    sleep(2); // Wait for a few seconds before retrying
                }
            }
        }
    }
}
