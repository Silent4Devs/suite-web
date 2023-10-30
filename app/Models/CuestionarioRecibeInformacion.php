<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CuestionarioRecibeInformacion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'cuestionario_recibe_informacion';

    public $fillable = [
        'id',
        'nombre',
        'puesto',
        'correo_electronico',
        'extencion',
        'ubicacion',
        'cuestionario_id',
        'interno_externo',
    ];

    public function cuestionario()
    {
        return $this->belongsTo(AnalisisImpacto::class, 'cuestionario_id', 'id');
    }
}
