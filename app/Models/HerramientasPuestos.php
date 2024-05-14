<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HerramientasPuestos extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'herramientas_puesto';

    protected $fillable = [
        'nombre_herramienta',
        'descripcion_herramienta',
        'puesto_id',
    ];

    public function puesto()
    {
        return $this->hasMany('App\Model\Puesto');
    }
}
