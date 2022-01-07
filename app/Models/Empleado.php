<?php

namespace App\Models;

use App\Models\RH\BeneficiariosEmpleado;
use App\Models\RH\ContactosEmergenciaEmpleado;
use App\Models\RH\DependientesEconomicosEmpleados;
use Carbon\Carbon;
use DateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

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
 *
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
class Empleado extends Model
{
    use SoftDeletes;
    use HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

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
        'avatar', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'fecha_ingreso', 'saludo',
        'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad',
    ];
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
        'domicilio_personal',
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
    ];

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
        $hora = date('H');
        $saludo = '';
        $nombre = explode(' ', $this->name)[0];
        // if ($hora >= '12' && $hora <= '18') {
        //     $saludo = "Buenas Tardes, <strong style='font-size: 14px !important;'>{$nombre}</strong>";
        // } elseif ($hora >= '19' && $hora <= '23') {
        //     $saludo = "Buenas Noches, <strong style='font-size: 14px !important;'>{$nombre}</strong>";
        // } else {
        //     $saludo = "Buenos Días, <strong style='font-size: 14px !important;'>{$nombre}</strong>";
        // }

        $saludo = $nombre;

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
        return $this->belongsTo('App\Models\Puesto', 'puesto_id', 'id');
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
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'supervisor_id', 'id')->with('children', 'supervisor', 'area'); //Eager Loading utilizar solo para construir un arbol si no puede desbordar la pila
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

    public function empleado_experiencia()
    {
        return $this->hasMany(ExperienciaEmpleados::class);
    }

    public function empleado_certificaciones()
    {
        return $this->hasMany(CertificacionesEmpleados::class);
    }

    public function idiomas()
    {
        return $this->hasMany(IdiomaEmpleado::class, 'empleado_id', 'id');
    }

    public function empleado_cursos()
    {
        return $this->hasMany(CursosDiplomasEmpleados::class);
    }

    public function empleado_educacion()
    {
        return $this->hasMany(EducacionEmpleados::class);
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

    // public function getJefeInmediatoAttribute()
    // {
    //     return $this->supervisor ? $this->supervisor->id : $this->id;
    // }

    public function getEmpleadosMismaAreaAttribute()
    {
        $by_area = self::where('id', '!=', $this->id)->where('area_id', $this->area_id)->pluck('id')->toArray();

        return $by_area;
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
            $mensaje .= "{$antiguedad->format('%Y')} años  ";
        }
        if ($antiguedad->format('%m') != '0') {
            $mensaje .= "{$antiguedad->format('%m')} meses  ";
        }
        if ($antiguedad->format('%d') != '0') {
            $mensaje .= "{$antiguedad->format('%d')} días";
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
}
