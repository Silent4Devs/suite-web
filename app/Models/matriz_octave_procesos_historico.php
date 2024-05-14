<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class matriz_octave_procesos_historico extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'matriz_octave_procesos';

    protected $casts = [
        'id_proceso' => 'int',
        'nivel_riesgo' => 'int',
        'id_direccion' => 'int',
        'servicio_id' => 'int',
        'operacional' => 'int',
        'cumplimiento' => 'int',
        'legal' => 'int',
        'reputacional' => 'int',
        'tecnologico' => 'int',
        'impacto' => 'int',
        'id_activos_informacion' => 'int',
        'promedio' => 'int',
    ];

    protected $fillable = [
        'id_proceso',
        'nivel_riesgo',
        'id_direccion',
        'servicio_id',
        'operacional',
        'cumplimiento',
        'legal',
        'reputacional',
        'tecnologico',
        'impacto',
        'id_activos_informacion',
        'promedio',
        'fecha_registro',
        'matriz_id',
    ];

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function children()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso')->with('children');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_direccion', 'id');
    }

    public function servicio()
    {
        return $this->belongsTo(MatrizOctaveServicio::class, 'servicio_id', 'id');
    }

    public function activos_informacion()
    {
        return $this->hasMany(ActivosInformacion::class, 'id_activos_informacion', 'id');
    }
}
