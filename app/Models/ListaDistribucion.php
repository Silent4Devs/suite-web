<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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

    public static function getAll()
    {
        return Cache::remember('ListaDistribucion:lista_distribucion_all', 3600 * 6, function () {
            return self::with('participantes.empleado')->orderByDesc('id')->get();
        });
    }
}
