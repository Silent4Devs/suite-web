<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class activos_informacion_historico extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, MultiTenantModelTrait, SoftDeletes;

    protected $table = 'activos_informacion_historicos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = ['riesgo_activo', 'name', 'content', 'color', 'nivel_riesgo_ai'];

    protected $fillable = [
        'identificador',
        'nombreVP',
        'duenoVP',
        'nombre_direccion',
        'custodioALDirector',
        'activo_informacion',
        'formato',
        'proceso_id',
        'creacion',
        'recepcion',
        'otra_recepcion',
        'uso_digital',
        'nombre_aplicacion',
        'carpeta_compartida',
        'otra_AppCarpeta',
        'uso_fisico',
        'otro',
        'imprime',
        'direccion_envio',
        'vp_envio',
        'envio_digital',
        'otro_envio_digital',
        'informacion_total',
        'proveedor_envio',
        'envio_ext',
        'otro_envioExt',
        'informacion_totalExt',
        'acceso_informacionExt',
        'requiere_info',
        'almacenamiento_digital',
        'almacenamiento_aplicacion',
        'carpeta_compartida_almacenamiento',
        'otra_AppCarpeta_almacenamiento',
        'almacenamiento_fisico',
        'otro_almacenamiento_fisico',
        'ubicacion_fisica',
        'almacenamiento_acceso',
        'acceso_requerido',
        'tiempo_almacenamiento',
        'destruye',
        'eliminacion_digital',
        'otro_eliminacion',
        'eliminacion_fisica',
        'question',
        'question_1',
        'question_2',
        'question_3',
        'question_4',
        'question_5',
        'question_6',
        'question_7',
        'confidencialidad_id',
        'integridad_id',
        'disponibilidad_id',
        'valor_criticidad',
        'nombredevp_id',
        'name_direccion_id',
        'matriz_id',
        'vp_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getNivelRiesgoAiAttribute()
    {
        $criticidad = $this->traducirCriticidadARangoContenedor($this->valor_criticidad);
        $contenedores = $this->riesgo_activo;
        $riesgo = 0;

        $riesgo = $criticidad * $contenedores;

        return [
            'riesgo' => $riesgo,
            'coordenada' => "{$criticidad},{$contenedores}",
        ];
    }

    private function traducirCriticidadARangoContenedor($criticidad)
    {
        $valorCriticidad = 1;

        if ($criticidad == 3 || $criticidad == 4) {
            $valorCriticidad = 2;
        } elseif ($criticidad == 5 || $criticidad == 6) {
            $valorCriticidad = 3;
        } elseif ($criticidad == 7 || $criticidad == 8 || $criticidad == 9) {
            $valorCriticidad = 4;
        } elseif ($criticidad == 10 || $criticidad == 11 || $criticidad == 12) {
            $valorCriticidad = 5;
        }

        return $valorCriticidad;
    }

    public function getNameAttribute()
    {
        return $this->identificador.' '.$this->activo_informacion;
    }

    public function getContentAttribute()
    {
        return Str::limit($this->nombreVP, 20, '...') ? Str::limit($this->nombreVP, 20, '...') : 'Sin Contenido';
    }

    public function getRiesgoActivoAttribute()
    {
        $contenedores = $this->contenedores;
        $cantidadContenedores = count($contenedores) > 0 ? count($contenedores) : 1;
        $sumatoria = 0;
        foreach ($contenedores as $contenedor) {
            $sumatoria += $contenedor->riesgo ? $contenedor->riesgo : 0;
        }
        $sumatoria = $sumatoria / $cantidadContenedores;

        return round($sumatoria);
    }

    public function getColorAttribute()
    {
        if ($this->riesgo_activo <= 5) {
            return '#0C7000';
        } elseif ($this->riesgo_activo <= 10) {
            return '#2BE015';
        } elseif ($this->riesgo_activo <= 15) {
            return '#FFFF00';
        } elseif ($this->riesgo_activo <= 20) {
            return '#FF7000';
        } else {
            return '#FF0000';
        }
    }

    public function dueno()
    {
        return $this->belongsTo(Empleado::class, 'duenoVP', 'id')->alta();
    }

    public function vp()
    {
        return $this->belongsTo(Grupo::class, 'nombredevp_id', 'id');
    }

    public function custodio()
    {
        return $this->belongsTo(Empleado::class, 'custodioALDirector', 'id')->alta();
    }

    public function direccion()
    {
        return $this->belongsTo(Area::class, 'nombre_direccion', 'id');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id', 'id');
    }

    public function confidencialidad()
    {
        return $this->belongsTo(activoConfidencialidad::class, 'confidencialidad_id', 'id');
    }

    public function integridad()
    {
        return $this->belongsTo(activoIntegridad::class, 'integridad_id', 'id');
    }

    public function disponibilidad()
    {
        return $this->belongsTo(activoDisponibilidad::class, 'disponibilidad_id', 'id');
    }

    public function contenedores()
    {
        return $this->belongsToMany(MatrizOctaveContenedor::class, 'activos_contenedores', 'activo_id', 'contenedor_id');
    }

    public function children()
    {
        return $this->belongsToMany(MatrizOctaveContenedor::class, 'activos_contenedores', 'activo_id', 'contenedor_id')->with('children');
    }
}
