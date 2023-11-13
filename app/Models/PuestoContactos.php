<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PuestoContactos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
