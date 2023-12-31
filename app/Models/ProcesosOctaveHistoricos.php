<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProcesosOctaveHistoricos extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'procesos_octave_historicos';

    protected $fillable = [
        'proceso_id',
        'matriz_id',
        'historico',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public function matriz()
    {
        return $this->belongsTo(AnalisisDeRiesgo::class, 'proceso_id', 'id');
    }

    public function proceso()
    {
        return $this->belongsTo(MatrizOctaveProceso::class, 'matriz_id', 'id');
    }
}
