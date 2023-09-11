<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanAuditoriumRequest;
use App\Models\ActividadesPlanAuditorium;
use App\Models\AuditoriaAnual;
use App\Models\Empleado;
use App\Models\PlanAuditoria;
use App\Models\PlanAuditorium;
use App\Models\Puesto;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlanAuditoriaController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('plan_de_auditoria_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PlanAuditorium::with(['auditados', 'team', 'equipo'])->select(sprintf('%s.*', (new PlanAuditorium)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'plan_de_auditoria_ver';
                $editGate = 'plan_de_auditoria_editar';
                $deleteGate = 'plan_de_auditoria_eliminar';
                $crudRoutePart = 'plan-auditoria';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->addColumn('nombre_auditoria', function ($row) {
                return $row->nombre_auditoria ? $row->nombre_auditoria : '';
            });

            $table->addColumn('fecha_inicio_auditoria', function ($row) {
                return $row->fecha_inicio_auditoria ? \Carbon\Carbon::parse($row->fecha_inicio_auditoria)->format('d-m-Y') : '';
            });

            $table->editColumn('objetivo', function ($row) {
                return $row->objetivo ? html_entity_decode(strip_tags($row->objetivo), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->editColumn('alcance', function ($row) {
                return $row->alcance ? html_entity_decode(strip_tags($row->alcance), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->editColumn('criterios', function ($row) {
                return $row->criterios ? html_entity_decode(strip_tags($row->criterios), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->editColumn('documentoauditar', function ($row) {
                return $row->documentoauditar ? $row->documentoauditar : '';
            });
            $table->editColumn('equipo_auditor', function ($row) {
                return $row->auditados ? $row->auditados : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'auditados']);

            return $table->make(true);
        }

        $auditoria_anuals = AuditoriaAnual::getAll();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.planAuditoria.index', compact('auditoria_anuals', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_de_auditoria_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $fechas = AuditoriaAnual::all()->pluck('fechainicio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipoauditorias = Empleado::getaltaAll();

        $empleados = Empleado::getaltaAll();

        $puesto = Puesto::getAll();

        $actividadesAuditoria = ActividadesPlanAuditorium::get();

        $planAuditoria = PlanAuditoria::get();

        return view('admin.planAuditoria.create', compact('planAuditoria', 'equipoauditorias', 'empleados', 'puesto', 'actividadesAuditoria'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('plan_de_auditoria_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'fecha_inicio_auditoria' => 'required|date',
            'nombre_auditoria' => 'required|string',
            'fecha_fin_auditoria' => 'required|date',
            'objetivo' => 'required',
            'alcance' => 'required',
            'criterios' => 'required',
            'id_auditoria' => ['nullable', Rule::unique('plan_auditoria')->whereNull('deleted_at')],

        ]);

        $planAuditorium = PlanAuditorium::create($request->all());

        $planAuditorium->auditados()->sync($request->equipo);
        $this->saveUpdateAuditados($request->auditados, $planAuditorium);

        return redirect()->route('admin.plan-auditoria.edit', ['planAuditorium' => $planAuditorium]);
    }

    public function edit(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_de_auditoria_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $fechas = AuditoriaAnual::all()->pluck('fechainicio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipo_seleccionado = $planAuditorium->auditados->pluck('id')->toArray();
        // dd($equipo_seleccionado);

        $equipoauditorias = Empleado::getaltaAll();

        $actividadesAuditoria = ActividadesPlanAuditorium::get();

        return view('admin.planAuditoria.edit', compact('equipoauditorias', 'planAuditorium', 'equipo_seleccionado', 'actividadesAuditoria'));
    }

    public function update(Request $request, PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_de_auditoria_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'fecha_inicio_auditoria' => 'required|date',
            'nombre_auditoria' => 'required|string',
            'fecha_fin_auditoria' => 'required|date',
            'objetivo' => 'required',
            'alcance' => 'required',
            'criterios' => 'required',
            'id_auditoria' => 'nullable|unique:plan_auditoria,id_auditoria,' . $planAuditorium->id . ',id,deleted_at,NULL',

        ]);

        $planAuditorium->update([
            'fecha_inicio_auditoria' => $request->fecha_inicio_auditoria,
            'fecha_fin_auditoria' => $request->fecha_fin_auditoria,
            'objetivo' => $request->objetivo,
            'alcance' => $request->alcance,
            'criterios' => $request->criterios,
            'documentoauditar' => $request->documentoauditar,
            'nombre_auditoria' => $request->nombre_auditoria,
            'id_auditoria' => $request->id_auditoria,

        ]);

        // $planAuditorium->auditados()->sync($request->input('auditados', []));
        $planAuditorium->auditados()->sync($request->equipo);
        $this->saveUpdateAuditados($request->auditados, $planAuditorium);

        return redirect()->route('admin.plan-auditoria.index');
    }

    public function show(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_de_auditoria_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planAuditorium->load('auditados', 'team', 'actividadesPlan');

        return view('admin.planAuditoria.show', compact('planAuditorium'));
    }

    public function destroy(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_de_auditoria_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planAuditorium->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanAuditoriumRequest $request)
    {
        PlanAuditorium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function saveUpdateAuditados($auditados, $planAuditorium)
    {
        if (!is_null($auditados)) {
            foreach ($auditados as $auditado) {
                // dd(PuestoResponsabilidade::exists($responsabilidad['id']));
                if (ActividadesPlanAuditorium::find($auditado['id']) != null) {
                    ActividadesPlanAuditorium::find($auditado['id'])->update([
                        'actividad_auditar' => $auditado['actividad_auditar'],
                        'fecha_act_auditoria' => $auditado['fecha_act_auditoria'],
                        'hora_inicio' => $auditado['hora_inicio'],
                        'hora_fin' => $auditado['hora_fin'],
                        'id_contacto' => $auditado['id_contacto'],
                    ]);
                } else {
                    ActividadesPlanAuditorium::create([
                        'plan_auditoria_id' => $planAuditorium->id,
                        'actividad_auditar' => $auditado['actividad_auditar'],
                        'actividad_auditar' => $auditado['actividad_auditar'],
                        'fecha_act_auditoria' => $auditado['fecha_act_auditoria'],
                        'hora_inicio' => $auditado['hora_inicio'],
                        'hora_fin' => $auditado['hora_fin'],
                        'id_contacto' => $auditado['id_contacto'],
                    ]);
                }
            }
        }
        // dd($contactos);
    }
}
