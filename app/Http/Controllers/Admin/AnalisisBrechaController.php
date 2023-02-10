<?php

namespace App\Http\Controllers\Admin;

use App\Functions\GenerateAnalisisB;
use App\Functions\Porcentaje;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAnalisisBrechasRequest;
use App\Models\AnalisisBrechaSedatu;
use App\Models\Area;
use App\Models\DeclaracionAplicabilidad;
use App\Models\Empleado;
use App\Models\GapDosSedatu;
use App\Models\GapTresSedatu;
use App\Models\GapUnoSedatu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Traits\ObtenerOrganizacion;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AnalisisBrechaController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('analisis_de_brechas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AnalisisBrechaSedatu::with(['empleado', 'gap_tres_sedatu', 'gap_dos_sedatu', 'gap_uno_sedatu'])->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_brechas_ver';
                $editGate = 'analisis_de_brechas_editar';
                $deleteGate = 'analisis_de_brechas_eliminar';
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
                $gap1porcentaje = GapUnoSedatu::latest()->select('id', 'valoracion', 'analisis_brechas_id')->get()->where('analisis_brechas_id', '=', $row->id)->skip(3)->take(91);
                $gap12porcentaje = GapUnoSedatu::select('id', 'valoracion', 'analisis_brechas_id')->orderBy('id', 'asc')->get()->where('analisis_brechas_id', '=', $row->id)->take(3);
               
                $gapunoPorc = new Porcentaje();
                $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
              
                $porcentajeGap1=(($porcentajeGap1 * 100)/455);
                $porcentajeGap1=(($porcentajeGap1*30)/100);
                

                $puntosGap2 = GapDosSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $row->id)->get();       
                $preguntasGap2 = GapDosSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $row->id)->count();
                $porcentajeGap2 = $gapunoPorc->GapDosPorc($preguntasGap2, $puntosGap2);
                // $porcentajeGap2 = $this->GapDosPorc($row);
        
                $puntosGap3 = GapTresSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $row->id)->get();   
                $preguntasGap3 = GapTresSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $row->id)->count();
                $porcentajeGap3 = $gapunoPorc->GapTresPorc($preguntasGap3, $puntosGap3);
                

                $cuentas = number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '');
                return $cuentas . '%' ? $cuentas . '%' : '';
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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.analisisdebrechas.index', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
    }


    public function create()
    {
        abort_if(Gate::denies('analisis_de_brechas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::alta()->get();
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();


        return view('admin.analisisdebrechas.create', compact('empleados', 'controles'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('analisis_de_brechas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $analisisBrecha = AnalisisBrechaSedatu::create($request->all());
        
        $dataCieCont = new GenerateAnalisisB();
        $datosgapuno = $dataCieCont->TraerDatos($analisisBrecha->id);
        // dd($cie);
        GapUnoSedatu::insert($datosgapuno);
        $datosgapdos = $dataCieCont->TraerDatosDos($analisisBrecha->id);
        GapDosSedatu::insert($datosgapdos);
        $datosgaptres = $dataCieCont->TraerDatosTres($analisisBrecha->id);
        GapTresSedatu::insert($datosgaptres);

        return redirect()->route('admin.analisisdebrechas.index');
    }

    public function show(AnalisisBrechaSedatu $analisisBrecha)
    {
    }

    public function edit($id)
    {
        abort_if(Gate::denies('analisis_de_brechas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::alta()->get();

        $analisisBrecha = AnalisisBrechaSedatu::find($id);

        $gap1porcentaje = GapUnoSedatu::latest()->select('id', 'valoracion', 'analisis_brechas_id')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id)->skip(3)->take(91);
        $gap12porcentaje = GapUnoSedatu::select('id', 'valoracion', 'analisis_brechas_id')->orderBy('id', 'asc')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id)->take(3);
        $gap2porcentaje = GapDosSedatu::select('id', 'valoracion')->where('valoracion', '!=', '4')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2satisfactorio = GapDosSedatu::select('id', 'valoracion')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2parcialmente = GapDosSedatu::select('id', 'valoracion')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3porcentaje = GapTresSedatu::select('id', 'valoracion')->where('estado', '=', 'verificar')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id);
        $gap31porcentaje = GapTresSedatu::select('id', 'valoracion')->where('estado', '=', 'actuar')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id);
        $gap2noaplica = GapDosSedatu::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2inexistente = GapDosSedatu::select('id')->where('valoracion', '=', '0')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2inicial = GapDosSedatu::select('id')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2repetible = GapDosSedatu::select('id')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2definida = GapDosSedatu::select('id')->where('valoracion', '=', '3')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2administrada = GapDosSedatu::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2optimizada = GapDosSedatu::select('id')->where('valoracion', '=', '5')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3inexistente = GapTresSedatu::select('id')->where('valoracion', '=', '0')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3inicial = GapTresSedatu::select('id')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3repetible = GapTresSedatu::select('id')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3definida = GapTresSedatu::select('id')->where('valoracion', '=', '3')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3administrada = GapTresSedatu::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3optimizada = GapTresSedatu::select('id')->where('valoracion', '=', '5')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $total = GapDosSedatu::select('id')->where('analisis_brechas_id','=', $analisisBrecha->id)->get()->count();
        $totaltres = GapTresSedatu::select('id')->where('analisis_brechas_id','=', $analisisBrecha->id)->get()->count();
        $gapunoPorc = new Porcentaje();
        $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
        $porcentajeGap1=(($porcentajeGap1 * 100)/455);
        $porcentajeGap1=(($porcentajeGap1*30)/100);
        
        $puntosGap2 = GapDosSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $analisisBrecha->id)->get();       
        $preguntasGap2 = GapDosSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $porcentajeGap2 = $gapunoPorc->GapDosPorc($preguntasGap2, $puntosGap2);

        $puntosGap3 = GapTresSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $analisisBrecha->id)->get();   
        $preguntasGap3 = GapTresSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $porcentajeGap3 = $gapunoPorc->GapTresPorc($preguntasGap3, $puntosGap3);

        $cuentas = number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '');
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();

        return view('admin.analisisdebrechas.edit', compact('empleados', 'analisisBrecha', 'gap1porcentaje', 'gap12porcentaje', 'gap2porcentaje', 'gap2satisfactorio', 'gap2parcialmente', 'gap3porcentaje', 'gap31porcentaje', 'gap2noaplica', 'total', 'gapunoPorc', 'porcentajeGap1', 'porcentajeGap2', 'porcentajeGap3', 'cuentas', 'controles'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('analisis_de_brechas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analisisBrecha = AnalisisBrechaSedatu::find($id);

        $analisisBrecha->update([
            'nombre' =>  $request->nombre,
            'fecha' =>  $request->fecha,
            'id_elaboro' =>  $request->id_elaboro,
            'porcentaje_implementacion' => $request->porcentaje_implementacion,
            'estatus' =>  $request->estatus,
        ]);

        return redirect()->route('admin.analisisdebrechas.index')->with('success', 'Editado con éxito');
    }

    public function destroy($AnalisisBrecha)
    {
        abort_if(Gate::denies('analisis_de_brechas_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $AnalisisBrecha = AnalisisBrechaSedatu::find($AnalisisBrecha);
        $AnalisisBrecha->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyAnalisisBrechasRequest $request)
    {
        AnalisisBrechaSedatu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getEmployeeData(Request $request)
    {
        $empleados = Empleado::alta()->find($request->id);
        $areas = Area::find($empleados->area_id);

        return response()->json(['puesto' => $empleados->puesto, 'area' => $areas->area]);
    }

    // public function GapDosPorc($row)
    // {

    //     $puntosGap2 = GapDosSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $row->id)->get();
       
    //     $preguntasGap2 = GapDosSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $row->id)->count();

    //     $puntaje_maximo = $preguntasGap2 * 5;
    //     $puntaje = 0;
    //     foreach ($puntosGap2 as $punto) {
    //         if ($punto->valoracion == '0') {
    //             $puntaje += 0;
    //         } elseif ($punto->valoracion == '1') {
    //             $puntaje += 1;
    //         } elseif ($punto->valoracion == '2') {
    //             $puntaje += 2;
    //         } elseif ($punto->valoracion == '3') {
    //             $puntaje += 3;
    //         } elseif ($punto->valoracion == '4') {
    //             $puntaje += 4;
    //         } elseif ($punto->valoracion == '5') {
    //             $puntaje += 5;
    //         } else {
    //             $puntaje += 0;
    //         }
    //     }

    //     $resultado = $puntaje;

    //     $porcentaje_gap = ($resultado / $puntaje_maximo) * 100;
    //     $porcentaje_analisis = (($porcentaje_gap * 40)/100);

    //     return [
    //         'preguntas' => $preguntasGap2,
    //         'puntaje_maximo' => $puntaje_maximo,
    //         'porcentaje_gap' => $porcentaje_gap,
    //         'Porcentaje' => $porcentaje_analisis,
    //         'Avance' => $porcentaje_analisis,
    //     ];
    // }

    // public function GapTresPorc($row)
    // {

    //     $puntos = GapTresSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $row->id)->get();   
    //     $preguntas = GapTresSedatu::select('id', 'valoracion', 'analisis_brechas_id')->where('analisis_brechas_id', '=', $row->id)->count();
        
    //     $puntaje_maximo = $preguntas * 5;

    //     $puntaje = 0;
    //     foreach ($puntos as $punto) {
    //         if ($punto->valoracion == '0') {
    //             $puntaje += 0;
    //         } elseif ($punto->valoracion == '1') {
    //             $puntaje += 1;
    //         } elseif ($punto->valoracion == '2') {
    //             $puntaje += 2;
    //         } elseif ($punto->valoracion == '3') {
    //             $puntaje += 3;
    //         } elseif ($punto->valoracion == '4') {
    //             $puntaje += 4;
    //         } elseif ($punto->valoracion == '5') {
    //             $puntaje += 5;
    //         } else {
    //             $puntaje += 0;
    //         }
    //     }

    //     $resultado = $puntaje;

    //     $porcentaje_gap = ($resultado / $puntaje_maximo) * 100;
    //     $porcentaje_analisis = (($porcentaje_gap * 30)/100);

    //     return [
        
    //         'porcentaje_gap' => $porcentaje_gap,
    //         'porcentaje' => $porcentaje_analisis,
    //         'verificar' => $porcentaje_analisis,
    //     ];
    // }
}
