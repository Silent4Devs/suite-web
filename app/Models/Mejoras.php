<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Mejoras extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'mejoras';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'estatus',
        'fecha_cierre',
        'descripcion',
        'beneficios',
        'titulo',
        'area_mejora',
        'proceso_mejora',
        'tipo',
        'otro',
        'empleado_mejoro_id',
        'sentimientos',
    ];

    protected $appends = ['folio', 'fecha_creacion', 'fecha_de_cierre', 'fecha_reporte', 'beneficio_html', 'descripcion_html'];

    // Redis methods
    public static function getAll()
    {
        // retrieve all data or can pass columns to retrieve
        return Cache::remember('mejoras_all', 3600, function () {
            return self::select('id', 'estatus', 'fecha_cierre', 'descripcion', 'beneficios', 'titulo', 'area_mejora', 'proceso_mejora', 'tipo', 'otro', 'archivado')->with('mejoro:id,name,foto,email,telefono')->where('archivado', false)->get();
        });
    }

    public function getFolioAttribute()
    {
        return sprintf('MJA-%04d', $this->id);
    }

    public function getBeneficioHtmlAttribute()
    {
        return html_entity_decode(strip_tags($this->beneficios), ENT_QUOTES, 'UTF-8');
    }

    public function getDescripcionHtmlAttribute()
    {
        return html_entity_decode(strip_tags($this->descripcion), ENT_QUOTES, 'UTF-8');
    }

    public function mejoro()
    {
        return $this->belongsTo(Empleado::class, 'empleado_mejoro_id', 'id')->alta();
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadMejora::class, 'mejora_id', 'id');
    }

    public function getFechaCreacionAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function getFechaDeCierreAttribute()
    {
        return $this->fecha_cierre ? Carbon::parse($this->fecha_ciere)->format('d-m-Y') : '';
    }

    public function getFechaReporteAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    public function accionCorrectivaAprobacional()
    {
        return $this->morphToMany(AccionCorrectiva::class, 'acciones_correctivas_aprobacionables', null, null, 'acciones_correctivas_id');
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
