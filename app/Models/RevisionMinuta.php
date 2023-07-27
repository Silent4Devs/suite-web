<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevisionMinuta extends Model
{
    use HasFactory, SoftDeletes;

    // REVISION ESTATUS
    const SOLICITUD_REVISION = 1;

    const APROBADO = 2;

    const RECHAZADO = 3;

    const RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR = 4;

    const RECHAZADO_POR_NUEVA_EDICION = 5;

    //ARCHIVADO?
    const ARCHIVADO = '1';

    const NO_ARCHIVADO = '0';

    protected $fillable = [
        'empleado_id',
        'minuta_id',
        'comentarios',
        'estatus',
        'nivel',
        'no_revision',
        'archivado',
    ];

    protected $appends = [
        'fecha_solicitud', 'estatus_revisiones_formateado', 'color_revisiones_estatus',
    ];

    public function getEstatusRevisionesFormateadoAttribute()
    {
        switch ($this->estatus) {
            case strval($this::SOLICITUD_REVISION):
                return 'Solicitud de Aprobación';
                break;
            case strval($this::APROBADO):
                return 'Aprobado';
                break;
            case strval($this::RECHAZADO):
                return 'Rechazado';
                break;
            case strval($this::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR):
                return 'Rechazado en Consecuencia Por Nivel Anterior';
                break;
            case strval($this::RECHAZADO_POR_NUEVA_EDICION):
                return 'Rechazado en Consecuencia Por Edición del Formulario';
                break;
            default:
                return 'Solicitud de Aprobación';
                break;
        }
    }

    public function getColorRevisionesEstatusAttribute()
    {
        switch ($this->estatus) {
            case strval($this::SOLICITUD_REVISION):
                return '#1068C6';
                break;
            case strval($this::APROBADO):
                return '#10C639';
                break;
            case strval($this::RECHAZADO):
                return '#E10D0D';
                break;
            case strval($this::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR):
                return '#E10D0D';
                break;
            case strval($this::RECHAZADO_POR_NUEVA_EDICION):
                return '#E10D0D';
                break;
            default:
                return '#1068C6';
                break;
        }
    }

    public function getFechaSolicitudAttribute()
    {
        $fecha_diff = Carbon::parse($this->created_at)->format('d-m-Y');

        return $fecha_diff;
    }

    public function minuta()
    {
        return $this->belongsTo(Minutasaltadireccion::class, 'minuta_id', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->alta();
    }
}
