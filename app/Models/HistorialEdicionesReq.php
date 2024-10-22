<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEdicionesReq extends Model
{
    use HasFactory;

    protected $table = 'historial_ediciones_req';

    protected $fillable =
    [
        'requisicion_id', // ID del registro modificado
        'registro_tipo', // Tipo de modelo (por ejemplo, App\Models\Registro)
        'id_empleado', // ID del empleado que hizo el cambio
        'campo', // Campo modificado
        'valor_anterior', // Valor anterior
        'valor_nuevo', // Valor nuevo
        'version_id',
    ];

    // Otras relaciones

    public function version()
    {
        return $this->belongsTo(VersionesRequisiciones::class, 'version_id'); // Asegúrate de que 'version_id' sea la clave foránea correcta
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado')->select('id', 'name'); // Asegúrate de que 'version_id' sea la clave foránea correcta
    }
}
