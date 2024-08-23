<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobadorFirmaPuestoHistorico extends Model
{
    use HasFactory;

    public $table = 'aprobadores_firma_puestos_historico';

    protected $fillable = [
        'puesto_id',
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

    public function puesto()
    {
        return $this->belongsTo(puesto::class, 'puesto_id');
    }
}
