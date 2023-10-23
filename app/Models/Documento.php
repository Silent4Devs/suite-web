<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Documento extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    //REVISION DE DOCUMENTOS ESTATUS
    const SOLICITUD_REVISION = 1;

    const APROBADO = 2;

    const RECHAZADO = 3;

    const RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR = 4;

    // DOCUMENTOS ESTATUS
    const EN_ELABORACION = 1;

    const EN_REVISION = 2;

    const PUBLICADO = 3;

    const DOCUMENTO_RECHAZADO = 4;

    const DOCUMENTO_OBSOLETO = 5;

    public static $searchable = [
        'nombre', 'codigo',
    ];

    protected $dates = ['fecha'];

    protected $appends = ['estatus_formateado', 'fecha_dmy', 'archivo_actual', 'color_estatus', 'no_vistas'];

    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'macroproceso_id',
        'proceso_id',
        'estatus',
        'version',
        'fecha',
        'archivo',
        'elaboro_id',
        'reviso_id',
        'aprobo_id',
        'responsable_id',
    ];

    public function searchableAs()
    {
        return 'posts_index';
    }

    //Redis methods
    public static function getLastFiveWithMacroproceso()
    {
        return Cache::remember('Documentos:Documentos_last_five_macroprocesos', 3600 * 4, function () {
            return self::with('macroproceso')->where('estatus', Documento::PUBLICADO)->latest('updated_at')->get()->take(5);
        });
    }

    public static function getWithMacroproceso($empleado_id)
    {
        return Cache::remember('Documentos:Documentos_all_macroprocesos_' . $empleado_id, 3600 * 4, function () use ($empleado_id) {
            return self::where('elaboro_id', $empleado_id)->get();
        });
    }

    public function getNoVistasAttribute()
    {
        $no_vistas = VistaDocumento::where('documento_id', $this->id)->count();

        return $no_vistas;
    }

    public function getFechaDMYAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function getEstatusFormateadoAttribute()
    {
        switch ($this->estatus) {
            case strval($this::EN_ELABORACION):
                return 'En Elaboración';
                break;
            case strval($this::EN_REVISION):
                return 'En Revisión';
                break;
            case strval($this::PUBLICADO):
                return 'Publicado';
                break;
            case strval($this::DOCUMENTO_RECHAZADO):
                return 'Documento Rechazado';
                break;
            default:
                return 'En Elaboración';
                break;
        }
    }

    public function getColorEstatusAttribute()
    {
        switch ($this->estatus) {
            case strval($this::EN_ELABORACION):
                return '#10A5C6';
                break;
            case strval($this::EN_REVISION):
                return '#1068C6';
                break;
            case strval($this::PUBLICADO):
                return '#10C639';
                break;
            case strval($this::DOCUMENTO_RECHAZADO):
                return '#E10D0D';
                break;
            default:
                return '#10A5C6';
                break;
        }
    }

    public function getArchivoActualAttribute()
    {
        $path_documento = '/storage/Documentos publicados';
        if ($this->estatus == $this::EN_REVISION) {
            $path_documento = '/storage/Documentos en aprobacion';
        }
        if ($this->estatus == $this::EN_ELABORACION) {
            $path_documento = '/storage/Documentos en aprobacion';
        }

        switch ($this->tipo) {
            case 'politica':
                $path_documento .= '/politicas';
                break;
            case 'procedimiento':
                $path_documento .= '/procedimientos';
                break;
            case 'manual':
                $path_documento .= '/manuales';
                break;
            case 'plan':
                $path_documento .= '/planes';
                break;
            case 'instructivo':
                $path_documento .= '/instructivos';
                break;
            case 'reglamento':
                $path_documento .= '/reglamentos';
                break;
            case 'externo':
                $path_documento .= '/externos';
                break;
            case 'proceso':
                $path_documento .= '/procesos';
                break;
            case 'formato':
                $path_documento .= '/formatos';
                break;
            default:
                $path_documento .= '/procesos';
                break;
        }

        return asset($path_documento . '/' . $this->archivo);
    }

    //Relacion uno a muchos inversa
    public function empleado()
    {
        return $this->belongsTo(Empleado::class)->alta();
    }

    public function revisores()
    {
        return $this->belongsToMany(Empleado::class)->alta();
    }

    public function revisiones()
    {
        return $this->hasMany(RevisionDocumento::class, 'documento_id', 'id');
    }

    public function revisor()
    {
        return $this->belongsTo(Empleado::class, 'reviso_id', 'id')->alta();
    }

    public function macroproceso()
    {
        return $this->belongsTo(Macroproceso::class, 'macroproceso_id', 'id');
    }

    public function elaborador()
    {
        return $this->belongsTo(Empleado::class, 'elaboro_id', 'id')->alta();
    }

    public function aprobador()
    {
        return $this->belongsTo(Empleado::class, 'aprobo_id', 'id')->alta();
    }

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id', 'id')->alta();
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id', 'id');
    }

    public function procesos()
    {
        return $this->hasMany(Proceso::class);
    }
}
