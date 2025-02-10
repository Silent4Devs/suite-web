<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IncidentesDeSeguridad extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $table = 'incidentes_de_seguridads';

    public static $searchable = [
        'resumen',
    ];

    protected $dates = [
        'fechaocurrencia',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PRIORIDAD_SELECT = [
        '1' => 'Baja',
        '2' => 'Media',
        '3' => 'Alta',
        '4' => 'Crítica',
    ];

    protected $fillable = [
        'folio',
        'resumen',
        'estatus',
        'prioridad',
        'fechaocurrencia',
        'clasificacion',
        'created_at',
        'estado_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // Redis methods
    public static function getAll()
    {
        // retrieve all data or can pass columns to retrieve
        return Cache::remember('incidentesSeguridad_all', 3600, function () {

            return self::select('id', 'titulo', 'estatus', 'fecha', 'fecha_cierre', 'categoria', 'subcategoria', 'sede', 'ubicacion', 'descripcion', 'areas_afectados', 'procesos_afectados', 'activos_afectados', 'urgencia', 'impacto', 'prioridad', 'comentarios',
                'empleado_reporto_id', 'empleado_asignado_id', 'evidencia')->where('archivado', false)->get();
        });
    }

    public function getFechaocurrenciaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaocurrenciaAttribute($value)
    {
        $this->attributes['fechaocurrencia'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function activos()
    {
        return $this->belongsToMany(Activo::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoIncidente::class, 'estado_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
