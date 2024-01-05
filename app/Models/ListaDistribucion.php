<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaDistribucion extends Model
{
    use HasFactory;

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
