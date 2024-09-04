<?php

namespace App\Models;

use App\Models\Iso27\DeclaracionAplicabilidadAprobarIso;
use App\Models\Iso27\DeclaracionAplicabilidadResponsableIso;
use App\Models\RH\BeneficiariosEmpleado;
use App\Models\RH\ContactosEmergenciaEmpleado;
use App\Models\RH\DependientesEconomicosEmpleados;
use App\Models\RH\Objetivo;
use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use DateTime;
use DateTimeInterface;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Empleado.
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $n_registro
 * @property string|null $foto
 * @property string|null $puesto
 * @property Carbon|null $antiguedad
 * @property string|null $estatus
 * @property string|null $email
 * @property string|null $telefono
 * @property string|null $genero
 * @property string|null $n_empleado
 * @property int|null $supervisor_id
 * @property int|null $area_id
 * @property int|null $sede_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Area|null $area
 * @property Sede|null $sede
 * @property Empleado|null $empleado
 * @property Collection|AnalisisDeRiesgo[] $analisis_de_riesgos
 * @property Collection|Documento[] $documentos
 * @property Collection|Recurso[] $recursos
 * @property Collection|Empleado[] $empleados
 * @property Collection|EntendimientoOrganizacion[] $entendimiento_organizacions
 * @property Collection|HistorialVersionesDocumento[] $historial_versiones_documentos
 * @property Collection|IndicadoresSgsi[] $indicadores_sgsis
 * @property Collection|MatrizRiesgo[] $matriz_riesgos
 * @property Collection|RevisionDocumento[] $revision_documentos
 * @property Collection|User[] $users
 */
class Empleado extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use Filterable;
    use HasFactory;
    use SoftDeletes;

    const BAJA = 'baja';

    const ALTA = 'alta';

    protected $table = 'empleados';

    protected $casts = [
        'supervisor_id' => 'int',
        'area_id' => 'int',
        'sede_id' => 'int',
        'mostrar_telefono' => 'boolean',
    ];

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'antiguedad',
    ];

    //public $preventsLazyLoading = true;
    //protected $with = ['children:id,name,foto,puesto as title,area,supervisor_id']; //Se desborda la memoria al entrar en un bucle infinito se opto por utilizar eager loading
    protected $appends = [
        'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
        'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet',
        // 'disposicion',
    ];

    protected $with = ['area', 'supervisor'];

    //, 'jefe_inmediato', 'empleados_misma_area'
    protected $fillable = [
        'name',
        'n_registro',
        'foto',
        'puesto',
        'antiguedad',
        'estatus',
        'email',
        'telefono',
        'extension',
        'telefono_movil',
        'genero',
        'n_empleado',
        'supervisor_id',
        'area_id',
        'sede_id',
        'direccion',
        'cumpleaños',
        'resumen',
        'puesto_id',
        'perfil_empleado_id',
        'tipo_contrato_empleados_id', //Agregados para nueva version de perfil de empleado
        'terminacion_contrato',
        'renovacion_contrato',
        'esquema_contratacion',
        'proyecto_asignado',
        'telefono_casa',
        'correo_personal',
        'estado_civil',
        'NSS',
        'CURP',
        'RFC',
        'lugar_nacimiento',
        'nacionalidad',
        'entidad_crediticias_id',
        'numero_credito',
        'descuento',
        'banco',
        'cuenta_bancaria',
        'clabe_interbancaria',
        'centro_costos',
        'salario_bruto',
        'salario_diario',
        'salario_diario_integrado',
        'salario_base_mensual',
        'pagadora_actual',
        'periodicidad_nomina',
        'mostrar_telefono',
        'calle',
        'num_exterior',
        'num_interior',
        'colonia',
        'delegacion',
        'estado',
        'pais',
        'cp',
        'fecha_baja',
        'razon_baja',
        'semanas_min_timesheet',
        'vacante_activa',
    ];

    //Redis methods
    public static function getExists()
    {
        return Cache::remember('Empleados:empleados_exists', 3600 * 8, function () {
            return DB::table('empleados')->select('id')->exists();
        });
    }

    public static function getCeoExists()
    {
        return Cache::remember('Empleados:empleados_ceo_exists', 3600 * 6, function () {
            return DB::table('empleados')->select('supervisor_id')->whereNull('supervisor_id')->exists();
        });
    }

    public static function getMyEmpleadodata($id)
    {
        return Cache::remember('Empleados:empleados_my_empleado_data_' . $id, 3600, function () use ($id) {
            return self::where('id', $id)->first();
        });
    }

    public static function getAll(array $options = [])
    {
        return Cache::remember('Empleados:empleados_all', 3600 * 8, function () use ($options) {
            $query = self::query();

            if (isset($options['orderBy'])) {
                $orderBy = $options['orderBy'];
                $query->orderBy($orderBy[0], $orderBy[1]);
            }

            return $query->get();
        });
    }

    public static function getAllwithDeleted(array $options = [])
    {
        return Cache::remember('Empleados:empleados_all_borrados', 3600 * 8, function () use ($options) {
            $query = self::query();

            if (isset($options['orderBy'])) {
                $orderBy = $options['orderBy'];
                $query->orderBy($orderBy[0], $orderBy[1]);
            }

            return $query->withTrashed()->get();
        });
    }

    public static function getIdNameAll(array $options = [])
    {
        // Generate a unique cache key based on the options provided

        return Cache::remember('Empleados:empleados_id_name_all', 3600 * 8, function () {
            $query = self::select('id', 'name')->where('estatus', 'alta')->orderBy('id', 'desc')->get();

            return $query;
        });
    }

    public static function getEmpleadoCurriculum($id)
    {
        return
            Cache::remember('Empleados:EmpleadoCurriculum_' . $id, 3600 * 8, function () use ($id) {
                return self::alta()->with('empleado_certificaciones', 'empleado_cursos', 'empleado_experiencia')->findOrFail($id);
            });
    }

    public static function getAltaEmpleados()
    {
        return Cache::remember('Empleados:empleados_alta', 3600 * 4, function () {
            return self::alta()->select('id', 'area_id', 'name', 'puesto', 'foto', 'genero')
                ->get();
        });
    }

    public static function getAltaEmpleadosWithCertificacionesCursosExperiencia()
    {
        return Cache::remember('Empleados:empleados_alta_WithCertificacionesCursosExperiencia', 3600 * 7, function () {
            return self::with('empleado_certificaciones', 'empleado_cursos', 'empleado_experiencia')->alta()->get();
        });
    }

    public static function getAltaEmpleadosWithAreaSedeSupervisor()
    {
        return Cache::remember('Empleados:empleados_alta_area_sede_supervisor', 3600 * 8, function () {
            return self::with('area', 'sede', 'supervisor')->alta()->orderByDesc('id')->get();
        });
    }

    public static function getAltaEmpleadosWithArea()
    {
        return Cache::remember('Empleados:empleados_alta_area', 3600 * 6, function () {
            return self::with('area')->alta()->orderBy('name')->get();
        });
    }

    public static function getSelectEmpleadosWithArea()
    {
        return Cache::remember('Empleados:empleados_select_area', 3600 * 6, function () {
            return self::select('id', 'antiguedad', 'estatus', 'name', 'fecha_baja', 'area_id', 'foto', 'puesto_id')->with('area', 'puesto')->get();
        });
    }

    public static function getIDaltaAll()
    {
        return Cache::remember('Empleados:empleados_alta_id', 3600 * 6, function () {
            return self::alta()->with('area', 'puestoRelacionado')->select('id', 'name', 'email', 'area_id', 'puesto_id')->get();
        });
    }

    public static function getaltaAll()
    {
        return Cache::remember('Empleados:empleados_alta_all', 3600 * 6, function () {
            return self::orderBy('name')->alta()->get();
        });
    }

    public static function getAllEvaluaciones()
    {
        return Cache::remember('Empleados:empleados_all_evaluaciones', 3600 * 6, function () {
            return self::select('id', 'name', 'foto', 'area_id', 'puesto_id', 'supervisor_id')
                ->get();
        });
    }

    public function registrosHistorico()
    {
        return $this->hasMany(HistoricoEmpleados::class, 'empleado_id', 'id');
    }

    public static function getAllOrganigramaTree()
    {
        return Cache::remember('Empleados:empleados_all_organigrama_tree', 3600 * 6, function () {
            return self::select(
                'id',
                'name',
                'area_id',
                'foto',
                'puesto_id',
                'antiguedad',
                'email',
                'telefono',
                'estatus',
                'n_registro',
                'n_empleado',
                'genero',
                'telefono_movil'
            )
                ->with([
                    'supervisor.childrenOrganigrama' => function ($query) {
                        $query->select('id', 'name', 'foto', 'puesto_id', 'genero');
                    },
                    'supervisor.supervisor:id,name,foto,puesto_id,genero',
                    'area:id,area',
                    'childrenOrganigrama.supervisor:id,name,foto,puesto_id,genero',
                    'childrenOrganigrama.childrenOrganigrama',
                ])
                ->alta()
                ->vacanteActiva()
                ->whereNull('supervisor_id')
                ->first();
            // Carga ansiosa (Eager loading)
        });
    }

    public static function getAllOrganigramaTreeElse($id)
    {
        return Cache::remember('Empleados:empleados_all_organigrama_tree_else', 3600 * 6, function () use ($id) {
            return self::select(
                'id',
                'name',
                'area_id',
                'foto',
                'puesto_id',
                'antiguedad',
                'email',
                'telefono',
                'estatus',
                'n_registro',
                'n_empleado',
                'genero',
                'telefono_movil'
            )
                ->alta()
                ->vacanteActiva()
                ->with([
                    'supervisor.childrenOrganigrama' => function ($query) {
                        $query->select('id', 'name', 'foto', 'puesto_id', 'genero');
                    },
                    'supervisor.supervisor:id,name,foto,puesto_id,genero',
                    'area:id,area',
                    'childrenOrganigrama.supervisor:id,name,foto,puesto_id,genero',
                    'childrenOrganigrama.childrenOrganigrama',
                ])
                ->where('id', $id)
                ->first(); //Eager loading
        });
    }

    public static function getAllDataObjetivosEmpleado()
    {
        return Cache::remember('Empleados:empleados_all_objetivos_empleado', 3600 * 6, function () {
            return self::alta()->select('id', 'name', 'foto', 'area_id', 'puesto_id', 'supervisor_id')
                ->with(['objetivos' => function ($q) {
                    $q->with(['objetivo' => function ($query) {
                        $query->with(['tipo', 'metrica']);
                    }]);
                }])->get();
        });
    }

    public static function getaltaAllWithAreaObjetivoPerfil()
    {
        return Cache::remember('Empleados:empleados_alta_all_area', 3600 * 6, function () {
            return self::alta()->select(
                'n_empleado',
                'name',
                'puesto_id',
                'area_id',
                'perfil_empleado_id',
                'id',
                'foto'
            )->with(['objetivos', 'area', 'perfil', 'puestoRelacionado'])->get();
        });
    }

    public static function getaltaAllObjetivoSupervisorChildren()
    {
        return Cache::remember('Empleados:empleados_alta_all_evaluaciones', 3600 * 6, function () {
            return self::alta()->select(
                'id',
                'name',
                'area_id',
                'supervisor_id',
                'puesto_id',
            )->with(['objetivos.objetivo', 'children', 'supervisor', 'area', 'puestoRelacionado'])->get();
        });
    }

    public function TimesheetProyectoEmpleado()
    {
        return $this->hasMany(TimesheetProyectoEmpleado::class, 'empleado_id', 'id');
    }

    public static function getreportesAll()
    {
        return Cache::remember('Empleados:empleados_reportes_all', 3600 * 6, function () {
            return self::select('id', 'antiguedad', 'puesto_id', 'area_id', 'name', 'estatus', 'antiguedad')->get();
        });
    }

    public static function getAltaDataColumns()
    {
        return Cache::remember('Empleados:empleados_alta_data_columns_all', 3600 * 6, function () {
            return self::alta()->select('id', 'name', 'email', 'foto')->get();
        });
    }

    public static function getAllDataColumns()
    {
        return Cache::remember('Empleados:empleados_all_data_columns_all', 3600 * 6, function () {
            return self::select('id', 'name', 'email', 'foto')->get();
        });
    }

    public static function getDataColumns()
    {
        return Cache::remember('Empleados:empleados_data_columns_all', 3600 * 6, function () {
            return self::select('id', 'name', 'email', 'foto')->get();
        });
    }

    public function getActualBirdthdayAttribute()
    {
        $birdthday = date('Y') . '-' . Carbon::parse($this->cumpleaños)->format('m-d');

        return $birdthday;
    }

    public function getActualAniversaryAttribute()
    {
        $aniversario = date('Y') . '-' . Carbon::parse($this->antiguedad)->format('m-d');

        return $aniversario;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getResumenAttribute($value)
    {
        return html_entity_decode(utf8_decode(strip_tags($value)));
    }

    public function getResourceIdAttribute()
    {
        return $this->id;
    }

    public function getPuestoAttribute()
    {
        return $this->puestoRelacionado ? $this->puestoRelacionado->puesto : 'Sin puesto';
    }

    public function getGeneroFormateadoAttribute()
    {
        if ($this->genero == 'H') {
            return 'Masculino';
        } elseif ($this->genero == 'M') {
            return 'Femenino';
        } else {
            return 'Otro Género';
        }
    }

    public function getSaludoAttribute()
    {
        $nombre = explode(' ', $this->name);

        return $nombre;
    }

    public function getSaludoCompletoAttribute()
    {
        $hora = date('H');
        $saludo = '';
        $nombre = explode(' ', $this->name)[0];
        if ($hora >= '12' && $hora <= '18') {
            $saludo = "Buenas Tardes, <strong style='font-size: 14px !important;'>{$nombre}</strong>";
        } elseif ($hora >= '19' && $hora <= '23') {
            $saludo = "Buenas Noches, <strong style='font-size: 14px !important;'>{$nombre}</strong>";
        } else {
            $saludo = "Buenos Días, <strong style='font-size: 14px !important;'>{$nombre}</strong>";
        }

        return $saludo;
    }

    public function getAvatarAttribute()
    {
        if ($this->foto == null || $this->foto == '0') {
            if ($this->genero == 'H') {
                return 'man.png';
            } elseif ($this->genero == 'M') {
                return 'woman.png';
            } else {
                return 'usuario_no_cargado.png';
            }
        }

        return $this->foto;
    }

    public function getAvatarRutaAttribute()
    {
        if ($this->foto == null || $this->foto == '0') {
            if ($this->genero == 'H') {
                return asset('storage/empleados/imagenes/man.png');
            } elseif ($this->genero == 'M') {
                return asset('storage/empleados/imagenes/woman.png');
            } else {
                return asset('storage/empleados/imagenes/usuario_no_cargado.png');
            }
        }

        return asset('storage/empleados/imagenes/' . $this->foto);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(self::class, 'supervisor_id');
    }

    public function analisis_de_riesgos()
    {
        return $this->hasMany(AnalisisDeRiesgo::class, 'id_elaboro');
    }

    /*public function documentos()
    {
        return $this->hasMany(Documento::class, 'reviso_id');
    }*/

    public function recursos()
    {
        return $this->belongsToMany(Recurso::class)
            ->withPivot('id', 'calificacion', 'certificado')
            ->withTimestamps();
    }

    public function puestoRelacionado()
    {
        return $this->belongsTo('App\Models\Puesto', 'puesto_id', 'id')->select('id', 'puesto');
    }

    public function getCompetenciasAsignadasAttribute()
    {
        return !is_null($this->puestoRelacionado) ? $this->puestoRelacionado->competencias->count() : 0;
    }

    public function getObjetivosAsignadosAttribute()
    {
        $cuenta_objetivos = !is_null($this->objetivos) ? $this->objetivos->count() : 0;
        $objetivos = $this->objetivos;

        $objetivo_pendiente = false;

        if ($cuenta_objetivos > 0) {
            foreach ($objetivos as $obj) {
                if ($obj->objetivo->esta_aprobado == Objetivo::SIN_DEFINIR) {
                    $objetivo_pendiente = true;
                }
            }
        }

        return [
            'cuenta' => $cuenta_objetivos,
            'pendientes' => $objetivo_pendiente,
        ];
    }

    public function getFechaMinTimesheetAttribute($value)
    {
        if ($this->semanas_min_timesheet) {
            $fecha = Carbon::now()->startOfWeek()->subWeeks($this->semanas_min_timesheet)->format('Y-m-d');
        } else {
            $fecha = Carbon::now()->startOfWeek()->subWeeks(1000)->format('Y-m-d');
        }

        return $fecha;
    }

    public function empleados()
    {
        return $this->hasMany(self::class, 'supervisor_id', 'id'); //Sin Eager Loading
    }

    public function entendimiento_organizacions()
    {
        return $this->hasMany(EntendimientoOrganizacion::class, 'id_elabora');
    }

    public function historial_versiones_documentos()
    {
        return $this->hasMany(HistorialVersionesDocumento::class, 'reviso_id');
    }

    public function indicadores_sgsis()
    {
        return $this->hasMany(IndicadoresSgsi::class, 'id_empleado');
    }

    public function matriz_riesgos()
    {
        return $this->hasMany(MatrizRiesgo::class, 'id_responsable');
    }

    public function revision_documentos()
    {
        return $this->hasMany(RevisionDocumento::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'n_empleado', 'n_empleado');
    }

    public function supervisor()
    {
        return $this->belongsTo(self::class)->alta();
    }

    public function supervisorCrearEvaluacion()
    {
        return $this->belongsTo(self::class)->alta()->select('id', 'name', 'area_id');
    }

    public function supervisorEv360()
    {
        return $this->belongsTo(self::class, 'supervisor_id', 'id')->select('id', 'name', 'area_id');
    }

    public function onlyChildren()
    {
        return $this->hasMany(self::class, 'supervisor_id', 'id')->select('id', 'name', 'foto');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'supervisor_id', 'id')->with('children', 'supervisor', 'area'); //Eager Loading utilizar solo para construir un arbol si no puede desbordar la pila
    }

    public function childrenCrearEvaluacion()
    {
        return $this->hasMany(self::class, 'supervisor_id', 'id')->with('children', 'supervisor', 'area')->select('id', 'name', 'area_id', 'supervisor_id'); //Eager Loading utilizar solo para construir un arbol si no puede desbordar la pila
    }

    public function childrenOrganigrama()
    {
        return $this->hasMany(self::class, 'supervisor_id', 'id')
            ->with('childrenOrganigrama:id,name,foto,puesto_id,genero,estatus', 'supervisor:id,name,foto,puesto_id,genero', 'area')
            ->vacanteActiva();
    }

    public function scopeAlta($query)
    {
        return $query->where('estatus', 'alta');
    }

    public function scopeVacanteActiva($query)
    {
        return $query->where('vacante_activa', true);
    }

    public function scopeBaja($query)
    {
        return $query->where('estatus', 'alta');
    }

    public function empleadoEsSupervisor()
    {
        // code...
    }

    public function fodas()
    {
        return $this->hasMany(EntendimientoOrganizacion::class, 'id_elabora', 'id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function archivos()
    {
        return $this->hasMany(Documento::class);
    }

    public function procesos()
    {
        return $this->hasMany(Proceso::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(PlanImplementacionTask::class, 'task_id');
    }

    public function minutas()
    {
        return $this->belongsToMany(Minutasaltadireccion::class, 'minuta_id');
    }

    public function entendimiento()
    {
        return $this->belongsToMany(EntendimientoOrganizacion::class, 'foda_id');
    }

    public function empleado_experiencia()
    {
        return $this->hasMany(ExperienciaEmpleados::class)->orderByDesc('inicio_mes');
    }

    public function empleado_certificaciones()
    {
        return $this->hasMany(CertificacionesEmpleados::class)->orderByDesc('vigencia');
    }

    // public function idiomas()
    // {
    //     return $this->hasMany(IdiomaEmpleado::class, 'empleado_id', 'id');
    // }

    public function idiomas()
    {
        // return $this->belongsToMany(Language::class, 'puesto_idioma_porcentaje_pivot','id_puesto', 'id_language');
        return $this->hasMany('App\Models\IdiomaEmpleado', 'empleado_id')->with('language')->orderBy('id');
    }

    public function empleado_cursos()
    {
        return $this->hasMany(CursosDiplomasEmpleados::class)->orderByDesc('año');
    }

    public function empleado_educacion()
    {
        return $this->hasMany(EducacionEmpleados::class)->orderByDesc('año_fin');
    }

    public function empleado_documentos()
    {
        return $this->hasMany(EvidenciasDocumentosEmpleados::class);
    }

    public function empleado_documentos_certificados()
    {
        return $this->hasMany(EvidenciasDocumentosEmpleados::class);
    }

    public function foto_organizacion()
    {
        return $this->hasMany(Organizacion::class);
    }

    public function objetivos()
    {
        return $this->hasMany('App\Models\RH\ObjetivoEmpleado', 'empleado_id', 'id');
    }

    public function perfil()
    {
        return $this->belongsTo('App\Models\PerfilEmpleado', 'perfil_empleado_id', 'id');
    }

    // Recursos Humanos
    public function evaluadores()
    {
        return $this->belongsToMany('App\Models\Empleado', 'ev360_evaluado_evaluador', 'evaluador_id', 'id');
    }

    public function getJefeInmediatoAttribute()
    {
        return $this->supervisor ? $this->supervisor->name : $this->id;
    }

    public function getEmpleadosMismaAreaAttribute()
    {
        $by_area = self::where('id', '!=', $this->id)->where('area_id', $this->area_id)->pluck('id')->toArray();

        return $by_area;
    }

    public function getEmpleadosParesAttribute()
    {
        $por_par = self::where('id', '!=', $this->id)->where('perfil_empleado_id', $this->perfil_empleado_id)->pluck('id')->toArray();

        return $por_par;
    }
    //declaraciones

    public function getDeclaracionesResponsableAttribute()
    {
        $misDeclaraciones = DeclaracionAplicabilidadResponsable::select('id', 'declaracion_id')->where('empleado_id', $this->id)->pluck('declaracion_id')->toArray();

        return $misDeclaraciones;
    }

    public function getDeclaracionesAprobadorAttribute()
    {
        $misDeclaraciones = DeclaracionAplicabilidadAprobadores::select('id', 'declaracion_id')->where('aprobadores_id', $this->id)->pluck('declaracion_id')->toArray();

        return $misDeclaraciones;
    }

    public function getFechaIngresoAttribute()
    {
        return Carbon::parse($this->antiguedad)->format('d-m-Y');
    }

    //declaraciones iso

    public function getDeclaracionesResponsable2022Attribute()
    {
        $misDeclaraciones = DeclaracionAplicabilidadResponsableIso::select('id', 'declaracion_id')->where('empleado_id', $this->id)->pluck('declaracion_id')->toArray();

        return $misDeclaraciones;
    }

    public function getDeclaracionesAprobador2022Attribute()
    {
        $misDeclaraciones = DeclaracionAplicabilidadAprobarIso::select('id', 'declaracion_id')->where('empleado_id', $this->id)->pluck('declaracion_id')->toArray();

        return $misDeclaraciones;
    }

    public function getFechaIngreso2020Attribute()
    {
        return Carbon::parse($this->antiguedad)->format('d-m-Y');
    }

    // dependientes economicos
    public function dependientesEconomicos()
    {
        return $this->hasMany(DependientesEconomicosEmpleados::class, 'empleado_id', 'id')->orderBy('id');
    }

    public function contactosEmergencia()
    {
        return $this->hasMany(ContactosEmergenciaEmpleado::class, 'empleado_id', 'id')->orderBy('id');
    }

    public function beneficiarios()
    {
        return $this->hasMany(BeneficiariosEmpleado::class, 'empleado_id', 'id')->orderBy('id');
    }

    public function puesto()
    {
        return $this->hasMany(Puesto::class, 'id_reporta');
    }

    public function getObtenerAntiguedadAttribute()
    {
        $antiguedad = $this->calcularAntiguedad($this->antiguedad);
        $mensaje = '';
        // dd($antiguedad->format('%d'));
        if ($antiguedad->format('%Y') != '00') {
            $mensaje .= "{$antiguedad->format('%Y')} año(s)  ";
        }
        if ($antiguedad->format('%m') != '0') {
            $mensaje .= "{$antiguedad->format('%m')} mes(es)  ";
        }
        if ($antiguedad->format('%d') != '0') {
            $mensaje .= "{$antiguedad->format('%d')} día(s)";
        }

        return $mensaje;
        // return "Tiene {$antiguedad->format('%Y')} años, {$antiguedad->format('%m')} meses y {$antiguedad->format('%d')} días";
    }

    private function calcularAntiguedad($fecha)
    {
        $fecha_nac = new DateTime(date('Y/m/d', strtotime($fecha))); // Creo un objeto DateTime de la fecha ingresada
        $fecha_hoy = new DateTime(date('Y/m/d', time())); // Creo un objeto DateTime de la fecha de hoy
        $edad = date_diff($fecha_hoy, $fecha_nac); // La funcion ayuda a calcular la diferencia, esto seria un objeto

        return $edad;
    }

    public function configuracion_soporte()
    {
        return $this->hasMany(ConfigurarSoporteModel::class, 'id_elaboro');
    }

    public function contactos()
    {
        return $this->hasMany('App\Models\PuestoContactos', 'id_contacto')->orderBy('id');
    }

    public function getEsSupervisorAttribute()
    {
        return $this->onlyChildren->count() > 0 ? true : false;
    }

    public function timesheet()
    {
        return $this->hasMany(Timesheet::class, 'empleado_id', 'id')->orderBy('id')->with('horas');
    }

    public function comiteSeguridad()
    {
        return $this->hasMany(Comiteseguridad::class, 'id_asignada', 'id')->orderBy('id');
    }

    public function planificacion()
    {
        return $this->belongsToMany(PlanificacionControl::class, 'planificacion_id');
    }

    public function tratamiento()
    {
        return $this->belongsToMany(PlanificacionControl::class, 'tratamiento_id');
    }

    public function responsableTratamiento()
    {
        return $this->hasMany(TratamientoRiesgo::class, 'id_dueno', 'id')->alta()->with('area');
    }

    public function disponibilidad()
    {
        return $this->hasOne(DisponibilidadEmpleados::class, 'empleado_id', 'id');
    }

    // public function getDisposicionAttribute()
    // {
    //     return $this->disponibilidad->disposicion;
    // }
}
