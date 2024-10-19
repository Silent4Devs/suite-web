<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

// use App\Models\Schedule;

/**
 * Class Organizacion.
 *
 * @property int $id
 * @property string $empresa
 * @property string $direccion
 * @property int|null $telefono
 * @property string|null $correo
 * @property string|null $pagina_web
 * @property string|null $giro
 * @property string|null $servicios
 * @property string|null $mision
 * @property string|null $vision
 * @property string|null $valores
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $antecedentes
 * @property string|null $logotipo
 * @property Team|null $team
 * @property Collection|Sede[] $sedes
 */
class Organizacion extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'organizacions';

    protected $appends = ['logotipo', 'fecha_min_timesheet'];

    protected $casts = [
        'telefono' => 'int'
    ];

    protected $fillable = [
        'empresa',
        'direccion',
        'telefono',
        'correo',
        'pagina_web',
        'giro',
        'servicios',
        'mision',
        'vision',
        'valores',
        'antecedentes',
        'logotipo',
        'razon_social',
        'rfc',
        'representante_legal',
        'fecha_constitucion',
        'num_empleados',
        'tamano',
        'linkedln',
        'youtube',
        'facebook',
        'twitter',
        'dia_timesheet',
        'inicio_timesheet',
        'fin_timesheet',
        'fecha_registro_timesheet',
        'semanas_min_timesheet',
        'semanas_faltantes',
        'semanas_adicionales',
    ];

    public static function getExists()
    {
        return Cache::remember('Organizacion:Organizacion_exists', 3600 * 12, function () {
            return DB::table('organizacions')->select('id')->exists();
        });
    }

    //Redis methods
    public static function getLogo()
    {
        return Cache::remember('Organizacion:getLogo_organizacion', 3600 * 12, function () {
            return self::select('id', 'logotipo', 'empresa')->first();
        });
    }

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('Organizacion:organizacion_all', 3600 * 12, function () {
            return self::get();
        });
    }

    //Redis methods
    public static function getFirst()
    {
        return Cache::remember('Organizacion:organizacion_first', 3600 * 12, function () {
            return self::get()->first();
        });
    }

    public static function getFechaRegistroTimesheet()
    {
        return Cache::remember('Organizacion:fecha_registro_timesheet', 3600 * 12, function () {
            return self::select('fecha_registro_timesheet')->first()->fecha_registro_timesheet;
        });
    }

    public function getLogotipoAttribute($value)
    {
        $logotipo = asset('img/logo_policromatico_2.png');
        if ($value) {
            $logotipo = asset('storage/images/'.$value);
        }

        return $logotipo;
    }

    public function getFechaMinTimesheetAttribute($value)
    {
        if ($this->semanas_min_timesheet) {
            $fecha = Carbon::now()->startOfWeek()->subWeeks($this->semanas_min_timesheet)->format('Y-m-d');
        } else {
            $fecha = Carbon::now()->startOfWeek()->subWeeks(1000)->format('Y-m-d');
        }

        return $fecha;
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function sedes()
    {
        return $this->hasMany(Sede::class);
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule', 'organizacions_id')->orderBy('id');
    }

    public function panel()
    {
        return $this->hasMany(PanelOrganizacion::class);
    }
}
