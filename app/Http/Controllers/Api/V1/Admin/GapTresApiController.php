<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGapTreRequest;
use App\Http\Requests\UpdateGapTreRequest;
use App\Http\Resources\Admin\GapTreResource;
use App\Models\GapTre;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class GapTresApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gap_tre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GapTreResource(GapTre::with(['team'])->get());
    }

    public function store(StoreGapTreRequest $request)
    {
        $gapTre = GapTre::create($request->all());

        return (new GapTreResource($gapTre))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GapTre $gapTre)
    {
        abort_if(Gate::denies('gap_tre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GapTreResource($gapTre->load(['team']));
    }

    public function update(UpdateGapTreRequest $request, GapTre $gapTre)
    {
        $gapTre->update($request->all());

        return (new GapTreResource($gapTre))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GapTre $gapTre)
    {
        abort_if(Gate::denies('gap_tre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapTre->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
