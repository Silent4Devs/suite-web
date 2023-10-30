<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactosExternosPuestos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
