<?php

namespace App\Models;

use App\Models\ContractManager\Contrato;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TimesheetCliente extends Model
{
    use ClearsResponseCache, HasFactory;

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

        'objeto_descripcion',
        'cobertura',
    ];

    // Redis methods
    public static function getAll()
    {
        return Cache::remember('TimesheetCliente:timesheetcliente_all', 3600 * 8, function () {
            return self::get();
        });
    }

    public static function getAllOrderBy($value)
    {
        return Cache::remember('TimesheetCliente:timesheetcliente_order_by_'.$value, 3600, function () use ($value) {
            return self::orderBy($value)->get();
        });
    }

    public function cliente()
    {
        return $this->hasMany(QuejasCliente::class, 'cliente_id');
    }

    public function proyectos()
    {
        return $this->hasMany(TimesheetProyecto::class, 'cliente_id');
    }

    public function proyectosConvergencia()
    {
        return $this->hasManyThrough(
            TimesheetProyecto::class,
            ConvergenciaContratos::class,
            'timesheet_cliente_id', // Foreign key on the convergence table...
            'id', // Foreign key on the contratos table...
            'id', // Local key on the timesheet proyectos table...
            'timesheet_proyecto_id' // Local key on the convergence table...
        );
    }

    public function contratosConvergencia()
    {
        return $this->hasManyThrough(
            Contrato::class,
            ConvergenciaContratos::class,
            'timesheet_cliente_id', // Foreign key on the convergence table...
            'id', // Foreign key on the contratos table...
            'id', // Local key on the timesheet proyectos table...
            'contrato_id' // Local key on the convergence table...
        );
    }
}
