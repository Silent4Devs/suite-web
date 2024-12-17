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

                    $area = $this->getAreaWithLiderAndChildren($request->area_id);
                    $childrenArea = $area->lider;
                    return response()->json($childrenArea);
                } else {
                    if ($request->id === null) {
                        $organizacionTree = Empleado::getAllOrganigramaTree();
                        if (! $organizacionTree) {
                            return response()->json(['error' => 'No se encontró la organización'], 404);
                        }

                        $organizacionArray = $organizacionTree;
                        $this->traverseAllOrganigrama($organizacionArray->children_organigrama, $organizacionArray->area_id);
                        return response()->json($organizacionTree);
                    } else {
                        $organizacionTree = $this->getSearchEmployOrganizationChart($request->id);
                        $organizacionTree->children = $this->transverseChildrens($organizacionTree->id);
                        return response()->json($organizacionTree);

                        // return $organizacionTree
                        //     ? response()->json($organizacionTree)
                        //     : response()->json(['error' => 'No encontrado'], 404);
                    }
                }
            }

            $rutaImagenes = Async::run(fn() => asset('storage/empleados/imagenes/'));
            $organizacionDB = Async::run(fn() => Organizacion::first());
            $areas = Area::all();

            if ($organizacionDB && property_exists($organizacionDB, 'empresa')) {
                $organizacion = $organizacionDB->empresa;
                $org_foto = url('images/'.$organizacionDB->logotipo);
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

    function traverseArea(&$areasChildren)
    {
        foreach ($areasChildren as $areaChildren) {
            $puesto =  $areaChildren->puesto;
            $areaChildren->setAppends([]);
            $areaChildren->area->setAppends([]);
            $areaChildren->supervisor->setAppends([]);
            $areaChildren->puesto = $puesto;
            if ($areaChildren->children->isNotEmpty()) {
                $this->traverseArea($areaChildren->children);
            }
        }
    }

    function traverseAllOrganigrama(&$allsChildren, $liderAreaId)
    {
        foreach ($allsChildren as $allChildren) {

            if ($allChildren->area_id !== $liderAreaId) {
                $area = $this->getAreaWithLiderAndChildren($allChildren->area_id);
                $childrenAll = $area->lider;
                $allChildren->childrenOrganigrama = $childrenAll->children;
            }
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


    public function getAreaWithLiderAndChildren($areaId)
    {
        // Obtener el área con el líder y sus hijos
        $area = DB::table('areas')
            ->select('id', 'area', 'empleados_id') // Selecciona los campos necesarios de la tabla 'areas'
            ->where('areas.id', $areaId)
            ->first();

        if ($area) {
            $lider = $this->getSearchEmployOrganizationChart($area->empleados_id);
            $childrens = $this->transverseChildrens($lider->id);
        }

        $lider->children = $childrens;
        $area->lider = $lider;

        // Comprobar si el área no fue encontrada
        if (!$area) {
            return response()->json(['error' => 'Área no encontrada'], 404);
        }

        // Devolver la información del área con su líder y los hijos
        return $area;
    }

    //obtener los childres de un lider, mediante su id
    public function transverseChildrens($liderId)
    {

        $childrens = DB::table('empleados')
            ->select(
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
                'telefono_movil',
                'supervisor_id'
            )
            ->where('supervisor_id', $liderId)
            ->where('estatus', 'alta')
            ->whereNull('deleted_at')
            ->get();

        foreach ($childrens as $children) {
            $puesto = DB::table('puestos')
                ->select('puesto')
                ->where('id', '=', $children->puesto_id)
                ->first();
            $children->puesto = $puesto->puesto;
            $area = DB::table('areas')
                ->select('area')
                ->where('id', '=', $children->area_id)
                ->first();
            $children->area = $area;
            $grandChildren = $this->transverseChildrens($children->id);
            $children->children = $grandChildren;
        }

        return $childrens;
    }

    public function getSearchEmployOrganizationChart($employId)
    {
        $employ = DB::table('empleados')
            ->select(
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
            ->where('id', $employId)
            ->first();

        $puesto = DB::table('puestos')
            ->select('puesto')
            ->where('id', '=', $employ->puesto_id)
            ->first();
        $employ->puesto = $puesto->puesto;

        $area = DB::table('areas')
            ->select('area')
            ->where('id', '=', $employ->area_id)
            ->first();
        $employ->area = $area;

        return $employ;
    }
}
