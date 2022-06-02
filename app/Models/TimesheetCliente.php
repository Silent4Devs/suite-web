<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetCliente extends Model
{
    use HasFactory;

    protected $table = 'timesheet_clientes';

    protected $fillable = [
        'identificador',
        'razon_social',
        'nombre',
        'rfc',

        'calle',
        'colonia',
        'ciudad',
        'codigo_postal',
        'telefono',
        'pagina_web',

        'nombre_contacto',
        'puesto_contacto',
        'correo_contacto',
        'celular_contacto',
    ];

    public function cliente()
    {
        return $this->hasMany(QuejasCliente::class, 'cliente_id');
    }
}
