<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnvioDocumentosAjustes extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'envio_documentos_ajustes';

    protected $fillable = [
        'id_coordinador',
        'id_mensajero',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    //Redis methods
    public static function getFirstWithCoordinadorMensajero()
    {
        return Cache::remember('EnvioDocumentosAjustes:EnviodocumentosAjustes_with_coordinador_mensajero', 3600 * 7, function () {
            return self::with(['coordinador', 'mensajero'])->first();
        });
    }

    public function coordinador()
    {
        return $this->belongsTo(Empleado::class, 'id_coordinador')->alta();
    }

    public function mensajero()
    {
        return $this->belongsTo(Empleado::class, 'id_mensajero')->alta();
    }
}
