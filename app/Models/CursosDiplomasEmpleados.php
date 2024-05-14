<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\DateTranslator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Date\Date;
use OwenIt\Auditing\Contracts\Auditable;

class CursosDiplomasEmpleados extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use DateTranslator;
    use SoftDeletes;

    protected $table = 'cursos_diplomados_empleados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TipoSelect = [
        'Curso' => 'Curso',
        'Diplomado' => 'Diplomado',
        'Taller' => 'Taller',
        'Seminario' => 'Seminario',
        'Coloquio' => 'Coloquio',
        'Congreso' => 'Congreso',
        'Foro' => 'Foro',
        'Simposio' => 'Simposio',
    ];

    protected $casts = [
        'empleado_id' => 'int',
        'curso_diploma' => 'string',
        'tipo' => 'string',
        'año' => 'string',
        'duracion' => 'string',
    ];

    protected $fillable = [
        'empleado_id',
        'curso_diploma',
        'tipo',
        'año',
        'duracion',
        'fecha_fin',
        'file',
    ];

    protected $appends = ['year_ymd', 'fecha_fin_ymd', 'ruta_documento', 'fecha_inicio_spanish', 'fecha_fin_spanish'];

    public function getFechaInicioSpanishAttribute()
    {
        Date::setLocale('es');

        return new Date($this->año);
    }

    public function getFechaFinSpanishAttribute()
    {
        Date::setLocale('es');

        return new Date($this->fecha_fin);
    }

    public function getRutaDocumentoAttribute()
    {
        return asset('storage/cursos_empleados/').'/'.$this->file;
    }

    public function getYearYmdAttribute()
    {
        if ($this->año) {
            return Carbon::parse($this->año)->format('Y-m-d');
        } else {
            return null;
        }
    }

    public function getFechaFinYmdAttribute()
    {
        if ($this->fecha_fin) {
            return Carbon::parse($this->fecha_fin)->format('Y-m-d');
        } else {
            return null;
        }
    }

    public function empleado_cursos()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }

    public function getAñoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }
}
