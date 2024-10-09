<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEdicionesOC extends Model
{
    use HasFactory;

    protected $table ="historial_ediciones_o_c_s";

    protected $fillable=
    [
        'requisicion_id', // ID del registro modificado
        'numero_edicion',
        'registro_tipo', // Tipo de modelo (por ejemplo, App\Models\Registro)
        'id_empleado', // ID del empleado que hizo el cambio
        'campo', // Campo modificado
        'valor_anterior', // Valor anterior
        'valor_nuevo', // Valor nuevo
    ];
}
