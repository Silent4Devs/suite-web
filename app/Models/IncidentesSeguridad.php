<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class IncidentesSeguridad extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    const ARCHIVADO = '1';

    const NO_ARCHIVADO = '0';

    protected $table = 'incidentes_seguridad';

    protected $dates = [
        'fecha' => 'format:d-m-Y',
    ];

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'empleado_asignado_id',
        'titulo',
        'fecha',
        'sede',
        'fecha_cierre',
        'ubicacion',
        'descripcion',
        'areas_afectados',
        'procesos_afectados',
        'activos_afectados',
        'empleado_reporto_id',
        'procedente',
        'justificacion',
        'estatus',
        'sentimientos',
    ];

    protected $appends = ['folio', 'archivo', 'fecha_creacion', 'fecha_cerrado'];

    // public function getFechaAttribute()
    // {
    //     return $this->fecha ? Carbon::parse($this->fecha)->format('d-m-Y'):'';
    // }

    //Redis methods
    public static function getAll()
    {
        //retrieve all data or can pass columns to retrieve
        return Cache::remember('incidentes_seguridad_all', 3600 * 4, function () {
            return self::orderBy('id')->get();
        });
    }

    public function getFolioAttribute()
    {
        return sprintf('INC-%04d', $this->id);
    }

    public function reporto()
    {
        return $this->belongsTo(Empleado::class, 'empleado_reporto_id');
    }

    public function asignado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_asignado_id');
    }

    public function evidencias_seguridad()
    {
        return $this->hasMany(EvidenciasSeguridad::class, 'id_seguridad');
    }

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo')->first();
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadIncidente::class, 'seguridad_id', 'id');
    }

    public function getFechaCreacionAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function getFechaCerradoAttribute()
    {
        return $this->fecha_cierre ? Carbon::parse($this->fecha_ciere)->format('d-m-Y') : '';
    }

    public function accionCorrectivaAprobacional()
    {
        return $this->morphToMany(AccionCorrectiva::class, 'acciones_correctivas_aprobacionables', null, null, 'acciones_correctivas_id');
    }

    public function categorias()
    {
        return $this->belongsTo(CategoriaIncidente::class, 'categoria_id', 'id')->alta();
    }

    public function subcategorias()
    {
        return $this->belongsTo(SubcategoriaIncidente::class, 'subcategoria_id', 'id')->alta();
    }

    public function getSentimientosArrayAttribute()
    {
        $sentimientos = $this->sentimientos;

        $array_null =
        [
            'analisis_de_sentimientos' => [
                [
                    'neg' => 0.0,
                    'neu' => 0.0,
                    'pos' => 0.0,
                    'compound' => 0.0,
                ],
            ],
            'sentimientos_textblob' => [
                [
                    'polarity' => 0.0,
                    'subjectivity' => 0.0,
                ],
            ],
            'frases_nominales_spacy' => [
                [],
            ],
            'palabras_clave' => [
                [],
            ],
        ];

        return json_decode($sentimientos, true) ?? $array_null;
    }
}
