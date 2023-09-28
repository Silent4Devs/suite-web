<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TimesheetCliente extends Model
    // implements Auditable
{
    use HasFactory;
    // use \OwenIt\Auditing\Auditable;

    protected $table = 'timesheet_clientes';

    public $incrementing = false;

    protected $fillable = [
        'identificador',
        'razon_social',
        'nombre',
        'rfc',
        'id_old',

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

        // 'objeto_descripcion',
        // 'cobertura',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('timesheetcliente_all', 3600 * 24, function () {
            return self::get();
        });
    }

    public function cliente()
    {
        return $this->hasMany(QuejasCliente::class, 'cliente_id');
    }
}
