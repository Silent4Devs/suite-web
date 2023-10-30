<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RevisionDocumento extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    const ARCHIVADO = '1';

    const NO_ARCHIVADO = '0';

    protected $fillable = [
        'empleado_id',
        'documento_id',
        'comentarios',
        'estatus',
        'nivel',
        'no_revision',
        'version',
        'archivado',
    ];

    protected $appends = [
        'fecha_solicitud', 'before_level_all_answered', 'estatus_revisiones_formateado', 'color_revisiones_estatus',
    ];

    public function getBeforeLevelAllAnsweredAttribute()
    {
        if (intval($this->nivel) == 1) {
            return true;
        } else {
            $revisiones = self::where('documento_id', '=', $this->documento_id)
                ->where('no_revision', '=', $this->no_revision)
                ->where('version', '=', $this->version)
                ->where('nivel', '=', strval(intval($this->nivel) - 1))->get();
            $habilitar_revision = false;
            foreach ($revisiones as $revision) {
                if ($revision->estatus == strval(Documento::SOLICITUD_REVISION)) {
                    $habilitar_revision = false;
                } else {
                    $habilitar_revision = true;
                }
            }

            return $habilitar_revision;
        }
    }

    public function getEstatusRevisionesFormateadoAttribute()
    {
        switch ($this->estatus) {
            case strval(Documento::SOLICITUD_REVISION):
                return 'Solicitud de Aprobación';
                break;
            case strval(Documento::APROBADO):
                return 'Aprobado';
                break;
            case strval(Documento::RECHAZADO):
                return 'Rechazado';
                break;
            case strval(Documento::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR):
                return 'Rechazado en Consecuencia Por Nivel Anterior';
                break;
            default:
                return 'Solicitud de Aprobación';
                break;
        }
    }

    public function getColorRevisionesEstatusAttribute()
    {
        switch ($this->estatus) {
            case strval(Documento::SOLICITUD_REVISION):
                return '#1068C6';
                break;
            case strval(Documento::APROBADO):
                return '#10C639';
                break;
            case strval(Documento::RECHAZADO):
                return '#E10D0D';
                break;
            case strval(Documento::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR):
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

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class)->alta();
    }
}
