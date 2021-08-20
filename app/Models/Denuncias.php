<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncias extends Model
{
    use HasFactory;

    protected $table='denuncias';
 
    protected $guarded=[
        'id'
    ];

    protected $appends = ['folio'];

    public function getFolioAttribute(){
        return  sprintf('DEN-%04d', $this->id);
    }

    public function denuncio(){
        return $this->belongsTo(Empleado::class, 'empleado_denuncio_id', 'id');
    }

    public function denunciado(){
        return $this->belongsTo(Empleado::class, 'empleado_denunciado_id', 'id');
    }
}
