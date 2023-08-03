<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ContactosExternosPuestos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
