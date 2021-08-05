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

    public function quejo(){
        return $this->belongsTo(Empleado::class, 'empleado_quejo_id', 'id');
    }
}
