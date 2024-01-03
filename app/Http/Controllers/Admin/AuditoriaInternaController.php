<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAuditoriaInternaRequest;
use App\Mail\NotificacionAprobadoReporteAuditoria;
use App\Mail\NotificacionRechazoReporteAuditoria;
use App\Mail\NotificacionReporteAuditoria;
use App\Models\AuditoriaInterna;
use App\Models\AuditoriaInternasReportes;
use App\Models\ClasificacionesAuditorias;
use App\Models\Clausula;
use App\Models\ClausulasAuditorias;
use App\Models\Controle;
use App\Models\Empleado;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class AuditoriaInternaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('auditoria_interna_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // if ($request->ajax()) {
        $query = AuditoriaInterna::with(['clausulas', 'lider', 'equipo', 'team'])->orderByDesc('id')->get();
        //     $table = Datatables::of($query);

        //     $table->addColumn('placeholder', '&nbsp;');
        //     $table->addColumn('actions', '&nbsp;');

        //     $table->editColumn('actions', function ($row) {
        //         $viewGate = 'auditoria_interna_ver';
        //         $editGate = 'auditoria_interna_editar';
        //         $deleteGate = 'auditoria_interna_eliminar';
        //         $crudRoutePart = 'auditoria-internas';

        //         return view('partials.datatablesActions', compact(
        //             'viewGate',
        //             'editGate',
        //             'deleteGate',
        //             'crudRoutePart',
        //             'row'
        //         ));
        //     });

        //     $table->addColumn('id_auditoria', function ($row) {
        //         return $row->id_auditoria ? $row->id_auditoria : '';
        //     });
        //     $table->addColumn('nombre_auditoria', function ($row) {
        //         return $row->nombre_auditoria ? $row->nombre_auditoria : '';
        //     });
        //     $table->editColumn('objetivo', function ($row) {
        //         return $row->objetivo ? html_entity_decode(strip_tags($row->objetivo), ENT_QUOTES, 'UTF-8') : 'n/a';
        //     });
        //     $table->editColumn('alcance', function ($row) {
        //         return $row->alcance ? html_entity_decode(strip_tags($row->alcance), ENT_QUOTES, 'UTF-8') : 'n/a';
        //     });
        //     $table->editColumn('fecha_inicio', function ($row) {
        //         return $row->fecha_inicio ? \Carbon\Carbon::parse($row->fechainicio)->format('d-m-Y') : '';
        //     });
        //     $table->addColumn('criterios_auditoria', function ($row) {
        //         return $row->criterios_auditoria ? html_entity_decode(strip_tags($row->criterios_auditoria), ENT_QUOTES, 'UTF-8') : 'n/a';
        //     });
        //     $table->addColumn('lider', function ($row) {
        //         return $row->lider ? $row->lider : '';
        //     });
        //     $table->addColumn('auditor_externo', function ($row) {
        //         return $row->auditor_externo ? $row->auditor_externo : '';
        //     });

        //     $table->addColumn('equipo', function ($row) {
        //         return $row->equipo ? $row->equipo : '';
        //     });

        //     $table->addColumn('id_audit', function ($row) {
        //         return $row->id_auditoria ? $row->id_auditoria : '';
        //     });

        //     $table->rawColumns(['actions', 'placeholder', 'cheknoconformidadmenor', 'checknoconformidadmayor', 'checkobservacion', 'checkmejora']);

        //     return $table->make(true);
        // }

        $controles = Controle::get();
        $users = User::getAll();
        $teams = Team::get();

        return view('admin.auditoriaInternas.index', compact('controles', 'users', 'users', 'teams', 'query'));
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
            'nombre_auditoria' => 'required|max:250',
            'criterios_auditoria' => 'required',
            'fecha_inicio' => 'nullable|date',
            'auditor_externo' => 'max:250',
        ]);

        $auditoriaInterna = AuditoriaInterna::create($request->all());
        $auditoriaInterna->update([
            'creador_auditoria_id' => User::getCurrentUser()->empleado->id,
        ]);
        $auditoriaInterna->equipo()->sync($request->equipo);
        $auditoriaInterna->clausulas()->sync($request->clausulas);

        return redirect()->route('admin.auditoria-internas.edit', ['auditoriaInterna' => $auditoriaInterna->id]);
    }

    public function edit($IDauditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna = AuditoriaInterna::find($IDauditoriaInterna);
        if (
            User::getCurrentUser()->empleado->id == $auditoriaInterna->lider_id
            || User::getCurrentUser()->empleado->id == $auditoriaInterna->creador_auditoria_id
        ) {

            $auditoriaInterna->load('clausulas', 'lider', 'equipo', 'team');

            $clasificacionesauditorias = ClasificacionesAuditorias::all();
            $clausulasauditorias = ClausulasAuditorias::all();

            $clausulas = Clausula::all();

            $auditorliders = Empleado::getaltaAll();

            $equipoauditorias = Empleado::getaltaAll();

            return view('admin.auditoriaInternas.edit', compact('clausulas', 'auditorliders', 'equipoauditorias', 'auditoriaInterna'))
                ->with('clasificacionesauditorias', $clasificacionesauditorias)
                ->with('clausulasauditorias', $clausulasauditorias);
        } else {

            return redirect()->back()->with('edit', 'success');

            // return redirect(route('admin.auditoria-internas.index'));
        }
    }

    public function update(Request $request, AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'alcance' => 'required',
            'objetivo' => 'required',
            'id_auditoria' => 'required',
            'nombre_auditoria' => 'required|max:250',
            'criterios_auditoria' => 'required',
            'fecha_inicio' => 'nullable|date',
            'auditor_externo' => 'max:250',
        ]);

        $auditoriaInterna->update($request->all());
        $auditoriaInterna->equipo()->sync($request->equipo);
        $auditoriaInterna->clausulas()->sync($request->clausulas);

        return redirect()->route('admin.auditoria-internas.index', ['auditoriaInterna' => $auditoriaInterna]);
    }

    public function show(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->load('clausulas', 'lider', 'equipo', 'team', 'auditoriaHallazgos');
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

    public function indexReporteIndividual($id)
    {
        $miembrosaudit = AuditoriaInterna::find($id);
        // dd();
        $ids_equipo = $miembrosaudit->equipo()->get()->pluck('id');
        // dd($ids_equipo);
        foreach ($ids_equipo as $idmiembro) {
            if ($idmiembro == auth()->user()->empleado->id) {
                $clasificaciones = ClasificacionesAuditorias::all();
                $clausulas = ClausulasAuditorias::all();

                // dd($id, $clasificaciones);
                return view('admin.auditoriaInternas.reporteIndividual')
                    ->with('clasificaciones', $clasificaciones)
                    ->with('clausulas', $clausulas)
                    ->with('id', $id);
            } else {
                return redirect()->back()->with('reporte', 'success');
            }
        }

        return redirect()->route('admin.auditoria-internas.index');
    }

    public function createReporte($id)
    {
        // dd($id);
        return view('admin.auditoriaInternas.createReporte');
    }

    public function storeReporte($reporteid, Request $request)
    {
        $reporte = AuditoriaInternasReportes::find($reporteid);
        $nombre_colaborador = auth()->user()->empleado->name;

        $signature = $request->input('signature');

        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));

        if (!Storage::exists('public/auditorias-internas/auditoria/' . $reporte->id_auditoria . '/reporte')) {
            Storage::makeDirectory('public/auditorias-internas/auditoria/' . $reporte->id_auditoria . '/reporte' . '/' . $reporte->id . '/' . $nombre_colaborador, 0755, true);
        }

        $filename = '/audit' . $reporte->id_auditoria . 'firmaempleado' . $nombre_colaborador . '.png';

        Storage::put('public/auditorias-internas/auditoria/' . $reporte->id_auditoria . '/reporte' . '/' . $reporte->id . '/' . $nombre_colaborador . $filename, $image);

        $reporte = AuditoriaInternasReportes::where('id_auditoria', '=', $reporte->id_auditoria)
            ->where('empleado_id', '=', auth()->user()->empleado->id)
            ->where('lider_id', '=', $reporte->lider->id)->first();
        // dd($reporte);
        $reporte->update([
            // "comentarios",
            'estado' => 'enviado',
            'firma_empleado' => $filename,
            // "firma_lider",
        ]);

        $url = $reporte->id_auditoria;

        try {
            $email = new NotificacionReporteAuditoria($nombre_colaborador, $url);
            Mail::to(removeUnicodeCharacters($reporte->lider->email))->send($email);

            return response()->json(['success' => true]);
        } catch (Throwable $e) {
            return response()->json(['success' => false]);
        }
    }

    public function rechazoReporteIndividual($reporteid, Request $request)
    {

        $comentarios = $request->comentarios;
        $reporte = AuditoriaInternasReportes::find($reporteid);

        $reporte->update([
            'comentarios' => $comentarios,
            'estado' => 'rechazado',
        ]);

        $auditoria = $reporte->id_auditoria;

        try {
            $email = new NotificacionRechazoReporteAuditoria($auditoria);
            Mail::to(removeUnicodeCharacters($reporte->empleado->email))->send($email);

            return response()->json(['success' => true]);
        } catch (Throwable $e) {
            return response()->json(['success' => false]);
        }
    }

    public function storeFirmaReporteLider($reporteid, Request $request)
    {
        // dd($reporteid);
        $reporte = AuditoriaInternasReportes::find($reporteid);
        $nombre_lider = $reporte->lider->name;

        $signature = $request->input('signature');

        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));

        if (!Storage::exists('public/auditorias-internas/auditoria/' . $reporte->id_auditoria . '/reporte')) {
            Storage::makeDirectory('public/auditorias-internas/auditoria/' . $reporte->id_auditoria . '/reporte' . '/' . $nombre_lider, 0755, true);
        }

        $filename = '/audit' . $reporte->id_auditoria . 'firmalider' . $nombre_lider . '.png';

        Storage::put('public/auditorias-internas/auditoria/' . $reporte->id_auditoria . '/reporte' . '/' . $reporte->id . '/' . $nombre_lider . $filename, $image);

        $reporte = AuditoriaInternasReportes::where('id_auditoria', '=', $reporte->id_auditoria)
            ->where('lider_id', '=', $reporte->lider->id)->first();
        // dd($reporte);
        $reporte->update([
            'comentarios' => $request->comentarios,
            'estado' => 'aprobado',
            'firma_lider' => $filename,
        ]);

        try {
            $email = new NotificacionAprobadoReporteAuditoria();
            Mail::to(removeUnicodeCharacters($reporte->empleado->email))->send($email);

            return response()->json(['success' => true]);
        } catch (Throwable $e) {
            return response()->json(['success' => false]);
        }
    }
}
