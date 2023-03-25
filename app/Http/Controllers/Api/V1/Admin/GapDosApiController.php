<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGapDoRequest;
use App\Http\Requests\UpdateGapDoRequest;
use App\Http\Resources\Admin\GapDoResource;
use App\Models\GapDo;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class GapDosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gap_do_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GapDoResource(GapDo::with(['team'])->get());
    }

    public function store(StoreGapDoRequest $request)
    {
        $gapDo = GapDo::create($request->all());

        return (new GapDoResource($gapDo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GapDo $gapDo)
    {
        abort_if(Gate::denies('gap_do_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GapDoResource($gapDo->load(['team']));
    }

    public function update(UpdateGapDoRequest $request, GapDo $gapDo)
    {
        $gapDo->update($request->all());

        return (new GapDoResource($gapDo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GapDo $gapDo)
    {
        abort_if(Gate::denies('gap_do_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapDo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
