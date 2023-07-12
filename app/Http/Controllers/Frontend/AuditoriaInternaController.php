<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAuditoriaInternaRequest;
use App\Http\Requests\UpdateAuditoriaInternaRequest;
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
        abort_if(Gate::denies('auditoria_interna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AuditoriaInterna::with(['clausulas', 'lider', 'equipo', 'team'])->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'auditoria_interna_show';
                $editGate = 'auditoria_interna_edit';
                $deleteGate = 'auditoria_interna_delete';
                $crudRoutePart = 'auditoria-internas';

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
            $table->editColumn('alcance', function ($row) {
                return $row->alcance ? $row->alcance : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? $row->fecha_inicio : '';
            });
            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });
            $table->addColumn('clausula', function ($row) {
                return $row->clausulas ? $row->clausulas : '';
            });

            $table->addColumn('lider', function ($row) {
                return $row->lider ? $row->lider->name : '';
            });

            $table->addColumn('equipo', function ($row) {
                return $row->equipo ? $row->equipo : '';
            });

            $table->editColumn('hallazgos', function ($row) {
                return $row->hallazgos ? $row->hallazgos : '';
            });
            $table->editColumn('cheknoconformidadmenor', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->cheknoconformidadmenor ? 'checked' : null) . '>';
            });
            $table->editColumn('totalnoconformidadmenor', function ($row) {
                return $row->totalnoconformidadmenor ? $row->totalnoconformidadmenor : '';
            });
            $table->editColumn('checknoconformidadmayor', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->checknoconformidadmayor ? 'checked' : null) . '>';
            });
            $table->editColumn('totalnoconformidadmayor', function ($row) {
                return $row->totalnoconformidadmayor ? $row->totalnoconformidadmayor : '';
            });
            $table->editColumn('checkobservacion', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->checkobservacion ? 'checked' : null) . '>';
            });
            $table->editColumn('totalobservacion', function ($row) {
                return $row->totalobservacion ? $row->totalobservacion : '';
            });
            $table->editColumn('checkmejora', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->checkmejora ? 'checked' : null) . '>';
            });
            $table->editColumn('totalmejora', function ($row) {
                return $row->totalmejora ? $row->totalmejora : '';
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
        abort_if(Gate::denies('auditoria_interna_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clausulas = Clausula::all();

        $auditorliders = Empleado::all();

        $equipoauditorias = Empleado::all();

        return view('admin.auditoriaInternas.create', compact('clausulas', 'auditorliders', 'equipoauditorias'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'lider_id'=>'required|exists:empleados,id',
        ]);
        // dd($request->all());

        $auditoriaInterna = AuditoriaInterna::create($request->all());
        $auditoriaInterna->equipo()->sync($request->equipo);
        $auditoriaInterna->clausulas()->sync($request->clausulas);

        return redirect()->route('admin.auditoria-internas.index');
    }

    public function edit(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->load('clausulas', 'lider', 'equipo', 'team');

        $clausulas = Clausula::all();

        $auditorliders = Empleado::all();

        $equipoauditorias = Empleado::all();

        return view('admin.auditoriaInternas.edit', compact('clausulas', 'auditorliders', 'equipoauditorias', 'auditoriaInterna'));
    }

    public function update(UpdateAuditoriaInternaRequest $request, AuditoriaInterna $auditoriaInterna)
    {
        $request->validate([

            'lider_id'=>'required|exists:empleados,id',
        ]);

        $auditoriaInterna->update($request->all());
        $auditoriaInterna->equipo()->sync($request->equipo);
        $auditoriaInterna->clausulas()->sync($request->clausulas);

        return redirect()->route('admin.auditoria-internas.index');
    }

    public function show(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->load('clausulas', 'auditorlider', 'equipoauditoria', 'team');

        return view('admin.auditoriaInternas.show', compact('auditoriaInterna'));
    }

    public function destroy(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        abort_if(Gate::denies('auditoria_interna_create') && Gate::denies('auditoria_interna_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new AuditoriaInterna();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
