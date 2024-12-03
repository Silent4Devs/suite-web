<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TBTemplateAnalisisRiesgoModel;
use App\Models\TBTemplateAr_EscalaArModel;
use App\Models\TBTemplateArProbImpArModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TBTemplateAnalisisRiesgosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        DB::beginTransaction();
        try {
            $template = TBTemplateAnalisisRiesgoModel::create([
                'nombre' => 'Sin nombre',
                'norma_id' => null,
                'descripcion' => 'Sin descripcion',
                'status' => false,
                'top' => false,
            ]);

            TBTemplateAr_EscalaArModel::create([
                'valor_min' => 0,
                'valor_max' => 0,
                'template_id' => $template->id,
            ]);

            TBTemplateArProbImpArModel::create([
                'valor_min' => 0,
                'valor_max' => 0,
                'template_id' => $template->id,
            ]);

            DB::commit();
            $id = $template->id;

            return view('admin.analisis-riesgos.template.tbTemplateCrear', compact('id'));
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $template = TBTemplateAnalisisRiesgoModel::findOrFail($id);
        $id = $template->id;

        return view('admin.analisis-riesgos.template.tbTemplateCrear', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
