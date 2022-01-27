<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $table = 'timesheet';

    protected $fillable = [
        'fecha_semana',
        'fecha_dia',
        'aprobado',
        'empleado_id',
        'aprobador_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function aprobador()
    {
        return $this->belongsTo(Empleado::class, 'aprobador_id');
    }
}
