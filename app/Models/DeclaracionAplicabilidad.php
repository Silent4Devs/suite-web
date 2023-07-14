<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeclaracionAplicabilidad extends Model
{
    use HasFactory;

    public $table = 'declaracion_aplicabilidad';

    protected $fillable = [
        'control-uno',
        'control-dos',
        'anexo_descripcion',
        'anexo_politica',
        'anexo_indice',
        'control',
        'descripcion_control',
        'justificacion',
        'aplica',
        'aprobadores_id',
        'responsables_id',
        'estatus',
        'fecha_aprobacion',
        'created_at',
        'updated_at',
    ];

    #Redis methods
    public static function getAll($columns = ['id', 'columna1', 'columna2'])
    {
        #retrieve all data or can pass columns to retrieve
        return Cache::remember('declaracionaplicabilidad_all', 3600 * 24, function () use ($columns) {
            return self::select($columns)->get();
        });
    }

    public function getNameAttribute()
    {
        return $this->anexo_indice . ' ' . $this->nocontrolm_escenario;
    }

    public function getContentAttribute()
    {
        return Str::limit($this->anexo_politica, 50, '...') ? Str::limit($this->anexo_politica, 50, '...') : 'Sin Contenido';
    }

    public function responsables()
    {
        return $this->belongsToMany('App\Models\Empleado', 'declaracion_aplicabilidad_responsables', 'declaracion_id', 'empleado_id');
    }

    public function aprobadores()
    {
        return $this->belongsToMany('App\Models\Empleado', 'declaracion_aplicabilidad_aprobadores', 'declaracion_id', 'aprobadores_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'aprobadores_id', 'id')->alta();
    }

    public function notificacion()
    {
        return $this->hasMany(NotificacionAprobadores::class, 'declaracion_id', 'id');
    }

    public function control()
    {
        return $this->belongsTo(self::class, 'anexo_indice', 'id', 'anexo_politica');
    }
}
