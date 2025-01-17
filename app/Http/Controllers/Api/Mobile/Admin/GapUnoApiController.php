<?php

namespace App\Http\Controllers\Api\Mobile\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGapUnoRequest;
use App\Http\Requests\UpdateGapUnoRequest;
use App\Http\Resources\Admin\GapUnoResource;
use App\Models\GapUno;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class GapUnoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gap_uno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GapUnoResource(GapUno::with(['team'])->get());
    }

    public function store(StoreGapUnoRequest $request)
    {
        $gapUno = GapUno::create($request->all());

        return (new GapUnoResource($gapUno))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show($id_gapUno)
    {
        abort_if(Gate::denies('gap_uno_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $gapUno = GapUno::where('id', $id_gapUno)->first();

        return new GapUnoResource($gapUno->load(['team']));
    }

    public function update(UpdateGapUnoRequest $request, $id_gapUno)
    {
        $gapUno = GapUno::where('id', $id_gapUno)->first();
        $gapUno->update($request->all());

        return (new GapUnoResource($gapUno))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy($id_gapUno)
    {
        abort_if(Gate::denies('gap_uno_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $gapUno = GapUno::where('id', $id_gapUno)->first();
        $gapUno->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
