<?php

namespace App\Http\Controllers\Frontend;

use App\Functions\GenerateAnalisisB;
use App\Functions\Porcentaje;
use App\Http\Controllers\Controller;
use App\Models\AnalisisBrecha;
use App\Models\AnalisisDeRiesgo;
use App\Models\Empleado;
use App\Models\GapDo;
use App\Models\GapTre;
use App\Models\GapUno;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AnalisisBrechaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = AnalisisBrecha::with(['empleado', 'gap_logro_tres', 'gap_logro_dos', 'gap_logro_unos'])->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'analisisdebrechas';

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
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });

            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? \Carbon\Carbon::parse($row->fecha)->format('d-m-Y') : '';
            });

            $table->editColumn('porcentaje_implementacion', function ($row) {
                $gap1porcentaje = GapUno::latest()->select('id', 'valoracion', 'analisis_brechas_id')->get()->where('analisis_brechas_id', '=', $row->id)->skip(3)->take(12);
                $gap12porcentaje = GapUno::select('id', 'valoracion', 'analisis_brechas_id')->orderBy('id', 'asc')->get()->where('analisis_brechas_id', '=', $row->id)->take(3);
                $gap2porcentaje = GapDo::select('id', 'valoracion')->where('valoracion', '!=', '4')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap2satisfactorio = GapDo::select('id', 'valoracion')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap2parcialmente = GapDo::select('id', 'valoracion')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap3porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'verificar')->get()->where('analisis_brechas_id', '=', $row->id);
                $gap31porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'actuar')->get()->where('analisis_brechas_id', '=', $row->id);
                $gap2noaplica = GapDo::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', $row->id)->count();
                $total = 114 - $gap2noaplica;
                $gapunoPorc = new Porcentaje();
                $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
                $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorio, $gap2parcialmente);
                $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap31porcentaje);
                $cuentas = number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '');

                return $cuentas.'%' ? $cuentas.'%' : '';
            });

            $table->editColumn('elaboro', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });

            $table->editColumn('estatus', function ($row) {
                if ($row->estatus == 1) {
                    return $row->estatus ? 'Válido' : '';
                } else {
                    return $row->estatus ? 'Obsoleto' : '';
                }
            });
            $table->editColumn('enlace', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);
        }

        return view('frontend.analisisdebrechas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = Empleado::getAll();

        return view('frontend.analisisdebrechas.create', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $analisisBrecha = AnalisisBrecha::create($request->all());

        $dataCieCont = new GenerateAnalisisB();
        $datosgapuno = $dataCieCont->TraerDatos($analisisBrecha->id);
        // dd($cie);
        GapUno::insert($datosgapuno);
        $datosgapdos = $dataCieCont->TraerDatosDos($analisisBrecha->id);
        GapDo::insert($datosgapdos);
        $datosgaptres = $dataCieCont->TraerDatosTres($analisisBrecha->id);
        GapTre::insert($datosgaptres);

        return redirect()->route('analisisdebrechas.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(AnalisisBrecha $analisisBrecha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnalisisBrecha  $analisisBrecha
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleados = Empleado::getAll();

        $analisisBrecha = AnalisisBrecha::find($id);

        $gap1porcentaje = GapUno::latest()->select('id', 'valoracion', 'analisis_brechas_id')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id)->skip(3)->take(12);
        $gap12porcentaje = GapUno::select('id', 'valoracion', 'analisis_brechas_id')->orderBy('id', 'asc')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id)->take(3);
        $gap2porcentaje = GapDo::select('id', 'valoracion')->where('valoracion', '!=', '4')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2satisfactorio = GapDo::select('id', 'valoracion')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2parcialmente = GapDo::select('id', 'valoracion')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'verificar')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id);
        $gap31porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'actuar')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id);
        $gap2noaplica = GapDo::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $total = 114 - $gap2noaplica;
        $gapunoPorc = new Porcentaje();
        $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
        $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorio, $gap2parcialmente);
        $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap31porcentaje);
        $cuentas = number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '');
        // dd( $analisisBrecha);
        return view('frontend.analisisdebrechas.edit', compact('empleados', 'analisisBrecha', 'gap1porcentaje', 'gap12porcentaje', 'gap2porcentaje', 'gap2satisfactorio', 'gap2parcialmente', 'gap3porcentaje', 'gap31porcentaje', 'gap2noaplica', 'total', 'gapunoPorc', 'porcentajeGap1', 'porcentajeGap2', 'porcentajeGap3', 'cuentas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnalisisBrecha $analisisBrecha)
    {
        $analisisBrecha = AnalisisDeRiesgo::find($id);

        $analisisBrecha->update([
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'id_elaboro' => $request->id_elaboro,
            'porcentaje_implementacion' => $request->porcentaje_implementacion,
            'estatus' => $request->estatus,
        ]);

        return redirect()->route('analisisdebrechas.index')->with('success', 'Editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnalisisBrecha  $analisisBrecha
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        AnalisisBrecha::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
