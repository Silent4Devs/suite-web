<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobadorFirmaPuesto extends Model
{
    use HasFactory;

    public $table = 'aprobadores_firma_puestos';

    protected $fillable = [
        'puesto_id',
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

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id');
    }

    public function getFirmaRutaAttribute()
    {
        $ruta = asset('storage/puestos/firmasAprobadores/'.$this->firma);

        return $ruta;
    }
}
