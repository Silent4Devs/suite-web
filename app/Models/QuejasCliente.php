<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class QuejasCliente extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'quejas_clientes';

    protected $casts = [
        'area_quejado_id' => 'int',
        'colaborador_quejado_id' => 'int',
        'proceso_quejado_id' => 'int',
    ];

    protected $dates = [
        'fecha',
        'fecha_cierre',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cliente_id',
        'proyectos_id',
        'nombre',
        'puesto',
        'telefono',
        'correo',
        'estatus',
        'area_quejado',
        'colaborador_quejado',
        'proceso_quejado',
        'otro_quejado',
        'titulo',
        'fecha',
        'fecha_cierre',
        'ubicacion',
        'descripcion',
        'comentarios',
        'archivado',
        'canal',
        'otro_canal',
        'solucion_requerida_cliente',
        'impacto',
        'urgencia',
        'prioridad',
        'categoria_queja',
        'otro_categoria',
        'queja_procedente',
        'porque_procedente',
        'realizar_accion',
        'cual_accion',
        'desea_levantar_ac',
        'acciones_tomara_responsable',
        'fecha_limite',
        'comentarios_atencion',
        'empleado_reporto_id',
        'accion_correctiva_id',
        'correo_cliente',
        'responsable_sgi_id',
        'responsable_atencion_queja_id',
        'cumplio_ac_responsable',
        'porque_no_cumplio_responsable',
        'conforme_solucion',
        'cerrar_ticket',
        'correoEnviado',
        'cumplio_fecha',
        'correo_enviado_responsable',
        'notificar_responsable',
        'notificar_registro_queja',
        'correo_enviado_registro',
        'porque_no_cierre_ticket',
        'email_env_resolucion_rechazada',
        'notificar_atencion_queja_no_aprobada',
        'email_env_resolucion_aprobada',
        'email_realizara_accion_inmediata',

    ];

    protected $appends = [
        'folio',
        'fecha_de_cierre',
        'fecha_reporte',
    ];

    public static function getAll()
    {
        //retrieve all data or can pass columns to retrieve
        return Cache::remember('quejas_cliente_all', 3600 * 4, function () {
            return self::orderBy('id')->get();
        });
    }

    public function getFolioAttribute()
    {
        return sprintf('QUE-%04d', $this->id);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_quejado_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'colaborador_quejado_id')->alta();
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_quejado_id');
    }

    public function cliente()
    {
        return $this->belongsTo(TimesheetCliente::class, 'cliente_id');
    }

    public function proyectos()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyectos_id');
    }

    public function analisis()
    {
        return $this->hasMany(AnalisisQuejasClientes::class, 'quejas_clientes_id', 'id');
    }

    public function evidencias_quejas()
    {
        return $this->hasMany(EvidenciaQuejasClientes::class, 'quejas_clientes_id');
    }

    public function cierre_evidencias()
    {
        return $this->hasMany(EvidenciasQuejasClientesCerrado::class, 'quejas_clientes_id');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function getFechaCreacionAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function getFechaDeCierreAttribute()
    {
        return $this->fecha_cierre ? Carbon::parse($this->fecha_ciere)->format('d-m-Y H:i') : '';
    }

    public function getFechaReporteAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }

    public function registro()
    {
        return $this->belongsTo(Empleado::class, 'empleado_reporto_id', 'id')->alta();
    }

    public function responsableSgi()
    {
        return $this->belongsTo(Empleado::class, 'responsable_sgi_id', 'id')->alta();
    }

    public function responsableAtencion()
    {
        return $this->belongsTo(Empleado::class, 'responsable_atencion_queja_id', 'id')->alta();
    }

    public function accionCorrectiva()
    {
        return $this->belongsTo(AccionCorrectiva::class, 'accion_correctiva_id', 'id');
    }

    public function seguimiento()
    {
        return $this->hasMany(SeguimientoQuejaCliente::class, 'queja_cliente_id', 'id');
    }

    public function accionCorrectivaAprobacional()
    {
        return $this->morphToMany(AccionCorrectiva::class, 'acciones_correctivas_aprobacionables', null, null, 'acciones_correctivas_id')->withTimestamps()->withPivot('id');
    }
}
