<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmasRequisiciones extends Model
{
    use HasFactory;

    protected $table = 'firmas_requisiciones';

    protected $fillable = [
        'solicitante_id',
        'firma_solicitante',
        'fecha_firma_solicitante',
        'jefe_id',
        'firma_jefe',
        'fecha_firma_jefe',
        'responsable_finanzas_id',
        'firma_responsable_finanzas',
        'fecha_firma_responsable_finanzas',
        'comprador_id',
        'firma_comprador',
        'fecha_firma_comprador_requi',
    ];

    public function solicitante()
    {
        return $this->belongsTo(Empleado::class, 'solicitante_id', 'id');
    }

    public function jefe()
    {
        return $this->belongsTo(Empleado::class, 'jefe_id', 'id');
    }

    public function responsableFinanzas()
    {
        return $this->belongsTo(Empleado::class, 'responsable_finanzas_id', 'id');
    }

    public function comprador()
    {
        return $this->belongsTo(Empleado::class, 'comprador_id', 'id');
    }
}
