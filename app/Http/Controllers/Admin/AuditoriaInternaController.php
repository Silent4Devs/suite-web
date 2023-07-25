<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAuditoriaInternaRequest;
use App\Models\AuditoriaInterna;
use App\Models\Clausula;
use App\Models\Controle;
use App\Models\Empleado;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AuditoriaInternaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('auditoria_interna_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AuditoriaInterna::with(['clausulas', 'lider', 'equipo', 'team'])->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'auditoria_interna_ver';
                $editGate = 'auditoria_interna_editar';
                $deleteGate = 'auditoria_interna_eliminar';
                $crudRoutePart = 'auditoria-internas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('id_auditoria', function ($row) {
                return $row->id_auditoria ? $row->id_auditoria : '';
            });
            $table->addColumn('nombre_auditoria', function ($row) {
                return $row->nombre_auditoria ? $row->nombre_auditoria : '';
            });
            $table->editColumn('objetivo', function ($row) {
                return $row->objetivo ? html_entity_decode(strip_tags($row->objetivo), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->editColumn('alcance', function ($row) {
                return $row->alcance ? html_entity_decode(strip_tags($row->alcance), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? \Carbon\Carbon::parse($row->fechainicio)->format('d-m-Y') : '';
            });
            $table->addColumn('criterios_auditoria', function ($row) {
                return $row->criterios_auditoria ? html_entity_decode(strip_tags($row->criterios_auditoria), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->addColumn('lider', function ($row) {
                return $row->lider ? $row->lider : '';
            });
            $table->addColumn('auditor_externo', function ($row) {
                return $row->auditor_externo ? $row->auditor_externo : '';
            });

            $table->addColumn('equipo', function ($row) {
                return $row->equipo ? $row->equipo : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'cheknoconformidadmenor', 'checknoconformidadmayor', 'checkobservacion', 'checkmejora']);

            return $table->make(true);
        }

        $controles = Controle::get();
        $users = User::getAll();
        $teams = Team::get();

        return view('admin.auditoriaInternas.index', compact('controles', 'users', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('auditoria_interna_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clausulas = Clausula::all();

        $auditorliders = Empleado::getaltaAll();

        $equipoauditorias = Empleado::getaltaAll();

        return view('admin.auditoriaInternas.create', compact('clausulas', 'auditorliders', 'equipoauditorias'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('auditoria_interna_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            // 'lider_id' => 'required|exists:empleados,id',
            'alcance' => 'required',
            'objetivo' => 'required',
            'id_auditoria' => 'required',
            'nombre_auditoria' => 'required',
            'criterios_auditoria' => 'required',
            'fecha_inicio' => 'nullable|date',
        ]);

        $auditoriaInterna = AuditoriaInterna::create($request->all());
        $auditoriaInterna->equipo()->sync($request->equipo);
        $auditoriaInterna->clausulas()->sync($request->clausulas);

        return redirect()->route('admin.auditoria-internas.edit', ['auditoriaInterna' => $auditoriaInterna]);
    }

    public function edit(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->load('clausulas', 'lider', 'equipo', 'team');

        $clausulas = Clausula::all();

        $auditorliders = Empleado::getaltaAll();

        $equipoauditorias = Empleado::getaltaAll();

        return view('admin.auditoriaInternas.edit', compact('clausulas', 'auditorliders', 'equipoauditorias', 'auditoriaInterna'));
    }

    public function update(Request $request, AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'alcance' => 'required',
            'objetivo' => 'required',
            'id_auditoria' => 'required',
            'nombre_auditoria' => 'required',
            'criterios_auditoria' => 'required',
            'fecha_inicio' => 'nullable|date',
        ]);

        $auditoriaInterna->update($request->all());
        $auditoriaInterna->equipo()->sync($request->equipo);
        $auditoriaInterna->clausulas()->sync($request->clausulas);

        return redirect()->route('admin.auditoria-internas.index', ['auditoriaInterna' => $auditoriaInterna]);
    }

    public function show(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->load('clausulas', 'auditorlider', 'equipo', 'team', 'auditoriaHallazgos');
        // dd( $auditoriaInterna->hallazgos);

        return view('admin.auditoriaInternas.show', compact('auditoriaInterna'));
    }

    public function destroy(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->delete();

        return back();
    }

    public function massDestroy(MassDestroyAuditoriaInternaRequest $request)
    {
        AuditoriaInterna::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('auditoria_interna_agregar') && Gate::denies('auditoria_interna_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new AuditoriaInterna();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
