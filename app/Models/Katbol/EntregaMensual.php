<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class EntregaMensual extends Model implements Auditable
{
    public $table = 'entregas_mensuales';

    use HasFactory,softDeletes;
    use AuditableTrait;

    protected $dates = ['deleted_at'];

    protected $appends = ['archivo'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'no',
        'contrato_id',
        'nombre_entregable',
        'descripcion',
        'plazo_entrega_inicio',
        'plazo_entrega_termina',
        'entrega_real',
        'cumplimiento',
        'observaciones',
        'aplica_deductiva',
        'deductiva_penalizacion',
        'factura_id',
        'justificacion_deductiva_penalizacion',
        'deductiva_factura_id',
        'nota_credito',
        'created_by',
        'updated_by',
    ];

    //Relaciones
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id', 'id');
    }

    public function deductivaFactura()
    {
        return $this->belongsTo(Factura::class, 'deductiva_factura_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(EntregableFile::class, 'entregable_id', 'id');
    }

    public function getArchivoAttribute()
    {
        $archivo = EntregableFile::where('entregable_id', $this->id)->first();
        $archivo = $archivo ? $archivo->pdf : '';
        $ruta = asset('storage/contratos/'.$this->contrato->id.'_contrato_'.$this->contrato->no_contrato.'/entregables/pdf');
        $ruta = $ruta.'/'.$archivo;

        return $ruta;
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }
}
