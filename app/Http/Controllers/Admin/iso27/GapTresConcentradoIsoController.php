<?php

namespace App\Http\Controllers\Admin\iso27;

use App\Http\Controllers\Controller;
use App\Models\Iso27\GapTresConcentradoIso;
use Illuminate\Http\Request;

class GapTresConcentradoIsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->ajax()) {
            switch ($request->name) {
                case 'evidencia':
                    $gapun = GapTresConcentradoIso::findOrFail($id);
                    $gapun->evidencia = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'recomendacion':
                    $gapun = GapTresConcentradoIso::findOrFail($id);
                    $gapun->recomendacion = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'valoracion':
                    $gapun = GapTresConcentradoIso::findOrFail($id);
                    $gapun->valoracion = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
