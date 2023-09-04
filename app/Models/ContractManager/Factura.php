<?php

namespace App\Models\ContractManager;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Facturacion.
 *
 * @property int $id
 * @property int|null $contrato_id
 * @property string|null $no_factura
 * @property string|null $concepto
 * @property Carbon|null $fecha_recepcion
 * @property Carbon|null $fecha_liberacion
 * @property int|null $no_revisiones
 * @property bool|null $cumple
 * @property string|null $hallazgos_comentarios
 * @property float|null $monto_factura
 * @property string|null $observaciones
 * @property string|null $n_cxl
 * @property bool|null $firma
 * @property bool|null $conformidad
 * @property string|null $estatus
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property Contrato|null $contrato
 * @property Collection|EntregasMensuale[] $entregas_mensuales
 * @property Collection|FacturasFile[] $facturas_files
 * @property Collection|RevisionesFactura[] $revisiones_facturas
 */
class Factura extends Model implements Auditable
{
    use HasFactory, softDeletes;
    use AuditableTrait;

    public $table = 'facturacion';

    protected $appends = ['archivo'];

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'contrato_id',
        'no_factura',
        'concepto',
        'fecha_recepcion',
        'fecha_liberacion',
        'no_revisiones',
        'cumple',
        'hallazgos_comentarios',
        'monto_factura',
        'observaciones',
        'n_cxl',
        'firma',
        'conformidad',
        'estatus',
        'created_by',
        'updated_by',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function entregas_mensuales()
    {
        return $this->hasMany(EntregaMensual::class, 'factura_id');
    }

    public function facturas_files()
    {
        return $this->hasMany(FacturasFile::class, 'factura_id');
    }

    public function entregables_files()
    {
        return $this->hasMany(EntregableFile::class, 'entregable_id');
    }

    public function revisiones_facturas()
    {
        return $this->hasMany(RevisionesFactura::class, 'id_facturacion');
    }

    // protected $fillable = [
    //     'contrato_id',
    //     'no_factura',
    //     'concepto',
    //     'periodo',
    //     'fecha_recepcion',
    //     'no_revisiones',
    //     'cumple',
    //     'fecha_liberacion',
    //     'monto_factura',
    //     'hallazgos_comentarios',
    //     'perioricidad_pago',
    //     'fecha_inicio_pago',
    //     'estatus',
    //     'conformidad',
    //     'firma',
    //     'n_cxl',
    //     'created_by',
    //     'updated_by',
    // ];

    public function file()
    {
        return $this->belongsTo(FacturaFile::class, 'factura_id', 'id');
    }

    public function getArchivoAttribute()
    {
        $archivo = FacturaFile::where('factura_id', $this->id)->first();
        $archivo = $archivo ? $archivo->pdf : '';
        $ruta = asset('storage/contratos/' . $this->contrato->id . '_contrato_' . $this->contrato->no_contrato . '/facturas/pdf');
        $ruta = $ruta . '/' . $archivo;

        return $ruta;
    }
}
