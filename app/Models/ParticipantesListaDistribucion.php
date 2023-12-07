<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantesListaDistribucion extends Model
{
    use HasFactory;

    protected $table = "participantes_lista_distribucions";

    protected $fillable = [
        'modulo_id',
        'nivel',
        'numero_orden',
        'empleado_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->select('id', 'name', 'foto');
    }

    public function estatus()
    {
        return $this->hasOne(ControlListaDistribucion::class);
    }
}
