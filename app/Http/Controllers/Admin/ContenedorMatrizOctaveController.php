<?php

namespace App\Http\Controllers\Admin;
use App\Models\MatrizOctaveContenedor;
use App\Models\MatrizOctaveEscenario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\DeclaracionAplicabilidad;


class ContenedorMatrizOctaveController extends Controller
{
    public function index()
    {
        return view('admin.ContenedorMatrizOctave.index');
    }

    public function create()
    {
        // dd("aqui");
        return view('admin.ContenedorMatrizOctave.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $contenedor = MatrizOctaveContenedor::create($request->all());

        return redirect()->route('admin.contenedores.edit', $contenedor);
    }

    public function edit(Request $request, $contenedor)
    {
        $contenedor = MatrizOctaveContenedor::find($contenedor);
        $sumatoria = $this->calcularRiesgo($contenedor->id);
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();

        return view('admin.ContenedorMatrizOctave.edit', compact('contenedor', 'sumatoria', 'controles'));
    }

    public function update(Request $request, $contenedor)
    {
        $contenedor = MatrizOctaveContenedor::find($contenedor);
        $contenedor = $contenedor->update($request->all());
        return redirect()->route('admin.contenedores.index');
    }

    public function agregarEscenarios(Request $request, $contenedor){
        $controles = array_map(function ($value){
            return intval($value);
        },$request->controles);

        $request->validate([
            'identificador_escenario'=>'required',
            'nom_escenario'=>'required',
        ]);

        $escenario = MatrizOctaveEscenario::create([
            'identificador_escenario'=>$request->identificador_escenario,
            'nom_escenario'=>$request->nom_escenario,
            'descripcion'=>$request->descripcion,
            'confidencialidad'=>$request->confidencialidad,
            'integridad'=>$request->integridad,
            'disponibilidad'=>$request->disponibilidad,
            'id_octave_contenedor'=>$contenedor,
        ]);
        $escenario->controles()->sync($controles);
        $sumatoria = $this->calcularRiesgo($contenedor);
        $contenedor = MatrizOctaveContenedor::find($contenedor);
        $contenedor->update(['riesgo'=>$sumatoria]);

        return response()->json(['estatus'=>200, 'riesgo'=>$sumatoria]);
    }
    public function calcularRiesgo($contenedor){
        $escenarios = MatrizOctaveContenedor::with('escenarios')->find($contenedor)->escenarios;
        $cantidadEscenarios = count($escenarios)>0?count($escenarios):1;
        $sumatoria = 0;
        foreach ($escenarios as $escenario) {
            $sumatoria = $sumatoria + ($escenario->confidencialidad?$escenario->confidencialidad:0) + ($escenario->integridad?$escenario->integridad:0) + ($escenario->disponibilidad?$escenario->disponibilidad:0);
        }
        $sumatoria = $sumatoria/$cantidadEscenarios;

        return round($sumatoria);
    }
    public function escenarios($contenedor)
    {
        $escenarios = MatrizOctaveContenedor::with(['escenarios'=>function($q){
            $q->with('controles');
        }])->find($contenedor)->escenarios;

        return Datatables::of($escenarios)->make(true);
    }
}
