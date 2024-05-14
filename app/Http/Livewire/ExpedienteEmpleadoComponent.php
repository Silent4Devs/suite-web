<?php

namespace App\Http\Livewire;

use App\Models\EvidenciasDocumentosEmpleados;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpedienteEmpleadoComponent extends Component
{
    use WithFileUploads;

    public $empleado;

    public $documentoIne;

    public $documentoImss;

    public $documentoCurp;

    public $documentoRfc;

    public $documentosExistentes;

    public function updatedDocumentoIne()
    {
        $this->validate([
            'documentoIne' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1000000', // 1GB Max
        ]);
        $extension = $this->documentoIne->extension();
        $this->documentoIne->storeAs('public/expedientes/'.Str::slug($this->empleado->name).'/', "INE.{$extension}");
        EvidenciasDocumentosEmpleados::create([
            'nombre' => 'INE',
            'documentos' => "INE.{$extension}",
            'empleado_id' => $this->empleado->id,
        ]);
    }

    public function updatedDocumentoImss()
    {
        $this->validate([
            'documentoImss' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1000000', // 1GB Max
        ]);
        $extension = $this->documentoImss->extension();
        $nombre_documento = 'IMSS';
        $this->documentoImss->storeAs('public/expedientes/'.Str::slug($this->empleado->name).'/', "{$nombre_documento}.{$extension}");
        EvidenciasDocumentosEmpleados::create([
            'nombre' => $nombre_documento,
            'documentos' => "{$nombre_documento}.{$extension}",
            'empleado_id' => $this->empleado->id,
        ]);
    }

    public function updatedDocumentoCurp()
    {
        $this->validate([
            'documentoCurp' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1000000', // 1GB Max
        ]);
        $extension = $this->documentoCurp->extension();
        $nombre_documento = 'CURP';
        $this->documentoCurp->storeAs('public/expedientes/'.Str::slug($this->empleado->name).'/', "{$nombre_documento}.{$extension}");
        EvidenciasDocumentosEmpleados::create([
            'nombre' => $nombre_documento,
            'documentos' => "{$nombre_documento}.{$extension}",
            'empleado_id' => $this->empleado->id,
        ]);
    }

    public function updatedDocumentoRFC()
    {
        $this->validate([
            'documentoRfc' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1000000', // 1GB Max
        ]);
        $extension = $this->documentoRfc->extension();
        $nombre_documento = 'RFC';
        $this->documentoRfc->storeAs('public/expedientes/'.Str::slug($this->empleado->name).'/', "{$nombre_documento}.{$extension}");
        EvidenciasDocumentosEmpleados::create([
            'nombre' => $nombre_documento,
            'documentos' => "{$nombre_documento}.{$extension}",
            'empleado_id' => $this->empleado->id,
        ]);
    }

    public function mount()
    {
        $this->documentosExistentes = $this->empleado->empleado_documentos->pluck('nombre')->toArray();
    }

    private function checkIfDocumentExists()
    {
        if (EvidenciasDocumentosEmpleados::where('empleado_id', $this->empleado->id)->where('nombre', 'INE')->exists()) {
            $this->documentoIne = EvidenciasDocumentosEmpleados::where('empleado_id', $this->empleado->id)->where('nombre', 'INE')->first();
        } else {
            $this->documentoIne = null;
        }

        if (EvidenciasDocumentosEmpleados::where('empleado_id', $this->empleado->id)->where('nombre', 'IMSS')->exists()) {
            $this->documentoImss = EvidenciasDocumentosEmpleados::where('empleado_id', $this->empleado->id)->where('nombre', 'IMSS')->first();
        } else {
            $this->documentoImss = null;
        }
        if (EvidenciasDocumentosEmpleados::where('empleado_id', $this->empleado->id)->where('nombre', 'CURP')->exists()) {
            $this->documentoCurp = EvidenciasDocumentosEmpleados::where('empleado_id', $this->empleado->id)->where('nombre', 'CURP')->first();
        } else {
            $this->documentoCurp = null;
        }
        if (EvidenciasDocumentosEmpleados::where('empleado_id', $this->empleado->id)->where('nombre', 'RFC')->exists()) {
            $this->documentoRfc = EvidenciasDocumentosEmpleados::where('empleado_id', $this->empleado->id)->where('nombre', 'RFC')->first();
        } else {
            $this->documentoRfc = null;
        }
    }

    public function removeDocumento($documento_id)
    {
        $evidencia = EvidenciasDocumentosEmpleados::find($documento_id);
        Storage::disk('public')->delete('expedientes/'.Str::slug($this->empleado->name).'/'.$evidencia->documentos);
        $evidencia->delete();
        $this->checkIfDocumentExists();
    }

    public function render()
    {
        $this->checkIfDocumentExists();

        return view('livewire.expediente-empleado-component', [
            'empleado' => $this->empleado,
        ]);
    }
}
