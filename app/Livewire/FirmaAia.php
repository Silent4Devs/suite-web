<?php

namespace App\Livewire;

use App\Models\AnalisisAIA;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FirmaAia extends Component
{
    public $signature;

    public $cuestionario_id;

    public $firmante;

    public function mount($cuestionario_id, $firmante)
    {
        $this->cuestionario_id = $cuestionario_id;
        $this->firmante = $firmante;
    }

    public function submitSignatureEntrevistado()
    {
        $base64_image = $this->signature;
        $data = substr($base64_image, strpos($base64_image, ',') + 1);
        $data = base64_decode($data);
        $URL_signature = 'AIA/signatures/'.$this->cuestionario_id.'/signature_'.$this->firmante.'.png';
        $analisis_impacto = AnalisisAIA::find($this->cuestionario_id);
        $analisis_impacto->update([
            'firma_'.$this->firmante => $URL_signature,
            'exite_firma_'.$this->firmante => true,
        ]);
        Storage::put('/public/'.$URL_signature, $data);
    }

    public function render()
    {
        return view('livewire.firma-aia');
    }
}
