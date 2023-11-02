<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnvioDocumentos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'envio_documentos';

    protected $fillable = [
        'status',
        'id_solicita',
        'id_coordinador',
        'id_mensajero',
        'hora_recepcion_inicio',
        'hora_recepcion_fin',
        'fecha_solicitud',
        'fecha_limite',
        'descripcion',
        'lugar',
        'destinatario',
        'notas',
        'telefono',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    const EstatusSelect = [
        '1' => 'En recolección',
        '2' => 'En camino',
        '3' => 'Entregado',
        '4' => 'Devolución',
    ];

    public function solicita()
    {
        return $this->belongsTo(Empleado::class, 'id_solicita')->alta();
    }

    public function coordinador()
    {
        return $this->belongsTo(Empleado::class, 'id_coordinador')->alta();
    }

    public function mensajero()
    {
        return $this->belongsTo(Empleado::class, 'id_mensajero')->alta();
    }
}
