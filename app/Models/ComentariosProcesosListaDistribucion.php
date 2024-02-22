<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class ComentariosProcesosListaDistribucion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
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
