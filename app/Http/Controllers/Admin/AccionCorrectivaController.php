<?php

namespace App\Http\Controllers\Admin;

use Flash;
use App\Functions\GeneratePdf;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAccionCorrectivaRequest;
use App\Http\Requests\StoreAccionCorrectivaRequest;
use App\Http\Requests\UpdateAccionCorrectivaRequest;
use App\Models\AccionCorrectiva;
use App\Models\Puesto;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AccionCorrectivaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('accion_correctiva_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AccionCorrectiva::with(['nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team'])->select(sprintf('%s.*', (new AccionCorrectiva)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'accion_correctiva_show';
                $editGate      = 'accion_correctiva_edit';
                $deleteGate    = 'accion_correctiva_delete';
                $crudRoutePart = 'accion-correctivas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });

            $table->addColumn('nombrereporta_name', function ($row) {
                return $row->nombrereporta ? $row->nombrereporta->name : '';
            });

            $table->addColumn('puestoreporta_puesto', function ($row) {
                return $row->puestoreporta ? $row->puestoreporta->puesto : '';
            });

            $table->addColumn('nombreregistra_name', function ($row) {
                return $row->nombreregistra ? $row->nombreregistra->name : '';
            });

            $table->addColumn('puestoregistra_puesto', function ($row) {
                return $row->puestoregistra ? $row->puestoregistra->puesto : '';
            });

            $table->editColumn('tema', function ($row) {
                return $row->tema ? $row->tema : "";
            });
            $table->editColumn('causaorigen', function ($row) {
                return $row->causaorigen ? AccionCorrectiva::CAUSAORIGEN_SELECT[$row->causaorigen] : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });
            $table->editColumn('metodo_causa', function ($row) {
                return $row->metodo_causa ? AccionCorrectiva::METODO_CAUSA_SELECT[$row->metodo_causa] : '';
            });
            $table->editColumn('solucion', function ($row) {
                return $row->solucion ? $row->solucion : "";
            });
            $table->editColumn('cierre_accion', function ($row) {
                return $row->cierre_accion ? $row->cierre_accion : "";
            });
            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? AccionCorrectiva::ESTATUS_SELECT[$row->estatus] : '';
            });

            $table->addColumn('responsable_accion_name', function ($row) {
                return $row->responsable_accion ? $row->responsable_accion->name : '';
            });

            $table->addColumn('nombre_autoriza_name', function ($row) {
                return $row->nombre_autoriza ? $row->nombre_autoriza->name : '';
            });

            $table->editColumn('documentometodo', function ($row) {
                return $row->documentometodo ? '<a href="' . $row->documentometodo->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'documentometodo']);

            return $table->make(true);
        }

        $users   = User::get();
        $puestos = Puesto::get();
        $users   = User::get();
        $puestos = Puesto::get();
        $users   = User::get();
        $users   = User::get();
        $teams   = Team::get();

        return view('admin.accionCorrectivas.index', compact('users', 'puestos', 'users', 'puestos', 'users', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('accion_correctiva_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrereportas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoreportas = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.accionCorrectivas.create', compact('nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas'));
    }

    public function store(StoreAccionCorrectivaRequest $request)
    {

        $accionCorrectiva = AccionCorrectiva::create($request->all());;
        //dd($request['pdf-value']);

   /*     if ($request->input('documentometodo', false)) {
            $accionCorrectiva->addMedia(storage_path('tmp/uploads/' . $request->input('documentometodo')))->toMediaCollection('documentometodo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $accionCorrectiva->id]);
        }
        $generar = new GeneratePdf();
        //$generar->Generate($request['pdf-value'], $request);
        $generar->Generate($request['pdf-value'], $accionCorrectiva);      */
        //return redirect()->route('admin.accion-correctivas.plan_accion')->with('accioncorrectivas', $accionCorrectiva);

            Flash::success("Registro guardado exitosamente");
            return redirect('admin/plan-correctiva?param='.$accionCorrectiva->id);


    }

    public function edit(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrereportas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoreportas = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accionCorrectiva->load('nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team');

        return view('admin.accionCorrectivas.edit', compact('nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas', 'accionCorrectiva'));
    }

    public function update(UpdateAccionCorrectivaRequest $request, AccionCorrectiva $accionCorrectiva)
    {
        $accionCorrectiva->update($request->all());

        if ($request->input('documentometodo', false)) {
            if (!$accionCorrectiva->documentometodo || $request->input('documentometodo') !== $accionCorrectiva->documentometodo->file_name) {
                if ($accionCorrectiva->documentometodo) {
                    $accionCorrectiva->documentometodo->delete();
                }

                $accionCorrectiva->addMedia(storage_path('tmp/uploads/' . $request->input('documentometodo')))->toMediaCollection('documentometodo');
            }
        } elseif ($accionCorrectiva->documentometodo) {
            $accionCorrectiva->documentometodo->delete();
        }

        return redirect()->route('admin.accion-correctivas.index');
    }

    public function show(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accionCorrectiva->load('nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team', 'accioncorrectivaPlanaccionCorrectivas');

        return view('admin.accionCorrectivas.show', compact('accionCorrectiva'));
    }

    public function destroy(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accionCorrectiva->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccionCorrectivaRequest $request)
    {
        AccionCorrectiva::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('accion_correctiva_create') && Gate::denies('accion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AccionCorrectiva();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function test(){
        dd("Test");
    }
}
