<?php

namespace App\Models\ContractManager;

use App\Models\TimesheetCliente;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contrato.
 *
 * @version November 25, 2020, 3:51 pm UTC
 *
 * @property int $no_contrato
 * @property string $nombre_proveedor
 * @property string $area
 * @property string $nombre_servicio
 * @property string $clasificacion
 * @property string $administrador
 * @property string $fase
 * @property string $estatus
 * @property string $vigencia_contrato
 * @property string $pmp_asignado
 */
class Contrato extends Model implements Auditable
{
    use HasFactory, softDeletes, ClearsResponseCache;
    use AuditableTrait;

    public $table = 'contratos';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    //tipo contrato
    const FabricaDesarrollo = 'Fábrica de desarrollo';

    const FabricaPruebas = 'Fábrica de pruebas';

    const Telecomunicaciones = 'Telecomunicaciones';

    const SeguridadInfo = 'Seguridad de la información';

    const Infraestructura = 'Infraestructura';

    const ServNube = 'Servicios en la nube';

    const ServCNorm = 'Servicios de consultoría Normativa';

    const ArrenEqui = 'Arrendamiento de Equipos';

    const AdqBien = 'Adquisición de bienes';

    const Impresion = 'Impresión';

    const Soporte = 'Soporte';

    const Licencia = 'Licenciamiento';

    const Administrativo = 'Administrativo';

    const AdquisicionPapeleria = 'Adquisición de papelería';

    const ServiciosConsultoria = 'Servicios de Consultoría';

    const ServiciosMedicos = 'Servicios Médicos';

    const ServicioSeguros = 'Servicio de Seguros';

    const MantenimientoEdificio = 'Mantenimiento de Edificio';

    const SeguridadyVigilancia = 'Seguridad y Vigilancia';

    const ServiciodeLimpieza = 'Servicio de Limpieza';

    const ServiciosdeAlimentos = 'Servicios de Alimentos';

    const EducaciónContinua = 'Educación Continua';

    const AdquisiciónPruebasCOVID = 'Adquisición de Pruebas COVID';

    const AdquisiciónMascarillas = 'Adquisición de Mascarillas';

    const Restauracion = 'Restauración de Edificios';

    const Abastecimiento = 'Abastecimiento y Distribución de Revista y Periodicos';

    const Servicio = 'Servicio de Estacionamiento';

    const Otro = 'Otro';

    //fases
    const renovacion = 'Renovación';

    const solicituCont = 'Solicitud de contrato';

    const autorizacion = 'Autorización';

    const negociacion = 'Negociación';

    const aprobacion = 'Aprobacíon';

    const ejecucion = 'Ejecución';

    const gestionOb = 'Gestión de obligaciónes';

    const modifCont = 'Modificación de contrato';

    const auditRep = 'Auditoría y reportes';

    //tipo cambio
    const MXN = 'MXN';

    const USD = 'USD';

    const EUR = 'EUR';

    const GBP = 'GBP';

    const CHF = 'CHF';

    const JPY = 'JPY';

    const HKD = 'HKD';

    const CAD = 'CAD';

    const CNY = 'CNY';

    const AUD = 'AUD';

    const BRL = 'BRL';

    const RUB = 'RUB';

    public $fillable = [
        'no_contrato',
        'tipo_contrato',
        'proveedor_id',
        'nombre_servicio',
        'objetivo',
        'fecha_inicio',
        'fecha_fin',
        'vigencia_contrato',
        'no_pagos',
        'no_proyecto',
        'administrador_contrato',
        'servicios_descripcion',
        'administrador',
        'fecha_firma',
        'periodo_pagos',
        'monto_pago',
        'fecha_inicio_pago',
        'minimo',
        'maximo',
        'area',
        'area_administrador',
        'puesto',
        'cargo_administrador',
        'pmp_asignado',
        'clasificacion',
        'fase',
        'contrato_ampliado',
        'convenio_modificatorio',
        'estatus',
        'area_id',
        'file_contrato',
        'no_pagos',
        'folio',
        'documento',
        'tipo_cambio',
        'created_by',
        'updated_by',
        'identificador_privado',
        'firma1',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'no_contrato' => 'string',
        'tipo_contrato' => 'string',
        'proveedor_id' => 'string',
        'nombre_servicio' => 'string',
        'objetivo' => 'string',
        'fecha_inicio' => 'string',
        'fecha_fin' => 'string',
        'vigencia_contrato' => 'string',
        'administrador_contrato' => 'string',
        'cargo_administrador' => 'string',
        'servicios_descripcion' => 'string',
        'administrador' => 'string',
        'fecha_firma' => 'string',
        'periodo_pagos' => 'string',
        'minimo' => 'float',
        'maximo' => 'float',
        'area' => 'string',
        'area_administrador' => 'string',
        'puesto' => 'string',
        'pmp_asignado' => 'string',
        'clasificacion' => 'string',
        'fase' => 'string',
        'estatus' => 'string',
        'file_contrato' => 'string',
        'contrato_ampliado' => 'boolean',
        'convenio_modificatorio' => 'boolean',
        'no_pagos' => 'integer',
        'folio' => 'string',
        'documento' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'identificador_privado' => 'boolean',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        /*  'no_contrato' => 'none',
        *'nombre_proveedor' => 'none',
       * 'area' => 'none',
        *'nombre_servicio' => 'none',
       * 'clasificacion' => 'none',
       * 'administrador' => 'none',
       * 'fase' => 'none',
       * 'vigencia_contrato' => 'none',
       * 'pmp_asignado' => 'none' */];

    protected $appends = [
        'nameproveedor',
    ];

    //Relaciones
    public function ampliaciones()
    {
        return $this->hasMany(AmpliacionContrato::class, 'contrato_id');
    }

    public function cedulas()
    {
        return $this->hasMany(CedulaCumplimiento::class);
    }

    public function convenios()
    {
        return $this->hasMany(ConveniosModificatorios::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(TimesheetCliente::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function dolares()
    {
        return $this->hasMany(DolaresContrato::class, 'contrato_id');
    }

    public function getArchivoAttribute()
    {
        $archivo = self::where('contrato_id', $this->id)->first();
        $archivo = $archivo ? $archivo->pdf : '';
        // dd($archivo);
        $ruta = asset('storage/contratos/');
        // $ruta = asset('storage/contratos/'.$this->contrato->id.'_contrato_'.$this->contrato->no_contrato);
        $ruta = $ruta . '/' . $archivo;

        return $ruta;
    }

    public function getNameProveedorAttribute()
    {
        return $this->no_contrato . '-' . $this->nombre_servicio;
    }
}
