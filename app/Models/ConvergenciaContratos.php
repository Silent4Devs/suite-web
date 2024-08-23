<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvergenciaContratos extends Model
{
    use HasFactory;

    protected $table = 'convergencia_contratos_proyectos_clientes';

    protected $fillable = [
        'contrato_id',
        'timesheet_proyecto_id',
        'timesheet_cliente_id',
    ];
}
