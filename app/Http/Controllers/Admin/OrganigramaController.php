<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmpleadosExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class OrganigramaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('organigrama_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // La construccion del arbol necesita un primer nodo (NULL)
        $organizacionTree = Empleado::getExists();
        if ($request->ajax()) {
            if ($request->area_filter == 'true') {
                $treeByArea = Area::with(['lider' => function ($query) {
                    $query->select('id', 'name', 'area_id', 'foto', 'puesto_id', 'antiguedad', 'email', 'telefono', 'estatus', 'n_registro', 'n_empleado', 'genero', 'telefono_movil')->with('children');
                }])->find($request->area_id)->lider;

                return $treeByArea->toJson();
            } else {
                if ($request->id == null) {
                    // La construccion del arbol necesita un primer nodo (NULL)
                    $organizacionTree = Empleado::getAllOrganigramaTree();

                    $organizacionArray = $organizacionTree->toArray();
                    if (array_key_exists('saludo', $organizacionArray)) {
                        unset($organizacionArray['saludo']);
                        unset($organizacionArray['declaraciones_responsable']);
                        unset($organizacionArray['declaraciones_responsable2022']);
                        unset($organizacionArray['declaraciones_aprobador2022']);
                        unset($organizacionArray['fecha_ingreso']);
                        unset($organizacionArray['saludo_completo']);
                        unset($organizacionArray['actual_birdthday']);
                        unset($organizacionArray['actual_aniversary']);
                        unset($organizacionArray['obtener_antiguedad']);
                        unset($organizacionArray['declaraciones_aprobador']);
                        unset($organizacionArray['objetivos_asignados']);
                        unset($organizacionArray['objetivos']);
                        unset($organizacionArray['empleados_misma_area']);
                        unset($organizacionArray['empleados_pares']);
                        unset($organizacionArray['puesto_relacionado']);
                        unset($organizacionArray['only_children']);
                    }

                    $newArray = $organizacionArray['children_organigrama'];
                    foreach ($newArray as $key => &$subArray) {
                        if ($subArray['estatus'] === 'baja') {
                            unset($newArray[$key]);
                        }
                    }
                    $newArray = array_values($newArray);
                    $organizacionArray['children_organigrama'] = $newArray;

                    foreach ($organizacionArray['children_organigrama'] as &$subArray) {
                        // Verificamos si el subarray tiene la clave 'id'
                        if (array_key_exists('id', $subArray)) {
                            // Eliminamos la clave 'id' del subarray
                            unset($subArray['saludo']);
                            unset($subArray['declaraciones_responsable']);
                            unset($subArray['declaraciones_responsable2022']);
                            unset($subArray['declaraciones_aprobador2022']);
                            unset($subArray['fecha_ingreso']);
                            unset($subArray['saludo_completo']);
                            unset($subArray['actual_birdthday']);
                            unset($subArray['actual_aniversary']);
                            unset($subArray['obtener_antiguedad']);
                            unset($subArray['declaraciones_aprobador']);
                            unset($subArray['objetivos_asignados']);
                            unset($subArray['objetivos']);
                            unset($subArray['correo_personal']);
                            unset($subArray['estado_civil']);
                            unset($subArray['NSS']);
                            unset($subArray['CURP']);
                            unset($subArray['RFC']);
                            unset($subArray['lugar_nacimiento']);
                            unset($subArray['nacionalidad']);
                            unset($subArray['entidad_crediticias_id']);
                            unset($subArray['numero_credito']);
                            unset($subArray['descuento']);
                            unset($subArray['banco']);
                            unset($subArray['cuenta_bancaria']);
                            unset($subArray['clabe_interbancaria']);
                            unset($subArray['centro_costos']);
                            unset($subArray['salario_bruto']);
                            unset($subArray['salario_diario']);
                            unset($subArray['salario_diario_integrado']);
                            unset($subArray['salario_base_mensual']);
                            unset($subArray['pagadora_actual']);
                            unset($subArray['periodicidad_nomina']);
                            unset($subArray['terminacion_contrato']);
                            unset($subArray['renovacion_contrato']);
                            unset($subArray['esquema_contratacion']);
                            unset($subArray['proyecto_asignado']);
                            unset($subArray['mostrar_telefono']);
                            unset($subArray['calle']);
                            unset($subArray['num_exterior']);
                            unset($subArray['num_interior']);
                            unset($subArray['colonia']);
                            unset($subArray['delegacion']);
                            unset($subArray['estado']);
                            unset($subArray['pais']);
                            unset($subArray['cp']);
                            unset($subArray['fecha_baja']);
                            unset($subArray['razon_baja']);
                            unset($subArray['semanas_min_timesheet']);
                            unset($subArray['vacante_activa']);
                            unset($subArray['deleted_at']);
                            unset($subArray['telefono']);
                            unset($subArray['n_empleado']);
                            unset($subArray['n_registro']);
                            unset($subArray['genero']);
                            unset($subArray['sede_id']);
                            unset($subArray['direccion']);
                            unset($subArray['resumen']);
                            unset($subArray['cumplea\u00f1os']);
                            unset($subArray['telefono_movil']);
                            unset($subArray['extension']);
                            unset($subArray['puesto_id']);
                            unset($subArray['perfil_empleado_id']);
                            unset($subArray['tipo_contrato_empleados_id']);
                            unset($subArray['domicilio_personal']);
                            unset($subArray['telefono_casa']);
                            unset($subArray['avatar']);
                            unset($subArray['avatar_ruta']);
                            unset($subArray['empleados_pares']);
                            unset($subArray['empleados_misma_area']);
                            unset($subArray['supervisor']);
                            unset($subArray['puesto_relacionado']);
                            unset($subArray['only_children']);
                        }

                        $newArrayChil = $subArray['children_organigrama'];
                        foreach ($newArrayChil as $key => &$subArrayd) {
                            if ($subArrayd['estatus'] === 'baja') {
                                unset($newArrayChil[$key]);
                            }
                        }
                        $newArrayChil = array_values($newArrayChil);
                        $subArray['children_organigrama'] = $newArrayChil;

                        foreach ($subArray['children_organigrama'] as &$subArrayd) {

                            unset($subArrayd['declaraciones_responsable']);
                            unset($subArrayd['declaraciones_responsable2022']);
                            unset($subArrayd['declaraciones_aprobador2022']);
                            unset($subArrayd['fecha_ingreso']);
                            unset($subArrayd['saludo_completo']);
                            unset($subArrayd['actual_birdthday']);
                            unset($subArrayd['actual_aniversary']);
                            unset($subArrayd['obtener_antiguedad']);
                            unset($subArrayd['declaraciones_aprobador']);
                            unset($subArrayd['objetivos_asignados']);
                            unset($subArrayd['objetivos']);
                            unset($subArrayd['correo_personal']);
                            unset($subArrayd['estado_civil']);
                            unset($subArrayd['NSS']);
                            unset($subArrayd['CURP']);
                            unset($subArrayd['RFC']);
                            unset($subArrayd['lugar_nacimiento']);
                            unset($subArrayd['nacionalidad']);
                            unset($subArrayd['entidad_crediticias_id']);
                            unset($subArrayd['numero_credito']);
                            unset($subArrayd['descuento']);
                            unset($subArrayd['banco']);
                            unset($subArrayd['cuenta_bancaria']);
                            unset($subArrayd['clabe_interbancaria']);
                            unset($subArrayd['centro_costos']);
                            unset($subArrayd['salario_bruto']);
                            unset($subArrayd['salario_diario']);
                            unset($subArrayd['salario_diario_integrado']);
                            unset($subArrayd['salario_base_mensual']);
                            unset($subArrayd['pagadora_actual']);
                            unset($subArrayd['periodicidad_nomina']);
                            unset($subArrayd['terminacion_contrato']);
                            unset($subArrayd['renovacion_contrato']);
                            unset($subArrayd['esquema_contratacion']);
                            unset($subArrayd['proyecto_asignado']);
                            unset($subArrayd['mostrar_telefono']);
                            unset($subArrayd['calle']);
                            unset($subArrayd['num_exterior']);
                            unset($subArrayd['num_interior']);
                            unset($subArrayd['colonia']);
                            unset($subArrayd['delegacion']);
                            unset($subArrayd['estado']);
                            unset($subArrayd['pais']);
                            unset($subArrayd['cp']);
                            unset($subArrayd['fecha_baja']);
                            unset($subArrayd['razon_baja']);
                            unset($subArrayd['semanas_min_timesheet']);
                            unset($subArrayd['vacante_activa']);
                            unset($subArrayd['deleted_at']);
                            unset($subArrayd['telefono']);
                            unset($subArrayd['n_empleado']);
                            unset($subArrayd['n_registro']);
                            unset($subArrayd['genero']);
                            unset($subArrayd['sede_id']);
                            unset($subArrayd['direccion']);
                            unset($subArrayd['resumen']);
                            unset($subArrayd['cumplea\u00f1os']);
                            unset($subArrayd['telefono_movil']);
                            unset($subArrayd['extension']);
                            unset($subArrayd['puesto_id']);
                            unset($subArrayd['perfil_empleado_id']);
                            unset($subArrayd['tipo_contrato_empleados_id']);
                            unset($subArrayd['domicilio_personal']);
                            unset($subArrayd['telefono_casa']);
                            unset($subArrayd['avatar']);
                            unset($subArrayd['avatar_ruta']);
                            unset($subArrayd['empleados_misma_area']);
                            unset($subArrayd['empleados_pares']);
                            unset($subArrayd['competencias_asignadas']);
                            unset($subArrayd['created_at']);
                            unset($subArrayd['updated_at']);
                            unset($subArrayd['fecha_min_timesheet']);
                            unset($subArrayd['supervisor']);
                            unset($subArrayd['puesto_relacionado']);
                            unset($subArrayd['only_children']);
                        }
                    }

                    return json_encode($organizacionArray);
                } else {
                    $organizacionTree = Empleado::getAllOrganigramaTreeElse($request->id);
                    if ($organizacionTree != null) {
                        return $organizacionTree->toJson();
                    } else {
                        return 'No encontrado';
                    }
                }
            }
        }
        $rutaImagenes = asset('storage/empleados/imagenes/');
        $organizacionDB = Organizacion::getFirst();
        $organizacion = ! is_null($organizacionDB) ? Organizacion::getFirst()->empresa : 'la organización';
        $org_foto = ! is_null($organizacionDB) ? url('images/'.DB::table('organizacions')->select('logotipo')->first()->logotipo) : url('img/Silent4Business-Logo-Color.png');
        $areas = Area::getAll();

        return view('admin.organigrama.index', compact('organizacionTree', 'rutaImagenes', 'organizacion', 'org_foto', 'areas'));
    }

    public function exportTo()
    {
        abort_if(Gate::denies('organigrama_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return Excel::download(new EmpleadosExport, 'empleados.xlsx');
    }
}
