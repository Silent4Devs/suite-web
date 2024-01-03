<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AceptarAlcance extends Model
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