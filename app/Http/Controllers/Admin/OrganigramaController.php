<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmpleadosExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use VXM\Async\AsyncFacade as Async;

class OrganigramaController extends Controller
{
    public function index(Request $request)
    {
        try {

            $organizacionTree = null;
            $organizacionArray = [];
            if ($request->ajax()) {
                if ($request->area_filter === 'true') {
                    $area = Area::with(['lider' => function ($query) {
                        $query->select(
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
                        )->with('children');
                    }])->find($request->area_id);

                    if (!$area) {
                        return response()->json(['error' => 'Área no encontrada'], 404);
                    }

                    return response()->json($area->lider);
                } else {
                    if ($request->id === null) {
                        $organizacionTree = Empleado::getAllOrganigramaTree();
                        if (!$organizacionTree) {
                            return response()->json(['error' => 'No se encontró la organización'], 404);
                        }

                        $organizacionArray = $this->cleanOrganizacionArray($organizacionTree->toArray());
                        return response()->json($organizacionArray);
                    } else {
                        $organizacionTree = Empleado::getAllOrganigramaTreeElse($request->id);

                        return $organizacionTree
                            ? response()->json($organizacionTree)
                            : response()->json(['error' => 'No encontrado'], 404);
                    }
                }
            }

            $rutaImagenes = Async::run(fn() => asset('storage/empleados/imagenes/'));
            $organizacionDB = Async::run(fn() => Organizacion::first());
            $areas = Async::run(fn() => Area::all());

            if ($organizacionDB && property_exists($organizacionDB, 'empresa')) {
                $organizacion = $organizacionDB->empresa;
                $org_foto = url('images/' . $organizacionDB->logotipo);
            } else {
                $organizacion = 'la organización';
                $org_foto = url('img/Silent4Business-Logo-Color.png');
            }
            return view('admin.organigrama.index', compact(
                'organizacionTree',
                'rutaImagenes',
                'organizacion',
                'org_foto',
                'areas'
            ));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function exportTo()
    {
        abort_if(Gate::denies('organigrama_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return Excel::download(new EmpleadosExport, 'empleados.xlsx');
    }

    /**
     * Helper function to clean and format the organization array
     */
    private function cleanOrganizacionArray(array $organizacionArray)
    {
        // Define fields to remove at each level
        $fieldsToRemove = ['saludo', 'declaraciones_responsable', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo_completo', 'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'declaraciones_aprobador', 'objetivos_asignados', 'objetivos', 'correo_personal', 'estado_civil', 'NSS', 'CURP', 'RFC', 'lugar_nacimiento', 'nacionalidad', 'entidad_crediticias_id', 'numero_credito', 'descuento', 'banco', 'cuenta_bancaria', 'clabe_interbancaria', 'centro_costos', 'salario_bruto', 'salario_diario', 'salario_diario_integrado', 'salario_base_mensual', 'pagadora_actual', 'periodicidad_nomina', 'terminacion_contrato', 'renovacion_contrato', 'esquema_contratacion', 'proyecto_asignado', 'mostrar_telefono', 'calle', 'num_exterior', 'num_interior', 'colonia', 'delegacion', 'estado', 'pais', 'cp', 'fecha_baja', 'razon_baja', 'semanas_min_timesheet', 'vacante_activa', 'deleted_at', 'telefono', 'n_empleado', 'n_registro', 'genero', 'sede_id', 'direccion', 'resumen', 'cumpleaños', 'telefono_movil', 'extension', 'puesto_id', 'perfil_empleado_id', 'tipo_contrato_empleados_id', 'domicilio_personal', 'telefono_casa', 'avatar', 'avatar_ruta', 'empleados_pares', 'empleados_misma_area', 'supervisor', 'puesto_relacionado', 'only_children', 'competencias_asignadas', 'created_at', 'updated_at', 'fecha_min_timesheet'];

        // Recursively clean the array
        $this->removeFields($organizacionArray, $fieldsToRemove);

        return $organizacionArray;
    }

    /**
     * Recursive helper to remove fields from a multidimensional array
     */
    private function removeFields(array &$array, array $fields)
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $this->removeFields($value, $fields);
            } elseif (in_array($key, $fields)) {
                unset($array[$key]);
            }
        }

        // Handle 'children_organigrama' field if present
        if (isset($array['children_organigrama'])) {
            foreach ($array['children_organigrama'] as $index => &$child) {
                if (isset($child['estatus']) && $child['estatus'] === 'baja') {
                    unset($array['children_organigrama'][$index]);
                } else {
                    $this->removeFields($child, $fields);
                }
            }
            // Reindex after removing 'baja' items
            $array['children_organigrama'] = array_values($array['children_organigrama']);
        }
    }
}