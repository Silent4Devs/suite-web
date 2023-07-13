<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Date\Date;
// use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Cache;

class Recurso extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;
    // use QueryCacheable;

    // public $cacheFor = 600;
    // protected static $flushCacheOnUpdate = true;
    public $table = 'recursos';

    const TIPOS = [
        'Curso' => 'Curso',
        'Diplomado' => 'Diplomado',
        'Taller' => 'Taller',
        'Seminario' => 'Seminario',
        'Coloquio' => 'Coloquio',
        'Congreso' => 'Congreso',
        'Foro' => 'Foro',
        'Simposio' => 'Simposio',
    ];

    const ESTATUS = [
        'Borrador', //Borrador
        'Enviado', //Enviado (cuando se envia en este momento las invitaciones)
        'Programado', //Programado (cuando se programa el envio de invitaciones)
        // 'Re-Programado', //Re Programado (cuando se re programa)
        'Cancelado', // Cuando se cancela
    ];
    const PROXIMAMENTE = 0;
    const EN_CURSO = 1;
    const TERMINADO = 2;

    protected $appends = [
        'certificado', 'estatus_aceptacion', 'fecha_inicio_name', 'fecha_fin_name', 'fecha_limite_name', 'fecha_inicio_format_diagonal', 'fecha_fin_format_diagonal', 'only_fecha_inicio', 'only_fecha_fin', 'only_fecha_inicio_hora', 'only_fecha_fin_hora', 'fecha_inicio_ymd', 'fecha_limite_ymd', 'ya_finalizo', 'ya_inicio', 'ruta_lista_asistencia',
    ];

    public static $searchable = [
        'cursoscapacitaciones',
    ];

    protected $dates = [

        'fecha_limite',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'tipo_seleccion_participantes' => 'object',
        'configuracion_invitacion_envio' => 'object',
    ];

    protected $fillable = [
        'modalidad',
        'ubicacion',
        'cursoscapacitaciones',
        'fecha_curso',
        'fecha_fin',
        'duracion',
        'tipo',
        'categoria_capacitacion_id',
        'instructor',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'archivar',
        'fecha_limite',
        'tipo_seleccion_participantes',
        'estatus',
        'configuracion_invitacion_envio',
        'lista_asistencia',
        'is_sync_elearning',
    ];

    #Redis methods
    public static function getAll()
    {
        return Cache::remember('recursos_all', 3600 * 24, function () {
            return self::get();
        });
    }

    // SCOPES
    public function scopeCapacitacionesProximas($query)
    {
        return $query->whereDate('fecha_curso', '>', Carbon::now()->format('Y-m-d h:i:s'));
    }

    public function scopeCapacitacionesEnCurso($query)
    {
        // dd(Carbon::now()->format('Y-m-d h:i:s'));
        return $query->whereDate('fecha_curso', '<=', Carbon::now()->format('Y-m-d h:i:s'))->whereDate('fecha_fin', '>=', Carbon::now()->format('Y-m-d h:i:s'));
    }

    public function scopeCapacitacionesTerminadas($query)
    {
        return $query->whereDate('fecha_fin', '<', Carbon::now()->format('Y-m-d h:i:s'));
    }
    // FIN SCOPES

    public function getRutaListaAsistenciaAttribute()
    {
        if ($this->lista_asistencia != null) {
            return asset("storage/capacitaciones/listas/{$this->id}_capacitacion/{$this->lista_asistencia}");
        }

        return null;
    }

    public function getEstatusAceptacionAttribute()
    {
        $fechaInicio = Carbon::parse($this->fecha_curso)->format('Y-m-d h:i');
        $fechaFin = Carbon::parse($this->fecha_fin)->format('Y-m-d h:i');
        $hoy = Carbon::now()->format('Y-m-d h:i:s');
        if ($fechaInicio > $hoy) {
            return ['nombre' => 'Proximamente', 'code' => 'proximamente', 'color' => 'blue'];
        } elseif ($fechaInicio <= $hoy && $fechaFin >= $hoy) {
            return ['nombre' => 'Curso', 'code' => 'curso', 'color' => 'green'];
        } elseif ($fechaFin < $hoy) {
            return ['nombre' => 'Terminado', 'code' => 'terminado', 'color' => 'red'];
        }
    }

    public function getFechaLimiteYMDAttribute()
    {
        return Carbon::parse($this->fecha_limite)->format('Y-m-d h:i:s');
    }

    public function getFechaInicioYMDAttribute()
    {
        return Carbon::parse($this->fecha_curso)->format('Y-m-d h:i:s');
    }

    public function getOnlyFechaInicioAttribute()
    {
        return Carbon::parse($this->fecha_curso)->format('d/m/Y');
    }

    public function getOnlyFechaInicioHoraAttribute()
    {
        return Carbon::parse($this->fecha_curso)->format('g:i A');
    }

    public function getOnlyFechaFinAttribute()
    {
        return Carbon::parse($this->fecha_fin)->format('d/m/Y');
    }

    public function getOnlyFechaFinHoraAttribute()
    {
        return Carbon::parse($this->fecha_fin)->format('g:i A');
    }

    public function getFechaInicioNameAttribute()
    {
        $date = new Date($this->fecha_curso);

        return $date->format('d F Y g:i A');
    }

    public function getFechaFinNameAttribute()
    {
        $date = new Date($this->fecha_fin);

        return $date->format('d F Y g:i A');
    }

    public function getFechaLimiteNameAttribute()
    {
        $date = new Date($this->fecha_limite);

        return $date->format('d F Y g:i A');
    }

    public function getYaFinalizoAttribute()
    {
        return Carbon::now()->isAfter(Carbon::parse($this->fecha_fin));
    }

    public function getYaInicioAttribute()
    {
        return Carbon::now()->greaterThanOrEqualTo(Carbon::parse($this->fecha_curso));
    }

    public function getFechaInicioFormatDiagonalAttribute()
    {
        return Carbon::parse($this->fecha_curso)->format('d/m/Y g:i A');
    }

    public function getFechaFinFormatDiagonalAttribute()
    {
        return Carbon::parse($this->fecha_fin)->format('d/m/Y g:i A');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getFechaCursoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y H:i:s') : null;
    }

    public function getFechaFinAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y H:i:s') : null;
    }

    public function setFechaCursoAttribute($value)
    {
        $this->attributes['fecha_curso'] = $value ? Carbon::createFromFormat('Y-m-d\TH:i', $value)->toDateTimeString() : null;
    }

    public function getCertificadoAttribute()
    {
        return $this->getMedia('certificado');
    }

    public function participantes()
    {
        return $this->belongsToMany(User::class);
    }

    public function archivos()
    {
        return $this->hasMany(FileCapacitacion::class, 'recurso_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class)->alta()->with('area')->withPivot('certificado', 'calificacion', 'archivado', 'es_aceptada', 'evaluacion', 'asistio');
    }

    public function categoria_capacitacion()
    {
        return $this->belongsTo(CategoriaCapacitacion::class);
    }

    public function secciones()
    {
        return $this->hasMany(SeccionRecurso::class, 'recurso_id', 'id');
    }
}
