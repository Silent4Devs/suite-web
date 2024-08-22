<?php

namespace App\Models;

use App\Models\ContractManager\Contrato;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobadorFirmaContratoHistorico extends Model
{
    use HasFactory;

    public $table = 'aprobadores_firma_contratos_historico';

    protected $fillable = [
        'contrato_id',
        'solicitante_id',
        'firma_check',
        'empleado_update_id',
    ];

    public function solicitante()
    {
        return $this->belongsTo(Empleado::class, 'solicitante_id');
    }

    public function empleado_update()
    {
        return $this->belongsTo(Empleado::class, 'empleado_update_id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }
}
