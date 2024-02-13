<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantesListaInformativa extends Model
{
    use HasFactory;

    protected $table = 'participantes_lista_informativas';

    protected $fillable = [
        'modulo_id',
        'empleado_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->select('id', 'name', 'foto', 'email', 'estatus');
    }
}
