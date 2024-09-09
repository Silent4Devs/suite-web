<?php

namespace App\Models;

use App\Models\ContractManager\Contrato;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobadorFirmaContrato extends Model
{
    use HasFactory;

    public $table = 'aprobadores_firma_contratos';

    protected $fillable = [
        'contrato_id',
        'aprobador_id',
        'solicitante_id',
        'firma',
    ];

    public function aprobador()
    {
        return $this->belongsTo(Empleado::class, 'aprobador_id');
    }

    public function solicitante()
    {
        return $this->belongsTo(Empleado::class, 'solicitante_id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    public function getFirmaRutaAttribute()
    {
        $ruta = asset('storage/contratos/'.$this->contrato->id.'_contrato_'.$this->contrato->no_contrato.'/aprobacionFirma/'.$this->firma);

        return $ruta;
    }
}
