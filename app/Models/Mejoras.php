<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mejoras extends Model
{
    use HasFactory;

    protected $table='mejoras';
 
    protected $guarded=[
        'id'
    ];

    public function mejoro(){
        return $this->belongsTo(Empleado::class, 'empleado_mejoro_id', 'id');
    }
}
