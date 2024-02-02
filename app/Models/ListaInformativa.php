<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaInformativa extends Model
{
    protected $table = 'lista_informativas';

    protected $fillable = [
        'modulo',
        'submodulo',
        'modelo',
    ];

    public function participantes()
    {
        return $this->hasMany(ParticipantesListaDistribucion::class, 'modulo_id', 'id');
    }
}
