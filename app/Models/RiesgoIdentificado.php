<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiesgoIdentificado extends Model
{
    use HasFactory;

    protected $table='riesgos_identificados';
    
    protected $dates=[
        'fecha'
    ];

    protected $guarded=[
        'id'
    ];

    public function reporto(){
        return $this->belongsTo(Empleado::class, 'empleado_reporto_id', 'id');
    }
}
