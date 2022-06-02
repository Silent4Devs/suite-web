<?php

namespace App\Http\Controllers\Admin;

use App\Functions\GeneratePdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanAuditoriumRequest;
use App\Http\Requests\StorePlanAuditoriumRequest;
use App\Http\Requests\UpdatePlanAuditoriumRequest;
use App\Models\ActividadesPlanAuditorium;
use App\Models\AuditoriaAnual;
use App\Models\Empleado;
use App\Models\PlanAuditorium;
use App\Models\Puesto;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlanAuditoriaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('plan_auditorium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PlanAuditorium::with(['auditados', 'team', 'equipo'])->select(sprintf('%s.*', (new PlanAuditorium)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'plan_auditorium_show';
                $editGate = 'plan_auditorium_edit';
                $deleteGate = 'plan_auditorium_delete';
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
            $table->addColumn('fecha_auditoria', function ($row) {
                return $row->fecha_auditoria ? $row->fecha_auditoria : '';
            });

            $table->editColumn('objetivo', function ($row) {
                return $row->objetivo ? $row->objetivo : '';
            });
            $table->editColumn('alcance', function ($row) {
                return $row->alcance ? $row->alcance : '';
            });
            $table->editColumn('criterios', function ($row) {
                return $row->criterios ? $row->criterios : '';
            });
            $table->editColumn('documentoauditar', function ($row) {
                return $row->documentoauditar ? $row->documentoauditar : '';
            });
            $table->editColumn('equipo_auditor', function ($row) {
                return $row->auditados ? $row->auditados : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'auditados']);

            return $table->make(true);
        }

        $auditoria_anuals = AuditoriaAnual::get();
        $teams = Team::get();

        return view('admin.planAuditoria.index', compact('auditoria_anuals', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_auditorium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $fechas = AuditoriaAnual::all()->pluck('fechainicio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipoauditorias = Empleado::alta()->get();

        $empleados = Empleado::alta()->get();

        $puesto = Puesto::get();

        $actividadesAuditoria = ActividadesPlanAuditorium::get();

        return view('admin.planAuditoria.create', compact('equipoauditorias', 'empleados', 'puesto', 'actividadesAuditoria'));
    }

    public function store(StorePlanAuditoriumRequest $request)
    {
        $planAuditorium = PlanAuditorium::create($request->all());
        // $generar = new GeneratePdf();
        // $generar->Generate($request['pdf-value'], $planAuditorium);
        $planAuditorium->auditados()->sync($request->equipo);
        $this->saveUpdateAuditados($request->auditados, $planAuditorium);

        return redirect()->route('admin.plan-auditoria.index');
    }

    public function edit(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $fechas = AuditoriaAnual::all()->pluck('fechainicio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipo_seleccionado = $planAuditorium->auditados->pluck('id')->toArray();
        // dd($equipo_seleccionado);

        $equipoauditorias = Empleado::alta()->get();

        $actividadesAuditoria = ActividadesPlanAuditorium::get();

        return view('admin.planAuditoria.edit', compact('equipoauditorias', 'planAuditorium', 'equipo_seleccionado', 'actividadesAuditoria'));
    }

    public function update(UpdatePlanAuditoriumRequest $request, PlanAuditorium $planAuditorium)
    {
        $planAuditorium->update($request->all());
        // $planAuditorium->auditados()->sync($request->input('auditados', []));
        $planAuditorium->auditados()->sync($request->equipo);
        $this->saveUpdateAuditados($request->auditados, $planAuditorium);

        return redirect()->route('admin.plan-auditoria.index');
    }

    public function show(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planAuditorium->load('fecha', 'auditados', 'team');

        return view('admin.planAuditoria.show', compact('planAuditorium'));
    }

    public function destroy(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                        'actividad_auditar' =>  $auditado['actividad_auditar'],
                        'fecha_act_auditoria' =>  $auditado['fecha_act_auditoria'],
                        'hora_inicio' =>  $auditado['hora_inicio'],
                        'hora_fin' =>  $auditado['hora_fin'],
                        'id_contacto' => $auditado['id_contacto'],
                    ]);
                } else {
                    ActividadesPlanAuditorium::create([
                        'plan_auditoria_id' => $planAuditorium->id,
                        'actividad_auditar' =>  $auditado['actividad_auditar'],
                        'actividad_auditar' =>  $auditado['actividad_auditar'],
                        'fecha_act_auditoria' =>  $auditado['fecha_act_auditoria'],
                        'hora_inicio' =>  $auditado['hora_inicio'],
                        'hora_fin' =>  $auditado['hora_fin'],
                        'id_contacto' => $auditado['id_contacto'],
                    ]);
                }
            }
        }
        // dd($contactos);
    }
}
