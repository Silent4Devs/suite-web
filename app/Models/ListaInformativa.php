<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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

    public static function getAll()
    {
        return Cache::remember('ListaInformativa:lista_informativa_all', 3600 * 6, function () {
            return self::with('participantes.empleado', 'usuarios.usuario')->orderByDesc('id')->get();
        });
    }
}
