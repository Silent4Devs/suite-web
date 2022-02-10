<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactosExternosPuestos extends Model
{
    use HasFactory;

    protected $table = 'puestos_contactos_externos';

    protected $fillable = [

        'nombre_contacto_int',
        'puesto_id',
        'proposito',
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }
}
