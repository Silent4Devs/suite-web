<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanAccionKanban;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;

class KanbanPlanAccionController extends Controller
{
    use ObtenerOrganizacion;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $planesAccionKanban = PlanAccionKanban::get();
            return datatables($planesAccionKanban)->toJson();
        }
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        return view('admin.kanban-pa.index', compact('logo_actual', 'empresa_actual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $planAccionKanban = new PlanAccionKanban();
        return view('admin.kanban-pa.create', compact('planAccionKanban'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $planAccionKanban = PlanAccionKanban::find($id);
        return view('admin.kanban-pa.show', compact('planAccionKanban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planAccionKanban = PlanAccionKanban::find($id);
        return view('admin.kanban-pa.edit', compact('planAccionKanban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $planAccionKanban = PlanAccionKanban::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planAccionKanban = PlanAccionKanban::find($id);
    }
}
