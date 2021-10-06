<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEvidenciasSgsiRequest;
use App\Http\Requests\StoreEvidenciasSgsiRequest;
use App\Http\Requests\UpdateEvidenciasSgsiRequest;
use App\Models\EvidenciasSgsi;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EvidenciasSgsiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('evidencias_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evidenciasSgsis = EvidenciasSgsi::all();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.evidenciasSgsis.index', compact('evidenciasSgsis', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('evidencias_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.evidenciasSgsis.create', compact('responsables'));
    }

    public function store(StoreEvidenciasSgsiRequest $request)
    {
        $evidenciasSgsi = EvidenciasSgsi::create($request->all());

        if ($request->input('archivopdf', false)) {
            $evidenciasSgsi->addMedia(storage_path('tmp/uploads/' . $request->input('archivopdf')))->toMediaCollection('archivopdf');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $evidenciasSgsi->id]);
        }

        return redirect()->route('frontend.evidencias-sgsis.index');
    }

    public function edit(EvidenciasSgsi $evidenciasSgsi)
    {
        abort_if(Gate::denies('evidencias_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $evidenciasSgsi->load('responsable', 'team');

        return view('frontend.evidenciasSgsis.edit', compact('responsables', 'evidenciasSgsi'));
    }

    public function update(UpdateEvidenciasSgsiRequest $request, EvidenciasSgsi $evidenciasSgsi)
    {
        $evidenciasSgsi->update($request->all());

        if ($request->input('archivopdf', false)) {
            if (!$evidenciasSgsi->archivopdf || $request->input('archivopdf') !== $evidenciasSgsi->archivopdf->file_name) {
                if ($evidenciasSgsi->archivopdf) {
                    $evidenciasSgsi->archivopdf->delete();
                }

                $evidenciasSgsi->addMedia(storage_path('tmp/uploads/' . $request->input('archivopdf')))->toMediaCollection('archivopdf');
            }
        } elseif ($evidenciasSgsi->archivopdf) {
            $evidenciasSgsi->archivopdf->delete();
        }

        return redirect()->route('frontend.evidencias-sgsis.index');
    }

    public function show(EvidenciasSgsi $evidenciasSgsi)
    {
        abort_if(Gate::denies('evidencias_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evidenciasSgsi->load('responsable', 'team');

        return view('frontend.evidenciasSgsis.show', compact('evidenciasSgsi'));
    }

    public function destroy(EvidenciasSgsi $evidenciasSgsi)
    {
        abort_if(Gate::denies('evidencias_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evidenciasSgsi->delete();

        return back();
    }

    public function massDestroy(MassDestroyEvidenciasSgsiRequest $request)
    {
        EvidenciasSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('evidencias_sgsi_create') && Gate::denies('evidencias_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new EvidenciasSgsi();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
