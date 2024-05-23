<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisponibilidadEmpleados extends Model
{
    use HasFactory;

    protected $table = 'disponibilidad_empleados';

    protected $fillable =
    [
        'empleado_id',
        'disponibilidad',
    ];

    protected $appends = ['estado'];

    const ACTIVO = '1';

    const AUSENTE = '2';

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }

    public function getEstadoAttribute()
    {
        switch ($this->disponibilidad) {
            case strval(DisponibilidadEmpleados::ACTIVO):
                return 'Activo';
                break;
            case strval(DisponibilidadEmpleados::AUSENTE):
                return 'Ausente';
                break;
        }
    }
}
