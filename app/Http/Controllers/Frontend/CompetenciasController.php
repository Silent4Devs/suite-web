<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompetenciumRequest;
use App\Http\Requests\StoreCompetenciumRequest;
use App\Http\Requests\UpdateCompetenciumRequest;
use App\Models\Area;
use App\Models\Competencium;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompetenciasController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('competencium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Competencium::with(['nombrecolaborador', 'team'])->select(sprintf('%s.*', (new Competencium)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'competencium_show';
                $editGate = 'competencium_edit';
                $deleteGate = 'competencium_delete';
                $crudRoutePart = 'competencia';

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
            $table->addColumn('nombrecolaborador_name', function ($row) {
                return $row->nombrecolaborador ? $row->nombrecolaborador->name : '';
            });

            $table->editColumn('perfilpuesto', function ($row) {
                return $row->perfilpuesto ? $row->perfilpuesto : '';
            });
            $table->editColumn('certificados', function ($row) {
                if (!$row->certificados) {
                    return '';
                }

                $links = [];

                foreach ($row->certificados as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'nombrecolaborador', 'certificados']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();

        return view('admin.competencia.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('competencium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrecolaboradors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.competencia.create', compact('nombrecolaboradors'));
    }

    public function store(StoreCompetenciumRequest $request)
    {
        $competencium = Competencium::create($request->all());

        foreach ($request->input('certificados', []) as $file) {
            $competencium->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificados');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $competencium->id]);
        }

        return redirect()->route('admin.competencia.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Competencium $competencium)
    {
        abort_if(Gate::denies('competencium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrecolaboradors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competencium->load('nombrecolaborador', 'team');

        return view('admin.competencia.edit', compact('nombrecolaboradors', 'competencium'));
    }

    public function update(UpdateCompetenciumRequest $request, Competencium $competencium)
    {
        $competencium->update($request->all());

        if (count($competencium->certificados) > 0) {
            foreach ($competencium->certificados as $media) {
                if (!in_array($media->file_name, $request->input('certificados', []))) {
                    $media->delete();
                }
            }
        }

        $media = $competencium->certificados->pluck('file_name')->toArray();

        foreach ($request->input('certificados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $competencium->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificados');
            }
        }

        return redirect()->route('admin.competencia.index')->with('success', 'Editado con éxito');
    }

    public function show(Competencium $competencium)
    {
        abort_if(Gate::denies('competencium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competencium->load('nombrecolaborador', 'team');

        return view('admin.competencia.show', compact('competencium'));
    }

    public function destroy(Competencium $competencium)
    {
        abort_if(Gate::denies('competencium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competencium->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyCompetenciumRequest $request)
    {
        Competencium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('competencium_create') && Gate::denies('competencium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Competencium();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function buscarcv(Request $request)
    {
        // dd($request->all());

        $areas = Area::getAll();

        return view('admin.competencia.buscarCV', compact('areas'));
    }
}
