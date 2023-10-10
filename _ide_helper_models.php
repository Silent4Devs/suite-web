<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AccionCorrectiva
 *
 * @property int $id
 * @property string|null $fecharegistro
 * @property string|null $tema
 * @property string|null $causaorigen
 * @property string|null $descripcion
 * @property string|null $metodo_causa
 * @property string|null $solucion
 * @property string|null $cierre_accion
 * @property string|null $estatus
 * @property string|null $fecha_compromiso
 * @property string|null $fecha_verificacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $nombrereporta_id
 * @property int|null $puestoreporta_id
 * @property int|null $nombreregistra_id
 * @property int|null $puestoregistra_id
 * @property int|null $responsable_accion_id
 * @property int|null $nombre_autoriza_id
 * @property int|null $team_id
 * @property int|null $id_registro
 * @property int|null $id_reporto
 * @property int|null $id_autorizo
 * @property int|null $id_atencion
 * @property string|null $fecha_cierre
 * @property string|null $folio
 * @property string|null $comentarios
 * @property string|null $areas
 * @property string|null $procesos
 * @property string|null $activos
 * @property bool $es_externo
 * @property bool $aprobada
 * @property bool $aprobacion_contestada
 * @property string|null $colaborador_quejado
 * @property string|null $otros
 * @property string|null $comentarios_aprobacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanaccionCorrectiva> $accioncorrectivaPlanaccionCorrectivas
 * @property-read int|null $accioncorrectiva_planaccion_correctivas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActividadAccionCorrectiva> $actividades
 * @property-read int|null $actividades_count
 * @property-read \App\Models\Tipoactivo|null $activo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AnalisisAccionCorrectiva> $analisis
 * @property-read int|null $analisis_count
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuejasCliente> $deskQuejaCliente
 * @property-read int|null $desk_queja_cliente_count
 * @property-read \App\Models\Empleado|null $empleados
 * @property-read mixed $documentometodo
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User|null $nombre_autoriza
 * @property-read \App\Models\User|null $nombreregistra
 * @property-read \App\Models\User|null $nombrereporta
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Proceso|null $proceso
 * @property-read \App\Models\Puesto|null $puestoregistra
 * @property-read \App\Models\Puesto|null $puestoreporta
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuejasCliente> $quejascliente
 * @property-read int|null $quejascliente_count
 * @property-read \App\Models\Empleado|null $reporto
 * @property-read \App\Models\User|null $responsable_accion
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereActivos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereAprobacionContestada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereAprobada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereAreas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereCausaorigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereCierreAccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereColaboradorQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereComentariosAprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereEsExterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereFechaCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereFechaCompromiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereFechaVerificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereFecharegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereIdAtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereIdAutorizo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereIdRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereIdReporto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereMetodoCausa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereNombreAutorizaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereNombreregistraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereNombrereportaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereOtros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereProcesos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva wherePuestoregistraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva wherePuestoreportaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereResponsableAccionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereSolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereTema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccionCorrectiva withoutTrashed()
 */
	class AccionCorrectiva extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AceptoPolitica
 *
 * @property int $id
 * @property int $id_politica
 * @property bool $acepto
 * @property int $id_empleado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Empleado $aceptador
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\PoliticaSgsi $politica
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica query()
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica whereAcepto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica whereIdEmpleado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica whereIdPolitica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AceptoPolitica whereUpdatedAt($value)
 */
	class AceptoPolitica extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActividadAccionCorrectiva
 *
 * @property int $id
 * @property int $accion_correctiva_id
 * @property string $actividad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $prioridad
 * @property string $tipo
 * @property string $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\AccionCorrectiva $accionCorrectiva
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsables
 * @property-read int|null $responsables_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereAccionCorrectivaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadAccionCorrectiva withoutTrashed()
 */
	class ActividadAccionCorrectiva extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActividadDenuncia
 *
 * @property int $id
 * @property int $denuncia_id
 * @property string $actividad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $prioridad
 * @property string $tipo
 * @property string $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Denuncias $denuncia
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsables
 * @property-read int|null $responsables_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereDenunciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadDenuncia withoutTrashed()
 */
	class ActividadDenuncia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActividadFase
 *
 * @property int $id
 * @property string $fase_nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanBaseActividade> $plan_base_actividades
 * @property-read int|null $plan_base_actividades_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase whereFaseNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadFase withoutTrashed()
 */
	class ActividadFase extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActividadIncidente
 *
 * @property int $id
 * @property int $seguridad_id
 * @property string $actividad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $prioridad
 * @property string $tipo
 * @property string $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\IncidentesSeguridad $incidente_seguridad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsables
 * @property-read int|null $responsables_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereSeguridadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadIncidente withoutTrashed()
 */
	class ActividadIncidente extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActividadMejora
 *
 * @property int $id
 * @property int $mejora_id
 * @property string $actividad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $prioridad
 * @property string $tipo
 * @property string $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Mejoras $mejora
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsables
 * @property-read int|null $responsables_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereMejoraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadMejora withoutTrashed()
 */
	class ActividadMejora extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActividadQueja
 *
 * @property int $id
 * @property int $queja_id
 * @property string $actividad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $prioridad
 * @property string $tipo
 * @property string $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Quejas $queja
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsables
 * @property-read int|null $responsables_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereQuejaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadQueja withoutTrashed()
 */
	class ActividadQueja extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActividadRiesgo
 *
 * @property int $id
 * @property int $riesgo_id
 * @property string $actividad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $prioridad
 * @property string $tipo
 * @property string $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsables
 * @property-read int|null $responsables_count
 * @property-read \App\Models\RiesgoIdentificado $riesgos_identificados
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereRiesgoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadRiesgo withoutTrashed()
 */
	class ActividadRiesgo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActividadSugerencia
 *
 * @property int $id
 * @property int $sugerencia_id
 * @property string $actividad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $prioridad
 * @property string $tipo
 * @property string $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsables
 * @property-read int|null $responsables_count
 * @property-read \App\Models\Sugerencias $sugerencia
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereSugerenciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadSugerencia withoutTrashed()
 */
	class ActividadSugerencia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class ActividadesPlanAuditorium.
 *
 * @property int $id
 * @property string|null $actividad_auditar
 * @property Carbon|null $fecha_act_auditoria
 * @property time without time zone|null $hora_inicio
 * @property time without time zone|null $hora_fin
 * @property int|null $id_contacto
 * @property int|null $plan_auditoria_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Empleado|null $empleado
 * @property PlanAuditorium|null $plan_auditorium
 * @property mixed|null $hora_inicio
 * @property mixed|null $hora_fin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium whereActividadAuditar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium whereFechaActAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium whereHoraFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium whereHoraInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium whereIdContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium wherePlanAuditoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActividadesPlanAuditorium whereUpdatedAt($value)
 */
	class ActividadesPlanAuditorium extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Activo
 *
 * @property int $id
 * @property string|null $nombreactivo
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $dueno_id
 * @property int|null $tipoactivo_id
 * @property int|null $subtipo_id
 * @property int|null $ubicacion_id
 * @property int|null $team_id
 * @property string|null $nombre_activo
 * @property \App\Models\Marca|null $marca
 * @property \App\Models\Modelo|null $modelo
 * @property string|null $n_serie
 * @property string|null $n_producto
 * @property string|null $fecha_fin
 * @property string|null $fecha_compra
 * @property int|null $id_responsable
 * @property string|null $observaciones
 * @property string|null $sede
 * @property string|null $documentos_relacionados
 * @property string|null $fecha_alta
 * @property string|null $fecha_baja
 * @property string|null $documento
 * @property string|null $identificador
 * @property int|null $proceso_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncidentesDeSeguridad> $activoIncidentesDeSeguridads
 * @property-read int|null $activo_incidentes_de_seguridads_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentoActivo> $documento_activo
 * @property-read int|null $documento_activo_count
 * @property-read \App\Models\Empleado|null $dueno
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \App\Models\Empleado|null $proceso
 * @property-read \App\Models\SubcategoriaActivo|null $subcategoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubcategoriaActivo> $subtipo
 * @property-read int|null $subtipo_count
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\Tipoactivo|null $tipoactivo
 * @property-read \App\Models\Sede|null $ubicacion
 * @method static \Illuminate\Database\Eloquent\Builder|Activo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDocumentosRelacionados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDuenoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaAlta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaBaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereIdResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereIdentificador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereModelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNombreactivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereProcesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereSubtipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereTipoactivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereUbicacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo withoutTrashed()
 */
	class Activo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ActivoInformacion
 *
 * @property int $id
 * @property string $identificador
 * @property string|null $nombreVP
 * @property int|null $duenoVP
 * @property int|null $nombre_direccion
 * @property int|null $custodioALDirector
 * @property string|null $activo_informacion
 * @property string|null $formato
 * @property int|null $proceso_id
 * @property int|null $creacion
 * @property int|null $recepcion
 * @property string|null $otra_recepcion
 * @property int|null $uso_digital
 * @property string|null $nombre_aplicacion
 * @property string|null $carpeta_compartida
 * @property string|null $otra_AppCarpeta
 * @property string|null $uso_fisico
 * @property string|null $otro
 * @property string|null $imprime
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $direccion_envio
 * @property int|null $vp_envio
 * @property int|null $envio_digital
 * @property string|null $otro_envio_digital
 * @property string|null $informacion_total
 * @property string|null $proveedor_envio
 * @property int|null $envio_ext
 * @property string|null $otro_envioExt
 * @property string|null $informacion_totalExt
 * @property string|null $acceso_informacionExt
 * @property string|null $requiere_info
 * @property int|null $almacenamiento_digital
 * @property int|null $almacenamiento_aplicacion
 * @property string|null $carpeta_compartida_almacenamiento
 * @property string|null $otra_AppCarpeta_almacenamiento
 * @property int|null $almacenamiento_fisico
 * @property string|null $otro_almacenamiento_fisico
 * @property string|null $ubicacion_fisica
 * @property string|null $almacenamiento_acceso
 * @property string|null $acceso_requerido
 * @property string|null $tiempo_almacenamiento
 * @property string|null $destruye
 * @property string|null $eliminacion_digital
 * @property string|null $otro_eliminacion
 * @property int|null $eliminacion_fisica
 * @property int|null $question
 * @property int|null $question_1
 * @property int|null $question_2
 * @property int|null $question_3
 * @property int|null $question_4
 * @property int|null $question_5
 * @property int|null $question_6
 * @property int|null $question_7
 * @property int|null $confidencialidad_id
 * @property int|null $integridad_id
 * @property int|null $disponibilidad_id
 * @property int|null $valor_criticidad
 * @property int|null $vp_id
 * @property int|null $name_direccion_id
 * @property int|null $nombredevp_id
 * @property int|null $matriz_id
 * @property bool $aceptado
 * @property string|null $persona_califico
 * @property string|null $puesto_califico
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveContenedor> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\activoConfidencialidad|null $confidencialidad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveContenedor> $contenedores
 * @property-read int|null $contenedores_count
 * @property-read \App\Models\Empleado|null $custodio
 * @property-read \App\Models\Area|null $direccion
 * @property-read \App\Models\activoDisponibilidad|null $disponibilidad
 * @property-read \App\Models\Empleado|null $dueno
 * @property-read mixed $color
 * @property-read mixed $content
 * @property-read mixed $name
 * @property-read mixed $nivel_riesgo_ai
 * @property-read mixed $riesgo_activo
 * @property-read \App\Models\activoIntegridad|null $integridad
 * @property-read \App\Models\Proceso|null $proceso
 * @property-read \App\Models\Grupo|null $vp
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereAccesoInformacionExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereAccesoRequerido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereAceptado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereActivoInformacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereAlmacenamientoAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereAlmacenamientoAplicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereAlmacenamientoDigital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereAlmacenamientoFisico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereCarpetaCompartida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereCarpetaCompartidaAlmacenamiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereConfidencialidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereCreacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereCustodioALDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereDestruye($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereDireccionEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereDisponibilidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereDuenoVP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereEliminacionDigital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereEliminacionFisica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereEnvioDigital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereEnvioExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereFormato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereIdentificador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereImprime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereInformacionTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereInformacionTotalExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereIntegridadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereMatrizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereNameDireccionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereNombreAplicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereNombreDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereNombreVP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereNombredevpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereOtraAppCarpeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereOtraAppCarpetaAlmacenamiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereOtraRecepcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereOtro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereOtroAlmacenamientoFisico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereOtroEliminacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereOtroEnvioDigital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereOtroEnvioExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion wherePersonaCalifico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereProcesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereProveedorEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion wherePuestoCalifico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereQuestion1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereQuestion2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereQuestion3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereQuestion4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereQuestion5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereQuestion6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereQuestion7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereRecepcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereRequiereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereTiempoAlmacenamiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereUbicacionFisica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereUsoDigital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereUsoFisico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereValorCriticidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereVpEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion whereVpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoInformacion withoutTrashed()
 */
	class ActivoInformacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class ActivosInformacionAprobacione.
 *
 * @property int $id
 * @property bool $aceptado
 * @property int $persona_califico_id
 * @property int $activoInformacion_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Empleado $empleado
 * @property ActivosInformacion $activos_informacion
 * @property int $carta_aceptacion_aprobacion_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\CartaAceptacionAprobacione $cartaAceptacionAprobacion
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione whereAceptado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione whereActivoInformacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione whereCartaAceptacionAprobacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione wherePersonaCalificoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivosInformacionAprobacione whereUpdatedAt($value)
 */
	class ActivosInformacionAprobacione extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AjustesAIA
 *
 * @property int $id
 * @property int|null $impacto_operativo
 * @property int|null $impacto_regulatorio
 * @property int|null $impacto_reputacion
 * @property int|null $impacto_social
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA query()
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA whereImpactoOperativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA whereImpactoRegulatorio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA whereImpactoReputacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA whereImpactoSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AjustesAIA withoutTrashed()
 */
	class AjustesAIA extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class AlcanceSgsi.
 *
 * @property int $id
 * @property string|null $alcancesgsi
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property Carbon|null $fecha_publicacion
 * @property Carbon|null $fecha_entrada
 * @property Carbon|null $fecha_revision
 * @property int|null $id_reviso_alcance
 * @property int|null $norma_id
 * @property Team|null $team
 * @property Empleado|null $empleado
 * @property Norma|null $norma
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $nombre
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Norma> $normas
 * @property-read int|null $normas_count
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereAlcancesgsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereFechaEntrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereFechaPublicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereFechaRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereIdRevisoAlcance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereNormaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AlcanceSgsi withoutTrashed()
 */
	class AlcanceSgsi extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Amenaza
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $categoria
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRiesgo> $matriz_riesgos
 * @property-read int|null $matriz_riesgos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vulnerabilidad> $vulnerabilidads
 * @property-read int|null $vulnerabilidads_count
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza query()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza whereCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenaza withoutTrashed()
 */
	class Amenaza extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class AmenazasEntendimientoOrganizacion.
 *
 * @property int $id
 * @property string|null $amenaza
 * @property string|null $riesgo
 * @property int|null $foda_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property EntendimientoOrganizacion|null $entendimiento_organizacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $tiene_riesgos_asociados
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRiesgo> $riesgos
 * @property-read int|null $riesgos_count
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion whereAmenaza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion whereFodaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion whereRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AmenazasEntendimientoOrganizacion whereUpdatedAt($value)
 */
	class AmenazasEntendimientoOrganizacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AnalisisAIA
 *
 * @property int $id
 * @property string|null $fecha_entrevista
 * @property string|null $entrevistado
 * @property string|null $puesto
 * @property string|null $area
 * @property int|null $extencion
 * @property string|null $correo
 * @property string|null $aplicaciones_a_cargo
 * @property string|null $id_aplicacion
 * @property string|null $nombre_aplicacion
 * @property string|null $version
 * @property string|null $objetivo_aplicacion
 * @property int|null $periodicidad
 * @property string|null $p_otro_txt
 * @property string|null $area_pertenece_aplicacion
 * @property string|null $area_responsable_aplicacion
 * @property string|null $titular_nombre
 * @property string|null $titular_a_paterno
 * @property string|null $titular_a_materno
 * @property string|null $titular_puesto
 * @property string|null $titular_correo
 * @property int|null $titular_extencion
 * @property string|null $suplente_nombre
 * @property string|null $suplente_a_paterno
 * @property string|null $suplente_a_materno
 * @property string|null $suplente_puesto
 * @property string|null $suplente_correo
 * @property int|null $suplente_extencion
 * @property string|null $supervisor_nombre
 * @property string|null $supervisor_a_paterno
 * @property string|null $supervisor_a_materno
 * @property string|null $supervisor_puesto
 * @property string|null $supervisor_correo
 * @property int|null $supervisor_extencion
 * @property string|null $flujo_q_1
 * @property string|null $flujo_q_2
 * @property string|null $flujo_q_5
 * @property string|null $app_ip
 * @property string|null $bd_ip
 * @property string|null $otro_ip
 * @property string|null $app_host
 * @property string|null $bd_host
 * @property string|null $otro_host
 * @property string|null $app_base
 * @property string|null $bd_base
 * @property string|null $otro_base
 * @property string|null $app_puerto
 * @property string|null $bd_puerto
 * @property string|null $otro_puerto
 * @property int|null $app_servidor
 * @property int|null $bd_servidor
 * @property int|null $otro_servidor
 * @property string|null $app_SO
 * @property string|null $bd_SO
 * @property string|null $otro_SO
 * @property int|null $app_acceso
 * @property int|null $bd_acceso
 * @property int|null $otro_acceso
 * @property string|null $app_url
 * @property string|null $bd_url
 * @property string|null $otro_url
 * @property string|null $app_ip_publica
 * @property string|null $bd_ip_publica
 * @property string|null $otro_ip_publica
 * @property int|null $app_certificado
 * @property int|null $bd_certificado
 * @property int|null $otro_certificado
 * @property string|null $app_tipo_cifrado
 * @property string|null $bd_tipo_cifrado
 * @property string|null $otro_tipo_cifrado
 * @property int|null $app_internet
 * @property int|null $bd_internet
 * @property int|null $otro_internet
 * @property string|null $app_datos_url
 * @property string|null $bd_datos_url
 * @property string|null $otro_datos_url
 * @property int|null $app_acceso_moviles
 * @property int|null $bd_acceso_moviles
 * @property int|null $otro_acceso_moviles
 * @property string|null $app_nombre_app_movil
 * @property string|null $bd_nombre_app_movil
 * @property string|null $otro_nombre_app_movil
 * @property int|null $app_interaccion_otras_apps
 * @property int|null $bd_interaccion_otras_apps
 * @property int|null $otro_interaccion_otras_apps
 * @property string|null $app_datos_interactuan
 * @property string|null $bd_datos_interactuan
 * @property string|null $otro_datos_interactuan
 * @property int|null $app_soporte_terceros
 * @property int|null $bd_soporte_terceros
 * @property int|null $otro_soporte_terceros
 * @property string|null $app_datos_terceros
 * @property string|null $bd_datos_terceros
 * @property string|null $otro_datos_terceros
 * @property int|null $app_instancia_balanceo
 * @property int|null $bd_instancia_balanceo
 * @property int|null $otro_instancia_balanceo
 * @property string|null $app_datos_balanceo
 * @property string|null $bd_datos_balanceo
 * @property string|null $otro_datos_balanceo
 * @property string|null $app_sofware_adicional
 * @property string|null $bd_sofware_adicional
 * @property string|null $otro_sofware_adicional
 * @property string|null $app_lenguajes
 * @property string|null $bd_lenguajes
 * @property string|null $otro_lenguajes
 * @property string|null $contingencia_app_ip
 * @property string|null $contingencia_bd_ip
 * @property string|null $contingencia_otro_ip
 * @property string|null $contingencia_app_host
 * @property string|null $contingencia_bd_host
 * @property string|null $contingencia_otro_host
 * @property int|null $contingencia_app_servidor
 * @property int|null $contingencia_bd_servidor
 * @property int|null $contingencia_otro_servidor
 * @property string|null $contingencia_app_SO
 * @property string|null $contingencia_bd_SO
 * @property string|null $contingencia_otro_SO
 * @property int|null $contingencia_app_acceso
 * @property int|null $contingencia_bd_acceso
 * @property int|null $contingencia_otro_acceso
 * @property string|null $contingencia_app_url
 * @property string|null $contingencia_bd_url
 * @property string|null $contingencia_otro_url
 * @property int $primer_semestre
 * @property int $segundo_semestre
 * @property int $ene
 * @property int $feb
 * @property int $mar
 * @property int $abr
 * @property int $may
 * @property int $jun
 * @property int $jul
 * @property int $ago
 * @property int $sep
 * @property int $oct
 * @property int $nov
 * @property int $dic
 * @property int $s1
 * @property int $s2
 * @property int $s3
 * @property int $s4
 * @property int $d1
 * @property int $d2
 * @property int $d3
 * @property int $d4
 * @property int $d5
 * @property int $d6
 * @property int $d7
 * @property int $d8
 * @property int $d9
 * @property int $d10
 * @property int $d11
 * @property int $d12
 * @property int $d13
 * @property int $d14
 * @property int $d15
 * @property int $d16
 * @property int $d17
 * @property int $d18
 * @property int $d19
 * @property int $d20
 * @property int $d21
 * @property int $d22
 * @property int $d23
 * @property int $d24
 * @property int $d25
 * @property int $d26
 * @property int $d27
 * @property int $d28
 * @property int $d29
 * @property int $d30
 * @property int $d31
 * @property int $h1
 * @property int $h2
 * @property int $h3
 * @property int $h4
 * @property int $h5
 * @property int $h6
 * @property int $h7
 * @property int $h8
 * @property int $h9
 * @property int $h10
 * @property int $h11
 * @property int $h12
 * @property int $h13
 * @property int $h14
 * @property int $h15
 * @property int $h16
 * @property int $h17
 * @property int $h18
 * @property int $h19
 * @property int $h20
 * @property int $h21
 * @property int $h22
 * @property int $h23
 * @property int $h24
 * @property int|null $rpo_mes
 * @property int|null $rpo_semana
 * @property int|null $rpo_dia
 * @property int|null $rpo_hora
 * @property int|null $rto_mes
 * @property int|null $rto_semana
 * @property int|null $rto_dia
 * @property int|null $rto_hora
 * @property int|null $wrt_mes
 * @property int|null $wrt_semana
 * @property int|null $wrt_dia
 * @property int|null $wrt_hora
 * @property int|null $mtpd_mes
 * @property int|null $mtpd_semana
 * @property int|null $mtpd_dia
 * @property int|null $mtpd_hora
 * @property string|null $respaldo_q_14
 * @property string|null $respaldo_q_15
 * @property string|null $respaldo_q_16
 * @property int $disruptivos_q_1
 * @property int $disruptivos_q_2
 * @property int $disruptivos_q_3
 * @property int $disruptivos_q_4
 * @property int $disruptivos_q_5
 * @property int $disruptivos_q_6
 * @property int $disruptivos_q_7
 * @property int $disruptivos_q_8
 * @property int $disruptivos_q_9
 * @property int $disruptivos_q_10
 * @property int $disruptivos_q_11
 * @property int|null $operacion_q_1
 * @property int|null $operacion_q_2
 * @property int|null $operacion_q_3
 * @property int|null $regulatorio_q_1
 * @property int|null $regulatorio_q_2
 * @property int|null $regulatorio_q_3
 * @property int|null $reputacion_q_1
 * @property int|null $reputacion_q_2
 * @property int|null $reputacion_q_3
 * @property int|null $social_q_1
 * @property int|null $social_q_2
 * @property int|null $social_q_3
 * @property string|null $incidentes_q_26
 * @property string|null $incidentes_q_27
 * @property string|null $q_19
 * @property string|null $firma_Entrevistado
 * @property string|null $firma_Jefe
 * @property string|null $firma_Entrevistador
 * @property bool|null $exite_firma_Entrevistado
 * @property bool|null $exite_firma_Jefe
 * @property bool|null $exite_firma_Entrevistador
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $productivo_desarrollo
 * @property int|null $interno_externo
 * @property int|null $operacion_q_4
 * @property int|null $regulatorio_q_4
 * @property int|null $reputacion_q_4
 * @property int|null $social_q_4
 * @property string|null $manejador_bd
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $cantidad_equipo_computo_contingencia
 * @property-read mixed $cantidad_equipo_computo_normal
 * @property-read mixed $cantidad_impresora_contingencia
 * @property-read mixed $cantidad_impresora_normal
 * @property-read mixed $cantidad_otros_contingencia
 * @property-read mixed $cantidad_otros_normal
 * @property-read mixed $cantidad_telefonia_contingencia
 * @property-read mixed $cantidad_telefonia_normal
 * @property-read mixed $cantidad_total_personas_contingencia
 * @property-read mixed $cantidad_total_personas_normal
 * @property-read mixed $criticidad_proceso
 * @property-read mixed $datos_personas_contingencia
 * @property-read mixed $datos_personas_contingencia_dif
 * @property-read mixed $descripcion_otros_normal
 * @property-read mixed $mtpd_horas
 * @property-read mixed $nivel_impacto
 * @property-read mixed $nivel_rto
 * @property-read mixed $operacion_promedio
 * @property-read mixed $regulatorio_promedio
 * @property-read mixed $reputacion_promedio
 * @property-read mixed $rowspan_ajuste
 * @property-read mixed $rpo_horas
 * @property-read mixed $rto_horas
 * @property-read mixed $social_promedio
 * @property-read mixed $total_impactos
 * @property-read mixed $wrt_horas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CuestionarioProporcionaInformacionAIA> $proporcionaInformacion
 * @property-read int|null $proporciona_informacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LiberaMantenimientoAIA> $proporcionaMantenimientos
 * @property-read int|null $proporciona_mantenimientos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CuestionarioRecursosHumanosAIA> $recursosHumanos
 * @property-read int|null $recursos_humanos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CuestionarioRecursosMaterialesAIA> $recursosMateriales
 * @property-read int|null $recursos_materiales_count
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAplicacionesACargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppAccesoMoviles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppCertificado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppDatosBalanceo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppDatosInteractuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppDatosTerceros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppDatosUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppInstanciaBalanceo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppInteraccionOtrasApps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppInternet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppIpPublica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppLenguajes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppNombreAppMovil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppPuerto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppSO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppServidor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppSofwareAdicional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppSoporteTerceros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppTipoCifrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAreaPerteneceAplicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereAreaResponsableAplicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdAccesoMoviles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdCertificado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdDatosBalanceo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdDatosInteractuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdDatosTerceros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdDatosUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdInstanciaBalanceo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdInteraccionOtrasApps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdInternet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdIpPublica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdLenguajes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdNombreAppMovil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdPuerto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdSO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdServidor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdSofwareAdicional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdSoporteTerceros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdTipoCifrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereBdUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaAppAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaAppHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaAppIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaAppSO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaAppServidor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaBdAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaBdHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaBdIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaBdSO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaBdServidor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaBdUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaOtroAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaOtroHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaOtroIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaOtroSO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaOtroServidor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereContingenciaOtroUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD11($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD12($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD13($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD14($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD15($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD16($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD17($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD18($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD19($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD20($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD21($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD22($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD23($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD24($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD25($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD26($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD27($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD28($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD29($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD30($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD31($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereD9($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ11($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereDisruptivosQ9($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereEne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereEntrevistado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereExiteFirmaEntrevistado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereExiteFirmaEntrevistador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereExiteFirmaJefe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereFeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereFechaEntrevista($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereFirmaEntrevistado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereFirmaEntrevistador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereFirmaJefe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereFlujoQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereFlujoQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereFlujoQ5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH11($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH12($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH13($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH14($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH15($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH16($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH17($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH18($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH19($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH20($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH21($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH22($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH23($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH24($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereH9($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereIdAplicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereIncidentesQ26($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereIncidentesQ27($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereInternoExterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereJul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereJun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereManejadorBd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereMar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereMay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereMtpdDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereMtpdHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereMtpdMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereMtpdSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereNombreAplicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereNov($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereObjetivoAplicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOperacionQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOperacionQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOperacionQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOperacionQ4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroAccesoMoviles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroCertificado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroDatosBalanceo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroDatosInteractuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroDatosTerceros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroDatosUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroInstanciaBalanceo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroInteraccionOtrasApps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroInternet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroIpPublica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroLenguajes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroNombreAppMovil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroPuerto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroSO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroServidor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroSofwareAdicional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroSoporteTerceros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroTipoCifrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereOtroUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA wherePOtroTxt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA wherePeriodicidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA wherePrimerSemestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereProductivoDesarrollo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereQ19($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRegulatorioQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRegulatorioQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRegulatorioQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRegulatorioQ4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereReputacionQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereReputacionQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereReputacionQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereReputacionQ4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRespaldoQ14($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRespaldoQ15($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRespaldoQ16($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRpoDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRpoHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRpoMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRpoSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRtoDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRtoHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRtoMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereRtoSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereS3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereS4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSegundoSemestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSocialQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSocialQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSocialQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSocialQ4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSupervisorAMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSupervisorAPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSupervisorCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSupervisorExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSupervisorNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSupervisorPuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSuplenteAMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSuplenteAPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSuplenteCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSuplenteExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSuplenteNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereSuplentePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereTitularAMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereTitularAPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereTitularCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereTitularExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereTitularNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereTitularPuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereWrtDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereWrtHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereWrtMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAIA whereWrtSemana($value)
 */
	class AnalisisAIA extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AnalisisAccionCorrectiva
 *
 * @property int $id
 * @property int|null $accion_correctiva_id
 * @property string|null $metodo
 * @property string|null $ideas
 * @property string|null $causa_ideas
 * @property string|null $problema_porque
 * @property string|null $porque_1
 * @property string|null $porque_2
 * @property string|null $porque_3
 * @property string|null $porque_4
 * @property string|null $porque_5
 * @property string|null $causa_porque
 * @property string|null $control_a
 * @property string|null $control_b
 * @property string|null $proceso_a
 * @property string|null $proceso_b
 * @property string|null $personas_a
 * @property string|null $personas_b
 * @property string|null $tecnologia_a
 * @property string|null $tecnologia_b
 * @property string|null $metodos_a
 * @property string|null $metodos_b
 * @property string|null $ambiente_a
 * @property string|null $ambiente_b
 * @property string|null $problema_diagrama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\AccionCorrectiva|null $accionCorrectiva
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereAccionCorrectivaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereAmbienteA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereAmbienteB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereCausaIdeas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereCausaPorque($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereControlA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereControlB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereIdeas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereMetodo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereMetodosA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereMetodosB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva wherePersonasA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva wherePersonasB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva wherePorque1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva wherePorque2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva wherePorque3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva wherePorque4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva wherePorque5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereProblemaDiagrama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereProblemaPorque($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereProcesoA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereProcesoB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereTecnologiaA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereTecnologiaB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisAccionCorrectiva withoutTrashed()
 */
	class AnalisisAccionCorrectiva extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class AnalisisBrecha.
 *
 * @property int $id
 * @property character varying $nombre
 * @property Carbon $fecha
 * @property character varying $porcentaje_implementacion
 * @property int|null $id_elaboro
 * @property int $estatus
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Empleado|null $empleado
 * @property Collection|GapLogroTre[] $gap_logro_tres
 * @property Collection|GapLogroDo[] $gap_logro_dos
 * @property Collection|GapLogroUno[] $gap_logro_unos
 * @property string|null $nombre
 * @property string|null $porcentaje_implementacion
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $gap_logro_dos_count
 * @property-read int|null $gap_logro_tres_count
 * @property-read int|null $gap_logro_unos_count
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha whereIdElaboro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha wherePorcentajeImplementacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrecha withoutTrashed()
 */
	class AnalisisBrecha extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class AnalisisDeRiesgo.
 *
 * @property int $id
 * @property string $nombre
 * @property string $tipo
 * @property Carbon $fecha
 * @property string $porcentaje_implementacion
 * @property int|null $id_empleado
 * @property int $estatus
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Empleado|null $empleado
 * @property Collection|MatrizRiesgo[] $matriz_riesgos
 * @property int|null $id_elaboro
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $matriz_riesgos_count
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereIdElaboro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo wherePorcentajeImplementacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisDeRiesgo withoutTrashed()
 */
	class AnalisisDeRiesgo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AnalisisImpacto
 *
 * @property int $id
 * @property string|null $fecha_entrevista
 * @property string|null $entrevistado
 * @property string|null $puesto
 * @property string|null $area
 * @property string|null $direccion
 * @property int|null $extencion
 * @property string|null $correo
 * @property string|null $procesos_a_cargo
 * @property string|null $id_proceso
 * @property string|null $nombre_proceso
 * @property string|null $version
 * @property string|null $tipo
 * @property string|null $objetivo_proceso
 * @property int|null $periodicidad
 * @property string|null $p_otro_txt
 * @property string|null $titular_nombre
 * @property string|null $titular_a_paterno
 * @property string|null $titular_a_materno
 * @property string|null $titular_puesto
 * @property string|null $titular_correo
 * @property int|null $titular_extencion
 * @property string|null $suplente_nombre
 * @property string|null $suplente_a_paterno
 * @property string|null $suplente_a_materno
 * @property string|null $suplente_puesto
 * @property string|null $suplente_correo
 * @property int|null $suplente_extencion
 * @property string|null $supervisor_nombre
 * @property string|null $supervisor_a_paterno
 * @property string|null $supervisor_a_materno
 * @property string|null $supervisor_puesto
 * @property string|null $supervisor_correo
 * @property int|null $supervisor_extencion
 * @property string|null $flujo_q_1
 * @property string|null $flujo_q_2
 * @property string|null $flujo_q_4
 * @property int $periodicidad_diario
 * @property int $periodicidad_quincenal
 * @property int $periodicidad_mensual
 * @property int $periodicidad_otro
 * @property string|null $periodicidad_flujo_txt
 * @property string|null $flujo_q_6
 * @property string|null $flujo_q_7
 * @property string|null $flujo_q_8
 * @property string|null $flujo_q_10
 * @property int $flujo_años
 * @property int $flujo_meses
 * @property int $flujo_semanas
 * @property int $flujo_dias
 * @property int $flujo_otro
 * @property string|null $flujo_otro_txt
 * @property string|null $respaldo_q_20
 * @property string|null $respaldo_q_21
 * @property string|null $respaldo_q_22
 * @property string|null $respaldo_q_23
 * @property int $disruptivos_q_1
 * @property int $disruptivos_q_2
 * @property int $disruptivos_q_3
 * @property int $disruptivos_q_4
 * @property int $disruptivos_q_5
 * @property int $disruptivos_q_6
 * @property int $disruptivos_q_7
 * @property int $disruptivos_q_8
 * @property int $disruptivos_q_9
 * @property int $disruptivos_q_10
 * @property int $disruptivos_q_11
 * @property int|null $operacion_q_1
 * @property int|null $operacion_q_2
 * @property int|null $operacion_q_3
 * @property int|null $regulatorio_q_1
 * @property int|null $regulatorio_q_2
 * @property int|null $regulatorio_q_3
 * @property int|null $reputacion_q_1
 * @property int|null $reputacion_q_2
 * @property int|null $reputacion_q_3
 * @property int|null $social_q_1
 * @property int|null $social_q_2
 * @property int|null $social_q_3
 * @property string|null $incidentes_q_26
 * @property string|null $incidentes_q_27
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $firma_Entrevistado
 * @property string|null $firma_Jefe
 * @property string|null $firma_Entrevistador
 * @property bool|null $exite_firma_Entrevistado
 * @property bool|null $exite_firma_Jefe
 * @property bool|null $exite_firma_Entrevistador
 * @property int $primer_semestre
 * @property int $segundo_semestre
 * @property int $ene
 * @property int $feb
 * @property int $mar
 * @property int $abr
 * @property int $may
 * @property int $jun
 * @property int $jul
 * @property int $ago
 * @property int $sep
 * @property int $oct
 * @property int $nov
 * @property int $dic
 * @property int $s1
 * @property int $s2
 * @property int $s3
 * @property int $s4
 * @property int $d1
 * @property int $d2
 * @property int $d3
 * @property int $d4
 * @property int $d5
 * @property int $d6
 * @property int $d7
 * @property int $d8
 * @property int $d9
 * @property int $d10
 * @property int $d11
 * @property int $d12
 * @property int $d13
 * @property int $d14
 * @property int $d15
 * @property int $d16
 * @property int $d17
 * @property int $d18
 * @property int $d19
 * @property int $d20
 * @property int $d21
 * @property int $d22
 * @property int $d23
 * @property int $d24
 * @property int $d25
 * @property int $d26
 * @property int $d27
 * @property int $d28
 * @property int $d29
 * @property int $d30
 * @property int $d31
 * @property int $h1
 * @property int $h2
 * @property int $h3
 * @property int $h4
 * @property int $h5
 * @property int $h6
 * @property int $h7
 * @property int $h8
 * @property int $h9
 * @property int $h10
 * @property int $h11
 * @property int $h12
 * @property int $h13
 * @property int $h14
 * @property int $h15
 * @property int $h16
 * @property int $h17
 * @property int $h18
 * @property int $h19
 * @property int $h20
 * @property int $h21
 * @property int $h22
 * @property int $h23
 * @property int $h24
 * @property string|null $macroproceso
 * @property string|null $subproceso
 * @property int|null $rpo_mes
 * @property int|null $rpo_semana
 * @property int|null $rpo_dia
 * @property int|null $rpo_hora
 * @property int|null $rto_mes
 * @property int|null $rto_semana
 * @property int|null $rto_dia
 * @property int|null $rto_hora
 * @property int|null $wrt_mes
 * @property int|null $wrt_semana
 * @property int|null $wrt_dia
 * @property int|null $wrt_hora
 * @property int|null $mtpd_mes
 * @property int|null $mtpd_semana
 * @property int|null $mtpd_dia
 * @property int|null $mtpd_hora
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $cantidad_equipo_computo_contingencia
 * @property-read mixed $cantidad_equipo_computo_normal
 * @property-read mixed $cantidad_impresora_contingencia
 * @property-read mixed $cantidad_impresora_normal
 * @property-read mixed $cantidad_otros_contingencia
 * @property-read mixed $cantidad_otros_normal
 * @property-read mixed $cantidad_proporciona_informacion
 * @property-read mixed $cantidad_recibe_informacion
 * @property-read mixed $cantidad_telefonia_contingencia
 * @property-read mixed $cantidad_telefonia_normal
 * @property-read mixed $cantidad_total_personas_contingencia
 * @property-read mixed $cantidad_total_personas_normal
 * @property-read mixed $criticidad_proceso
 * @property-read mixed $diferencia_flujo_informacion
 * @property-read mixed $mtpd_horas
 * @property-read mixed $nivel_impacto
 * @property-read mixed $nivel_rto
 * @property-read mixed $operacion_promedio
 * @property-read mixed $regulatorio_promedio
 * @property-read mixed $reputacion_promedio
 * @property-read mixed $rpo_horas
 * @property-read mixed $rto_horas
 * @property-read mixed $social_promedio
 * @property-read mixed $total_impactos
 * @property-read mixed $wrt_horas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CuestionarioProporcionaInformacion> $proporcionaInformacion
 * @property-read int|null $proporciona_informacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CuestionarioRecibeInformacion> $recibeInformacion
 * @property-read int|null $recibe_informacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CuestionarioRecursosHumanos> $recursosHumanos
 * @property-read int|null $recursos_humanos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CuestionarioRecursosMateriales> $recursosMateriales
 * @property-read int|null $recursos_materiales_count
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereAbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereAgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD11($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD12($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD13($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD14($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD15($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD16($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD17($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD18($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD19($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD20($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD21($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD22($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD23($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD24($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD25($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD26($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD27($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD28($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD29($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD30($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD31($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereD9($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ11($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereDisruptivosQ9($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereEne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereEntrevistado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereExiteFirmaEntrevistado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereExiteFirmaEntrevistador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereExiteFirmaJefe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFechaEntrevista($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFirmaEntrevistado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFirmaEntrevistador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFirmaJefe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoAños($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoDias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoMeses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoOtro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoOtroTxt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoQ10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoQ4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoQ6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoQ7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoQ8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereFlujoSemanas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH11($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH12($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH13($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH14($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH15($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH16($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH17($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH18($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH19($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH20($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH21($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH22($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH23($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH24($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereH9($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereIncidentesQ26($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereIncidentesQ27($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereJul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereJun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereMacroproceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereMar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereMay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereMtpdDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereMtpdHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereMtpdMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereMtpdSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereNombreProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereNov($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereObjetivoProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereOct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereOperacionQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereOperacionQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereOperacionQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePOtroTxt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePeriodicidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePeriodicidadDiario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePeriodicidadFlujoTxt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePeriodicidadMensual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePeriodicidadOtro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePeriodicidadQuincenal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePrimerSemestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereProcesosACargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRegulatorioQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRegulatorioQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRegulatorioQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereReputacionQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereReputacionQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereReputacionQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRespaldoQ20($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRespaldoQ21($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRespaldoQ22($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRespaldoQ23($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRpoDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRpoHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRpoMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRpoSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRtoDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRtoHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRtoMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereRtoSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereS3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereS4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSegundoSemestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSocialQ1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSocialQ2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSocialQ3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSubproceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSupervisorAMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSupervisorAPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSupervisorCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSupervisorExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSupervisorNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSupervisorPuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSuplenteAMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSuplenteAPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSuplenteCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSuplenteExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSuplenteNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereSuplentePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereTitularAMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereTitularAPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereTitularCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereTitularExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereTitularNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereTitularPuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereWrtDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereWrtHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereWrtMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisImpacto whereWrtSemana($value)
 */
	class AnalisisImpacto extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AnalisisQuejasClientes
 *
 * @property int $id
 * @property int|null $quejas_clientes_id
 * @property string|null $metodo
 * @property string|null $ideas
 * @property string|null $causa_ideas
 * @property string|null $problema_porque
 * @property string|null $porque_1
 * @property string|null $porque_2
 * @property string|null $porque_3
 * @property string|null $porque_4
 * @property string|null $porque_5
 * @property string|null $causa_porque
 * @property string|null $control_a
 * @property string|null $control_b
 * @property string|null $proceso_a
 * @property string|null $proceso_b
 * @property string|null $personas_a
 * @property string|null $personas_b
 * @property string|null $tecnologia_a
 * @property string|null $tecnologia_b
 * @property string|null $metodos_a
 * @property string|null $metodos_b
 * @property string|null $ambiente_a
 * @property string|null $ambiente_b
 * @property string|null $problema_diagrama
 * @property string|null $formulario
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\QuejasCliente|null $quejasClientes
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereAmbienteA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereAmbienteB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereCausaIdeas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereCausaPorque($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereControlA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereControlB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereFormulario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereIdeas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereMetodo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereMetodosA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereMetodosB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes wherePersonasA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes wherePersonasB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes wherePorque1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes wherePorque2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes wherePorque3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes wherePorque4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes wherePorque5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereProblemaDiagrama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereProblemaPorque($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereProcesoA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereProcesoB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereQuejasClientesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereTecnologiaA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereTecnologiaB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisQuejasClientes withoutTrashed()
 */
	class AnalisisQuejasClientes extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AnalisisSeguridad
 *
 * @property int $id
 * @property int|null $seguridad_id
 * @property int|null $riesgos_id
 * @property int|null $quejas_id
 * @property int|null $denuncias_id
 * @property int|null $mejoras_id
 * @property int|null $sugerencias_id
 * @property string|null $formulario
 * @property string|null $causa_ideas
 * @property string|null $ideas
 * @property string|null $problema_porque
 * @property string|null $porque_1
 * @property string|null $porque_2
 * @property string|null $porque_3
 * @property string|null $porque_4
 * @property string|null $porque_5
 * @property string|null $causa_porque
 * @property string|null $problema_diagrama
 * @property string|null $control_a
 * @property string|null $control_b
 * @property string|null $proceso_a
 * @property string|null $proceso_b
 * @property string|null $personas_a
 * @property string|null $personas_b
 * @property string|null $tecnologia_a
 * @property string|null $tecnologia_b
 * @property string|null $metodos_a
 * @property string|null $metodos_b
 * @property string|null $ambiente_a
 * @property string|null $ambiente_b
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\IncidentesSeguridad|null $seguridad
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereAmbienteA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereAmbienteB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereCausaIdeas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereCausaPorque($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereControlA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereControlB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereDenunciasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereFormulario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereIdeas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereMejorasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereMetodosA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereMetodosB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad wherePersonasA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad wherePersonasB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad wherePorque1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad wherePorque2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad wherePorque3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad wherePorque4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad wherePorque5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereProblemaDiagrama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereProblemaPorque($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereProcesoA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereProcesoB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereQuejasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereRiesgosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereSeguridadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereSugerenciasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereTecnologiaA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereTecnologiaB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisSeguridad whereUpdatedAt($value)
 */
	class AnalisisSeguridad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Archivo
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $carpeta_id
 * @property int|null $team_id
 * @property int|null $estado_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Carpetum $carpeta
 * @property-read \App\Models\EstadoDocumento|null $estado
 * @property-read mixed $nombre
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo whereCarpetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Archivo withoutTrashed()
 */
	class Archivo extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Area.
 *
 * @property int $id
 * @property string|null $area
 * @property int|null $id_grupo
 * @property int|null $id_reporta
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property Grupo|null $grupo
 * @property Team|null $team
 * @property Collection|Area[] $areas
 * @property Collection|ConcientizacionSgi[] $concientizacion_sgis
 * @property Collection|Empleado[] $empleados
 * @property Collection|MaterialIsoVeinticiente[] $material_iso_veinticientes
 * @property Collection|MaterialSgsi[] $material_sgsis
 * @property Collection|User[] $users
 * @property string|null $foto_area
 * @property int|null $empleados_id
 * @property-read int|null $areas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Area> $children
 * @property-read int|null $children_count
 * @property-read int|null $concientizacion_sgis_count
 * @property-read int|null $empleados_count
 * @property-read mixed $foto_ruta
 * @property-read mixed $grupo_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IndicadoresSgsi> $indicadores_sistema_gestion
 * @property-read int|null $indicadores_sistema_gestion_count
 * @property-read \App\Models\Empleado|null $lider
 * @property-read int|null $material_iso_veinticientes_count
 * @property-read int|null $material_sgsis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRiesgo> $matriz_riesgos
 * @property-read int|null $matriz_riesgos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Puesto> $puesto
 * @property-read int|null $puesto_count
 * @property-read Area|null $supervisor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $totalEmpleados
 * @property-read int|null $total_empleados_count
 * @property-read int|null $users_count
 * @method static \Database\Factories\AreaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Area filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Area paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Area query()
 * @method static \Illuminate\Database\Eloquent\Builder|Area simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereEmpleadosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereFotoArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereIdGrupo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereIdReporta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Area withoutTrashed()
 */
	class Area extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Audit.
 *
 * @property int $id
 * @property string|null $user_type
 * @property int|null $user_id
 * @property string $event
 * @property string $auditable_type
 * @property int $auditable_id
 * @property string|null $old_values
 * @property string|null $new_values
 * @property string|null $url
 * @property inet|null $ip_address
 * @property string|null $user_agent
 * @property string|null $tags
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Audit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereAuditableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereAuditableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserType($value)
 */
	class Audit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AuditLog
 *
 * @property int $id
 * @property string $description
 * @property int|null $subject_id
 * @property string|null $subject_type
 * @property int|null $user_id
 * @property \Illuminate\Support\Collection|null $properties
 * @property string|null $host
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereUserId($value)
 */
	class AuditLog extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AuditoriaAnual
 *
 * @property int $id
 * @property string|null $fechainicio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $fechafin
 * @property string|null $objetivo
 * @property string|null $alcance
 * @property string|null $nombre
 * @property-read \App\Models\Empleado|null $auditorlider
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AuditoriaAnualDocumento> $documentos_material
 * @property-read int|null $documentos_material_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanAuditorium> $fechaPlanAuditoria
 * @property-read int|null $fecha_plan_auditoria_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AuditoriaAnualDocumento> $programa
 * @property-read int|null $programa_count
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereAlcance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereFechafin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereFechainicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnual withoutTrashed()
 */
	class AuditoriaAnual extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AuditoriaAnualDocumento
 *
 * @property int $id
 * @property int|null $id_auditoria_anuals
 * @property string $documento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AuditoriaAnual|null $auditoria_anual
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnualDocumento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnualDocumento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnualDocumento query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnualDocumento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnualDocumento whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnualDocumento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnualDocumento whereIdAuditoriaAnuals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaAnualDocumento whereUpdatedAt($value)
 */
	class AuditoriaAnualDocumento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AuditoriaInterna
 *
 * @property int $id
 * @property string $alcance
 * @property string|null $hallazgos
 * @property bool|null $cheknoconformidadmenor
 * @property float|null $totalnoconformidadmenor
 * @property bool|null $checknoconformidadmayor
 * @property float|null $totalnoconformidadmayor
 * @property bool|null $checkobservacion
 * @property float|null $totalobservacion
 * @property bool|null $checkmejora
 * @property float|null $totalmejora
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $auditorlider_id
 * @property int|null $equipoauditoria_id
 * @property int|null $clausulas_id
 * @property int|null $team_id
 * @property int|null $lider_id
 * @property string|null $objetivo
 * @property string|null $auditor_externo
 * @property string|null $fecha_inicio
 * @property string|null $criterios_auditoria
 * @property string|null $id_auditoria
 * @property string|null $nombre_auditoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AuditoriaInternasHallazgos> $auditoriaHallazgos
 * @property-read int|null $auditoria_hallazgos_count
 * @property-read \App\Models\User|null $auditorlider
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Clausula> $clausulas
 * @property-read int|null $clausulas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $equipo
 * @property-read int|null $equipo_count
 * @property-read \App\Models\User|null $equipoauditoria
 * @property mixed $fechaauditoria
 * @property-read mixed $logotipo
 * @property-read \App\Models\Empleado|null $lider
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereAlcance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereAuditorExterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereAuditorliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereCheckmejora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereChecknoconformidadmayor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereCheckobservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereCheknoconformidadmenor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereClausulasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereCriteriosAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereEquipoauditoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereHallazgos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereIdAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereLiderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereNombreAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereTotalmejora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereTotalnoconformidadmayor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereTotalnoconformidadmenor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereTotalobservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInterna withoutTrashed()
 */
	class AuditoriaInterna extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AuditoriaInternasHallazgos
 *
 * @property int $id
 * @property string|null $incumplimiento_requisito
 * @property string|null $descripcion
 * @property string|null $clasificacion_hallazgo
 * @property int|null $auditoria_internas_id
 * @property int|null $area_id
 * @property int|null $proceso_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Area|null $areas
 * @property-read \App\Models\AuditoriaInterna|null $auditoriaInterna
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Proceso|null $procesos
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereAuditoriaInternasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereClasificacionHallazgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereIncumplimientoRequisito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereProcesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditoriaInternasHallazgos withoutTrashed()
 */
	class AuditoriaInternasHallazgos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Calendario
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $fecha
 * @property string|null $categoria
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario whereCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendario withoutTrashed()
 */
	class Calendario extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CalendarioOficial
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $fecha
 * @property string|null $categoria
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial query()
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial whereCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarioOficial withoutTrashed()
 */
	class CalendarioOficial extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Carpetum
 *
 * @property int $id
 * @property string|null $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum query()
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Carpetum withoutTrashed()
 */
	class Carpetum extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class CartaAceptacion.
 *
 * @property int $id
 * @property string|null $folio_riesgo
 * @property Carbon|null $fecharegistro
 * @property Carbon|null $fechaaprobacion
 * @property int|null $responsable_id
 * @property string|null $activo_folio
 * @property string|null $nombre_activo
 * @property string|null $criticidad_activo
 * @property string|null $confidencialidad
 * @property string|null $descripcion_negocio
 * @property string|null $descripcion_tecnologico
 * @property int|null $legal
 * @property int|null $cumplimiento
 * @property int|null $operacional
 * @property int|null $reputacional
 * @property int|null $financiero
 * @property int|null $tecnologico
 * @property string|null $aceptacion_riesgo
 * @property string|null $hallazgo
 * @property string|null $controles_compensatorios
 * @property string|null $recomendaciones
 * @property int|null $controles_id
 * @property int|null $director_resp_id
 * @property Carbon|null $fecha_aut_direct
 * @property int|null $vp_responsable_id
 * @property Carbon|null $fecha_vp_aut
 * @property int|null $presidencia_id
 * @property Carbon|null $fecha_aut_presidencia
 * @property int|null $vice_operaciones_id
 * @property Carbon|null $fecha_aut_viceoperaciones
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Empleado|null $empleado
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property string|null $descripcion_riesgo
 * @property string|null $hallazgos_auditoria
 * @property int|null $proceso_id
 * @property bool $aceptado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CartaAceptacionAprobacione> $aprobaciones
 * @property-read int|null $aprobaciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CartaAceptacionPivot> $controles
 * @property-read int|null $controles_count
 * @property-read \App\Models\Empleado|null $directores
 * @property-read mixed $fechaautdirect
 * @property-read mixed $fechaautpresidencia
 * @property-read mixed $fechaautviceoperaciones
 * @property-read mixed $fechavpaut
 * @property-read \App\Models\Empleado|null $presidentes
 * @property-read \App\Models\MatrizOctaveProceso|null $proceso
 * @property-read \App\Models\Empleado|null $responsables
 * @property-read \App\Models\Empleado|null $vicepresidentes
 * @property-read \App\Models\Empleado|null $vicepresidentesOperaciones
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereAceptacionRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereAceptado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereControlesCompensatorios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereDescripcionNegocio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereDescripcionRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereDescripcionTecnologico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereDirectorRespId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereFechaAutDirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereFechaAutPresidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereFechaAutViceoperaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereFechaVpAut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereFechaaprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereFecharegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereFolioRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereHallazgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereHallazgosAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion wherePresidenciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereProcesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereRecomendaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereViceOperacionesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacion whereVpResponsableId($value)
 */
	class CartaAceptacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class CartaAceptacionAprobacione.
 *
 * @property int $id
 * @property int $aprobador_id
 * @property string $autoridad
 * @property string|null $comentarios
 * @property string $firma
 * @property int $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Empleado $empleado
 * @property int $carta_id
 * @property string|null $fecha_aprobacion
 * @property int $nivel
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivosInformacionAprobacione> $aprobacionesActivo
 * @property-read int|null $aprobaciones_activo_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\CartaAceptacion $carta
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereAprobadorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereAutoridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereCartaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereFechaAprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereFirma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionAprobacione withoutTrashed()
 */
	class CartaAceptacionAprobacione extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class CartaAceptacionPivot.
 *
 * @property int $id
 * @property int|null $controles_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property int|null $carta_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\CartaAceptacion|null $carta
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionPivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionPivot whereCartaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionPivot whereControlesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionPivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionPivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartaAceptacionPivot whereUpdatedAt($value)
 */
	class CartaAceptacionPivot extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CategoriaCapacitacion
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Recurso> $recursos
 * @property-read int|null $recursos_count
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaCapacitacion withoutTrashed()
 */
	class CategoriaCapacitacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CategoriaIncidente
 *
 * @property int $id
 * @property string $categoria
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaIncidente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaIncidente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaIncidente query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaIncidente whereCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaIncidente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaIncidente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoriaIncidente whereUpdatedAt($value)
 */
	class CategoriaIncidente extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CertificacionesEmpleados
 *
 * @property int $id
 * @property int|null $empleado_id
 * @property string|null $nombre
 * @property string|null $estatus
 * @property string|null $vigencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $documento
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado_certificaciones
 * @property-read mixed $ruta_documento
 * @property-read mixed $vigencia_string_formated
 * @property-read mixed $vigencia_ymd
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados query()
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados whereVigencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CertificacionesEmpleados withoutTrashed()
 */
	class CertificacionesEmpleados extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Clausula.
 *
 * @property int $id
 * @property character varying $nombre
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property character varying|null $modulo
 * @property Collection|AuditoriaInternoClausula[] $auditoria_interno_clausulas
 * @property Collection|PartesInteresada[] $partes_interesadas
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $modulo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $partes_interesadas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula query()
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula whereModulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Clausula withoutTrashed()
 */
	class Clausula extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Comiteseguridad
 *
 * @property int $id
 * @property string $nombre_comite
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $miembros
 * @property-read int|null $miembros_count
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad whereNombreComite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comiteseguridad withoutTrashed()
 */
	class Comiteseguridad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Competencium
 *
 * @property int $id
 * @property string|null $perfilpuesto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $nombrecolaborador_id
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $certificados
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $nombrecolaborador
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium query()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium whereNombrecolaboradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium wherePerfilpuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencium withoutTrashed()
 */
	class Competencium extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ComunicacionSgi
 *
 * @property int $id
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property int|null $id_publico
 * @property string|null $fecha_publicacion
 * @property string|null $titulo
 * @property string|null $publicar_en
 * @property string|null $habilitar
 * @property string|null $link
 * @property string|null $fecha_programable
 * @property string|null $fecha_programable_fin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentoComunicacionSgis> $documentos_comunicacion
 * @property-read int|null $documentos_comunicacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $empleados
 * @property-read int|null $empleados_count
 * @property-read mixed $archivo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ImagenesComunicacionSgis> $imagenes_comunicacion
 * @property-read int|null $imagenes_comunicacion_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereFechaProgramable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereFechaProgramableFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereFechaPublicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereHabilitar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereIdPublico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi wherePublicarEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ComunicacionSgi withoutTrashed()
 */
	class ComunicacionSgi extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ConcientizacionSgi
 *
 * @property int $id
 * @property string $objetivocomunicado
 * @property string|null $personalobjetivo
 * @property string|null $medio_envio
 * @property string|null $fecha_publicacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $arearesponsable_id
 * @property int|null $team_id
 * @property-read \App\Models\Area|null $arearesponsable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentoConcientizacionSgis> $documentos_concientizacion
 * @property-read int|null $documentos_concientizacion_count
 * @property-read mixed $archivo
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereArearesponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereFechaPublicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereMedioEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereObjetivocomunicado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi wherePersonalobjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConcientizacionSgi withoutTrashed()
 */
	class ConcientizacionSgi extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ConfigurarSoporteModel
 *
 * @property int $id
 * @property string|null $rol
 * @property string|null $puesto
 * @property string|null $telefono
 * @property string|null $extension
 * @property string|null $tel_celular
 * @property string|null $correo
 * @property int|null $id_elaboro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereIdElaboro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereTelCelular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurarSoporteModel whereUpdatedAt($value)
 */
	class ConfigurarSoporteModel extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ContactosExternosPuestos
 *
 * @property int $id
 * @property string|null $nombre_contacto_int
 * @property string|null $proposito
 * @property int|null $puesto_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Puesto|null $puesto
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos whereNombreContactoInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos whereProposito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosExternosPuestos whereUpdatedAt($value)
 */
	class ContactosExternosPuestos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * Class AmpliacionContrato.
 *
 * @property int $id
 * @property int|null $contrato_id
 * @property float|null $importe
 * @property float|null $monto_total_ampliado
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property Contrato|null $contrato
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|AmpliacionContrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AmpliacionContrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AmpliacionContrato query()
 */
	class AmpliacionContrato extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Bitacora
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora withoutTrashed()
 */
	class Bitacora extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\CedulaCumplimiento
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ContractManager\Contrato|null $contrato
 * @method static \Illuminate\Database\Eloquent\Builder|CedulaCumplimiento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CedulaCumplimiento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CedulaCumplimiento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CedulaCumplimiento query()
 * @method static \Illuminate\Database\Eloquent\Builder|CedulaCumplimiento withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CedulaCumplimiento withoutTrashed()
 */
	class CedulaCumplimiento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\CentroCosto
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CentroCosto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CentroCosto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CentroCosto query()
 */
	class CentroCosto extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ChFavorite
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite query()
 */
	class ChFavorite extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ChMessage
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage query()
 */
	class ChMessage extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\CierreContrato
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|CierreContrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CierreContrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CierreContrato onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CierreContrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|CierreContrato withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CierreContrato withoutTrashed()
 */
	class CierreContrato extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Comprador
 *
 * @property-read \App\Models\Empleado|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Comprador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comprador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comprador query()
 */
	class Comprador extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * Class Contrato.
 *
 * @version November 25, 2020, 3:51 pm UTC
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\AmpliacionContrato> $ampliaciones
 * @property-read int|null $ampliaciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\CedulaCumplimiento> $cedulas
 * @property-read int|null $cedulas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\ConveniosModificatorios> $convenios
 * @property-read int|null $convenios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\DolaresContrato> $dolares
 * @property-read int|null $dolares_count
 * @property-read mixed $archivo
 * @property-read mixed $name_proveedor
 * @property-read \App\Models\TimesheetCliente|null $proveedor
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato withoutTrashed()
 */
	class Contrato extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ConveniosModificatorios
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ContractManager\Contrato|null $contrato
 * @property-read \App\Models\ContractManager\ConveniosModificatoriosFile|null $file
 * @property-read mixed $archivo
 * @property-read ConveniosModificatorios|null $modificados
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatorios newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatorios newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatorios onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatorios query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatorios withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatorios withoutTrashed()
 */
	class ConveniosModificatorios extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ConveniosModificatoriosFile
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatoriosFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatoriosFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatoriosFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatoriosFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatoriosFile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConveniosModificatoriosFile withoutTrashed()
 */
	class ConveniosModificatoriosFile extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Documento
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $tipo
 * @property int|null $macroproceso_id
 * @property int|null $proceso_id
 * @property string $estatus
 * @property string $version
 * @property string $fecha
 * @property string $archivo
 * @property int|null $elaboro_id
 * @property int|null $reviso_id
 * @property int|null $aprobo_id
 * @property int|null $responsable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Documento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento query()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereAproboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereElaboroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereMacroprocesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereProcesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereRevisoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereVersion($value)
 */
	class Documento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * Class DolaresContrato.
 *
 * @property int $id
 * @property int|null $contrato_id
 * @property float|null $monto_dolares
 * @property float|null $maximo_dolares
 * @property float|null $minimo_dolares
 * @property string|null $valor_dolar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ContractManager\Contrato|null $contrato
 * @method static \Illuminate\Database\Eloquent\Builder|DolaresContrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DolaresContrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DolaresContrato onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DolaresContrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|DolaresContrato withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DolaresContrato withoutTrashed()
 */
	class DolaresContrato extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\EntregaMensual
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ContractManager\Contrato|null $contrato
 * @property-read \App\Models\ContractManager\Factura|null $deductivaFactura
 * @property-read \App\Models\ContractManager\Factura|null $factura
 * @property-read \App\Models\ContractManager\EntregableFile|null $file
 * @property-read mixed $archivo
 * @method static \Illuminate\Database\Eloquent\Builder|EntregaMensual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregaMensual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregaMensual onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregaMensual query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregaMensual withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregaMensual withoutTrashed()
 */
	class EntregaMensual extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\EntregableFile
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EntregableFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregableFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregableFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregableFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregableFile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EntregableFile withoutTrashed()
 */
	class EntregableFile extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\EvaluacionServicio
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionServicio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionServicio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionServicio onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionServicio query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionServicio withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionServicio withoutTrashed()
 */
	class EvaluacionServicio extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\EntregableFile> $entregables_files
 * @property-read int|null $entregables_files_count
 * @property-read int|null $entregas_mensuales_count
 * @property-read \App\Models\ContractManager\FacturaFile|null $file
 * @property-read mixed $archivo
 * @property-read int|null $revisiones_facturas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Factura newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factura newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factura onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Factura query()
 * @method static \Illuminate\Database\Eloquent\Builder|Factura withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Factura withoutTrashed()
 */
	class Factura extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\FacturaFile
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|FacturaFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacturaFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacturaFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FacturaFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|FacturaFile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FacturaFile withoutTrashed()
 */
	class FacturaFile extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Fiscale
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\Proveedores> $proveedores
 * @property-read int|null $proveedores_count
 * @method static \Illuminate\Database\Eloquent\Builder|Fiscale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fiscale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fiscale query()
 */
	class Fiscale extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\GenerarContrato
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|GenerarContrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GenerarContrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GenerarContrato query()
 */
	class GenerarContrato extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\HistoricoCedulaCumplimiento
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricoCedulaCumplimiento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricoCedulaCumplimiento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricoCedulaCumplimiento query()
 */
	class HistoricoCedulaCumplimiento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\LogSistema
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|LogSistema newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSistema newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSistema query()
 */
	class LogSistema extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Moneda
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Moneda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Moneda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Moneda query()
 */
	class Moneda extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\NivelesServicio
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesServicio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesServicio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesServicio onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesServicio query()
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesServicio withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesServicio withoutTrashed()
 */
	class NivelesServicio extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\OrdenCompra
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OrdenCompra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdenCompra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdenCompra query()
 */
	class OrdenCompra extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Plantilla
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Plantilla newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plantilla newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plantilla query()
 */
	class Plantilla extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Producto
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto query()
 */
	class Producto extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ProductoRequisicion
 *
 * @property-read \App\Models\ContractManager\CentroCosto|null $centro_costo
 * @property-read \App\Models\ContractManager\Contrato|null $contrato
 * @property-read \App\Models\ContractManager\Producto|null $producto
 * @method static \Illuminate\Database\Eloquent\Builder|ProductoRequisicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductoRequisicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductoRequisicion query()
 */
	class ProductoRequisicion extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ProvedorRequisicionCatalogo
 *
 * @property-read \App\Models\ContractManager\ProveedorOC|null $provedores
 * @method static \Illuminate\Database\Eloquent\Builder|ProvedorRequisicionCatalogo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProvedorRequisicionCatalogo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProvedorRequisicionCatalogo query()
 */
	class ProvedorRequisicionCatalogo extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ProveedorIndistinto
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorIndistinto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorIndistinto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorIndistinto query()
 */
	class ProveedorIndistinto extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ProveedorOC
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorOC newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorOC newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorOC query()
 */
	class ProveedorOC extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\ProveedorRequisicion
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorRequisicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorRequisicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProveedorRequisicion query()
 */
	class ProveedorRequisicion extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Proveedores
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ContractManager\Fiscale|null $fiscale
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\Solicitudes> $solicitud
 * @property-read int|null $solicitud_count
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores withoutTrashed()
 */
	class Proveedores extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Reporte
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Reporte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reporte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reporte query()
 */
	class Reporte extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Requsicion
 *
 * @property-read \App\Models\ContractManager\Comprador|null $comprador
 * @property-read \App\Models\ContractManager\Contrato|null $contrato
 * @property-read mixed $folio
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\ProductoRequisicion> $productos_requisiciones
 * @property-read int|null $productos_requisiciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\ProveedorIndistinto> $provedores_indistintos_requisiciones
 * @property-read int|null $provedores_indistintos_requisiciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\ProveedorRequisicion> $provedores_requisiciones
 * @property-read int|null $provedores_requisiciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\ProvedorRequisicionCatalogo> $provedores_requisiciones_catalogo
 * @property-read int|null $provedores_requisiciones_catalogo_count
 * @property-read \App\Models\ContractManager\ProveedorOC|null $proveedor
 * @property-read \App\Models\ContractManager\Sucursal|null $sucursal
 * @method static \Illuminate\Database\Eloquent\Builder|Requsicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requsicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requsicion query()
 */
	class Requsicion extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\RevisionesFactura
 *
 * @property-read \App\Models\Empleado|null $asignado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionesFactura newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionesFactura newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionesFactura onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionesFactura query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionesFactura withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionesFactura withoutTrashed()
 */
	class RevisionesFactura extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\SolicitudAprobador
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudAprobador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudAprobador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudAprobador query()
 */
	class SolicitudAprobador extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Solicitudes
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ContractManager\Plantilla|null $plantilla
 * @method static \Illuminate\Database\Eloquent\Builder|Solicitudes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Solicitudes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Solicitudes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Solicitudes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Solicitudes withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Solicitudes withoutTrashed()
 */
	class Solicitudes extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\Sucursal
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal query()
 */
	class Sucursal extends \Eloquent {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\TipoSolicitud
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|TipoSolicitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoSolicitud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoSolicitud onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoSolicitud query()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoSolicitud withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoSolicitud withoutTrashed()
 */
	class TipoSolicitud extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\VariablePlantilla
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|VariablePlantilla newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablePlantilla newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablePlantilla query()
 */
	class VariablePlantilla extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\ContractManager{
/**
 * App\Models\ContractManager\historicoSolicitudes
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractManager\Solicitudes> $solicitudes
 * @property-read int|null $solicitudes_count
 * @method static \Illuminate\Database\Eloquent\Builder|historicoSolicitudes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|historicoSolicitudes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|historicoSolicitudes query()
 */
	class historicoSolicitudes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ControlAcceso
 *
 * @property int $id
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property int|null $tipo_control_acceso_id
 * @property int|null $responsable_id
 * @property string|null $justificacion
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentoControlAcceso> $documentos_controlA
 * @property-read int|null $documentos_control_a_count
 * @property-read mixed $archivo
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\TipoDePermiso|null $tipo_de_permiso
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso query()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereTipoControlAccesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlAcceso withoutTrashed()
 */
	class ControlAcceso extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ControlDocumento
 *
 * @property int $id
 * @property string|null $clave
 * @property string|null $nombre
 * @property string|null $fecha_creacion
 * @property string|null $version
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $elaboro_id
 * @property int|null $reviso_id
 * @property int|null $team_id
 * @property int|null $estado_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User|null $elaboro
 * @property-read \App\Models\EstadoDocumento|null $estado
 * @property-read \App\Models\User|null $reviso
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento query()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereClave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereElaboroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereFechaCreacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereRevisoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ControlDocumento withoutTrashed()
 */
	class ControlDocumento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Controle
 *
 * @property int $id
 * @property string|null $numero
 * @property string|null $control
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRiesgosSistemaGestion> $matrizRiesgoSistemaGestion
 * @property-read int|null $matriz_riesgo_sistema_gestion_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Controle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Controle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Controle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Controle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Controle whereControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Controle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Controle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Controle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Controle whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Controle whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Controle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Controle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Controle withoutTrashed()
 */
	class Controle extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CorreoCumpleanos
 *
 * @property int $id
 * @property int $empleado_id
 * @property string $fecha_envio
 * @property bool|null $enviado
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos query()
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos whereEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos whereFechaEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CorreoCumpleanos whereUpdatedAt($value)
 */
	class CorreoCumpleanos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CuestionarioInfraestructuraTecnologica
 *
 * @property int $id
 * @property string|null $sistemas
 * @property string|null $aplicativos
 * @property string|null $base_datos
 * @property string|null $otro
 * @property int|null $escenario
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\AnalisisImpacto|null $cuestionario
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereAplicativos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereBaseDatos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereEscenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereOtro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereSistemas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioInfraestructuraTecnologica whereUpdatedAt($value)
 */
	class CuestionarioInfraestructuraTecnologica extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CuestionarioProporcionaInformacion
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $puesto
 * @property string|null $correo_electronico
 * @property int|null $extencion
 * @property string|null $ubicacion
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $interno_externo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\AnalisisImpacto|null $cuestionario
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereInternoExterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacion whereUpdatedAt($value)
 */
	class CuestionarioProporcionaInformacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CuestionarioProporcionaInformacionAIA
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $puesto
 * @property string|null $correo_electronico
 * @property int|null $extencion
 * @property string|null $ubicacion
 * @property int|null $interno_externo
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\AnalisisAIA|null $cuestionario
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereInternoExterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioProporcionaInformacionAIA whereUpdatedAt($value)
 */
	class CuestionarioProporcionaInformacionAIA extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CuestionarioRecibeInformacion
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $puesto
 * @property string|null $correo_electronico
 * @property int|null $extencion
 * @property string|null $ubicacion
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $interno_externo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\AnalisisImpacto|null $cuestionario
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereInternoExterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecibeInformacion whereUpdatedAt($value)
 */
	class CuestionarioRecibeInformacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CuestionarioRecursosHumanos
 *
 * @property int $id
 * @property string|null $empresa
 * @property string|null $nombre
 * @property string|null $a_paterno
 * @property string|null $a_materno
 * @property string|null $puesto
 * @property string|null $rol
 * @property int|null $tel
 * @property string|null $correo
 * @property int|null $escenario
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\AnalisisImpacto|null $cuestionario
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereAMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereAPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereEscenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanos whereUpdatedAt($value)
 */
	class CuestionarioRecursosHumanos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CuestionarioRecursosHumanosAIA
 *
 * @property int $id
 * @property string|null $empresa
 * @property string|null $nombre
 * @property string|null $a_paterno
 * @property string|null $a_materno
 * @property string|null $puesto
 * @property string|null $rol
 * @property int|null $tel
 * @property string|null $correo
 * @property int|null $escenario
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\AnalisisAIA|null $cuestionario
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereAMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereAPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereEscenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosHumanosAIA whereUpdatedAt($value)
 */
	class CuestionarioRecursosHumanosAIA extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CuestionarioRecursosMateriales
 *
 * @property int $id
 * @property int|null $equipos
 * @property int|null $impresoras
 * @property int|null $telefono
 * @property string|null $otro
 * @property int|null $escenario
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereEquipos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereEscenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereImpresoras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereOtro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMateriales whereUpdatedAt($value)
 */
	class CuestionarioRecursosMateriales extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CuestionarioRecursosMaterialesAIA
 *
 * @property int $id
 * @property int|null $equipos
 * @property int|null $impresoras
 * @property int|null $telefono
 * @property string|null $otro
 * @property int|null $escenario
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $otro_numero
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereEquipos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereEscenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereImpresoras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereOtro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereOtroNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuestionarioRecursosMaterialesAIA whereUpdatedAt($value)
 */
	class CuestionarioRecursosMaterialesAIA extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CursosDiplomasEmpleados
 *
 * @property int $id
 * @property int|null $empleado_id
 * @property string|null $curso_diploma
 * @property string|null $tipo
 * @property string|null $año
 * @property string|null $duracion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $fecha_fin
 * @property string|null $file
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado_cursos
 * @property-read mixed $fecha_fin_spanish
 * @property-read mixed $fecha_fin_ymd
 * @property-read mixed $fecha_inicio_spanish
 * @property-read mixed $ruta_documento
 * @property-read mixed $year_ymd
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados query()
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereAño($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereCursoDiploma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereDuracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CursosDiplomasEmpleados withoutTrashed()
 */
	class CursosDiplomasEmpleados extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DashboardIndicadorSG
 *
 * @property int $id
 * @property int $porcentaje_cumplimiento
 * @property int|null $alta
 * @property int|null $media
 * @property int|null $baja
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG query()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG whereAlta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG whereBaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG whereMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG wherePorcentajeCumplimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardIndicadorSG whereUpdatedAt($value)
 */
	class DashboardIndicadorSG extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DayOff
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int|null $dias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $afectados
 * @property int|null $tipo_conteo
 * @property int|null $inicio_conteo
 * @property int|null $incremento_dias
 * @property int|null $periodo_corte
 * @property int|null $meses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Area> $areas
 * @property-read int|null $areas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff query()
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereAfectados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereDias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereIncrementoDias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereInicioConteo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereMeses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff wherePeriodoCorte($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereTipoConteo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DayOff withoutTrashed()
 */
	class DayOff extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class DebilidadesEntendimientoOrganizacion.
 *
 * @property int $id
 * @property string|null $debilidad
 * @property string|null $riesgo
 * @property int|null $foda_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property EntendimientoOrganizacion|null $entendimiento_organizacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $tiene_riesgos_asociados
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRiesgo> $riesgos
 * @property-read int|null $riesgos_count
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion whereDebilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion whereFodaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion whereRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebilidadesEntendimientoOrganizacion whereUpdatedAt($value)
 */
	class DebilidadesEntendimientoOrganizacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DeclaracionAplicabilidad
 *
 * @property int $id
 * @property string|null $control-uno
 * @property string|null $control-dos
 * @property string|null $anexo_indice
 * @property string|null $anexo_politica
 * @property string|null $anexo_descripcion
 * @property string|null $aplica
 * @property string|null $justificacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $aprobadores
 * @property-read int|null $aprobadores_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read DeclaracionAplicabilidad|null $control
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read mixed $content
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsables
 * @property-read int|null $responsables_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereAnexoDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereAnexoIndice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereAnexoPolitica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereAplica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereControlDos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereControlUno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidad whereUpdatedAt($value)
 */
	class DeclaracionAplicabilidad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class DeclaracionAplicabilidadAprobadore.
 *
 * @property int $id
 * @property int|null $declaracion_id
 * @property int|null $aprobadores_id
 * @property int|null $estatus
 * @property Carbon|null $fecha_aprobacion
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property Empleado|null $empleado
 * @property string|null $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $esta_correo_enviado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NotificacionAprobadore> $notificacion
 * @property-read int|null $notificacion_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereAprobadoresId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereDeclaracionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereEstaCorreoEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereFechaAprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobadores withoutTrashed()
 */
	class DeclaracionAplicabilidadAprobadores extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class DeclaracionAplicabilidadResponsable.
 *
 * @property int $id
 * @property int|null $declaracion_id
 * @property int|null $empleado_id
 * @property character varying|null $aplica
 * @property string|null $justificacion
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property Empleado|null $empleado
 * @property string|null $aplica
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $notificado
 * @property bool $esta_correo_enviado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereAplica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereDeclaracionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereEstaCorreoEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereNotificado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsable withoutTrashed()
 */
	class DeclaracionAplicabilidadResponsable extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Denuncias
 *
 * @property int $id
 * @property string|null $anonimo
 * @property string|null $estatus
 * @property int|null $empleado_denuncio_id
 * @property int|null $empleado_denunciado_id
 * @property string|null $tipo
 * @property string|null $fecha
 * @property string|null $fecha_cierre
 * @property string|null $sede
 * @property string|null $ubicacion
 * @property string|null $descripcion
 * @property string|null $evidencia
 * @property string|null $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property bool|null $archivado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccionCorrectiva> $accionCorrectivaAprobacional
 * @property-read int|null $accion_correctiva_aprobacional_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActividadDenuncia> $actividades
 * @property-read int|null $actividades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $denunciado
 * @property-read \App\Models\Empleado|null $denuncio
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciasDenuncia> $evidencias_denuncias
 * @property-read int|null $evidencias_denuncias_count
 * @property-read mixed $fecha_creacion
 * @property-read mixed $fecha_de_cierre
 * @property-read mixed $fecha_reporte
 * @property-read mixed $folio
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias query()
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereAnonimo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereEmpleadoDenunciadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereEmpleadoDenuncioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereFechaCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denuncias whereUpdatedAt($value)
 */
	class Denuncias extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Dmaic
 *
 * @property int $id
 * @property string|null $definir
 * @property string|null $medir
 * @property string|null $analizar
 * @property string|null $implementar
 * @property string|null $controlar
 * @property string|null $leccionesaprendidas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $mejora_id
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Registromejora|null $mejora
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereAnalizar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereControlar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereDefinir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereImplementar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereLeccionesaprendidas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereMedir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereMejoraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dmaic withoutTrashed()
 */
	class Dmaic extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Documento
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $tipo
 * @property int|null $macroproceso_id
 * @property int|null $proceso_id
 * @property string $estatus
 * @property string $version
 * @property string $fecha
 * @property string $archivo
 * @property int|null $elaboro_id
 * @property int|null $reviso_id
 * @property int|null $aprobo_id
 * @property int|null $responsable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Empleado|null $aprobador
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $elaborador
 * @property-read \App\Models\Empleado $empleado
 * @property-read mixed $archivo_actual
 * @property-read mixed $color_estatus
 * @property-read mixed $estatus_formateado
 * @property-read mixed $fecha_d_m_y
 * @property-read mixed $no_vistas
 * @property-read \App\Models\Macroproceso|null $macroproceso
 * @property-read \App\Models\Proceso|null $proceso
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Proceso> $procesos
 * @property-read int|null $procesos_count
 * @property-read \App\Models\Empleado|null $responsable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RevisionDocumento> $revisiones
 * @property-read int|null $revisiones_count
 * @property-read \App\Models\Empleado|null $revisor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $revisores
 * @property-read int|null $revisores_count
 * @method static \Database\Factories\DocumentoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Documento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento query()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereAproboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereElaboroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereMacroprocesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereProcesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereRevisoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento withoutTrashed()
 */
	class Documento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DocumentoActivo
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Activo|null $documentos_activos
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoActivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoActivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoActivo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoActivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoActivo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoActivo withoutTrashed()
 */
	class DocumentoActivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DocumentoComunicacionSgis
 *
 * @property int $id
 * @property int|null $comunicacion_id
 * @property string|null $documento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ComunicacionSgi|null $documentos_comunicacion
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis whereComunicacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoComunicacionSgis whereUpdatedAt($value)
 */
	class DocumentoComunicacionSgis extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DocumentoConcientizacionSgis
 *
 * @property int $id
 * @property int|null $concientSgsi_id
 * @property string|null $documento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ConcientizacionSgi|null $documentos_concientizacion
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis whereConcientSgsiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoConcientizacionSgis withoutTrashed()
 */
	class DocumentoConcientizacionSgis extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DocumentoControlAcceso
 *
 * @property int $id
 * @property int|null $controlA_id
 * @property string|null $documento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ControlAcceso|null $documentos_controlA
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso whereControlAId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoControlAcceso withoutTrashed()
 */
	class DocumentoControlAcceso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DocumentoMaterialSgsi
 *
 * @property int $id
 * @property int|null $material_id
 * @property string|null $documento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\MaterialSgsi|null $documentos_material
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentoMaterialSgsi withoutTrashed()
 */
	class DocumentoMaterialSgsi extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EducacionEmpleados
 *
 * @property int $id
 * @property int|null $empleado_id
 * @property string|null $institucion
 * @property string|null $año_inicio
 * @property string|null $año_fin
 * @property string|null $nivel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $titulo_obtenido
 * @property bool $estudactualmente
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado_educacion
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados query()
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereAñoFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereAñoInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereEstudactualmente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereInstitucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereTituloObtenido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EducacionEmpleados withoutTrashed()
 */
	class EducacionEmpleados extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
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
 * @property string|null $direccion
 * @property string|null $resumen
 * @property string|null $cumpleaños
 * @property string|null $telefono_movil
 * @property string|null $extension
 * @property int|null $puesto_id
 * @property int|null $perfil_empleado_id
 * @property int|null $tipo_contrato_empleados_id
 * @property string|null $domicilio_personal
 * @property string|null $telefono_casa
 * @property string|null $correo_personal
 * @property string|null $estado_civil
 * @property string|null $NSS
 * @property string|null $CURP
 * @property string|null $RFC
 * @property string|null $lugar_nacimiento
 * @property string|null $nacionalidad
 * @property int|null $entidad_crediticias_id
 * @property string|null $numero_credito
 * @property string|null $descuento
 * @property string|null $banco
 * @property string|null $cuenta_bancaria
 * @property string|null $clabe_interbancaria
 * @property string|null $centro_costos
 * @property float|null $salario_bruto
 * @property float|null $salario_diario
 * @property float|null $salario_diario_integrado
 * @property float|null $salario_base_mensual
 * @property string|null $pagadora_actual
 * @property string|null $periodicidad_nomina
 * @property string|null $terminacion_contrato
 * @property bool|null $renovacion_contrato
 * @property string|null $esquema_contratacion
 * @property string|null $proyecto_asignado
 * @property bool $mostrar_telefono
 * @property string|null $calle
 * @property string|null $num_exterior
 * @property string|null $num_interior
 * @property string|null $colonia
 * @property string|null $delegacion
 * @property string|null $estado
 * @property string|null $pais
 * @property string|null $cp
 * @property string|null $fecha_baja
 * @property string|null $razon_baja
 * @property int|null $semanas_min_timesheet
 * @property bool $vacante_activa
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TimesheetProyectoEmpleado> $TimesheetProyectoEmpleado
 * @property-read int|null $timesheet_proyecto_empleado_count
 * @property-read int|null $analisis_de_riesgos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Documento> $archivos
 * @property-read int|null $archivos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\BeneficiariosEmpleado> $beneficiarios
 * @property-read int|null $beneficiarios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Empleado> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Empleado> $childrenOrganigrama
 * @property-read int|null $children_organigrama_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comiteseguridad> $comiteSeguridad
 * @property-read int|null $comite_seguridad_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ConfigurarSoporteModel> $configuracion_soporte
 * @property-read int|null $configuracion_soporte_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PuestoContactos> $contactos
 * @property-read int|null $contactos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\ContactosEmergenciaEmpleado> $contactosEmergencia
 * @property-read int|null $contactos_emergencia_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\DependientesEconomicosEmpleados> $dependientesEconomicos
 * @property-read int|null $dependientes_economicos_count
 * @property-read int|null $documentos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CertificacionesEmpleados> $empleado_certificaciones
 * @property-read int|null $empleado_certificaciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CursosDiplomasEmpleados> $empleado_cursos
 * @property-read int|null $empleado_cursos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciasDocumentosEmpleados> $empleado_documentos
 * @property-read int|null $empleado_documentos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciasDocumentosEmpleados> $empleado_documentos_certificados
 * @property-read int|null $empleado_documentos_certificados_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EducacionEmpleados> $empleado_educacion
 * @property-read int|null $empleado_educacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExperienciaEmpleados> $empleado_experiencia
 * @property-read int|null $empleado_experiencia_count
 * @property-read int|null $empleados_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntendimientoOrganizacion> $entendimiento
 * @property-read int|null $entendimiento_count
 * @property-read int|null $entendimiento_organizacions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Empleado> $evaluadores
 * @property-read int|null $evaluadores_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntendimientoOrganizacion> $fodas
 * @property-read int|null $fodas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Organizacion> $foto_organizacion
 * @property-read int|null $foto_organizacion_count
 * @property-read mixed $actual_aniversary
 * @property-read mixed $actual_birdthday
 * @property-read mixed $avatar
 * @property-read mixed $avatar_ruta
 * @property-read mixed $competencias_asignadas
 * @property-read mixed $declaraciones_aprobador2022
 * @property-read mixed $declaraciones_aprobador
 * @property-read mixed $declaraciones_responsable2022
 * @property-read mixed $declaraciones_responsable
 * @property-read mixed $empleados_misma_area
 * @property-read mixed $empleados_pares
 * @property-read mixed $es_supervisor
 * @property-read mixed $fecha_ingreso2020
 * @property-read mixed $fecha_ingreso
 * @property-read mixed $fecha_min_timesheet
 * @property-read mixed $genero_formateado
 * @property-read mixed $obtener_antiguedad
 * @property-read mixed $resource_id
 * @property-read mixed $saludo
 * @property-read mixed $saludo_completo
 * @property-read int|null $historial_versiones_documentos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IdiomaEmpleado> $idiomas
 * @property-read int|null $idiomas_count
 * @property-read int|null $indicadores_sgsis_count
 * @property-read int|null $matriz_riesgos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Minutasaltadireccion> $minutas
 * @property-read int|null $minutas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\ObjetivoEmpleado> $objetivos
 * @property-read int|null $objetivos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Empleado> $onlyChildren
 * @property-read int|null $only_children_count
 * @property-read \App\Models\PerfilEmpleado|null $perfil
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanificacionControl> $planificacion
 * @property-read int|null $planificacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Proceso> $procesos
 * @property-read int|null $procesos_count
 * @property-read int|null $puesto_count
 * @property-read \App\Models\Puesto|null $puestoRelacionado
 * @property-read int|null $recursos_count
 * @property-read int|null $revision_documentos_count
 * @property-read Empleado|null $supervisor
 * @property-read Empleado|null $supervisorEv360
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacionTask> $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Timesheet> $timesheet
 * @property-read int|null $timesheet_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanificacionControl> $tratamiento
 * @property-read int|null $tratamiento_count
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado alta()
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado baja()
 * @method static \Database\Factories\EmpleadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado vacanteActiva()
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereAntiguedad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereBanco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereCURP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereCalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereCentroCostos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereClabeInterbancaria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereColonia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereCorreoPersonal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereCp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereCuentaBancaria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereCumpleaños($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereDelegacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereDescuento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereDomicilioPersonal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereEntidadCrediticiasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereEsquemaContratacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereEstadoCivil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereFechaBaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereGenero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereLugarNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereMostrarTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereNEmpleado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereNRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereNSS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereNacionalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereNumExterior($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereNumInterior($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereNumeroCredito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado wherePagadoraActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado wherePais($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado wherePerfilEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado wherePeriodicidadNomina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereProyectoAsignado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereRFC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereRazonBaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereRenovacionContrato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereResumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereSalarioBaseMensual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereSalarioBruto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereSalarioDiario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereSalarioDiarioIntegrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereSedeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereSemanasMinTimesheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereTelefonoCasa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereTelefonoMovil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereTerminacionContrato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereTipoContratoEmpleadosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado whereVacanteActiva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Empleado withoutTrashed()
 */
	class Empleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EnlacesEjecutar
 *
 * @property int $id
 * @property string|null $ejecutar
 * @property string|null $descripcion
 * @property string|null $enlace
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar whereEjecutar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar whereEnlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EnlacesEjecutar withoutTrashed()
 */
	class EnlacesEjecutar extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EntendimientoOrganizacion
 *
 * @property int $id
 * @property string|null $fortalezas
 * @property string|null $oportunidades
 * @property string|null $debilidades
 * @property string|null $amenazas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $analisis
 * @property string|null $fecha
 * @property int|null $id_elabora
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DebilidadesEntendimientoOrganizacion> $fodadebilidades
 * @property-read int|null $fodadebilidades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FortalezasEntendimientoOrganizacion> $fodafortalezas
 * @property-read int|null $fodafortalezas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AmenazasEntendimientoOrganizacion> $fodamenazas
 * @property-read int|null $fodamenazas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OportunidadesEntendimientoOrganizacion> $fodaoportunidades
 * @property-read int|null $fodaoportunidades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $participantes
 * @property-read int|null $participantes_count
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereAmenazas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereAnalisis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereDebilidades($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereFortalezas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereIdElabora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereOportunidades($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EntendimientoOrganizacion withoutTrashed()
 */
	class EntendimientoOrganizacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EnvioDocumentos
 *
 * @property int $id
 * @property int|null $status
 * @property int|null $id_solicita
 * @property int|null $id_coordinador
 * @property int|null $id_mensajero
 * @property string|null $hora_recepcion_inicio
 * @property string|null $hora_recepcion_fin
 * @property string|null $fecha_solicitud
 * @property string|null $fecha_limite
 * @property string|null $descripcion
 * @property string|null $lugar
 * @property string|null $destinatario
 * @property string|null $notas
 * @property string|null $telefono
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $coordinador
 * @property-read \App\Models\Empleado|null $mensajero
 * @property-read \App\Models\Empleado|null $solicita
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereDestinatario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereFechaLimite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereFechaSolicitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereHoraRecepcionFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereHoraRecepcionInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereIdCoordinador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereIdMensajero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereIdSolicita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereLugar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereNotas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentos whereUpdatedAt($value)
 */
	class EnvioDocumentos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EnvioDocumentosAjustes
 *
 * @property int $id
 * @property int|null $id_coordinador
 * @property int|null $id_mensajero
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $coordinador
 * @property-read \App\Models\Empleado|null $mensajero
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes whereIdCoordinador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes whereIdMensajero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioDocumentosAjustes whereUpdatedAt($value)
 */
	class EnvioDocumentosAjustes extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Audience
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Audience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience withoutTrashed()
 */
	class Audience extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Comment
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment withoutTrashed()
 */
	class Comment extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Course
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Audience> $audiences
 * @property-read int|null $audiences_count
 * @property-read \App\Models\Escuela\Category|null $category
 * @property-read mixed $rating
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Goal> $goals
 * @property-read int|null $goals_count
 * @property-read \App\Models\Escuela\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Lesson> $lessons
 * @property-read int|null $lessons_count
 * @property-read \App\Models\Escuela\Level|null $level
 * @property-read \App\Models\Escuela\Level|null $price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Requirement> $requirements
 * @property-read int|null $requirements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Section> $sections
 * @property-read int|null $sections_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $students
 * @property-read int|null $students_count
 * @property-read \App\Models\User|null $teacher
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\UsuariosCursos> $usuarioscursos
 * @property-read int|null $usuarioscursos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Course category($category_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Course level($level_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Course withoutTrashed()
 */
	class Course extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\CourseUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser query()
 */
	class CourseUser extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Description
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Description newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Description newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Description onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Description query()
 * @method static \Illuminate\Database\Eloquent\Builder|Description withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Description withoutTrashed()
 */
	class Description extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Evaluation
 *
 * @property-read mixed $completed
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Instructor\Question> $questions
 * @property-read int|null $questions_count
 * @property-read \App\Models\Escuela\Section|null $section
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\UserEvaluation> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation withoutTrashed()
 */
	class Evaluation extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Goal
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Goal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal withoutTrashed()
 */
	class Goal extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Image
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 */
	class Image extends \Eloquent {}
}

namespace App\Models\Escuela\Instructor{
/**
 * App\Models\Escuela\Instructor\Answer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer withoutTrashed()
 */
	class Answer extends \Eloquent {}
}

namespace App\Models\Escuela\Instructor{
/**
 * App\Models\Escuela\Instructor\Question
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Instructor\Answer> $answers
 * @property-read int|null $answers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Question withoutTrashed()
 */
	class Question extends \Eloquent {}
}

namespace App\Models\Escuela\Instructor{
/**
 * App\Models\Escuela\Instructor\UserAnswer
 *
 * @property-read \App\Models\Escuela\Instructor\Answer|null $answer
 * @property-read \App\Models\Escuela\Instructor\Question|null $question
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer questions($evaluationId, $user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer withoutTrashed()
 */
	class UserAnswer extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Lesson
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\Escuela\Description|null $description
 * @property-read mixed $completed
 * @property-read \App\Models\Escuela\Platform|null $platform
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Reaction> $reactions
 * @property-read int|null $reactions_count
 * @property-read \App\Models\Escuela\Resource|null $resource
 * @property-read \App\Models\Escuela\Section|null $section
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson withoutTrashed()
 */
	class Lesson extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Level
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Level query()
 * @method static \Illuminate\Database\Eloquent\Builder|Level withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Level withoutTrashed()
 */
	class Level extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Platform
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Platform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform query()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform withoutTrashed()
 */
	class Platform extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Price
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Price withoutTrashed()
 */
	class Price extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Reaction
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $reactionable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction withoutTrashed()
 */
	class Reaction extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Requirement
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement withoutTrashed()
 */
	class Requirement extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Resource
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $resourceable
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource withoutTrashed()
 */
	class Resource extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Review
 *
 * @property-read \App\Models\Escuela\Course|null $course
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Review withoutTrashed()
 */
	class Review extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\Section
 *
 * @property-read \App\Models\Escuela\Course|null $course
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Evaluation> $evaluations
 * @property-read int|null $evaluations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Escuela\Lesson> $lessons
 * @property-read int|null $lessons_count
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Section withoutTrashed()
 */
	class Section extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\UserEvaluation
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvaluation query()
 */
	class UserEvaluation extends \Eloquent {}
}

namespace App\Models\Escuela{
/**
 * App\Models\Escuela\UsuariosCursos
 *
 * @property-read \App\Models\Escuela\Course|null $cursos
 * @method static \Illuminate\Database\Eloquent\Builder|UsuariosCursos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsuariosCursos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsuariosCursos query()
 */
	class UsuariosCursos extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EstadoDocumento
 *
 * @property int $id
 * @property string|null $estado
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento query()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoDocumento withoutTrashed()
 */
	class EstadoDocumento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EstadoIncidente
 *
 * @property int $id
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente query()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstadoIncidente withoutTrashed()
 */
	class EstadoIncidente extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EstatusPlanTrabajo
 *
 * @property int $id
 * @property string|null $estado
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo query()
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstatusPlanTrabajo withoutTrashed()
 */
	class EstatusPlanTrabajo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class EvaluacionIndicador.
 *
 * @property int $id
 * @property string|null $no
 * @property string|null $evaluacion
 * @property Carbon|null $fecha
 * @property int|null $resultado
 * @property int|null $id_indicador
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property IndicadoresSgsi|null $indicadores_sgsi
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereEvaluacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereIdIndicador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereResultado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionIndicador withoutTrashed()
 */
	class EvaluacionIndicador extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class EvaluacionObjetivo.
 *
 * @property int $id
 * @property character varying|null $no
 * @property character varying|null $evaluacion
 * @property Carbon|null $fecha
 * @property int|null $resultado
 * @property int|null $id_objetivo
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Objetivosseguridad|null $objetivosseguridad
 * @property int|null $no
 * @property string|null $evaluacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereEvaluacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereIdObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereResultado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo withoutTrashed()
 */
	class EvaluacionObjetivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvaluacionRequisitoLegal
 *
 * @property int $id
 * @property string|null $cumplerequisito
 * @property string|null $fechaverificacion
 * @property string|null $metodo
 * @property string|null $descripcion_cumplimiento
 * @property string|null $comentarios
 * @property int $id_matriz
 * @property int $id_reviso
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado $evaluador
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciaMatrizRequisitoLegale> $evidencias_matriz
 * @property-read int|null $evidencias_matriz_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\MatrizRequisitoLegale $requisito
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereCumplerequisito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereDescripcionCumplimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereFechaverificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereIdMatriz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereIdReviso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereMetodo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRequisitoLegal whereUpdatedAt($value)
 */
	class EvaluacionRequisitoLegal extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvaluacionesIndicadorInfo
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesIndicadorInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesIndicadorInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesIndicadorInfo query()
 */
	class EvaluacionesIndicadorInfo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Evidencia
 *
 * @property int $id
 * @property string $url
 * @property string $evidenciable_type
 * @property int $evidenciable_id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $evidenciable
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia whereEvidenciableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia whereEvidenciableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evidencia whereUrl($value)
 */
	class Evidencia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciaDocumentoEmpleadoArchivo
 *
 * @property int $id
 * @property int $evidencias_documentos_empleados_id
 * @property string $documento
 * @property bool $archivado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\EvidenciasDocumentosEmpleados $evidencia
 * @property-read mixed $ruta_absoluta_documento
 * @property-read mixed $ruta_documento
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo whereEvidenciasDocumentosEmpleadosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaDocumentoEmpleadoArchivo whereUpdatedAt($value)
 */
	class EvidenciaDocumentoEmpleadoArchivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciaMatrizRequisitoLegale
 *
 * @property int $id
 * @property int|null $id_matriz_requisito
 * @property string $evidencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $id_evaluacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\MatrizRequisitoLegale|null $matriz_requisito
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale whereIdEvaluacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale whereIdMatrizRequisito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaMatrizRequisitoLegale withoutTrashed()
 */
	class EvidenciaMatrizRequisitoLegale extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciaQuejasClientes
 *
 * @property int $id
 * @property int|null $quejas_clientes_id
 * @property string $evidencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\QuejasCliente|null $quejas
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes whereQuejasClientesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaQuejasClientes withoutTrashed()
 */
	class EvidenciaQuejasClientes extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciaSgsiPdf
 *
 * @property int $id
 * @property int|null $id_evidencias_sgsis
 * @property string $evidencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\EvidenciasSgsi|null $evidencia_sgsi
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf whereIdEvidenciasSgsis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciaSgsiPdf withoutTrashed()
 */
	class EvidenciaSgsiPdf extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciasCertificadosEmpleados
 *
 * @property int $id
 * @property int|null $empleado_id
 * @property string|null $evidencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado_documentos_certificados
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasCertificadosEmpleados withoutTrashed()
 */
	class EvidenciasCertificadosEmpleados extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciasDenuncia
 *
 * @property int $id
 * @property int|null $id_denuncias
 * @property string $evidencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Denuncias|null $denuncias
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia whereIdDenuncias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDenuncia whereUpdatedAt($value)
 */
	class EvidenciasDenuncia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciasDocumentosEmpleados
 *
 * @property int $id
 * @property int|null $empleado_id
 * @property string|null $documentos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $numero
 * @property bool $archivado
 * @property int|null $lista_documentos_empleados_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleados_documentos
 * @property-read mixed $ruta_absoluta_documento
 * @property-read mixed $ruta_documento
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereDocumentos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereListaDocumentosEmpleadosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasDocumentosEmpleados withoutTrashed()
 */
	class EvidenciasDocumentosEmpleados extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciasQueja
 *
 * @property int $id
 * @property int|null $id_quejas
 * @property string $evidencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Quejas|null $quejas
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja whereIdQuejas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQueja withoutTrashed()
 */
	class EvidenciasQueja extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciasQuejasClientesCerrado
 *
 * @property int $id
 * @property int|null $quejas_clientes_id
 * @property string $cierre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\QuejasCliente|null $quejas
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado whereCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado whereQuejasClientesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasQuejasClientesCerrado withoutTrashed()
 */
	class EvidenciasQuejasClientesCerrado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciasRiesgo
 *
 * @property int $id
 * @property int|null $id_riesgos
 * @property string $evidencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RiesgoIdentificado|null $riesgos
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo whereIdRiesgos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasRiesgo whereUpdatedAt($value)
 */
	class EvidenciasRiesgo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciasSeguridad
 *
 * @property int $id
 * @property int|null $id_seguridad
 * @property string $evidencia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\IncidentesSeguridad|null $seguridad
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad whereIdSeguridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSeguridad whereUpdatedAt($value)
 */
	class EvidenciasSeguridad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EvidenciasSgsi
 *
 * @property int $id
 * @property string $objetivodocumento
 * @property string|null $arearesponsable
 * @property string|null $fechadocumento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $responsable_id
 * @property int|null $team_id
 * @property string|null $nombredocumento
 * @property int $responsable_evidencia_id
 * @property int|null $area_id
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado $empleado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciaSgsiPdf> $evidencia_sgsi
 * @property-read int|null $evidencia_sgsi_count
 * @property-read mixed $archivopdf
 * @property-read mixed $fecha_documento
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User|null $responsable
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereArearesponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereFechadocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereNombredocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereObjetivodocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereResponsableEvidenciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EvidenciasSgsi withoutTrashed()
 */
	class EvidenciasSgsi extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ExperienciaEmpleados
 *
 * @property int $id
 * @property int|null $empleado_id
 * @property string|null $empresa
 * @property string|null $puesto
 * @property string|null $inicio_mes
 * @property string|null $inicio_año
 * @property string|null $fin_año
 * @property string|null $fin_mes
 * @property string|null $duracion
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $trabactualmente
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado_experiencia
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereDuracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereFinAño($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereFinMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereInicioAño($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereInicioMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereTrabactualmente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ExperienciaEmpleados withoutTrashed()
 */
	class ExperienciaEmpleados extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ExternosMinutaDireccion
 *
 * @property int $id
 * @property string|null $nombreEXT
 * @property string|null $emailEXT
 * @property string|null $puestoEXT
 * @property string|null $empresaEXT
 * @property int|null $minuta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Minutasaltadireccion|null $revision
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion whereEmailEXT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion whereEmpresaEXT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion whereMinutaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion whereNombreEXT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion wherePuestoEXT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternosMinutaDireccion whereUpdatedAt($value)
 */
	class ExternosMinutaDireccion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\FaqCategory
 *
 * @property int $id
 * @property string|null $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory withoutTrashed()
 */
	class FaqCategory extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\FaqQuestion
 *
 * @property int $id
 * @property string|null $question
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $category_id
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\FaqCategory|null $category
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion withoutTrashed()
 */
	class FaqQuestion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\FelicitarCumpleaños
 *
 * @property int $id
 * @property int $cumpleañero_id
 * @property int $felicitador_id
 * @property string|null $comentarios
 * @property bool $like
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $cumpleañero
 * @property-read \App\Models\Empleado $felicitador
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños query()
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños whereCumpleañeroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños whereFelicitadorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños whereLike($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FelicitarCumpleaños whereUpdatedAt($value)
 */
	class FelicitarCumpleaños extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\FileCapacitacion
 *
 * @property int $id
 * @property string $archivo
 * @property int $recurso_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $ruta_archivo
 * @property-read \App\Models\Recurso $recurso
 * @method static \Illuminate\Database\Eloquent\Builder|FileCapacitacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCapacitacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCapacitacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCapacitacion whereArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCapacitacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCapacitacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCapacitacion whereRecursoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCapacitacion whereUpdatedAt($value)
 */
	class FileCapacitacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\FilesRevisonDireccion
 *
 * @property int $id
 * @property string $name
 * @property int $revision_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion whereRevisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilesRevisonDireccion whereUpdatedAt($value)
 */
	class FilesRevisonDireccion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class FortalezasEntendimientoOrganizacion.
 *
 * @property int $id
 * @property string|null $fortaleza
 * @property string|null $riesgo
 * @property int|null $foda_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property EntendimientoOrganizacion|null $entendimiento_organizacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $tiene_riesgos_asociados
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRiesgo> $riesgos
 * @property-read int|null $riesgos_count
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion whereFodaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion whereFortaleza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion whereRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortalezasEntendimientoOrganizacion whereUpdatedAt($value)
 */
	class FortalezasEntendimientoOrganizacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\GapDo
 *
 * @property int $id
 * @property string|null $control-uno
 * @property string|null $control-dos
 * @property string|null $anexo_indice
 * @property string|null $anexo_politica
 * @property string|null $anexo_descripcion
 * @property string|null $valoracion
 * @property string|null $evidencia
 * @property string|null $recomendacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $analisis_brechas_id
 * @property string|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereAnalisisBrechasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereAnexoDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereAnexoIndice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereAnexoPolitica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereControlDos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereControlUno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereRecomendacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDo whereValoracion($value)
 */
	class GapDo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\GapTre
 *
 * @property int $id
 * @property string $pregunta
 * @property string|null $valoracion
 * @property string|null $evidencia
 * @property string|null $recomendacion
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $analisis_brechas_id
 * @property string|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereAnalisisBrechasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre wherePregunta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereRecomendacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTre whereValoracion($value)
 */
	class GapTre extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\GapUno
 *
 * @property int $id
 * @property string|null $pregunta
 * @property string|null $valoracion
 * @property string|null $evidencia
 * @property string|null $recomendacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $analisis_brechas_id
 * @property string|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno whereAnalisisBrechasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno wherePregunta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno whereRecomendacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUno whereValoracion($value)
 */
	class GapUno extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Glosario
 *
 * @property int $id
 * @property string $concepto
 * @property string|null $definicion
 * @property string|null $explicacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $numero
 * @property string|null $norma
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereConcepto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereDefinicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereExplicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereNorma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Glosario withoutTrashed()
 */
	class Glosario extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Grupo.
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Collection|Area[] $areas
 * @property Collection|Macroproceso[] $macroprocesos
 * @property string $color
 * @property-read int|null $areas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $macroprocesos_count
 * @property-read \App\Models\Team $team
 * @method static \Database\Factories\GrupoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Grupo withoutTrashed()
 */
	class Grupo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\HerramientasPuestos
 *
 * @property int $id
 * @property string|null $nombre_herramienta
 * @property string|null $descripcion_herramienta
 * @property int|null $puesto_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos query()
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos whereDescripcionHerramienta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos whereNombreHerramienta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HerramientasPuestos whereUpdatedAt($value)
 */
	class HerramientasPuestos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\HistoralRevisionMinuta
 *
 * @property int $id
 * @property int $minuta_id
 * @property string $descripcion
 * @property string $comentarios
 * @property string|null $fecha
 * @property string $estatus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $fecha_d_m_y
 * @property-read \App\Models\Minutasaltadireccion $minuta
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta query()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereMinutaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoralRevisionMinuta withoutTrashed()
 */
	class HistoralRevisionMinuta extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\HistorialRevisionDocumento
 *
 * @property int $id
 * @property int $documento_id
 * @property string $descripcion
 * @property string $comentarios
 * @property string|null $fecha
 * @property string $estatus
 * @property string $version
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Documento $documento
 * @property-read mixed $fecha_d_m_y
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento query()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereDocumentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialRevisionDocumento withoutTrashed()
 */
	class HistorialRevisionDocumento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\HistorialVersionesDocumento
 *
 * @property int $id
 * @property int $documento_id
 * @property string $codigo
 * @property string $nombre
 * @property string $tipo
 * @property int|null $macroproceso_id
 * @property string $estatus
 * @property string $version
 * @property string $fecha
 * @property string $archivo
 * @property int|null $elaboro_id
 * @property int|null $reviso_id
 * @property int|null $aprobo_id
 * @property int|null $responsable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Empleado|null $aprobador
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado $documento
 * @property-read \App\Models\Empleado|null $elaborador
 * @property-read mixed $cambios
 * @property-read mixed $day_localized
 * @property-read mixed $estatus_formateado
 * @property-read mixed $fecha_d_m_y
 * @property-read mixed $path_document
 * @property-read \App\Models\Macroproceso|null $macroproceso
 * @property-read \App\Models\Empleado|null $responsable
 * @property-read \App\Models\Empleado|null $revisor
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento query()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereAproboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereDocumentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereElaboroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereMacroprocesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereRevisoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialVersionesDocumento withoutTrashed()
 */
	class HistorialVersionesDocumento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\IdiomaEmpleado
 *
 * @property int $id
 * @property string $nivel
 * @property int|null $porcentaje
 * @property string|null $certificado
 * @property int $empleado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $id_language
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado $empleado
 * @property-read mixed $ruta_absoluta_documento
 * @property-read mixed $ruta_documento
 * @property-read \App\Models\Language|null $language
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado whereCertificado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado whereIdLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado wherePorcentaje($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdiomaEmpleado whereUpdatedAt($value)
 */
	class IdiomaEmpleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ImagenesComunicacionSgis
 *
 * @property int $id
 * @property int|null $comunicacion_id
 * @property string|null $imagen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $tipo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ComunicacionSgi|null $imagenes_comunicacion
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis whereComunicacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis whereImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenesComunicacionSgis withoutTrashed()
 */
	class ImagenesComunicacionSgis extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\IncidentesDayoff
 *
 * @property int $id
 * @property string $nombre
 * @property int $dias_aplicados
 * @property int $aniversario
 * @property int $efecto
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $empleados
 * @property-read int|null $empleados_count
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereAniversario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereDiasAplicados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereEfecto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDayoff withoutTrashed()
 */
	class IncidentesDayoff extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\IncidentesDeSeguridad
 *
 * @property int $id
 * @property string $folio
 * @property string|null $resumen
 * @property string|null $prioridad
 * @property string|null $fechaocurrencia
 * @property string|null $clasificacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property int|null $estado_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activo> $activos
 * @property-read int|null $activos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\EstadoIncidente|null $estado
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereClasificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereFechaocurrencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereResumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesDeSeguridad withoutTrashed()
 */
	class IncidentesDeSeguridad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\IncidentesSeguridad
 *
 * @property int $id
 * @property string|null $titulo
 * @property string $estatus
 * @property string|null $fecha
 * @property string|null $fecha_cierre
 * @property string|null $categoria
 * @property string|null $subcategoria
 * @property string|null $sede
 * @property string|null $ubicacion
 * @property string|null $descripcion
 * @property string|null $areas_afectados
 * @property string|null $procesos_afectados
 * @property string|null $activos_afectados
 * @property string|null $urgencia
 * @property string|null $impacto
 * @property string|null $prioridad
 * @property string|null $comentarios
 * @property int|null $empleado_reporto_id
 * @property int|null $empleado_asignado_id
 * @property string|null $evidencia
 * @property string $archivado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $procedente
 * @property string|null $justificacion
 * @property int|null $categorias_incidentes_id
 * @property int|null $subcategoria_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccionCorrectiva> $accionCorrectivaAprobacional
 * @property-read int|null $accion_correctiva_aprobacional_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActividadIncidente> $actividades
 * @property-read int|null $actividades_count
 * @property-read \App\Models\Empleado|null $asignado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciasSeguridad> $evidencias_seguridad
 * @property-read int|null $evidencias_seguridad_count
 * @property-read mixed $archivo
 * @property-read mixed $fecha_cerrado
 * @property-read mixed $fecha_creacion
 * @property-read mixed $folio
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Empleado|null $reporto
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereActivosAfectados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereAreasAfectados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereCategoriasIncidentesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereEmpleadoAsignadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereEmpleadoReportoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereFechaCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereImpacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereProcedente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereProcesosAfectados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereSubcategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereSubcategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad whereUrgencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesSeguridad withoutTrashed()
 */
	class IncidentesSeguridad extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\IncidentesVacaciones
 *
 * @property int $id
 * @property string $nombre
 * @property int $dias_aplicados
 * @property int $aniversario
 * @property int $efecto
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $empleados
 * @property-read int|null $empleados_count
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereAniversario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereDiasAplicados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereEfecto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentesVacaciones withoutTrashed()
 */
	class IncidentesVacaciones extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class IndicadoresSgsi.
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $formula
 * @property string|null $frecuencia
 * @property string|null $unidadmedida
 * @property string|null $meta
 * @property string|null $no_revisiones
 * @property string|null $resultado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $responsable_id
 * @property int|null $team_id
 * @property int|null $id_proceso
 * @property int|null $id_empleado
 * @property string|null $verde_uno
 * @property string|null $verde_dos
 * @property string|null $amarillo_uno
 * @property string|null $amarillo_dos
 * @property string|null $rojo_uno
 * @property string|null $rojo_dos
 * @property Empleado|null $empleado
 * @property Proceso|null $proceso
 * @property User|null $user
 * @property Team|null $team
 * @property Collection|EvaluacionIndicador[] $evaluacion_indicadors
 * @property string|null $verde
 * @property string|null $amarillo
 * @property string|null $rojo
 * @property int|null $ano
 * @property int|null $id_area
 * @property string|null $formula_raw
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $evaluacion_indicadors_count
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereAmarillo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereAno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereFormula($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereFormulaRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereFrecuencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereIdArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereIdEmpleado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereNoRevisiones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereRojo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereUnidadmedida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi whereVerde($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicadoresSgsi withoutTrashed()
 */
	class IndicadoresSgsi extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InformacionDocumetada
 *
 * @property int $id
 * @property string $titulodocumento
 * @property string|null $tipodocumento
 * @property string|null $identificador
 * @property float|null $version
 * @property string|null $contenido
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $elaboro_id
 * @property int|null $reviso_id
 * @property int|null $aprobacion_id
 * @property int|null $team_id
 * @property-read \App\Models\User|null $aprobacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User|null $elaboro
 * @property-read mixed $logotipo
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PoliticaSgsi> $politicas
 * @property-read int|null $politicas_count
 * @property-read \App\Models\User|null $reviso
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada query()
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereAprobacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereContenido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereElaboroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereIdentificador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereRevisoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereTipodocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereTitulodocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InformacionDocumetada withoutTrashed()
 */
	class InformacionDocumetada extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\AnalisisBrechasIso
 *
 * @property int $id
 * @property string $nombre
 * @property string $fecha
 * @property string|null $porcentaje_implementacion
 * @property int|null $id_elaboro
 * @property int $estatus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso whereIdElaboro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso wherePorcentajeImplementacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalisisBrechasIso withoutTrashed()
 */
	class AnalisisBrechasIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\ClasificacionIso
 *
 * @property int $id
 * @property string|null $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasificacionIso withoutTrashed()
 */
	class ClasificacionIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\DeclaracionAplicabilidadAprobarIso
 *
 * @property int $id
 * @property int|null $estatus
 * @property string|null $comentarios
 * @property string|null $fecha_aprobacion
 * @property bool $esta_correo_enviado
 * @property int|null $empleado_id
 * @property int|null $declaracion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $aprobador_declaracion
 * @property-read int|null $aprobador_declaracion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso|null $declaracion
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \App\Models\Iso27\GapDosCatalogoIso|null $gapdos
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NotificacionAprobadore> $notificacion
 * @property-read int|null $notificacion_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereDeclaracionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereEstaCorreoEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereFechaAprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadAprobarIso withoutTrashed()
 */
	class DeclaracionAplicabilidadAprobarIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso
 *
 * @property int $id
 * @property string|null $valoracion
 * @property int|null $id_gap_dos_catalogo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Iso27\DeclaracionAplicabilidadAprobarIso|null $aprobadores2022
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read DeclaracionAplicabilidadConcentradoIso|null $control
 * @property-read \App\Models\Empleado $empleado
 * @property-read \App\Models\Iso27\GapDosCatalogoIso|null $gapdos
 * @property-read mixed $content
 * @property-read \App\Models\Iso27\DeclaracionAplicabilidadResponsableIso|null $responsables2022
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso whereIdGapDosCatalogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso whereValoracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadConcentradoIso withoutTrashed()
 */
	class DeclaracionAplicabilidadConcentradoIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\DeclaracionAplicabilidadResponsableIso
 *
 * @property int $id
 * @property string|null $aplica
 * @property string|null $justificacion
 * @property bool $esta_correo_enviado
 * @property int|null $empleado_id
 * @property int|null $declaracion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Iso27\DeclaracionAplicabilidadAprobarIso|null $aprobador
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso|null $declaracion_aplicabilidad
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \App\Models\Iso27\GapDosCatalogoIso|null $gapdos
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $responsable_declaracion
 * @property-read int|null $responsable_declaracion_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereAplica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereDeclaracionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereEstaCorreoEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeclaracionAplicabilidadResponsableIso withoutTrashed()
 */
	class DeclaracionAplicabilidadResponsableIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\GapDosCatalogoIso
 *
 * @property int $id
 * @property string|null $control_iso
 * @property string|null $anexo_politica
 * @property string|null $anexo_descripcion
 * @property string|null $valoracion
 * @property int|null $id_clasificacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Iso27\ClasificacionIso|null $clasificacion
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereAnexoDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereAnexoPolitica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereControlIso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereIdClasificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso whereValoracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosCatalogoIso withoutTrashed()
 */
	class GapDosCatalogoIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\GapDosConcentradoIso
 *
 * @property int $id
 * @property string|null $valoracion
 * @property string|null $evidencia
 * @property string|null $recomendacion
 * @property int|null $id_gap_dos_catalogo
 * @property int|null $id_analisis_brechas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Iso27\AnalisisBrechasIso|null $analisis_brechas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Iso27\GapDosCatalogoIso|null $gap_dos_catalogo
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereIdAnalisisBrechas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereIdGapDosCatalogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereRecomendacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso whereValoracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapDosConcentradoIso withoutTrashed()
 */
	class GapDosConcentradoIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\GapTresCatalogoIso
 *
 * @property int $id
 * @property string $pregunta
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso wherePregunta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresCatalogoIso withoutTrashed()
 */
	class GapTresCatalogoIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\GapTresConcentradoIso
 *
 * @property int $id
 * @property string|null $valoracion
 * @property string|null $evidencia
 * @property string|null $recomendacion
 * @property int|null $id_gap_tres_catalogo
 * @property int|null $id_analisis_brechas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\AnalisisBrecha|null $analisis_brechas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Iso27\GapTresCatalogoIso|null $gap_tres_catalogo
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereIdAnalisisBrechas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereIdGapTresCatalogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereRecomendacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso whereValoracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapTresConcentradoIso withoutTrashed()
 */
	class GapTresConcentradoIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\GapUnoCatalogoIso
 *
 * @property int $id
 * @property string $pregunta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso wherePregunta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoCatalogoIso withoutTrashed()
 */
	class GapUnoCatalogoIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso27{
/**
 * App\Models\Iso27\GapUnoConcentratoIso
 *
 * @property int $id
 * @property string|null $valoracion
 * @property string|null $evidencia
 * @property string|null $recomendacion
 * @property int|null $id_gap_uno_catalogo
 * @property int|null $id_analisis_brechas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Iso27\GapUnoCatalogoIso|null $gap_uno_catalogo
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereIdAnalisisBrechas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereIdGapUnoCatalogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereRecomendacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso whereValoracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GapUnoConcentratoIso withoutTrashed()
 */
	class GapUnoConcentratoIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso9001{
/**
 * App\Models\Iso9001\LockedPlanTrabajo
 *
 * @property int $id
 * @property string $locked_to
 * @property string $blocked
 * @property string $locked_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo query()
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereLockedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereLockedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereUpdatedAt($value)
 */
	class LockedPlanTrabajo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Iso9001{
/**
 * App\Models\Iso9001\PlanImplementacion
 *
 * @property int $id
 * @property object $tasks
 * @property string|null $canAdd
 * @property string|null $canWrite
 * @property string|null $canWriteOnParent
 * @property string|null $changesReasonWhy
 * @property string|null $selectedRow
 * @property string|null $zoom
 * @property string $parent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $norma
 * @property string|null $modulo_origen
 * @property string|null $objetivo
 * @property int|null $elaboro_id
 * @property string|null $archivo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $elaborador
 * @property-read mixed $resources
 * @property-read mixed $roles
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereCanAdd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereCanWrite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereCanWriteOnParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereChangesReasonWhy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereElaboroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereModuloOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereNorma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereSelectedRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereTasks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereZoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion withoutTrashed()
 */
	class PlanImplementacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Language.
 *
 * @property int $id
 * @property character varying|null $idioma
 * @property int|null $id_puesto
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Puesto|null $puesto
 * @property string|null $idioma
 * @property string|null $nativeName
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereIdioma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereNativeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUpdatedAt($value)
 */
	class Language extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\LeccionRecurso
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $iframe
 * @property int $seccion_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\SeccionRecurso $seccion
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso query()
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso whereIframe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso whereSeccionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LeccionRecurso withoutTrashed()
 */
	class LeccionRecurso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\LiberaMantenimientoAIA
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $puesto
 * @property string|null $correo_electronico
 * @property int|null $extencion
 * @property string|null $ubicacion
 * @property int|null $interno_externo
 * @property int|null $cuestionario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\AnalisisAIA|null $cuestionario
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereCuestionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereExtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereInternoExterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiberaMantenimientoAIA whereUpdatedAt($value)
 */
	class LiberaMantenimientoAIA extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ListaDocumentoEmpleado
 *
 * @property int $id
 * @property string $documento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $activar_numero
 * @property string $tipo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado whereActivarNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListaDocumentoEmpleado whereUpdatedAt($value)
 */
	class ListaDocumentoEmpleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\LockedPlanTrabajo
 *
 * @property int $id
 * @property string $locked_to
 * @property string $blocked
 * @property string $locked_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo query()
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereLockedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereLockedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LockedPlanTrabajo whereUpdatedAt($value)
 */
	class LockedPlanTrabajo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Macroproceso.
 *
 * @property int $id
 * @property string|null $codigo
 * @property string|null $nombre
 * @property int|null $id_grupo
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Grupo|null $grupo
 * @property Collection|Proceso[] $procesos
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $procesos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Proceso> $procesosWithDocumento
 * @property-read int|null $procesos_with_documento_count
 * @method static \Database\Factories\MacroprocesoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso query()
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso whereIdGrupo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Macroproceso withoutTrashed()
 */
	class Macroproceso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Marca.
 *
 * @property int $id
 * @property int|null $activo_id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Tipoactivo|null $tipoactivo
 * @property Collection|Modelo[] $modelos
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $modelos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca withoutTrashed()
 */
	class Marca extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MaterialIsoVeinticiente
 *
 * @property int $id
 * @property string $objetivo
 * @property string|null $tipoimparticion
 * @property string|null $fechacreacion_actualizacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $arearesponsable_id
 * @property int|null $team_id
 * @property-read \App\Models\Area|null $arearesponsable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $listaasistencia
 * @property-read mixed $materialarchivo
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereArearesponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereFechacreacionActualizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereTipoimparticion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialIsoVeinticiente withoutTrashed()
 */
	class MaterialIsoVeinticiente extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MaterialSgsi
 *
 * @property int $id
 * @property string $objetivo
 * @property string|null $personalobjetivo
 * @property string|null $tipoimparticion
 * @property string|null $fechacreacion_actualizacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $arearesponsable_id
 * @property int|null $team_id
 * @property string|null $nombre
 * @property-read \App\Models\Area|null $arearesponsable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentoMaterialSgsi> $documentos_material
 * @property-read int|null $documentos_material_count
 * @property-read mixed $archivo
 * @property-read mixed $fechacreacionactualizacion
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereArearesponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereFechacreacionActualizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi wherePersonalobjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereTipoimparticion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialSgsi withoutTrashed()
 */
	class MaterialSgsi extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Matriz31000ActivosInfo.
 *
 * @property int $id
 * @property string|null $contenedor_activos
 * @property int|null $id_amenaza
 * @property int|null $id_vulnerabilidad
 * @property int|null $id_matriz31000
 * @property string|null $escenario_riesgo
 * @property int|null $confidencialidad
 * @property int|null $disponibilidad
 * @property int|null $integridad
 * @property int|null $evaluación_riesgo
 * @property int|null $activo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Amenaza|null $amenaza
 * @property Vulnerabilidad|null $vulnerabilidad
 * @property MatrizIso31000|null $matriz_iso31000
 * @property Activo|null $activo
 * @property string|null $activos_asociados
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereActivosAsociados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereConfidencialidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereContenedorActivos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereDisponibilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereEscenarioRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereEvaluaciónRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereIdAmenaza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereIdMatriz31000($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereIdVulnerabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereIntegridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matriz31000ActivosInfo whereUpdatedAt($value)
 */
	class Matriz31000ActivosInfo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class MatrizIso31000.
 *
 * @property int $id
 * @property string|null $proveedores
 * @property string|null $servicio
 * @property int|null $id_proceso
 * @property string|null $descripcion_servicio
 * @property int|null $estrategico
 * @property int|null $operacional
 * @property int|null $cumplimiento
 * @property int|null $legal
 * @property int|null $reputacional
 * @property int|null $tecnologico
 * @property int|null $valor
 * @property int|null $id_analisis
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Proceso|null $proceso
 * @property AnalisisDeRiesgo|null $analisis_de_riesgo
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Matriz31000ActivosInfo> $activosInformacion
 * @property-read int|null $activos_informacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereCumplimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereDescripcionServicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereEstrategico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereIdAnalisis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereLegal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereOperacional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereProveedores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereReputacional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereServicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereTecnologico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000 whereValor($value)
 */
	class MatrizIso31000 extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class MatrizIso31000ControlesPivot.
 *
 * @property int $id
 * @property int|null $id_matriz31000
 * @property int|null $controles_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property MatrizIso31000|null $matriz_iso31000
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property int|null $id_matriz
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000ControlesPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000ControlesPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000ControlesPivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000ControlesPivot whereControlesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000ControlesPivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000ControlesPivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000ControlesPivot whereIdMatriz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizIso31000ControlesPivot whereUpdatedAt($value)
 */
	class MatrizIso31000ControlesPivot extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MatrizNist
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $amenaza
 * @property string|null $impacto_vulnerabilidad
 * @property string|null $aplicaciones
 * @property string|null $escenario
 * @property string|null $categoria
 * @property string|null $causa
 * @property string|null $tipo
 * @property int|null $severidad
 * @property int|null $probabilidad
 * @property int|null $impacto_num
 * @property int|null $valor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereAmenaza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereAplicaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereCausa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereEscenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereImpactoNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereImpactoVulnerabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereProbabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereSeveridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist whereValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizNist withoutTrashed()
 */
	class MatrizNist extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class MatrizOctave.
 *
 * @property int $id
 * @property string|null $vp
 * @property int|null $id_area
 * @property int|null $id_sede
 * @property string|null $servicio
 * @property int|null $id_proceso
 * @property int|null $activo_id
 * @property int|null $operacional
 * @property int|null $cumplimiento
 * @property int|null $legal
 * @property int|null $reputacional
 * @property int|null $tecnologico
 * @property int|null $valor
 * @property int|null $id_analisis
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Area|null $area
 * @property Sede|null $sede
 * @property Proceso|null $proceso
 * @property Activo|null $activo
 * @property AnalisisDeRiesgo|null $analisis_de_riesgo
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizoctaveActivosInfo> $matrizActivos
 * @property-read int|null $matriz_activos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveControlesPivot> $matriz_octave_controles_pivots
 * @property-read int|null $matriz_octave_controles_pivots_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereCumplimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereIdAnalisis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereIdArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereIdSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereLegal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereOperacional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereReputacional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereServicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereTecnologico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctave whereVp($value)
 */
	class MatrizOctave extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MatrizOctaveContenedor
 *
 * @property int $id
 * @property string|null $identificador_contenedor
 * @property string|null $nom_contenedor
 * @property int|null $riesgo
 * @property string|null $vinculado_ai
 * @property string|null $descripcion
 * @property int|null $id_matriz_octave_escenarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $matriz_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoInformacion> $activoInformacion
 * @property-read int|null $activo_informacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveEscenario> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveEscenario> $escenarios
 * @property-read int|null $escenarios_count
 * @property-read mixed $color
 * @property-read mixed $content
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereIdMatrizOctaveEscenarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereIdentificadorContenedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereMatrizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereNomContenedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor whereVinculadoAi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveContenedor withoutTrashed()
 */
	class MatrizOctaveContenedor extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class MatrizOctaveControlesPivot.
 *
 * @property int $id
 * @property int|null $id_octave
 * @property int|null $controles_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property MatrizOctave|null $matriz_octave
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property int|null $id_matriz
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveControlesPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveControlesPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveControlesPivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveControlesPivot whereControlesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveControlesPivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveControlesPivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveControlesPivot whereIdMatriz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveControlesPivot whereUpdatedAt($value)
 */
	class MatrizOctaveControlesPivot extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MatrizOctaveEscenario
 *
 * @property int $id
 * @property string|null $identificador_escenario
 * @property string|null $nom_escenario
 * @property string|null $descripcion
 * @property int|null $confidencialidad
 * @property int|null $integridad
 * @property int|null $disponibilidad
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeclaracionAplicabilidad> $controles
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $id_octave_contenedor
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeclaracionAplicabilidad> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\MatrizOctaveContenedor|null $contenedor
 * @property-read int|null $controles_count
 * @property-read mixed $color
 * @property-read mixed $content
 * @property-read mixed $name
 * @property-read mixed $sumatoria
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereConfidencialidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereControles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereDisponibilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereIdOctaveContenedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereIdentificadorEscenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereIntegridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereNomEscenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveEscenario withoutTrashed()
 */
	class MatrizOctaveEscenario extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MatrizOctaveProceso
 *
 * @property int $id
 * @property int|null $id_proceso
 * @property int|null $nivel_riesgo
 * @property int|null $id_direccion
 * @property int|null $servicio_id
 * @property int|null $operacional
 * @property int|null $cumplimiento
 * @property int|null $legal
 * @property int|null $reputacional
 * @property int|null $tecnologico
 * @property int|null $impacto
 * @property int|null $id_activos_informacion
 * @property int|null $promedio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $fecha_registro
 * @property int|null $matriz_id
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Proceso|null $children
 * @property-read \App\Models\Proceso|null $proceso
 * @property-read \App\Models\MatrizOctaveServicio|null $servicio
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereCumplimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereIdActivosInformacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereIdDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereImpacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereLegal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereMatrizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereNivelRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereOperacional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso wherePromedio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereReputacional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereServicioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereTecnologico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveProceso whereUpdatedAt($value)
 */
	class MatrizOctaveProceso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class MatrizOctaveServicio.
 *
 * @property int $id
 * @property string|null $servicio
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|MatrizOctaveProceso[] $matriz_octave_procesos
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $matriz_octave_procesos_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveServicio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveServicio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveServicio query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveServicio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveServicio whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveServicio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveServicio whereServicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizOctaveServicio whereUpdatedAt($value)
 */
	class MatrizOctaveServicio extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MatrizRequisitoLegale
 *
 * @property int $id
 * @property string $nombrerequisito
 * @property string|null $fechaexpedicion
 * @property string|null $fechavigor
 * @property string|null $requisitoacumplir
 * @property string|null $cumplerequisito
 * @property string|null $formacumple
 * @property string|null $periodicidad_cumplimiento
 * @property string|null $fechaverificacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property string|null $medio
 * @property string|null $tipo
 * @property string|null $descripcion_cumplimiento
 * @property string|null $evidencia
 * @property int|null $id_reviso
 * @property string|null $alcance
 * @property string|null $metodo
 * @property string|null $comentarios
 * @property string|null $cumplimiento_organizacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvaluacionRequisitoLegal> $evaluaciones
 * @property-read int|null $evaluaciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciaMatrizRequisitoLegale> $evidencias_matriz
 * @property-read int|null $evidencias_matriz_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereAlcance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereCumplerequisito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereCumplimientoOrganizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereDescripcionCumplimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereFechaexpedicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereFechaverificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereFechavigor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereFormacumple($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereIdReviso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereMedio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereMetodo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereNombrerequisito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale wherePeriodicidadCumplimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereRequisitoacumplir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRequisitoLegale withoutTrashed()
 */
	class MatrizRequisitoLegale extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class MatrizRiesgo.
 *
 * @property int $id
 * @property string|null $descripcionriesgo
 * @property string|null $tipo_riesgo
 * @property string|null $confidencialidad
 * @property string|null $integridad
 * @property string|null $disponibilidad
 * @property string|null $probabilidad
 * @property string|null $impacto
 * @property float|null $nivelriesgo
 * @property float|null $riesgototal
 * @property float|null $resultadoponderacion
 * @property float|null $riesgoresidual
 * @property string|null $justificacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $controles_id
 * @property int|null $team_id
 * @property int|null $id_analisis
 * @property int|null $id_sede
 * @property int|null $id_proceso
 * @property int|null $id_responsable
 * @property int|null $activo_id
 * @property int|null $id_amenaza
 * @property int|null $id_area
 * @property int|null $id_vulnerabilidad
 * @property string|null $plan_de_accion
 * @property string|null $confidencialidad_cid
 * @property string|null $integridad_cid
 * @property string|null $disponibilidad_cid
 * @property string|null $probabilidad_residual
 * @property string|null $impacto_residual
 * @property string|null $nivelriesgo_residual
 * @property string|null $riesgo_total_residual
 * @property Controle|null $controle
 * @property Activo|null $activo
 * @property Amenaza|null $amenaza
 * @property AnalisisDeRiesgo|null $analisis_de_riesgo
 * @property Area|null $area
 * @property Proceso|null $proceso
 * @property Empleado|null $empleado
 * @property Sede|null $sede
 * @property Vulnerabilidad|null $vulnerabilidad
 * @property Team|null $team
 * @property Collection|MatrizRiesgosControlesPivot[] $matriz_riesgos_controles_pivots
 * @property string|null $tipo_tratamiento
 * @property string|null $aceptar_transferir
 * @property float|null $resultadoponderacionRes
 * @property bool|null $version_historico
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Controle|null $controles
 * @property-read int|null $matriz_riesgos_controles_pivots_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereAceptarTransferir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereConfidencialidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereConfidencialidadCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereControlesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereDescripcionriesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereDisponibilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereDisponibilidadCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIdAmenaza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIdAnalisis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIdArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIdResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIdSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIdVulnerabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereImpacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereImpactoResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIntegridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereIntegridadCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereNivelriesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereNivelriesgoResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo wherePlanDeAccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereProbabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereProbabilidadResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereResultadoponderacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereResultadoponderacionRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereRiesgoTotalResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereRiesgoresidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereRiesgototal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereTipoRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereTipoTratamiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo whereVersionHistorico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgo withoutTrashed()
 */
	class MatrizRiesgo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class MatrizRiesgosControlesPivot.
 *
 * @property int $id
 * @property int $matriz_id
 * @property int $controles_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property DeclaracionAplicabilidad $declaracion_aplicabilidad
 * @property MatrizRiesgo $matriz_riesgo
 * @property bool $version_historico
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot whereControlesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot whereMatrizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosControlesPivot whereVersionHistorico($value)
 */
	class MatrizRiesgosControlesPivot extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MatrizRiesgosSistemaGestion
 *
 * @property int $id
 * @property string|null $descripcionriesgo
 * @property string|null $tipo_riesgo
 * @property string|null $probabilidad
 * @property string|null $impacto
 * @property float|null $nivelriesgo
 * @property float|null $riesgototal
 * @property float|null $resultadoponderacion
 * @property float|null $riesgoresidual
 * @property string|null $justificacion
 * @property int|null $id_analisis
 * @property int|null $id_sede
 * @property int|null $id_proceso
 * @property int|null $id_responsable
 * @property int|null $activo_id
 * @property int|null $id_amenaza
 * @property int|null $id_area
 * @property int|null $id_vulnerabilidad
 * @property string|null $plan_de_accion
 * @property string|null $probabilidad_residual
 * @property string|null $impacto_residual
 * @property int|null $nivelriesgo_residual
 * @property string|null $riesgo_total_residual
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $tipo_tratamiento
 * @property string|null $aceptar_transferir
 * @property float|null $calidad_servicio
 * @property float|null $cliente
 * @property float|null $estrategia_negocio
 * @property float|null $disponibilidad_2000
 * @property float|null $niveles_servicio
 * @property float|null $continuidad_BCP
 * @property float|null $confidencialidad_270000
 * @property float|null $integridad_27000
 * @property float|null $disponibilidad_27000
 * @property float|null $resultado_ponderacion
 * @property float|null $estrategia_negocioRes
 * @property float|null $calidad_servicioRes
 * @property float|null $clienteRes
 * @property float|null $disponibilidad_2000Res
 * @property float|null $niveles_servicioRes
 * @property float|null $continuidad_BCPRes
 * @property float|null $confidencialidad_270000Res
 * @property float|null $integridad_27000Res
 * @property float|null $disponibilidad_27000Res
 * @property float|null $resultado_ponderacionRes
 * @property float|null $riesgo_total
 * @property float|null $riesgo_residual
 * @property int|null $identificador
 * @property bool|null $version_historico
 * @property-read \App\Models\SubcategoriaActivo|null $activo
 * @property-read \App\Models\Amenaza|null $amenaza
 * @property-read \App\Models\AnalisisDeRiesgo|null $analisis_de_riesgo
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Controle $controles
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeclaracionAplicabilidad> $matriz_riesgos_controles_pivots
 * @property-read int|null $matriz_riesgos_controles_pivots_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Proceso|null $proceso
 * @property-read \App\Models\Sede|null $sede
 * @property-read \App\Models\Team $team
 * @property-read \App\Models\Vulnerabilidad|null $vulnerabilidad
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereAceptarTransferir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereCalidadServicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereCalidadServicioRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereClienteRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereConfidencialidad270000($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereConfidencialidad270000Res($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereContinuidadBCP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereContinuidadBCPRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereDescripcionriesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereDisponibilidad2000($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereDisponibilidad2000Res($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereDisponibilidad27000($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereDisponibilidad27000Res($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereEstrategiaNegocio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereEstrategiaNegocioRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIdAmenaza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIdAnalisis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIdArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIdResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIdSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIdVulnerabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIdentificador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereImpacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereImpactoResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIntegridad27000($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereIntegridad27000Res($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereNivelesServicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereNivelesServicioRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereNivelriesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereNivelriesgoResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion wherePlanDeAccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereProbabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereProbabilidadResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereResultadoPonderacionRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereResultadoponderacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereRiesgoTotalResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereRiesgoresidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereRiesgototal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereTipoRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereTipoTratamiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion whereVersionHistorico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestion withoutTrashed()
 */
	class MatrizRiesgosSistemaGestion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MatrizRiesgosSistemaGestionControlesPivot
 *
 * @property int $id
 * @property int $matriz_id
 * @property int $controles_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\DeclaracionAplicabilidad $declaracion_aplicabilidad
 * @property-read \App\Models\MatrizRiesgosSistemaGestion $matriz_riesgo
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot whereControlesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot whereMatrizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizRiesgosSistemaGestionControlesPivot whereUpdatedAt($value)
 */
	class MatrizRiesgosSistemaGestionControlesPivot extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class MatrizoctaveActivosInfo.
 *
 * @property int $id
 * @property string|null $nombre_ai
 * @property int|null $valor_criticidad
 * @property string|null $contenedor_activos
 * @property int|null $id_amenaza
 * @property int|null $id_octave
 * @property int|null $id_vulnerabilidad
 * @property string|null $escenario_riesgo
 * @property int|null $id_custodio
 * @property int|null $id_dueno
 * @property int|null $confidencialidad
 * @property int|null $disponibilidad
 * @property int|null $integridad
 * @property int|null $evaluacion_riesgo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Amenaza|null $amenaza
 * @property MatrizOctave|null $matriz_octave
 * @property Vulnerabilidad|null $vulnerabilidad
 * @property Empleado|null $empleado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereConfidencialidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereContenedorActivos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereDisponibilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereEscenarioRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereEvaluacionRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereIdAmenaza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereIdCustodio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereIdDueno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereIdOctave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereIdVulnerabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereIntegridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereNombreAi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatrizoctaveActivosInfo whereValorCriticidad($value)
 */
	class MatrizoctaveActivosInfo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Mejoras
 *
 * @property int $id
 * @property string $estatus
 * @property string|null $fecha_cierre
 * @property int $empleado_mejoro_id
 * @property string|null $area_mejora
 * @property string|null $proceso_mejora
 * @property string $titulo
 * @property string $tipo
 * @property string|null $otro
 * @property string $descripcion
 * @property string $beneficios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property bool|null $archivado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccionCorrectiva> $accionCorrectivaAprobacional
 * @property-read int|null $accion_correctiva_aprobacional_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActividadMejora> $actividades
 * @property-read int|null $actividades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $beneficio_html
 * @property-read mixed $descripcion_html
 * @property-read mixed $fecha_creacion
 * @property-read mixed $fecha_de_cierre
 * @property-read mixed $fecha_reporte
 * @property-read mixed $folio
 * @property-read \App\Models\Empleado $mejoro
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereAreaMejora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereBeneficios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereEmpleadoMejoroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereFechaCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereOtro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereProcesoMejora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mejoras whereUpdatedAt($value)
 */
	class Mejoras extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MiembrosComiteSeguridad
 *
 * @property int $id
 * @property string $nombrerol
 * @property string|null $fechavigor
 * @property string|null $responsabilidades
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $personaasignada_id
 * @property int|null $team_id
 * @property int|null $id_asignada
 * @property int|null $comite_id
 * @property-read \App\Models\Empleado|null $asignacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $fecha_vigor
 * @property-read MiembrosComiteSeguridad|null $miembrosComite
 * @property-read \App\Models\User|null $personaasignada
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereComiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereFechavigor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereIdAsignada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereNombrerol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad wherePersonaasignadaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereResponsabilidades($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MiembrosComiteSeguridad withoutTrashed()
 */
	class MiembrosComiteSeguridad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Minutasaltadireccion
 *
 * @property int $id
 * @property string|null $objetivoreunion
 * @property string|null $arearesponsable
 * @property string|null $fechareunion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $responsablereunion_id
 * @property int|null $team_id
 * @property string|null $hora_inicio
 * @property string|null $hora_termino
 * @property string|null $tema_reunion
 * @property string|null $tema_tratado
 * @property string|null $documento
 * @property string $estatus
 * @property int $responsable_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FilesRevisonDireccion> $documentos
 * @property-read int|null $documentos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExternosMinutaDireccion> $externos
 * @property-read int|null $externos_count
 * @property-read mixed $archivo
 * @property-read mixed $color_estatus
 * @property-read mixed $estatus_formateado
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $participantes
 * @property-read int|null $participantes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Empleado $responsable
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereArearesponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereFechareunion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereHoraInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereHoraTermino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereObjetivoreunion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereResponsablereunionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereTemaReunion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereTemaTratado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Minutasaltadireccion withoutTrashed()
 */
	class Minutasaltadireccion extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Modelo.
 *
 * @property int $id
 * @property int|null $marca_id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Marca|null $marca
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereMarcaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo withoutTrashed()
 */
	class Modelo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\NecesidadExpectativaNorma
 *
 * @property int $id
 * @property int $id_norma
 * @property int $id_necesidad_expectativa
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma query()
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma whereIdNecesidadExpectativa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma whereIdNorma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NecesidadExpectativaNorma whereUpdatedAt($value)
 */
	class NecesidadExpectativaNorma extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class NivelesImpacto.
 *
 * @property int $id
 * @property string|null $nivel
 * @property string|null $clasificacion
 * @property string|null $color
 * @property int|null $tabla_impacto_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TablaImpacto|null $tabla_impacto
 * @property Collection|TipoImpacto[] $tipo_impactos
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $tipo_impactos_count
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto query()
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto whereClasificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto whereTablaImpactoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NivelesImpacto whereUpdatedAt($value)
 */
	class NivelesImpacto extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Norma.
 *
 * @property int $id
 * @property character varying $norma
 * @property character varying $descripcion
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Collection|PartesInteresada[] $partes_interesadas
 * @property string $norma
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AlcanceSgsi> $alcance
 * @property-read int|null $alcance_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Objetivosseguridad> $objetivos
 * @property-read int|null $objetivos_count
 * @property-read int|null $partes_interesadas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Norma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Norma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Norma onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Norma query()
 * @method static \Illuminate\Database\Eloquent\Builder|Norma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Norma whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Norma whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Norma whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Norma whereNorma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Norma whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Norma withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Norma withoutTrashed()
 */
	class Norma extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class NotificacionAprobadore.
 *
 * @property int $id
 * @property int|null $declaracion_id
 * @property int|null $aprobadores_id
 * @property int|null $responsables_id
 * @property bool|null $indicador_aprobador
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property DeclaracionAplicabilidadAprobadores|null $declaracion_aplicabilidad_aprobadore
 * @property DeclaracionAplicabilidadResponsable|null $declaracion_aplicabilidad_responsable
 * @property string|null $correo_aprobadores
 * @property string|null $correo_responsables
 * @property mixed|null $created_at
 * @property mixed|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereAprobadoresId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereCorreoAprobadores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereCorreoResponsables($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereDeclaracionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereIndicadorAprobador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereResponsablesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificacionAprobadore whereUpdatedAt($value)
 */
	class NotificacionAprobadore extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Objetivosseguridad.
 *
 * @property int $id
 * @property character varying $objetivoseguridad
 * @property character varying|null $indicador
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property int|null $responsable_id
 * @property character varying|null $formula
 * @property character varying|null $verde
 * @property character varying|null $amarillo
 * @property character varying|null $rojo
 * @property character varying|null $unidadmedida
 * @property character varying|null $meta
 * @property character varying|null $frecuencia
 * @property character varying|null $revisiones
 * @property int|null $ano
 * @property Team|null $team
 * @property Empleado|null $empleado
 * @property Collection|VariablesObjetivosseguridad[] $variables_objetivosseguridads
 * @property Collection|EvaluacionObjetivo[] $evaluacion_objetivos
 * @property string $objetivoseguridad
 * @property string|null $indicador
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $formula
 * @property string|null $verde
 * @property string|null $amarillo
 * @property string|null $rojo
 * @property string|null $unidadmedida
 * @property string|null $meta
 * @property string|null $frecuencia
 * @property string|null $revisiones
 * @property int|null $tipo_objetivo_sistema_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $evaluacion_objetivos_count
 * @property-read \App\Models\Norma $norma
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Norma> $normas
 * @property-read int|null $normas_count
 * @property-read \App\Models\TiposObjetivosSistema|null $tipo_objetivo_sistema
 * @property-read int|null $variables_objetivosseguridads_count
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereAmarillo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereAno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereFormula($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereFrecuencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereIndicador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereObjetivoseguridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereRevisiones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereRojo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereTipoObjetivoSistemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereUnidadmedida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad whereVerde($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivosseguridad withoutTrashed()
 */
	class Objetivosseguridad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class OportunidadesEntendimientoOrganizacion.
 *
 * @property int $id
 * @property string|null $oportunidad
 * @property string|null $riesgo
 * @property int|null $foda_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property EntendimientoOrganizacion|null $entendimiento_organizacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $tiene_riesgos_asociados
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRiesgo> $riesgos
 * @property-read int|null $riesgos_count
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion whereFodaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion whereOportunidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion whereRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OportunidadesEntendimientoOrganizacion whereUpdatedAt($value)
 */
	class OportunidadesEntendimientoOrganizacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Organizacion.
 *
 * @property int $id
 * @property string $empresa
 * @property string $direccion
 * @property int|null $telefono
 * @property string|null $correo
 * @property string|null $pagina_web
 * @property string|null $giro
 * @property string|null $servicios
 * @property string|null $mision
 * @property string|null $vision
 * @property string|null $valores
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property string|null $antecedentes
 * @property string|null $logotipo
 * @property Team|null $team
 * @property Collection|Sede[] $sedes
 * @property string|null $razon_social
 * @property string|null $rfc
 * @property string|null $representante_legal
 * @property string|null $fecha_constitucion
 * @property int|null $num_empleados
 * @property string|null $tamano
 * @property string|null $linkedln
 * @property string|null $youtube
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string $dia_timesheet
 * @property string $inicio_timesheet
 * @property string $fin_timesheet
 * @property string|null $fecha_registro_timesheet
 * @property int|null $semanas_min_timesheet
 * @property int $semanas_adicionales
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $fecha_min_timesheet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PanelOrganizacion> $panel
 * @property-read int|null $panel_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Schedule> $schedules
 * @property-read int|null $schedules_count
 * @property-read int|null $sedes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereAntecedentes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereDiaTimesheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereFechaConstitucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereFechaRegistroTimesheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereFinTimesheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereGiro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereInicioTimesheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereLinkedln($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereLogotipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereMision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereNumEmpleados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion wherePaginaWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereRepresentanteLegal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereRfc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereSemanasAdicionales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereSemanasMinTimesheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereServicios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereTamano($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereValores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereVision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion whereYoutube($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacion withoutTrashed()
 */
	class Organizacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Organizacione
 *
 * @property int $id
 * @property string $organizacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione query()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione whereOrganizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Organizacione withoutTrashed()
 */
	class Organizacione extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PanelInicioRule
 *
 * @property int $id
 * @property bool|null $nombre
 * @property bool|null $area
 * @property bool|null $puesto
 * @property bool|null $jefe_inmediato
 * @property bool|null $n_empleado
 * @property bool|null $perfil
 * @property bool|null $fecha_ingreso
 * @property bool|null $genero
 * @property bool|null $estatus
 * @property bool|null $email
 * @property bool|null $movil
 * @property bool|null $telefono
 * @property bool|null $sede
 * @property bool|null $direccion
 * @property bool|null $cumpleaños
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule query()
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereCumpleaños($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereGenero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereJefeInmediato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereMovil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereNEmpleado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule wherePerfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelInicioRule whereUpdatedAt($value)
 */
	class PanelInicioRule extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PanelOrganizacion
 *
 * @property int $id
 * @property bool|null $empresa
 * @property bool|null $direccion
 * @property bool|null $telefono
 * @property bool|null $correo
 * @property bool|null $pagina_web
 * @property bool|null $giro
 * @property bool|null $servicios
 * @property bool|null $mision
 * @property bool|null $vision
 * @property bool|null $valores
 * @property bool|null $team_id
 * @property bool|null $antecedentes
 * @property bool|null $logotipo
 * @property bool|null $razon_social
 * @property bool|null $rfc
 * @property bool|null $representante_legal
 * @property bool|null $fecha_constitucion
 * @property bool|null $num_empleados
 * @property bool|null $tamano
 * @property bool|null $schedule
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool|null $redessociales
 * @property bool|null $linkedln
 * @property bool|null $facebook
 * @property bool|null $youtube
 * @property bool|null $twitter
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereAntecedentes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereFechaConstitucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereGiro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereLinkedln($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereLogotipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereMision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereNumEmpleados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion wherePaginaWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereRedessociales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereRepresentanteLegal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereRfc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereServicios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereTamano($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereValores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereVision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PanelOrganizacion whereYoutube($value)
 */
	class PanelOrganizacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ParteInteresadaExpectativaNecesidad
 *
 * @property int $id
 * @property string|null $necesidades
 * @property string|null $expectativas
 * @property int $id_interesada
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\PartesInteresada $interesada
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Norma> $normas
 * @property-read int|null $normas_count
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad whereExpectativas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad whereIdInteresada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad whereNecesidades($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ParteInteresadaExpectativaNecesidad withoutTrashed()
 */
	class ParteInteresadaExpectativaNecesidad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class PartesInteresada.
 *
 * @property int $id
 * @property character varying $parteinteresada
 * @property string $requisitos
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property int|null $norma_id
 * @property Team|null $team
 * @property Norma|null $norma
 * @property Collection|Clausula[] $clausulas
 * @property string $parteinteresada
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $clausulas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ParteInteresadaExpectativaNecesidad> $expectativasNecesidades
 * @property-read int|null $expectativas_necesidades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ParteInteresadaExpectativaNecesidad> $expectativasNecesidadesWithNormas
 * @property-read int|null $expectativas_necesidades_with_normas_count
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada query()
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada whereNormaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada whereParteinteresada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresada withoutTrashed()
 */
	class PartesInteresada extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class PartesInteresadasClausula.
 *
 * @property int $id
 * @property int $clausula_id
 * @property int $partesint_id
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Clausula $clausula
 * @property PartesInteresada $partes_interesada
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresadasClausula newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresadasClausula newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresadasClausula query()
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresadasClausula whereClausulaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresadasClausula whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresadasClausula whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresadasClausula wherePartesintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartesInteresadasClausula whereUpdatedAt($value)
 */
	class PartesInteresadasClausula extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PerfilEmpleado
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $empleados
 * @property-read int|null $empleados_count
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PerfilEmpleado withoutTrashed()
 */
	class PerfilEmpleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PermisosGoceSueldo
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int|null $dias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $tipo_permiso
 * @property mixed $0
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo query()
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo whereDias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo whereTipoPermiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PermisosGoceSueldo withoutTrashed()
 */
	class PermisosGoceSueldo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutTrashed()
 */
	class Permission extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanAuditoria
 *
 * @property int $id
 * @property string|null $objetivo
 * @property string|null $alcance
 * @property string|null $criterios
 * @property string|null $documentoauditar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $fecha_auditoria
 * @property string|null $fecha_fin_auditoria
 * @property string|null $fecha_inicio_auditoria
 * @property string|null $id_auditoria
 * @property string|null $nombre_auditoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereAlcance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereCriterios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereDocumentoauditar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereFechaAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereFechaFinAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereFechaInicioAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereIdAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereNombreAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoria withoutTrashed()
 */
	class PlanAuditoria extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanAuditoriaActividades
 *
 * @property int $id
 * @property string|null $actividad_auditar
 * @property string|null $fecha_auditoria
 * @property string|null $horario_inicio
 * @property string|null $horario_termino
 * @property string|null $nombre_auditor
 * @property int|null $id_auditado
 * @property int|null $plan_auditoria_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Empleado|null $auditado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\PlanAuditorium|null $planAuditoria
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereActividadAuditar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereFechaAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereHorarioInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereHorarioTermino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereIdAuditado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereNombreAuditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades wherePlanAuditoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditoriaActividades withoutTrashed()
 */
	class PlanAuditoriaActividades extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanAuditorium
 *
 * @property int $id
 * @property string|null $objetivo
 * @property string|null $alcance
 * @property string|null $criterios
 * @property string|null $documentoauditar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $fecha_auditoria
 * @property string|null $fecha_fin_auditoria
 * @property string|null $fecha_inicio_auditoria
 * @property string|null $id_auditoria
 * @property string|null $nombre_auditoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanAuditoriaActividades> $actividadesPlan
 * @property-read int|null $actividades_plan_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $auditados
 * @property-read int|null $auditados_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $equipo
 * @property-read mixed $alcance_html
 * @property-read mixed $criterios_html
 * @property-read mixed $documento_auditar_html
 * @property-read mixed $objetivo_html
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereAlcance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereCriterios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereDocumentoauditar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereFechaAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereFechaFinAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereFechaInicioAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereIdAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereNombreAuditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAuditorium withoutTrashed()
 */
	class PlanAuditorium extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanBaseActividade
 *
 * @property int $id
 * @property string|null $actividad
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 * @property string|null $compromiso
 * @property string|null $real
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $responsable_id
 * @property int|null $colaborador_id
 * @property int|null $ejecutar_id
 * @property int|null $estatus_id
 * @property int|null $team_id
 * @property int|null $actividad_fase_id
 * @property-read \App\Models\ActividadFase|null $actividad_fase
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User|null $colaborador
 * @property-read \App\Models\EnlacesEjecutar|null $ejecutar
 * @property-read \App\Models\EstatusPlanTrabajo|null $estatus
 * @property-read mixed $guia
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User|null $responsable
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereActividadFaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereColaboradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereCompromiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereEjecutarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereEstatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanBaseActividade withoutTrashed()
 */
	class PlanBaseActividade extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanImplementacion
 *
 * @property int $id
 * @property object $tasks
 * @property string|null $canAdd
 * @property string|null $canWrite
 * @property string|null $canWriteOnParent
 * @property string|null $changesReasonWhy
 * @property string|null $selectedRow
 * @property string|null $zoom
 * @property string $parent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $norma
 * @property string|null $modulo_origen
 * @property string|null $objetivo
 * @property int|null $elaboro_id
 * @property string|null $archivo
 * @property bool $es_plan_trabajo_base
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $elaborador
 * @property-read mixed $resources
 * @property-read mixed $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRequisitoLegale> $matriz_requsitos_legales
 * @property-read int|null $matriz_requsitos_legales_count
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereCanAdd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereCanWrite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereCanWriteOnParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereChangesReasonWhy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereElaboroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereEsPlanTrabajoBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereModuloOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereNorma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereSelectedRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereTasks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion whereZoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacion withoutTrashed()
 */
	class PlanImplementacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanImplementacionTask
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $assigs
 * @property-read int|null $assigs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\PlanImplementacion|null $plan
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacionTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacionTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacionTask onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacionTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacionTask withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanImplementacionTask withoutTrashed()
 */
	class PlanImplementacionTask extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanMejora
 *
 * @property int $id
 * @property string|null $descripcion
 * @property string|null $fecha_compromiso
 * @property string|null $estatus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $mejora_id
 * @property int|null $responsable_id
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Registromejora|null $mejora
 * @property-read \App\Models\User|null $responsable
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereFechaCompromiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereMejoraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanMejora withoutTrashed()
 */
	class PlanMejora extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanaccionCorrectiva
 *
 * @property int $id
 * @property string $actividad
 * @property string|null $fechacompromiso
 * @property string|null $estatus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $accioncorrectiva_id
 * @property int|null $responsable_id
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User|null $responsable
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereAccioncorrectivaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereFechacompromiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereResponsableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanaccionCorrectiva withoutTrashed()
 */
	class PlanaccionCorrectiva extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanificacionControl
 *
 * @property int $id
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $id_reviso
 * @property string|null $folio_cambio
 * @property string|null $fecha_registro
 * @property string|null $fecha_inicio
 * @property string|null $fecha_termino
 * @property string|null $objetivo
 * @property string|null $criterios_aceptacion
 * @property int|null $id_responsable
 * @property int|null $origen_id
 * @property int|null $id_responsable_aprobar
 * @property string|null $firma_registro
 * @property string|null $firma_responsable
 * @property string|null $firma_responsable_aprobador
 * @property bool $aprobado
 * @property string $es_aprobado
 * @property string|null $comentarios
 * @property string|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \App\Models\PlanificacionControlOrigenCambio|null $origen
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $participantes
 * @property-read int|null $participantes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Empleado|null $responsable
 * @property-read \App\Models\Empleado|null $responsableAprobar
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereAprobado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereCriteriosAceptacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereEsAprobado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereFechaTermino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereFirmaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereFirmaResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereFirmaResponsableAprobador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereFolioCambio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereIdResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereIdResponsableAprobar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereIdReviso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereOrigenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControl withoutTrashed()
 */
	class PlanificacionControl extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanificacionControlOrigenCambio
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, PlanificacionControlOrigenCambio> $origen
 * @property-read int|null $origen_count
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanificacionControlOrigenCambio withoutTrashed()
 */
	class PlanificacionControlOrigenCambio extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PoliticaSgsi
 *
 * @property int $id
 * @property string|null $politicasgsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property string|null $fecha_publicacion
 * @property string|null $fecha_entrada
 * @property string|null $fecha_revision
 * @property int|null $id_reviso_politica
 * @property string|null $nombre_politica
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $reviso
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereFechaEntrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereFechaPublicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereFechaRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereIdRevisoPolitica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereNombrePolitica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi wherePoliticasgsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticaSgsi withoutTrashed()
 */
	class PoliticaSgsi extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Porcentaje.
 *
 * @property int $id
 * @property character varying|null $porcentaje
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $porcentaje
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Porcentaje newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Porcentaje newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Porcentaje query()
 * @method static \Illuminate\Database\Eloquent\Builder|Porcentaje whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Porcentaje whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Porcentaje wherePorcentaje($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Porcentaje whereUpdatedAt($value)
 */
	class Porcentaje extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Proceso.
 *
 * @property int $id
 * @property string|null $codigo
 * @property string|null $nombre
 * @property int|null $id_macroproceso
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Macroproceso|null $macroproceso
 * @property Collection|IndicadoresSgsi[] $indicadores_sgsis
 * @property string|null $estatus
 * @property int|null $documento_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoInformacion> $activosAI
 * @property-read int|null $activos_a_i_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoInformacion> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Documento|null $documento
 * @property-read mixed $color
 * @property-read mixed $content
 * @property-read mixed $name
 * @property-read mixed $proceso_octave_riesgo
 * @property-read int|null $indicadores_sgsis_count
 * @property-read \App\Models\Area $macro
 * @property-read \App\Models\MatrizOctaveProceso|null $procesoOctave
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveProceso> $procesosOctave
 * @property-read int|null $procesos_octave_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Documento> $vistaDocumento
 * @property-read int|null $vista_documento_count
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereDocumentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereIdMacroproceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Proceso withoutTrashed()
 */
	class Proceso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class ProcesosActivosInformacion.
 *
 * @property int $id
 * @property int|null $losprocesos_id
 * @property int|null $id_activos_informacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Proceso|null $proceso
 * @property ActivosInformacion|null $activos_informacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosActivosInformacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosActivosInformacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosActivosInformacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosActivosInformacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosActivosInformacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosActivosInformacion whereIdActivosInformacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosActivosInformacion whereLosprocesosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosActivosInformacion whereUpdatedAt($value)
 */
	class ProcesosActivosInformacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ProcesosOctaveHistoricos
 *
 * @property int $id
 * @property int|null $proceso_id
 * @property int|null $matriz_id
 * @property mixed $historico
 * @property string|null $fecha_registro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\AnalisisDeRiesgo|null $matriz
 * @property-read \App\Models\MatrizOctaveProceso|null $proceso
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos whereHistorico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos whereMatrizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos whereProcesoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcesosOctaveHistoricos whereUpdatedAt($value)
 */
	class ProcesosOctaveHistoricos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Puesto
 *
 * @property int $id
 * @property string $puesto
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property int|null $id_reporta
 * @property int|null $id_area
 * @property string|null $estudios
 * @property string|null $experiencia
 * @property string|null $conocimientos
 * @property string|null $conocimientos_esp
 * @property string|null $sueldo
 * @property string|null $lugar_trabajo
 * @property string|null $genero
 * @property string|null $estado_civil
 * @property string|null $edad_de
 * @property string|null $edad_a
 * @property string|null $fecha_puesto
 * @property string|null $horario
 * @property string|null $edad
 * @property string|null $personas_internas
 * @property string|null $personas_externas
 * @property int|null $perfil_empleado_id
 * @property string|null $entrenamiento
 * @property int|null $elaboro_id
 * @property int|null $reviso_id
 * @property int|null $autoriza_id
 * @property int|null $reporta_puesto_id
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $autoriza
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PuestosCertificado> $certificados
 * @property-read int|null $certificados_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\Competencia> $competencia
 * @property-read int|null $competencia_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\CompetenciaPuesto> $competencias
 * @property-read int|null $competencias_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PuestoContactos> $contactos
 * @property-read int|null $contactos_count
 * @property-read \App\Models\Empleado|null $elaboro
 * @property-read \App\Models\Empleado|null $empleados
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactosExternosPuestos> $externos
 * @property-read int|null $externos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HerramientasPuestos> $herramientas
 * @property-read int|null $herramientas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PuestoIdiomaPorcentajePivot> $language
 * @property-read int|null $language_count
 * @property-read Puesto|null $reportara
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PuestoResponsabilidade> $responsabilidades
 * @property-read int|null $responsabilidades_count
 * @property-read \App\Models\Empleado|null $reviso
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereAutorizaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereConocimientos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereConocimientosEsp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereEdad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereEdadA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereEdadDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereElaboroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereEntrenamiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereEstadoCivil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereEstudios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereExperiencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereFechaPuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereGenero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereHorario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereIdArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereIdReporta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereLugarTrabajo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto wherePerfilEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto wherePersonasExternas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto wherePersonasInternas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereReportaPuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereRevisoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereSueldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Puesto withoutTrashed()
 */
	class Puesto extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PuestoContactos
 *
 * @property int $id
 * @property string|null $descripcion_contacto
 * @property int|null $id_contacto
 * @property int|null $puesto_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $contacto_puesto_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleados
 * @property-read \App\Models\Puesto|null $puesto
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos query()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos whereContactoPuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos whereDescripcionContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos whereIdContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoContactos whereUpdatedAt($value)
 */
	class PuestoContactos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class PuestoIdiomaPorcentajePivot.
 *
 * @property int $id
 * @property int $id_language
 * @property int $id_puesto
 * @property int $id_porcentaje
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Language $language
 * @property Puesto $puesto
 * @property Porcentaje $porcentaje
 * @property Collection|Puesto[] $puestos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $nivel
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $puestos_count
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot whereIdLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot whereIdPuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot wherePorcentaje($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoIdiomaPorcentajePivot whereUpdatedAt($value)
 */
	class PuestoIdiomaPorcentajePivot extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class PuestoResponsabilidade.
 *
 * @property int $id
 * @property string|null $actividad
 * @property int|null $puesto_id
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Puesto|null $puesto
 * @property string|null $resultado
 * @property string|null $indicador
 * @property string|null $tiempo_asignado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade query()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade whereActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade whereIndicador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade whereResultado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade whereTiempoAsignado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestoResponsabilidade whereUpdatedAt($value)
 */
	class PuestoResponsabilidade extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class PuestosCertificado.
 *
 * @property int $id
 * @property character varying|null $requisito
 * @property character varying|null $nombre
 * @property int|null $puesto_id
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Puesto|null $puesto
 * @property string|null $requisito
 * @property string|null $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado query()
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado whereRequisito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PuestosCertificado whereUpdatedAt($value)
 */
	class PuestosCertificado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Quejas
 *
 * @property int $id
 * @property string|null $anonimo
 * @property string|null $estatus
 * @property int|null $empleado_quejo_id
 * @property string|null $quejado
 * @property string|null $area_quejado
 * @property string|null $colaborador_quejado
 * @property string|null $proceso_quejado
 * @property string|null $externo_quejado
 * @property string|null $titulo
 * @property string|null $fecha
 * @property string|null $fecha_cierre
 * @property string|null $sede
 * @property string|null $ubicacion
 * @property string|null $descripcion
 * @property string|null $evidencia
 * @property string|null $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property bool|null $archivado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccionCorrectiva> $accionCorrectivaAprobacional
 * @property-read int|null $accion_correctiva_aprobacional_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActividadQueja> $actividades
 * @property-read int|null $actividades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciasQueja> $evidencias_quejas
 * @property-read int|null $evidencias_quejas_count
 * @property-read mixed $fecha_creacion
 * @property-read mixed $fecha_de_cierre
 * @property-read mixed $fecha_reporte
 * @property-read mixed $folio
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Empleado|null $quejo
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereAnonimo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereAreaQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereColaboradorQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereEmpleadoQuejoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereExternoQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereFechaCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereProcesoQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quejas whereUpdatedAt($value)
 */
	class Quejas extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\QuejasCliente
 *
 * @property int $id
 * @property string|null $nombre
 * @property int $cliente_id
 * @property int $proyectos_id
 * @property string|null $puesto
 * @property string|null $telefono
 * @property string|null $correo
 * @property string|null $estatus
 * @property string|null $area_quejado
 * @property string|null $colaborador_quejado
 * @property string|null $proceso_quejado
 * @property string|null $otro_quejado
 * @property string|null $titulo
 * @property string|null $fecha
 * @property string|null $fecha_cierre
 * @property string|null $ubicacion
 * @property string|null $descripcion
 * @property string|null $comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $archivado
 * @property string|null $canal
 * @property string|null $otro_canal
 * @property bool $correo_cliente
 * @property string|null $urgencia
 * @property string|null $impacto
 * @property string|null $prioridad
 * @property string|null $solucion_requerida_cliente
 * @property string|null $categoria_queja
 * @property string|null $otro_categoria
 * @property bool $queja_procedente
 * @property string|null $porque_procedente
 * @property bool $realizar_accion
 * @property string|null $cual_accion
 * @property bool $desea_levantar_ac
 * @property string|null $acciones_tomara_responsable
 * @property string|null $fecha_limite
 * @property string|null $comentarios_atencion
 * @property bool $cumplio_ac_responsable
 * @property string|null $porque_no_cumplio_responsable
 * @property bool $conforme_solucion
 * @property bool $cerrar_ticket
 * @property int|null $empleado_reporto_id
 * @property int|null $responsable_sgi_id
 * @property int|null $responsable_atencion_queja_id
 * @property int|null $accion_correctiva_id
 * @property bool $correoEnviado
 * @property bool $cumplio_fecha
 * @property bool $correo_enviado_responsable
 * @property bool $correo_enviado_registro
 * @property bool $notificar_responsable
 * @property bool $notificar_registro_queja
 * @property string|null $porque_no_cierre_ticket
 * @property bool $email_env_resolucion_rechazada
 * @property bool $notificar_atencion_queja_no_aprobada
 * @property bool $email_env_resolucion_aprobada
 * @property bool $email_realizara_accion_inmediata
 * @property-read \App\Models\AccionCorrectiva|null $accionCorrectiva
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccionCorrectiva> $accionCorrectivaAprobacional
 * @property-read int|null $accion_correctiva_aprobacional_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AnalisisQuejasClientes> $analisis
 * @property-read int|null $analisis_count
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciasQuejasClientesCerrado> $cierre_evidencias
 * @property-read int|null $cierre_evidencias_count
 * @property-read \App\Models\TimesheetCliente $cliente
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciaQuejasClientes> $evidencias_quejas
 * @property-read int|null $evidencias_quejas_count
 * @property-read mixed $fecha_creacion
 * @property-read mixed $fecha_de_cierre
 * @property-read mixed $fecha_reporte
 * @property-read mixed $folio
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Proceso|null $proceso
 * @property-read \App\Models\TimesheetProyecto $proyectos
 * @property-read \App\Models\Empleado|null $registro
 * @property-read \App\Models\Empleado|null $responsableAtencion
 * @property-read \App\Models\Empleado|null $responsableSgi
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SeguimientoQuejaCliente> $seguimiento
 * @property-read int|null $seguimiento_count
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereAccionCorrectivaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereAccionesTomaraResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereAreaQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCanal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCategoriaQueja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCerrarTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereColaboradorQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereComentariosAtencion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereConformeSolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCorreoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCorreoEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCorreoEnviadoRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCorreoEnviadoResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCualAccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCumplioAcResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereCumplioFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereDeseaLevantarAc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereEmailEnvResolucionAprobada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereEmailEnvResolucionRechazada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereEmailRealizaraAccionInmediata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereEmpleadoReportoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereFechaCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereFechaLimite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereImpacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereNotificarAtencionQuejaNoAprobada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereNotificarRegistroQueja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereNotificarResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereOtroCanal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereOtroCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereOtroQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente wherePorqueNoCierreTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente wherePorqueNoCumplioResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente wherePorqueProcedente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereProcesoQuejado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereProyectosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereQuejaProcedente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereRealizarAccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereResponsableAtencionQuejaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereResponsableSgiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereSolucionRequeridaCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente whereUrgencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|QuejasCliente withoutTrashed()
 */
	class QuejasCliente extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\BeneficiariosEmpleado
 *
 * @property int $id
 * @property int $empleado_id
 * @property string $nombre
 * @property string $parentesco
 * @property int $porcentaje
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $edad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado whereEdad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado whereParentesco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado wherePorcentaje($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeneficiariosEmpleado whereUpdatedAt($value)
 */
	class BeneficiariosEmpleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\Competencia
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $tipo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $toda_la_empresa
 * @property string|null $imagen
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\CompetenciaPuesto> $competencia_puesto
 * @property-read int|null $competencia_puesto_count
 * @property-read mixed $existe_imagen_en_servidor
 * @property-read mixed $imagen_ruta
 * @property-read mixed $tipo_competencia
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\Conducta> $opciones
 * @property-read int|null $opciones_count
 * @property-read \App\Models\RH\TipoCompetencia $tipo
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereTodaLaEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Competencia withoutTrashed()
 */
	class Competencia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\CompetenciaPuesto
 *
 * @property int $id
 * @property int $puesto_id
 * @property int $competencia_id
 * @property int $nivel_esperado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RH\Competencia $competencia
 * @property-read \App\Models\Puesto $puesto
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto whereCompetenciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto whereNivelEsperado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompetenciaPuesto whereUpdatedAt($value)
 */
	class CompetenciaPuesto extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\Conducta
 *
 * @property int $id
 * @property string $definicion
 * @property int $ponderacion
 * @property int $competencia_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $definicion_h
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta whereCompetenciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta whereDefinicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta wherePonderacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conducta whereUpdatedAt($value)
 */
	class Conducta extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\ContactosEmergenciaEmpleado
 *
 * @property int $id
 * @property int $empleado_id
 * @property string $nombre
 * @property string $telefono
 * @property string $parentesco
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado whereParentesco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactosEmergenciaEmpleado whereUpdatedAt($value)
 */
	class ContactosEmergenciaEmpleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\DependientesEconomicosEmpleados
 *
 * @property int $id
 * @property int $empleado_id
 * @property string $nombre
 * @property string $parentesco
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados query()
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados whereParentesco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DependientesEconomicosEmpleados whereUpdatedAt($value)
 */
	class DependientesEconomicosEmpleados extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\EntidadCrediticia
 *
 * @property int $id
 * @property string $entidad
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia whereEntidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntidadCrediticia whereUpdatedAt($value)
 */
	class EntidadCrediticia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\Evaluacion
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $estatus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $autor_id
 * @property bool $autoevaluacion
 * @property bool $evaluado_por_jefe
 * @property bool $evaluado_por_equipo_a_cargo
 * @property bool $evaluado_por_misma_area
 * @property \Illuminate\Support\Carbon|null $fecha_inicio
 * @property \Illuminate\Support\Carbon|null $fecha_fin
 * @property bool $include_competencias
 * @property bool $include_objetivos
 * @property string $evaluados_objetivo
 * @property int $peso_autoevaluacion
 * @property int $peso_jefe_inmediato
 * @property int $peso_equipo
 * @property int $peso_area
 * @property int $peso_general_competencias
 * @property int $peso_general_objetivos
 * @property bool $email_sended
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $autor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\Competencia> $competencias
 * @property-read int|null $competencias_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $evaluados
 * @property-read int|null $evaluados_count
 * @property-read mixed $color_estatus
 * @property-read mixed $color_estatus_text
 * @property-read mixed $estatus_formateado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\Objetivo> $objetivos
 * @property-read int|null $objetivos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereAutoevaluacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereAutorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereEmailSended($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereEvaluadoPorEquipoACargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereEvaluadoPorJefe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereEvaluadoPorMismaArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereEvaluadosObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereIncludeCompetencias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereIncludeObjetivos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion wherePesoArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion wherePesoAutoevaluacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion wherePesoEquipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion wherePesoGeneralCompetencias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion wherePesoGeneralObjetivos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion wherePesoJefeInmediato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluacion withoutTrashed()
 */
	class Evaluacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\EvaluacionCompetencia
 *
 * @property int $id
 * @property int $competencia_id
 * @property int $evaluacion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RH\Competencia $competencia
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionCompetencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionCompetencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionCompetencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionCompetencia whereCompetenciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionCompetencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionCompetencia whereEvaluacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionCompetencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionCompetencia whereUpdatedAt($value)
 */
	class EvaluacionCompetencia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\EvaluacionObjetivo
 *
 * @property int $id
 * @property int $objetivo_id
 * @property int $evaluacion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RH\Objetivo $objetivo
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereEvaluacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereObjetivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionObjetivo whereUpdatedAt($value)
 */
	class EvaluacionObjetivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\EvaluacionRepuesta
 *
 * @property int $id
 * @property int $calificacion
 * @property string|null $descripcion
 * @property int $competencia_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $evaluado_id
 * @property int $evaluador_id
 * @property int $evaluacion_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RH\Competencia $competencia
 * @property-read \App\Models\RH\Evaluacion $evaluacion
 * @property-read \App\Models\Empleado $evaluado
 * @property-read \App\Models\Empleado $evaluador
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereCalificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereCompetenciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereEvaluacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereEvaluadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereEvaluadorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionRepuesta whereUpdatedAt($value)
 */
	class EvaluacionRepuesta extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\EvaluacionesEvaluados
 *
 * @property int $id
 * @property int $evaluacion_id
 * @property int $evaluado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $puesto_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados whereEvaluacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados whereEvaluadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluacionesEvaluados whereUpdatedAt($value)
 */
	class EvaluacionesEvaluados extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\EvaluadoEvaluador
 *
 * @property int $id
 * @property int $evaluado_id
 * @property int $evaluador_id
 * @property int $evaluacion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $evaluado
 * @property int $peso
 * @property string|null $firma_evaluado
 * @property string|null $firma_evaluador
 * @property string|null $tipo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado $empleado_evaluado
 * @property-read \App\Models\RH\Evaluacion $evaluacion
 * @property-read \App\Models\Empleado $evaluador
 * @property-read mixed $progreso_competencias
 * @property-read mixed $progreso_objetivos
 * @property-read mixed $tipo_formateado
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereEvaluacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereEvaluado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereEvaluadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereEvaluadorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereFirmaEvaluado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereFirmaEvaluador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador wherePeso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluadoEvaluador whereUpdatedAt($value)
 */
	class EvaluadoEvaluador extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\GruposEvaluado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $empleados
 * @property-read int|null $empleados_count
 * @method static \Illuminate\Database\Eloquent\Builder|GruposEvaluado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GruposEvaluado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GruposEvaluado query()
 * @method static \Illuminate\Database\Eloquent\Builder|GruposEvaluado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GruposEvaluado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GruposEvaluado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GruposEvaluado whereUpdatedAt($value)
 */
	class GruposEvaluado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\MetricasObjetivo
 *
 * @property int $id
 * @property string $definicion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|MetricasObjetivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetricasObjetivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetricasObjetivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|MetricasObjetivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetricasObjetivo whereDefinicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetricasObjetivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetricasObjetivo whereUpdatedAt($value)
 */
	class MetricasObjetivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\Objetivo
 *
 * @property int $id
 * @property string $nombre
 * @property string $KPI
 * @property int $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $tipo_id
 * @property string|null $descripcion_meta
 * @property int $metrica_id
 * @property string|null $imagen
 * @property string $esta_aprobado
 * @property string|null $comentarios_aprobacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RH\ObjetivoCalificacion $calificacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\ObjetivoComentario> $comentarios
 * @property-read int|null $comentarios_count
 * @property-read mixed $imagen_ruta
 * @property-read \App\Models\RH\MetricasObjetivo $metrica
 * @property-read \App\Models\RH\TipoObjetivo $tipo
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo aprobado()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereComentariosAprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereDescripcionMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereEstaAprobado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereKPI($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereMetricaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Objetivo withoutTrashed()
 */
	class Objetivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\ObjetivoCalificacion
 *
 * @property int $id
 * @property string $meta_alcanzada
 * @property int $calificacion
 * @property int $objetivo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $evaluado_id
 * @property int $evaluador_id
 * @property int $evaluacion_id
 * @property bool $evaluado
 * @property int $calificacion_persepcion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereCalificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereCalificacionPersepcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereEvaluacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereEvaluado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereEvaluadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereEvaluadorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereMetaAlcanzada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereObjetivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoCalificacion whereUpdatedAt($value)
 */
	class ObjetivoCalificacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\ObjetivoComentario
 *
 * @property int $id
 * @property string $comentario
 * @property string $tipo
 * @property int $empleado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\Objetivo> $objetivos
 * @property-read int|null $objetivos_count
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario query()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario whereComentario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoComentario whereUpdatedAt($value)
 */
	class ObjetivoComentario extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\ObjetivoEmpleado
 *
 * @property int $id
 * @property int $empleado_id
 * @property int $objetivo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $completado
 * @property bool $en_curso
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RH\Objetivo $objetivo
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado whereCompletado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado whereEnCurso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado whereObjetivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoEmpleado whereUpdatedAt($value)
 */
	class ObjetivoEmpleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\ObjetivoRespuesta
 *
 * @property int $id
 * @property string $meta_alcanzada
 * @property int $calificacion
 * @property int $objetivo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $evaluado_id
 * @property int $evaluador_id
 * @property int $evaluacion_id
 * @property \App\Models\Empleado $evaluado
 * @property int $calificacion_persepcion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RH\Evaluacion $evaluacion
 * @property-read \App\Models\Empleado $evaluador
 * @property-read \App\Models\RH\Objetivo $objetivo
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta query()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereCalificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereCalificacionPersepcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereEvaluacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereEvaluado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereEvaluadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereEvaluadorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereMetaAlcanzada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereObjetivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjetivoRespuesta whereUpdatedAt($value)
 */
	class ObjetivoRespuesta extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\PeriodoEvaluacion
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodoEvaluacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodoEvaluacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodoEvaluacion query()
 */
	class PeriodoEvaluacion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\RangosResultado
 *
 * @property int $id
 * @property int $inaceptable
 * @property int $minimo_aceptable
 * @property int $aceptable
 * @property int $sobresaliente
 * @property int $evaluacion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\RH\Evaluacion $evaluacion
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado query()
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereAceptable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereEvaluacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereInaceptable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereMinimoAceptable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereSobresaliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RangosResultado withoutTrashed()
 */
	class RangosResultado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\TipoCompetencia
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoCompetencia withoutTrashed()
 */
	class TipoCompetencia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\TipoContratoEmpleado
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoContratoEmpleado withoutTrashed()
 */
	class TipoContratoEmpleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\RH{
/**
 * App\Models\RH\TipoObjetivo
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $imagen
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $imagen_ruta
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RH\Objetivo> $objetivos
 * @property-read int|null $objetivos_count
 * @method static \Illuminate\Database\Eloquent\Builder|TipoObjetivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoObjetivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoObjetivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoObjetivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoObjetivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoObjetivo whereImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoObjetivo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoObjetivo whereUpdatedAt($value)
 */
	class TipoObjetivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Recurso
 *
 * @property int $id
 * @property string|null $cursoscapacitaciones
 * @property string|null $fecha_curso
 * @property string|null $instructor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property string|null $fecha_fin
 * @property string|null $duracion
 * @property string|null $descripcion
 * @property string|null $tipo
 * @property int|null $categoria_capacitacion_id
 * @property string $modalidad
 * @property string $ubicacion
 * @property string|null $archivar
 * @property string|null $fecha_limite
 * @property object|null $tipo_seleccion_participantes
 * @property string|null $estatus
 * @property object|null $configuracion_invitacion_envio
 * @property string|null $lista_asistencia
 * @property bool $is_sync_elearning
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FileCapacitacion> $archivos
 * @property-read int|null $archivos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\CategoriaCapacitacion|null $categoria_capacitacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $empleados
 * @property-read int|null $empleados_count
 * @property-read mixed $certificado
 * @property-read mixed $estatus_aceptacion
 * @property-read mixed $fecha_fin_format_diagonal
 * @property-read mixed $fecha_fin_name
 * @property-read mixed $fecha_inicio_format_diagonal
 * @property-read mixed $fecha_inicio_name
 * @property-read mixed $fecha_inicio_y_m_d
 * @property-read mixed $fecha_limite_name
 * @property-read mixed $fecha_limite_y_m_d
 * @property-read mixed $only_fecha_fin
 * @property-read mixed $only_fecha_fin_hora
 * @property-read mixed $only_fecha_inicio
 * @property-read mixed $only_fecha_inicio_hora
 * @property-read mixed $ruta_lista_asistencia
 * @property-read mixed $ya_finalizo
 * @property-read mixed $ya_inicio
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $participantes
 * @property-read int|null $participantes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SeccionRecurso> $secciones
 * @property-read int|null $secciones_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso capacitacionesEnCurso()
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso capacitacionesProximas()
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso capacitacionesTerminadas()
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereArchivar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereCategoriaCapacitacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereConfiguracionInvitacionEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereCursoscapacitaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereDuracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereFechaCurso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereFechaLimite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereInstructor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereIsSyncElearning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereListaAsistencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereModalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereTipoSeleccionParticipantes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Recurso withoutTrashed()
 */
	class Recurso extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Registromejora
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $prioridad
 * @property string|null $clasificacion
 * @property string|null $descripcion
 * @property string|null $participantes
 * @property string|null $recursos
 * @property string|null $beneficios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $nombre_reporta_id
 * @property int|null $responsableimplementacion_id
 * @property int|null $valida_id
 * @property int|null $team_id
 * @property int|null $id_reporta
 * @property int|null $id_responsable
 * @property int|null $id_participantes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dmaic> $mejoraDmaics
 * @property-read int|null $mejora_dmaics_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanMejora> $mejoraPlanMejoras
 * @property-read int|null $mejora_plan_mejoras_count
 * @property-read \App\Models\User|null $nombre_reporta
 * @property-read \App\Models\User|null $responsableimplementacion
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\User|null $valida
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora query()
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereBeneficios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereClasificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereIdParticipantes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereIdReporta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereIdResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereNombreReportaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereParticipantes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereRecursos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereResponsableimplementacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora whereValidaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Registromejora withoutTrashed()
 */
	class Registromejora extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\RevisionDireccion
 *
 * @property int $id
 * @property string|null $estadorevisionesprevias
 * @property string|null $cambiosinternosexternos
 * @property string|null $retroalimentaciondesempeno
 * @property string|null $retroalimentacionpartesinteresadas
 * @property string|null $resultadosriesgos
 * @property string|null $oportunidadesmejoracontinua
 * @property string|null $acuerdoscambios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereAcuerdoscambios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereCambiosinternosexternos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereEstadorevisionesprevias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereOportunidadesmejoracontinua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereResultadosriesgos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereRetroalimentaciondesempeno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereRetroalimentacionpartesinteresadas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDireccion withoutTrashed()
 */
	class RevisionDireccion extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\RevisionDocumento
 *
 * @property int $id
 * @property int $empleado_id
 * @property int $documento_id
 * @property string|null $comentarios
 * @property string|null $nivel
 * @property string $estatus
 * @property string $no_revision
 * @property string $version
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $archivado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Documento $documento
 * @property-read \App\Models\Empleado $empleado
 * @property-read mixed $before_level_all_answered
 * @property-read mixed $color_revisiones_estatus
 * @property-read mixed $estatus_revisiones_formateado
 * @property-read mixed $fecha_solicitud
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereDocumentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereNoRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionDocumento withoutTrashed()
 */
	class RevisionDocumento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\RevisionMinuta
 *
 * @property int $id
 * @property int $empleado_id
 * @property int $minuta_id
 * @property string|null $comentarios
 * @property string|null $nivel
 * @property string $estatus
 * @property string $no_revision
 * @property string $archivado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado $empleado
 * @property-read mixed $color_revisiones_estatus
 * @property-read mixed $estatus_revisiones_formateado
 * @property-read mixed $fecha_solicitud
 * @property-read \App\Models\Minutasaltadireccion $minuta
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereMinutaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereNoRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RevisionMinuta withoutTrashed()
 */
	class RevisionMinuta extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\RiesgoIdentificado
 *
 * @property int $id
 * @property string|null $titulo
 * @property string|null $fecha
 * @property string|null $fecha_cierre
 * @property string $estatus
 * @property string|null $sede
 * @property string|null $ubicacion
 * @property string|null $descripcion
 * @property string|null $areas_afectados
 * @property string|null $procesos_afectados
 * @property string|null $activos_afectados
 * @property string|null $comentarios
 * @property int|null $empleado_reporto_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property bool|null $archivado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccionCorrectiva> $accionCorrectivaAprobacional
 * @property-read int|null $accion_correctiva_aprobacional_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActividadRiesgo> $actividades
 * @property-read int|null $actividades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EvidenciasRiesgo> $evidencias_riesgos
 * @property-read int|null $evidencias_riesgos_count
 * @property-read mixed $fecha_creacion
 * @property-read mixed $fecha_de_cierre
 * @property-read mixed $fecha_reporte
 * @property-read mixed $folio
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Empleado|null $reporto
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado query()
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereActivosAfectados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereAreasAfectados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereEmpleadoReportoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereFechaCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereProcesosAfectados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RiesgoIdentificado whereUpdatedAt($value)
 */
	class RiesgoIdentificado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Riesgosoportunidade
 *
 * @property int $id
 * @property string|null $aplicaorganizacion
 * @property string|null $justificacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $control_id
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Controle|null $control
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade query()
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade whereAplicaorganizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade whereControlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Riesgosoportunidade withoutTrashed()
 */
	class Riesgosoportunidade extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string|null $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutTrashed()
 */
	class Role extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\RolesResponsabilidade
 *
 * @property int $id
 * @property string $responsabilidad
 * @property string $direccionsgsi
 * @property string|null $comiteseguridad
 * @property string|null $responsablesgsi
 * @property string|null $coordinadorsgsi
 * @property string|null $rol
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade query()
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereComiteseguridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereCoordinadorsgsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereDireccionsgsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereResponsabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereResponsablesgsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RolesResponsabilidade withoutTrashed()
 */
	class RolesResponsabilidade extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property string|null $working_day
 * @property string|null $start_work_time
 * @property string|null $end_work_time
 * @property int|null $organizacions_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereEndWorkTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereOrganizacionsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStartWorkTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereWorkingDay($value)
 */
	class Schedule extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\SeccionRecurso
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $iframe
 * @property int $seccion_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Recurso $capacitacion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LeccionRecurso> $lecciones
 * @property-read int|null $lecciones_count
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso query()
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso whereIframe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso whereSeccionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SeccionRecurso withoutTrashed()
 */
	class SeccionRecurso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Sede.
 *
 * @property int $id
 * @property string $sede
 * @property string|null $foto_sedes
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $organizacion_id
 * @property int|null $team_id
 * @property string|null $direccion
 * @property Organizacion|null $organizacion
 * @property Team|null $team
 * @property Collection|Activo[] $activos
 * @property Collection|Empleado[] $empleados
 * @property float|null $latitude
 * @property float|null $longitud
 * @property-read int|null $activos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $empleados_count
 * @method static \Database\Factories\SedeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Sede newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sede newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sede onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sede query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereFotoSedes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereOrganizacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereSede($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sede withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sede withoutTrashed()
 */
	class Sede extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class SeguimientoQuejaCliente.
 *
 * @property int $id
 * @property int $queja_cliente_id
 * @property int $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property QuejasCliente $quejas_cliente
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\QuejasCliente $quejas
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente whereQuejaClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SeguimientoQuejaCliente withoutTrashed()
 */
	class SeguimientoQuejaCliente extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\SolicitudDayOff
 *
 * @property int $id
 * @property int|null $dias_solicitados
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string|null $descripcion
 * @property int $aprobacion
 * @property int $año
 * @property int $autoriza
 * @property string|null $comentarios_aprobador
 * @property int|null $empleado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff query()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereAprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereAutoriza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereAño($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereComentariosAprobador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereDiasSolicitados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDayOff withoutTrashed()
 */
	class SolicitudDayOff extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\SolicitudPermisoGoceSueldo
 *
 * @property int $id
 * @property int|null $dias_solicitados
 * @property string $fecha_inicio
 * @property string|null $fecha_fin
 * @property string|null $descripcion
 * @property int $aprobacion
 * @property int $autoriza
 * @property string|null $comentarios_aprobador
 * @property int|null $empleado_id
 * @property int|null $permiso_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read \App\Models\PermisosGoceSueldo|null $permiso
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo query()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereAprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereAutoriza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereComentariosAprobador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereDiasSolicitados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo wherePermisoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudPermisoGoceSueldo withoutTrashed()
 */
	class SolicitudPermisoGoceSueldo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\SolicitudVacaciones
 *
 * @property int $id
 * @property int|null $dias_solicitados
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string|null $descripcion
 * @property int $aprobacion
 * @property int $año
 * @property int $autoriza
 * @property string|null $comentarios_aprobador
 * @property int|null $empleado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones query()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereAprobacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereAutoriza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereAño($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereComentariosAprobador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereDiasSolicitados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudVacaciones withoutTrashed()
 */
	class SolicitudVacaciones extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class SubcategoriaActivo.
 *
 * @property int $id
 * @property character varying $subcategoria
 * @property int $categoria_id
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Tipoactivo $tipoactivo
 * @property string $subcategoria
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo whereSubcategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaActivo withoutTrashed()
 */
	class SubcategoriaActivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\SubcategoriaIncidente
 *
 * @property int $id
 * @property string $subcategoria
 * @property int|null $categoria_id
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\CategoriaIncidente|null $categoria
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente whereSubcategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoriaIncidente whereUpdatedAt($value)
 */
	class SubcategoriaIncidente extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Sugerencias
 *
 * @property int $id
 * @property string $titulo
 * @property string $estatus
 * @property string $descripcion
 * @property string|null $area_sugerencias
 * @property string|null $proceso_sugerencias
 * @property string|null $fecha_cierre
 * @property int|null $empleado_sugirio_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property bool|null $archivado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccionCorrectiva> $accionCorrectivaAprobacional
 * @property-read int|null $accion_correctiva_aprobacional_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActividadSugerencia> $actividades
 * @property-read int|null $actividades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $fecha_de_cierre
 * @property-read mixed $fecha_reporte
 * @property-read mixed $folio
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlanImplementacion> $planes
 * @property-read int|null $planes_count
 * @property-read \App\Models\Empleado|null $sugirio
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereArchivado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereAreaSugerencias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereEmpleadoSugirioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereFechaCierre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereProcesoSugerencias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugerencias whereUpdatedAt($value)
 */
	class Sugerencias extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class TablaImpacto.
 *
 * @property int $id
 * @property string|null $impacto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|NivelesImpacto[] $niveles_impactos
 * @property Collection|TipoImpacto[] $tipo_impactos
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $niveles_impactos_count
 * @property-read int|null $tipo_impactos_count
 * @method static \Illuminate\Database\Eloquent\Builder|TablaImpacto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablaImpacto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablaImpacto query()
 * @method static \Illuminate\Database\Eloquent\Builder|TablaImpacto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaImpacto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaImpacto whereImpacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaImpacto whereUpdatedAt($value)
 */
	class TablaImpacto extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Team
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $owner_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User|null $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Team withoutTrashed()
 */
	class Team extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Timesheet
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $fecha_dia
 * @property int $empleado_id
 * @property int|null $aprobador_id
 * @property string $estatus
 * @property string|null $comentarios
 * @property string $dia_semana
 * @property string $inicio_semana
 * @property string $fin_semana
 * @property-read \App\Models\Empleado|null $aprobador
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado $empleado
 * @property-read mixed $fin
 * @property-read mixed $fin_letras
 * @property-read mixed $inicio
 * @property-read mixed $inicio_letras
 * @property-read void $proyectos
 * @property-read mixed $semana
 * @property-read mixed $semana_text
 * @property-read mixed $semana_y
 * @property-read void $total_horas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TimesheetHoras> $horas
 * @property-read int|null $horas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereAprobadorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereDiaSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereFechaDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereFinSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereInicioSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Timesheet whereUpdatedAt($value)
 */
	class Timesheet extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TimesheetCliente
 *
 * @property int $id
 * @property string $razon_social
 * @property string|null $nombre
 * @property string|null $rfc
 * @property string|null $calle
 * @property string|null $colonia
 * @property string|null $ciudad
 * @property string|null $codigo_postal
 * @property string|null $telefono
 * @property string|null $pagina_web
 * @property string|null $nombre_contacto
 * @property string|null $puesto_contacto
 * @property string|null $correo_contacto
 * @property string|null $celular_contacto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $identificador
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuejasCliente> $cliente
 * @property-read int|null $cliente_count
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereCalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereCelularContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereCiudad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereCodigoPostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereColonia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereCorreoContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereIdentificador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereNombreContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente wherePaginaWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente wherePuestoContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereRfc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetCliente whereUpdatedAt($value)
 */
	class TimesheetCliente extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TimesheetHoras
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool|null $facturable
 * @property int|null $timesheet_id
 * @property int|null $proyecto_id
 * @property int|null $tarea_id
 * @property string|null $horas_lunes
 * @property string|null $horas_martes
 * @property string|null $horas_miercoles
 * @property string|null $horas_jueves
 * @property string|null $horas_viernes
 * @property string|null $horas_sabado
 * @property string|null $horas_domingo
 * @property string|null $descripcion
 * @property int|null $empleado_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\TimesheetProyecto|null $proyecto
 * @property-read \App\Models\TimesheetTarea|null $tarea
 * @property-read \App\Models\Timesheet|null $timesheet
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereFacturable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereHorasDomingo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereHorasJueves($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereHorasLunes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereHorasMartes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereHorasMiercoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereHorasSabado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereHorasViernes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereProyectoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereTareaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereTimesheetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetHoras whereUpdatedAt($value)
 */
	class TimesheetHoras extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TimesheetProyecto
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $proyecto
 * @property int|null $cliente_id
 * @property string $estatus
 * @property string|null $identificador
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 * @property int|null $sede_id
 * @property string|null $tipo
 * @property int|null $horas_proyecto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\TimesheetCliente|null $cliente
 * @property-read mixed $areas
 * @property-read mixed $empleados
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TimesheetProyectoProveedor> $proveedores
 * @property-read int|null $proveedores_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TimesheetProyectoEmpleado> $proyectos
 * @property-read int|null $proyectos_count
 * @property-read \App\Models\Sede|null $sede
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TimesheetTarea> $tareas
 * @property-read int|null $tareas_count
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereHorasProyecto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereIdentificador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereProyecto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereSedeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyecto whereUpdatedAt($value)
 */
	class TimesheetProyecto extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TimesheetProyectoArea
 *
 * @property int $id
 * @property int $proyecto_id
 * @property int $area_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\TimesheetProyecto $proyecto
 * @property-read \App\Models\TimesheetProyectoEmpleado $proyectosAsignados
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoArea whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoArea whereProyectoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoArea whereUpdatedAt($value)
 */
	class TimesheetProyectoArea extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TimesheetProyectoEmpleado
 *
 * @property int $id
 * @property int $proyecto_id
 * @property int $empleado_id
 * @property int|null $area_id
 * @property float|null $horas_asignadas
 * @property float|null $costo_hora
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool|null $correo_enviado
 * @property bool|null $usuario_bloqueado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado $empleado
 * @property-read \App\Models\TimesheetProyecto $proyecto
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereCorreoEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereCostoHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereHorasAsignadas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereProyectoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoEmpleado whereUsuarioBloqueado($value)
 */
	class TimesheetProyectoEmpleado extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TimesheetProyectoProveedor
 *
 * @property int $id
 * @property int $proyecto_id
 * @property string|null $proveedor_tercero
 * @property float|null $horas_tercero
 * @property float|null $costo_tercero
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\TimesheetProyecto $proyecto
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor whereCostoTercero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor whereHorasTercero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor whereProveedorTercero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor whereProyectoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetProyectoProveedor whereUpdatedAt($value)
 */
	class TimesheetProyectoProveedor extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TimesheetTarea
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $tarea
 * @property int|null $proyecto_id
 * @property int|null $area_id
 * @property bool $todos
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\Area|null $areaData
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $areas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TimesheetHoras> $horas
 * @property-read int|null $horas_count
 * @property-read \App\Models\TimesheetProyecto|null $proyecto
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereProyectoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereTarea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereTodos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimesheetTarea whereUpdatedAt($value)
 */
	class TimesheetTarea extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TipoDePermiso
 *
 * @property int $id
 * @property string $nombre
 * @property string $slug
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ControlAcceso> $controlacceso
 * @property-read int|null $controlacceso_count
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso query()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoDePermiso whereUpdatedAt($value)
 */
	class TipoDePermiso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class TipoImpacto.
 *
 * @property int $id
 * @property string|null $nombre_impacto
 * @property string|null $criterio
 * @property string|null $base
 * @property int|null $niveles_impacto_id
 * @property int|null $tabla_impacto_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property NivelesImpacto|null $niveles_impacto
 * @property TablaImpacto|null $tabla_impacto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto query()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto whereBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto whereCriterio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto whereNivelesImpactoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto whereNombreImpacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto whereTablaImpactoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoImpacto whereUpdatedAt($value)
 */
	class TipoImpacto extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class TipoNivelImpacto.
 *
 * @property int $id
 * @property int|null $tabla_impacto_id
 * @property int|null $niveles_impacto_id
 * @property string|null $contenido
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TablaImpacto|null $tabla_impacto
 * @property NivelesImpacto|null $niveles_impacto
 * @property int|null $tipo_impacto_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\TipoImpacto|null $tipo_impacto
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto query()
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto whereContenido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto whereNivelesImpactoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto whereTipoImpactoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TipoNivelImpacto whereUpdatedAt($value)
 */
	class TipoNivelImpacto extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Tipoactivo.
 *
 * @property int $id
 * @property character varying $tipo
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property Team|null $team
 * @property Collection|SubcategoriaActivo[] $subcategoria_activos
 * @property Collection|Marca[] $marcas
 * @property Collection|Activo[] $activos
 * @property string $tipo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $activos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int|null $marcas_count
 * @property-read int|null $subcategoria_activos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipoactivo withoutTrashed()
 */
	class Tipoactivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TiposObjetivosSistema
 *
 * @property int $id
 * @property string $nombre
 * @property string $slug
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Objetivosseguridad> $objetivosseguridad
 * @property-read int|null $objetivosseguridad_count
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema query()
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TiposObjetivosSistema whereUpdatedAt($value)
 */
	class TiposObjetivosSistema extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TratamientoRiesgo
 *
 * @property int $id
 * @property string|null $nivelriesgo
 * @property string|null $acciones
 * @property string|null $fechacompromiso
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $identificador
 * @property string|null $descripcionriesgo
 * @property string|null $tipo_riesgo
 * @property float|null $riesgototal
 * @property string|null $riesgo_total_residual
 * @property int|null $id_proceso
 * @property string|null $inversion_requerida
 * @property int|null $id_dueno
 * @property int|null $matriz_sistema_gestion_id
 * @property int|null $id_registro
 * @property string|null $firma_responsable_aprobador
 * @property string $es_aprobado
 * @property string|null $comentarios
 * @property string|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\DeclaracionAplicabilidad $control
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empleado> $participantes
 * @property-read int|null $participantes_count
 * @property-read \App\Models\Proceso|null $proceso
 * @property-read \App\Models\Empleado|null $registro
 * @property-read \App\Models\Empleado|null $responsable
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo query()
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereAcciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereDescripcionriesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereEsAprobado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereFechacompromiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereFirmaResponsableAprobador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereIdDueno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereIdRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereIdentificador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereInversionRequerida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereMatrizSistemaGestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereNivelriesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereRiesgoTotalResidual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereRiesgototal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereTipoRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TratamientoRiesgo withoutTrashed()
 */
	class TratamientoRiesgo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property bool|null $approved
 * @property bool|null $verified
 * @property string|null $verified_at
 * @property string|null $verification_token
 * @property bool|null $two_factor
 * @property string|null $two_factor_code
 * @property string|null $two_factor_expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $organizacion_id
 * @property int|null $area_id
 * @property int|null $puesto_id
 * @property int|null $team_id
 * @property string|null $n_empleado
 * @property bool $is_active
 * @property int|null $empleado_id
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @property-read mixed $is_admin
 * @property-read \App\Models\Empleado|null $nEmpleado
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Organizacione|null $organizacion
 * @property-read \App\Models\Puesto|null $puesto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\Team|null $team
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserAlert> $userUserAlerts
 * @property-read int|null $user_user_alerts_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNEmpleado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOrganizacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerificationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\UserAlert
 *
 * @property int $id
 * @property string|null $alert_text
 * @property string|null $alert_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Team|null $team
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert whereAlertLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert whereAlertText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAlert whereUpdatedAt($value)
 */
	class UserAlert extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Vacaciones
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int|null $dias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $afectados
 * @property int|null $tipo_conteo
 * @property int|null $inicio_conteo
 * @property int|null $incremento_dias
 * @property int|null $periodo_corte
 * @property int|null $fin_conteo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Area> $areas
 * @property-read int|null $areas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereAfectados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereDias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereFinConteo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereIncrementoDias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereInicioConteo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones wherePeriodoCorte($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereTipoConteo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacaciones withoutTrashed()
 */
	class Vacaciones extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class VariablesIndicador.
 *
 * @property int $id
 * @property int|null $id_indicador
 * @property string|null $variable
 * @property int|null $valor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property IndicadoresSgsi|null $indicadores_sgsi
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador whereIdIndicador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador whereVariable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesIndicador withoutTrashed()
 */
	class VariablesIndicador extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class VariablesObjetivosseguridad.
 *
 * @property int $id
 * @property int|null $id_objetivo
 * @property character varying|null $variable
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Objetivosseguridad|null $objetivosseguridad
 * @property string|null $variable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad whereIdObjetivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad whereVariable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VariablesObjetivosseguridad withoutTrashed()
 */
	class VariablesObjetivosseguridad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\VersionesIso
 *
 * @property int $id
 * @property bool|null $version_historico
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|VersionesIso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VersionesIso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VersionesIso query()
 * @method static \Illuminate\Database\Eloquent\Builder|VersionesIso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionesIso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionesIso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionesIso whereVersionHistorico($value)
 */
	class VersionesIso extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Visitantes{
/**
 * App\Models\Visitantes\AvisoPrivacidadVisitante
 *
 * @property int $id
 * @property string $aviso_privacidad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante query()
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante whereAvisoPrivacidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AvisoPrivacidadVisitante withoutTrashed()
 */
	class AvisoPrivacidadVisitante extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Visitantes{
/**
 * App\Models\Visitantes\RegistrarVisitante
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string|null $email
 * @property string|null $telefono
 * @property string|null $celular
 * @property string|null $empresa
 * @property string|null $dispositivo
 * @property string|null $serie
 * @property string|null $motivo
 * @property string|null $foto
 * @property string|null $tipo_visita
 * @property int|null $empleado_id
 * @property int|null $area_id
 * @property bool $registro_salida
 * @property string|null $fecha_salida
 * @property string|null $firma
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $uuid
 * @property bool $autorizado
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Visitantes\VisitantesDispositivo> $dispositivos
 * @property-read int|null $dispositivos_count
 * @property-read \App\Models\Empleado|null $empleado
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereAutorizado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereCelular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereDispositivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereFechaSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereFirma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereRegistroSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereTipoVisita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrarVisitante withoutTrashed()
 */
	class RegistrarVisitante extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Visitantes{
/**
 * App\Models\Visitantes\ResponsableVisitantes
 *
 * @property int $id
 * @property int|null $empleado_id
 * @property bool $fotografia_requerida
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $firma_requerida
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Empleado|null $empleado
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes whereFirmaRequerida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes whereFotografiaRequerida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResponsableVisitantes whereUpdatedAt($value)
 */
	class ResponsableVisitantes extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Visitantes{
/**
 * App\Models\Visitantes\VisitanteQuote
 *
 * @property int $id
 * @property string $quote
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote whereQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitanteQuote withoutTrashed()
 */
	class VisitanteQuote extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Visitantes{
/**
 * App\Models\Visitantes\VisitantesDispositivo
 *
 * @property int $id
 * @property int $registrar_visitante_id
 * @property string $dispositivo
 * @property string $serie
 * @property string|null $marca
 * @property string|null $modelo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Visitantes\RegistrarVisitante $visitante
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo whereDispositivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo whereMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo whereModelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo whereRegistrarVisitanteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitantesDispositivo whereUpdatedAt($value)
 */
	class VisitantesDispositivo extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\VistaDocumento
 *
 * @property int $id
 * @property int $empleado_id
 * @property int $documento_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Documento $docummentos
 * @property-read \App\Models\Empleado $empleados
 * @method static \Illuminate\Database\Eloquent\Builder|VistaDocumento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VistaDocumento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VistaDocumento query()
 * @method static \Illuminate\Database\Eloquent\Builder|VistaDocumento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VistaDocumento whereDocumentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VistaDocumento whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VistaDocumento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VistaDocumento whereUpdatedAt($value)
 */
	class VistaDocumento extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * Class Vulnerabilidad.
 *
 * @version August 5, 2021, 7:45 pm UTC
 * @property \App\Models\Amenaza $idAmenaza
 * @property string $nombre
 * @property string $descripcion
 * @property int $id_amenaza
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizRiesgo> $matriz_riesgos
 * @property-read int|null $matriz_riesgos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad whereIdAmenaza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Vulnerabilidad withoutTrashed()
 */
	class Vulnerabilidad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\activoConfidencialidad
 *
 * @property int $id
 * @property string|null $confidencialidad
 * @property int|null $valor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad whereConfidencialidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoConfidencialidad whereValor($value)
 */
	class activoConfidencialidad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\activoDisponibilidad
 *
 * @property int $id
 * @property string|null $disponibilidad
 * @property int|null $valor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad whereDisponibilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoDisponibilidad whereValor($value)
 */
	class activoDisponibilidad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\activoIntegridad
 *
 * @property int $id
 * @property string|null $integridad
 * @property int|null $valor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad query()
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad whereIntegridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|activoIntegridad whereValor($value)
 */
	class activoIntegridad extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\activos_informacion_historico
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveContenedor> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\activoConfidencialidad $confidencialidad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveContenedor> $contenedores
 * @property-read int|null $contenedores_count
 * @property-read \App\Models\Empleado|null $custodio
 * @property-read \App\Models\Area|null $direccion
 * @property-read \App\Models\activoDisponibilidad $disponibilidad
 * @property-read \App\Models\Empleado|null $dueno
 * @property-read mixed $color
 * @property-read mixed $content
 * @property-read mixed $name
 * @property-read mixed $nivel_riesgo_ai
 * @property-read mixed $riesgo_activo
 * @property-read \App\Models\activoIntegridad $integridad
 * @property-read \App\Models\Proceso $proceso
 * @property-read \App\Models\Grupo $vp
 * @method static \Illuminate\Database\Eloquent\Builder|activos_informacion_historico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|activos_informacion_historico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|activos_informacion_historico onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|activos_informacion_historico query()
 * @method static \Illuminate\Database\Eloquent\Builder|activos_informacion_historico withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|activos_informacion_historico withoutTrashed()
 */
	class activos_informacion_historico extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ajustesMatrizBIA
 *
 * @property int $id
 * @property int|null $impacto_operativo
 * @property int|null $impacto_regulatorio
 * @property int|null $impacto_reputacion
 * @property int|null $impacto_social
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA query()
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA whereImpactoOperativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA whereImpactoRegulatorio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA whereImpactoReputacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA whereImpactoSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ajustesMatrizBIA withoutTrashed()
 */
	class ajustesMatrizBIA extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\matriz_octave_contenedores_historico
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoInformacion> $activoInformacion
 * @property-read int|null $activo_informacion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveEscenario> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatrizOctaveEscenario> $escenarios
 * @property-read int|null $escenarios_count
 * @property-read mixed $color
 * @property-read mixed $content
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_contenedores_historico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_contenedores_historico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_contenedores_historico onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_contenedores_historico query()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_contenedores_historico withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_contenedores_historico withoutTrashed()
 */
	class matriz_octave_contenedores_historico extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\matriz_octave_escenarios_historicos
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeclaracionAplicabilidad> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\MatrizOctaveContenedor $contenedor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeclaracionAplicabilidad> $controles
 * @property-read int|null $controles_count
 * @property-read mixed $color
 * @property-read mixed $content
 * @property-read mixed $name
 * @property-read mixed $sumatoria
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_escenarios_historicos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_escenarios_historicos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_escenarios_historicos onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_escenarios_historicos query()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_escenarios_historicos withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_escenarios_historicos withoutTrashed()
 */
	class matriz_octave_escenarios_historicos extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\matriz_octave_procesos_historico
 *
 * @property int $id
 * @property int|null $id_proceso
 * @property int|null $nivel_riesgo
 * @property int|null $id_direccion
 * @property int|null $servicio_id
 * @property int|null $operacional
 * @property int|null $cumplimiento
 * @property int|null $legal
 * @property int|null $reputacional
 * @property int|null $tecnologico
 * @property int|null $impacto
 * @property int|null $id_activos_informacion
 * @property int|null $promedio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $fecha_registro
 * @property int|null $matriz_id
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Proceso|null $children
 * @property-read \App\Models\Proceso|null $proceso
 * @property-read \App\Models\MatrizOctaveServicio|null $servicio
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico query()
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereCumplimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereIdActivosInformacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereIdDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereImpacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereLegal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereMatrizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereNivelRiesgo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereOperacional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico wherePromedio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereReputacional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereServicioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereTecnologico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|matriz_octave_procesos_historico whereUpdatedAt($value)
 */
	class matriz_octave_procesos_historico extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\procesos_activos_informacion_historico
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Proceso $proceso
 * @method static \Illuminate\Database\Eloquent\Builder|procesos_activos_informacion_historico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|procesos_activos_informacion_historico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|procesos_activos_informacion_historico query()
 */
	class procesos_activos_informacion_historico extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

