<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntendimientoOrganizacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'entendimiento_organizacions';
    protected $fillable = [
        'fortalezas',
        'oportunidades',
        'debilidades',
        'amenazas',
        'analisis',
        'fecha',
        'id_elabora',

    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_elabora', 'id');
    }
}
