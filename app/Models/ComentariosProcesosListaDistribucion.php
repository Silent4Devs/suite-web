<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosProcesosListaDistribucion extends Model
{
    use HasFactory;

    protected $table = 'comentarios_procesos_lista_distribucions';

    protected $fillable = [
        'comentario',
        'proceso_id',
    ];

    public function proceso()
    {
        return $this->belongsTo(ProcesosListaDistribucion::class, 'proceso_id', 'id');
    }
}
