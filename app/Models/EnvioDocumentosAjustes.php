<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioDocumentosAjustes extends Model
{
    use HasFactory;

    // public $cacheFor = 3600;
    // protected static $flushCacheOnUpdate = true;
    public $table = 'envio_documentos_ajustes';

    protected $fillable = [
        'id_coordinador',
        'id_mensajero',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function coordinador()
    {
        return $this->belongsTo(Empleado::class, 'id_coordinador')->alta();
    }

    public function mensajero()
    {
        return $this->belongsTo(Empleado::class, 'id_mensajero')->alta();
    }
}
