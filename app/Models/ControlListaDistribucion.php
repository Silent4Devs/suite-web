<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlListaDistribucion extends Model
{
    use HasFactory;

    protected $table = 'control_lista_distribucions';

    protected $fillable = [
        'proceso_id',
        'participante_id',
        'estatus',
        'firma',
    ];

    public function proceso()
    {
        return $this->belongsTo(ProcesosListaDistribucion::class, 'proceso_id', 'id');
    }

    public function participante()
    {
        return $this->belongsTo(ParticipantesListaDistribucion::class, 'participante_id', 'id');
    }
}
