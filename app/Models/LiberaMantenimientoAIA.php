<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LiberaMantenimientoAIA extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'libera_mantenimiento_aia';

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
        return $this->belongsTo(AnalisisAIA::class, 'cuestionario_id', 'id');
    }
}
