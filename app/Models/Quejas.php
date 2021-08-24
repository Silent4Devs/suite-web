<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quejas extends Model
{
    use HasFactory;

    protected $table='quejas';
 
    protected $guarded=[
        'id'
    ];

    protected $appends = ['folio'];

    public function getFolioAttribute(){
        return  sprintf('QUE-%04d', $this->id);
    }

    public function quejo(){
        return $this->belongsTo(Empleado::class, 'empleado_quejo_id', 'id');
    }

    public function evidencias_quejas(){
        return $this->hasMany(EvidenciasQueja::class, 'id_quejas');
    }
}
