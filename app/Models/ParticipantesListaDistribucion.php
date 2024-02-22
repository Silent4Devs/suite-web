<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ParticipantesListaDistribucion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'participantes_lista_distribucions';

    protected $fillable = [
        'modulo_id',
        'nivel',
        'numero_orden',
        'empleado_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->select('id', 'name', 'foto', 'email', 'estatus');
    }

    public function control($id_proceso)
    {
        return ControlListaDistribucion::where('proceso_id', $id_proceso)
            ->where('participante_id', $this->id)
            ->first();
    }
}
