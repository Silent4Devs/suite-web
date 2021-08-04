<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMinutasaltadireccionRequest;
use App\Http\Requests\StoreMinutasaltadireccionRequest;
use App\Http\Requests\UpdateMinutasaltadireccionRequest;
use App\Models\Minutasaltadireccion;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MinutasaltadireccionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('minutasaltadireccion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Minutasaltadireccion::with(['responsablereunion', 'team'])->select(sprintf('%s.*', (new Minutasaltadireccion)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'minutasaltadireccion_show';
                $editGate      = 'minutasaltadireccion_edit';
                $deleteGate    = 'minutasaltadireccion_delete';
                $crudRoutePart = 'minutasaltadireccions';

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
            $table->editColumn('objetivoreunion', function ($row) {
                return $row->objetivoreunion ? $row->objetivoreunion : "";
            });
            $table->addColumn('responsablereunion_name', function ($row) {
                return $row->responsablereunion ? $row->responsablereunion->name : '';
            });

            $table->editColumn('arearesponsable', function ($row) {
                return $row->arearesponsable ? $row->arearesponsable : "";
            });

            $table->editColumn('archivo', function ($row) {
                return $row->archivo ? '<a href="' . $row->archivo->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'responsablereunion', 'archivo']);

            return $table->make(true);
        }

        $users = User::get();
        $teams = Team::get();

        return view('admin.minutasaltadireccions.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('minutasaltadireccion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsablereunions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.minutasaltadireccions.create', compact('responsablereunions'));
    }

    public function store(StoreMinutasaltadireccionRequest $request)
    {
        $minutasaltadireccion = Minutasaltadireccion::create($request->all());

        if ($request->input('archivo', false)) {
            $minutasaltadireccion->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $minutasaltadireccion->id]);
        }

        return redirect()->route('admin.minutasaltadireccions.index')->with("success", 'Guardado con éxito');
    }

    public function edit(Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsablereunions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $minutasaltadireccion->load('responsablereunion', 'team');

        return view('admin.minutasaltadireccions.edit', compact('responsablereunions', 'minutasaltadireccion'));
    }

    public function update(UpdateMinutasaltadireccionRequest $request, Minutasaltadireccion $minutasaltadireccion)
    {
        $minutasaltadireccion->update($request->all());

        if ($request->input('archivo', false)) {
            if (!$minutasaltadireccion->archivo || $request->input('archivo') !== $minutasaltadireccion->archivo->file_name) {
                if ($minutasaltadireccion->archivo) {
                    $minutasaltadireccion->archivo->delete();
                }

                $minutasaltadireccion->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($minutasaltadireccion->archivo) {
            $minutasaltadireccion->archivo->delete();
        }

        return redirect()->route('admin.minutasaltadireccions.index')->with("success", 'Editado con éxito');
    }

    public function show(Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minutasaltadireccion->load('responsablereunion', 'team');

        return view('admin.minutasaltadireccions.show', compact('minutasaltadireccion'));
    }

    public function destroy(Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minutasaltadireccion->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyMinutasaltadireccionRequest $request)
    {
        Minutasaltadireccion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('minutasaltadireccion_create') && Gate::denies('minutasaltadireccion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Minutasaltadireccion();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
