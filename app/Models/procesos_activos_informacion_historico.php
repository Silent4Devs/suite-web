<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class procesos_activos_informacion_historico extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'procesos_activos_informacion_historicos';

    protected $casts = [
        'losprocesos_id' => 'int',
        'id_activos_informacion' => 'int',
    ];

    protected $fillable = [
        'losprocesos_id',
        'id_activos_informacion',
    ];

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'losprocesos_id');
    }

    public function activos_informacion()
    {
        return $this->belongsTo(ActivosInformacion::class, 'id_activos_informacion');
    }
}
