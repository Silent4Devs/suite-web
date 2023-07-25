<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialVersionesDocumento extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['fecha'];

    protected $appends = ['estatus_formateado', 'path_document', 'cambios', 'fecha_dmy', 'day_localized'];

    protected $fillable = [
        'documento_id',
        'codigo',
        'nombre',
        'tipo',
        'macroproceso_id',
        'estatus',
        'version',
        'fecha',
        'archivo',
        'elaboro_id',
        'reviso_id',
        'aprobo_id',
        'responsable_id',
    ];

    public function getDayLocalizedAttribute()
    {
        // Carbon::setlocale(LC_ALL, 'es_ES');
        setlocale(LC_ALL, 'es_ES.UTF-8');
        setlocale(LC_TIME, 'es_ES');

        return Carbon::parse($this->fecha)->formatLocalized('%d de %B de %Y');
    }

    public function getFechaDMYAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function getEstatusFormateadoAttribute()
    {
        switch ($this->estatus) {
            case strval(Documento::EN_ELABORACION):
                return 'En Elaboración';
                break;
            case strval(Documento::EN_REVISION):
                return 'En Revisión';
                break;
            case strval(Documento::PUBLICADO):
                return 'Publicado';
                break;
            case strval(Documento::DOCUMENTO_RECHAZADO):
                return 'Documento Rechazado';
                break;
            default:
                return 'En Elaboración';
                break;
        }
    }

    public function getPathDocumentAttribute()
    {
        $documento = Documento::find($this->documento_id);
        $version_actual = $documento->version;
        $path_documento = '/storage/Documentos publicados';
        if (intval($this->version) != intval($version_actual)) {
            $path_documento = '/storage/Documento versiones anteriores';
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
            default:
                $path_documento .= '/procesos';
                break;
        }
        $archivo = $this->archivo;
        if (intval($this->version) != intval($version_actual)) {
            $archivo = str_replace('-publicado', '', $this->archivo);
        }

        return asset($path_documento.'/'.$archivo);
    }

    public function getCambiosAttribute()
    {
        return HistorialRevisionDocumento::select('documento_id', 'descripcion', 'comentarios', 'fecha')->where('documento_id', $this->documento_id)->where('version', $this->version - 1)->get();
    }

    public function documento()
    {
        return $this->belongsTo(Empleado::class, 'documento_id', 'id')->alta();
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
}
