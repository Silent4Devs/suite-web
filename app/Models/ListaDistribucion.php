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
        'niveles',
        'superaprobador',
    ];

    public function participantes()
    {
        return $this->hasMany(ParticipantesListaDistribucion::class, 'modulo_id', 'id');
    }
}
