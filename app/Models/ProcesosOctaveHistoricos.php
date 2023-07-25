<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesosOctaveHistoricos extends Model
{
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
