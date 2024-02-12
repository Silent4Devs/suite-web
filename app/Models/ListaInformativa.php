<?php

namespace App\Models;

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
        return $this->hasMany(ParticipantesListaInformativa::class, 'modulo_id', 'id');
    }

    public function usuarios()
    {
        return $this->hasMany(UsuariosListaInformativa::class, 'modulo_id', 'id');
    }
}
