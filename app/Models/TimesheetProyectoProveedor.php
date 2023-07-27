<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TimesheetProyectoProveedor extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'timesheet_proyectos_proveedores';

    protected $fillable = [
        'proyecto_id',
        'proveedor_tercero',
        'horas_tercero',
        'costo_tercero',
    ];

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id');
    }
}
