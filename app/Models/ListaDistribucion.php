<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ListaDistribucion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'lista_distribucions';

    protected $fillable = [
        'modulo',
        'submodulo',
        'modelo',
        'niveles',
        'superaprobador',
    ];

    public function proceso()
    {
        return $this->hasOne(ProcesosListaDistribucion::class, 'modulo_id', 'id');
    }

    public function participantes()
    {
        return $this->hasMany(ParticipantesListaDistribucion::class, 'modulo_id', 'id');
    }
}
