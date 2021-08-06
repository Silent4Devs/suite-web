<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugerencias extends Model
{
    use HasFactory;

    protected $table='sugerencias';
 
    protected $guarded=[
        'id'
    ];

    public function sugerir(){
        return $this->belongsTo(Empleado::class, 'empleado_sugerir_id', 'id');
    }
}
