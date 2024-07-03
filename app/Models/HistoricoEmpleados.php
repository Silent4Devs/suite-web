<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoEmpleados extends Model
{
    use HasFactory;

    protected $table = 'historico_empleados';

    protected $appends = ['relacion'];

    protected $fillable = [
        'empleado_id',
        'campo_modificado',
        'fecha_cambio',
        'valor_anterior_id',
        'tabla_origen',
        'user_id',
    ];

    public function empleadoHistorico()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }

    public function areaHistorico($id)
    {
        $area = Area::withTrashed()->find($id);

        return [
            'area' => $area,
        ];
    }

    public function puestoHistorico($id)
    {
        $puesto = Puesto::withTrashed()->find($id);

        return ['puesto' => $puesto];
    }

    public function getRelacionAttribute()
    {
        switch ($this->tabla_origen) {
            case 'areas':
                return $this->areaHistorico($this->valor_anterior_id);
            case 'puestos':
                return $this->puestoHistorico($this->valor_anterior_id);
                // Agrega más casos según sea necesario para otras tablas
            default:
                return null; // Manejar casos no reconocidos o agregar lógica personalizada
        }
    }
}
