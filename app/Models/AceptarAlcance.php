<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class AceptarAlcance extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'aceptar_alcances';

    protected $fillable = [
        'id_empleado',
        'id_alcance',
        'acepto',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function aceptador()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado')->alta();
    }

    public function alcance()
    {
        return $this->belongsTo(AlcanceSgsi::class, 'id_alcance');
    }
}
