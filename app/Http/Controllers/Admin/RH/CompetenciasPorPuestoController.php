<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Puesto;
use App\Models\RH\Competencia;
use App\Models\RH\CompetenciaPuesto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CompetenciasPorPuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('competencias_por_puesto_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $puestos = Puesto::select('id', 'puesto', 'id_area')->with(['area' => function ($q) {
                $q->select('id', 'area');
            }, 'competencias' => function ($q) {
                $q->with('competencia');
            }])->orderByDesc('id')->get();

            return datatables()->of($puestos)->toJson();
        }

        //Para Jon

        // if ($request->ajax()) {
        //     $puestos = Puesto::select('id', 'puesto', 'id_area')->with(['area'=>function ($q) {
        //         $q->select('id', 'area');
        //     }, 'competencias' => function ($q) {
        //         $q->with('competencia');}])->orderByDesc('id')->get();
        //         return datatables()->of($puestos)->toJson()
        //             ->addIndexColumn()
        //             ->filter(function ($instance) use ($request) {
        //                 if (!empty($request->get('area'))) {
        //                      $instance->where(function($w) use($request){
        //                         $search = $request->get('area');
        //                         $w->orWhere('area', 'LIKE', "%$search%");
        //                     });
        //                 }
        //             })
        //             ->rawColumns(['area'])
        //             ->make(true);
        //     }

        // $areas = Area::get();

        $areas = Area::getAll();

        return view('admin.recursos-humanos.evaluacion-360.competencias-por-puesto.index', compact('areas'));
    }

    public function indexCompetenciasPorPuesto(Request $request, $puesto)
    {
        if ($request->ajax()) {
            $competencias = CompetenciaPuesto::with('puesto', 'competencia')->where('puesto_id', intval($puesto));

            return datatables()->of($competencias)->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($puesto)
    {
        abort_if(Gate::denies('lista_de_perfiles_de_puesto_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $puesto = Puesto::find(intval($puesto));
        $competencias = Competencia::getAll();

        return view('admin.recursos-humanos.evaluacion-360.competencias-por-puesto.create', compact('puesto', 'competencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $puesto)
    {
        abort_if(Gate::denies('lista_de_perfiles_de_puesto_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'competencia_id' => 'required|exists:ev360_competencias,id',
            'nivel_esperado' => 'required|numeric',
        ]);
        $exists = CompetenciaPuesto::where('puesto_id', '=', intval($puesto))
            ->where('competencia_id', '=', $request->competencia_id)
            ->exists();
        if (! $exists) {
            $puestoCompetencia = CompetenciaPuesto::create([
                'puesto_id' => intval($puesto),
                'competencia_id' => $request->competencia_id,
                'nivel_esperado' => $request->nivel_esperado,
            ]);
            if ($puestoCompetencia) {
                return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['error' => true, 'mensaje' => 'Esta competencia ya ha sido asignada']);
        }
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
        abort_if(Gate::denies('competencias_por_puesto_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nivel_esperado' => 'required|numeric',
        ]);

        $competenciaPorPuesto = CompetenciaPuesto::find($id);
        $update = $competenciaPorPuesto->update([
            'nivel_esperado' => $request->nivel_esperado,
        ]);
        if ($update) {
            return response()->json(['success' => true]);
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
        abort_if(Gate::denies('competencias_por_puesto_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $competenciaPorPuesto = CompetenciaPuesto::find($id);
        $delete = $competenciaPorPuesto->delete();
        if ($delete) {
            return response()->json(['success' => true]);
        }
    }
}
