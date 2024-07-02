<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmaModule extends Model
{
    use HasFactory;

    protected $table = 'firma_modules';
    protected $fillable = ['modulo_id', 'submodulo_id', 'participantes', 'aprobadores'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function submodulo()
    {
        return $this->belongsTo(Submodulo::class, 'submodulo_id');
    }

    public function participantes()
    {
        return $this->belongsToMany(Empleado::class);
    }

    public function getAprobadoresAttribute()
    {
        $empleados_array = str_replace('[','', $this->participantes);
        $empleados_array = str_replace(']','', $empleados_array);
        $empleados_array = str_replace('"','', $empleados_array);
        $empleados_array = explode(',', $empleados_array);

        $aprobadores = collect();
        foreach ($empleados_array as $empleado_id) {
            $empleado = Empleado::find($empleado_id);
            $aprobadores->push($empleado);
        }

        return $aprobadores;
    }
}
