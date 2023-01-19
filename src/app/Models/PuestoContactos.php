<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestoContactos extends Model
{
    use HasFactory;

    protected $table = 'puestos_contactos';

    protected $fillable = [

        'descripcion_contacto',
        'puesto_id',
        'id_contacto',
        'contacto_puesto_id',
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'id_contacto', 'id')->alta()->with('puesto', 'area');
    }
}
