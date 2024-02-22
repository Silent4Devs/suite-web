<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class ProcesosListaDistribucion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'procesos_lista_distribucions';

    protected $fillable = [
        'modulo_id',
        'estatus',
        'proceso_id',
    ];

    public function modulo()
    {
        return $this->belongsTo(ListaDistribucion::class, 'modulo_id', 'id');
    }

    public function participantes()
    {
        return $this->hasMany(ControlListaDistribucion::class, 'proceso_id', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany(ComentariosProcesosListaDistribucion::class, 'proceso_id', 'id');
    }
}
