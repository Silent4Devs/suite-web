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

    protected $appends = ['folio'];

    public function getFolioAttribute(){
        return  sprintf('RSG-%04d', $this->id);
    }

    public function reporto(){
        return $this->belongsTo(Empleado::class, 'empleado_reporto_id', 'id');
    }
}
