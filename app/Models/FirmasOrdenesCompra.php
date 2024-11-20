<?php

namespace App\Models;

use App\Models\ContractManager\Requsicion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmasOrdenesCompra extends Model
{
    use HasFactory;

    protected $table = 'firmas_requisiciones';

    protected $fillable = [
        'requisicion_id',
        'comprador_id',
        'firma_comprador',
        'fecha_firma_comprador_requi',
        'solicitante_id',
        'firma_solicitante',
        'fecha_firma_solicitante',
        'responsable_finanzas_id',
        'firma_responsable_finanzas',
        'fecha_firma_responsable_finanzas',
    ];

    public function requisicion()
    {
        return $this->belongsTo(Requsicion::class, 'requisicion_id', 'id');
    }

    public function comprador()
    {
        return $this->belongsTo(Empleado::class, 'comprador_id', 'id');
    }

    public function solicitante()
    {
        return $this->belongsTo(Empleado::class, 'solicitante_id', 'id');
    }

    public function responsableFinanzas()
    {
        return $this->belongsTo(Empleado::class, 'responsable_finanzas_id', 'id');
    }

    public function duplicados($id_empleado)
    {
        $columns = ['solicitante_id', 'jefe_id', 'responsable_finanzas_id', 'comprador_id'];
        $count = 0;

        foreach ($columns as $column) {
            if ($id_empleado == $this->$column) {
                $count++;
            }
        }

        return $count >= 2;
    }
}
