<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAuditoriaAnualRequest;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaAnualDocumento;
use App\Models\Empleado;
use App\Models\Team;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AuditoriaAnualController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('programa_anual_auditoria_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AuditoriaAnual::with(['auditorlider', 'team', 'documentos_material'])->select(sprintf('%s.*', (new AuditoriaAnual)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'programa_anual_auditoria_ver';
                $editGate = 'programa_anual_auditoria_editar';
                $deleteGate = 'programa_anual_auditoria_eliminar';
                $crudRoutePart = 'auditoria-anuals';

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

            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });

            $table->editColumn('fechainicio', function ($row) {
                return $row->fechainicio ? \Carbon\Carbon::parse($row->fechainicio)->format('d-m-Y') : '';
            });

            $table->editColumn('fechafin', function ($row) {
                return $row->fechafin ? \Carbon\Carbon::parse($row->fechafin)->format('d-m-Y') : '';
            });
            $table->addColumn('objetivo', function ($row) {
                return $row->objetivo ? html_entity_decode(strip_tags($row->objetivo), ENT_QUOTES, 'UTF-8') : 'n/a';
            });

            $table->editColumn('alcance', function ($row) {
                return $row->alcance ? html_entity_decode(strip_tags($row->alcance), ENT_QUOTES, 'UTF-8') : 'n/a';
            });

            $table->rawColumns(['actions', 'placeholder', 'auditorlider']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();
        $auditoriaAnual = AuditoriaAnual::with('documentos_material')->get();
        $documentoAuditoriaAnuals = AuditoriaAnualDocumento::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.auditoriaAnuals.index', compact('auditoriaAnual', 'documentoAuditoriaAnuals', 'users', 'teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('programa_anual_auditoria_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // $auditorliders = Empleado::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $auditorliders = Empleado::alta()->get()->pluck('name', 'id');
        // dd($auditorliders);

        return view('admin.auditoriaAnuals.create', compact('auditorliders'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('programa_anual_auditoria_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre' => 'required|string',
            'fechainicio' => 'nullable|date',
            'fechafin' => 'nullable|date',
            'objetivo' => 'required|string',
            'alcance' => 'required|string',
        ]);

        $auditoriaAnual = AuditoriaAnual::create($request->all());

        return redirect()->route('admin.auditoria-anuals.index')->with('success', 'Guardado con éxito');
    }

    public function edit(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('programa_anual_auditoria_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditoriaAnual->load('auditorlider', 'team');

        $empleados = Empleado::getaltaAll();

        return view('admin.auditoriaAnuals.edit', compact('auditorliders', 'auditoriaAnual', 'empleados'));
    }

    public function update(Request $request, AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('programa_anual_auditoria_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre' => 'required|string',
            'fechainicio' => 'nullable|date',
            'fechafin' => 'nullable|date',
            'objetivo' => 'required|string',
            'alcance' => 'required|string',
        ]);

        $auditoriaAnual->update($request->all());

        return redirect()->route('admin.auditoria-anuals.index');
    }

    public function show(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('programa_anual_auditoria_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaAnual->load('team');

        return view('admin.auditoriaAnuals.show', compact('auditoriaAnual'));
    }

    public function destroy(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('programa_anual_auditoria_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaAnual->delete();

        return back();
    }

    public function massDestroy(MassDestroyAuditoriaAnualRequest $request)
    {
        AuditoriaAnual::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function programa($id)
    {
        return view('admin.auditoriaAnuals.programa', compact('id'));
    }

    public function programaDocumentos(Request $request)
    {
        $auditoria = AuditoriaAnual::with('documentos_material')->find($request->auditoriaId);
        $paths = [];
        foreach ($auditoria->documentos_material as $documento) {
            $path = asset('storage/programaAnualAuditoria/documentos/'.$auditoria->id.'/'.$documento->documento);
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            array_push($paths, [
                'path' => $path,
                'extension' => $extension,
            ]);
        }

        return response()->json(['paths' => $paths]);
    }
}
