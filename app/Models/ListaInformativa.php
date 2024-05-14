<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ListaInformativa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

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
