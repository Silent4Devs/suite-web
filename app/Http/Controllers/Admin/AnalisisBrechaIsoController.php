<?php

namespace App\Http\Controllers\Admin;

use App\Functions\GenerateAnalisisBIso;
use App\Functions\Porcentaje2022;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAnalisisBrechasRequest;
use App\Models\Empleado;
use App\Models\Iso27\GapUnoConcentratoIso;
use App\Models\Iso27\GapDosConcentradoIso;
use App\Models\Iso27\GapTresConcentradoIso;
use App\Models\Iso27\AnalisisBrechasIso;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AnalisisBrechaIsoController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('analisis_de_brechas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AnalisisBrechasIso::with(['empleado'])->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_brechas_ver';
                $editGate = 'analisis_de_brechas_editar';
                $deleteGate = 'analisis_de_brechas_eliminar';
                $crudRoutePart = 'analisisdebrechas-2022';

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
                $gap1porcentaje = GapUnoConcentratoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', $row->id)->orderBy('id', 'asc')->get();
                $gap1satisfactorios = GapUnoConcentratoIso::select('id')->where('valoracion', '1')->where('id_analisis_brechas', '=', $row->id)->count();
                $gap1parcialmente = GapUnoConcentratoIso::select('id')->where('valoracion', '2')->where('id_analisis_brechas', '=', $row->id)->count();
                $gap1nocumple = GapUnoConcentratoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', $row->id)->count();
                $gapunoPorc = new Porcentaje2022();
                $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje);
                // dd($porcentajeGap1);
                // dd($gap1porcentaje, $gap1satisfactorios, $gap1parcialmente, $gap1nocumple);

                $gap2porcentaje = GapDosConcentradoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', $row->id)->orderBy('id', 'asc')->get();
                $gap2satisfactorios = GapDosConcentradoIso::select('id')->where('valoracion', '1')->where('id_analisis_brechas', '=', $row->id)->count();
                $gap2parcialmente = GapDosConcentradoIso::select('id')->where('valoracion', '2')->where('id_analisis_brechas', '=', $row->id)->count();
                $gap2nocumple = GapDosConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', $row->id)->count();
                $gap2noaplica = GapDosConcentradoIso::select('id')->where('valoracion', '=', '4')->where('id_analisis_brechas', '=', $row->id)->count();
                $total = 93 - $gap2noaplica;
                $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorios, $gap2parcialmente);
                // dd($gap2porcentaje, $gap2satisfactorios, $gap2parcialmente, $gap2nocumple, $gap2noaplica);
                // dd($porcentajeGap2);

                $gap3porcentaje = GapTresConcentradoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', $row->id)->orderBy('id', 'asc')->count();
                $gap3satisfactorios = GapTresConcentradoIso::select('id')->where('valoracion', '=', '1')->where('id_analisis_brechas', '=', $row->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
                    return $query->where('estado', '=', 'verificar');
                })->count();
                $gap3parcialmente = GapTresConcentradoIso::select('id')->where('valoracion', '=', '2')->where('id_analisis_brechas', '=', $row->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
                    return $query->where('estado', '=', 'verificar');
                })->count();
                $gap3nocumple = GapTresConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', $row->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
                    return $query->where('estado', '=', 'verificar');
                })->count();
                $gap3asatisfactorios = GapTresConcentradoIso::select('id')->where('valoracion', '=', '1')->where('id_analisis_brechas', '=', $row->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
                    return $query->where('estado', '=', 'actuar');
                })->count();
                $gap3aparcialmente = GapTresConcentradoIso::select('id')->where('valoracion', '=', '2')->where('id_analisis_brechas', '=', $row->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
                    return $query->where('estado', '=', 'actuar');
                })->count();
                $gap3anocumple = GapTresConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', $row->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
                    return $query->where('estado', '=', 'actuar');
                })->count();
                $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap3satisfactorios, $gap3parcialmente, $gap3asatisfactorios, $gap3aparcialmente);

                $cuentas = $gapunoPorc->GAPTotal($porcentajeGap1, $porcentajeGap2['Avance'], $porcentajeGap3['porcentaje']);

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

            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.analisisdebrechas2022.index', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('analisis_de_brechas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::alta()->get();

        return view('admin.analisisdebrechas2022.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('analisis_de_brechas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => ['required'],
            'fecha' => ['required'],
            'id_elaboro' => ['required'],
            'estatus' => ['required'],
        ]);
        $analisisBrechaIso = AnalisisBrechasIso::create($request->all());

        $dataCieContIso = new GenerateAnalisisBIso();
        $datosgapunoIso = $dataCieContIso->TraerDatos($analisisBrechaIso->id);
        // dd($cie);
        GapUnoConcentratoIso::insert($datosgapunoIso);
        $datosgapdosIso = $dataCieContIso->TraerDatosDos($analisisBrechaIso->id);
        GapDosConcentradoIso::insert($datosgapdosIso);
        $datosgaptresIso = $dataCieContIso->TraerDatosTres($analisisBrechaIso->id);
        GapTresConcentradoIso::insert($datosgaptresIso);

        return redirect()->route('admin.analisisdebrechas-2022.index');
    }

    public function show(AnalisisBrechaIso $analisisBrecha)
    {
    }

    public function edit($id)
    {
        abort_if(Gate::denies('analisis_de_brechas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::alta()->get();

        $analisisBrecha = AnalisisBrechasIso::find($id);

        $gap1porcentaje = GapUnoConcentratoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', $id)->orderBy('id', 'asc')->get();
        $gap1satisfactorios = GapUnoConcentratoIso::select('id')->where('valoracion', '1')->where('id_analisis_brechas', '=', $id)->count();
        $gap1parcialmente = GapUnoConcentratoIso::select('id')->where('valoracion', '2')->where('id_analisis_brechas', '=', $id)->count();
        $gap1nocumple = GapUnoConcentratoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', $id)->count();
        $gapunoPorc = new Porcentaje2022();
        $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje);
        // dd($porcentajeGap1);
        // dd($gap1porcentaje, $gap1satisfactorios, $gap1parcialmente, $gap1nocumple);

        $gap2porcentaje = GapDosConcentradoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', $id)->orderBy('id', 'asc')->get();
        $gap2satisfactorios = GapDosConcentradoIso::select('id')->where('valoracion', '1')->where('id_analisis_brechas', '=', $id)->count();
        $gap2parcialmente = GapDosConcentradoIso::select('id')->where('valoracion', '2')->where('id_analisis_brechas', '=', $id)->count();
        $gap2nocumple = GapDosConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', $id)->count();
        $gap2noaplica = GapDosConcentradoIso::select('id')->where('valoracion', '=', '4')->where('id_analisis_brechas', '=', $id)->count();
        $total = 93 - $gap2noaplica;
        $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorios, $gap2parcialmente);
        // dd($gap2porcentaje, $gap2satisfactorios, $gap2parcialmente, $gap2nocumple, $gap2noaplica);
        // dd($porcentajeGap2);

        $gap3porcentaje = GapTresConcentradoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', $id)->orderBy('id', 'asc')->count();
        $gap3satisfactorios = GapTresConcentradoIso::select('id')->where('valoracion', '=', '1')->where('id_analisis_brechas', '=', $id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
            return $query->where('estado', '=', 'verificar');
        })->count();
        $gap3parcialmente = GapTresConcentradoIso::select('id')->where('valoracion', '=', '2')->where('id_analisis_brechas', '=', $id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
            return $query->where('estado', '=', 'verificar');
        })->count();
        $gap3nocumple = GapTresConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', $id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
            return $query->where('estado', '=', 'verificar');
        })->count();
        $gap3asatisfactorios = GapTresConcentradoIso::select('id')->where('valoracion', '=', '1')->where('id_analisis_brechas', '=', $id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
            return $query->where('estado', '=', 'actuar');
        })->count();
        $gap3aparcialmente = GapTresConcentradoIso::select('id')->where('valoracion', '=', '2')->where('id_analisis_brechas', '=', $id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
            return $query->where('estado', '=', 'actuar');
        })->count();
        $gap3anocumple = GapTresConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', $id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
            return $query->where('estado', '=', 'actuar');
        })->count();
        $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap3satisfactorios, $gap3parcialmente, $gap3asatisfactorios, $gap3aparcialmente);

        $cuentas = $gapunoPorc->GAPTotal($porcentajeGap1, $porcentajeGap2['Avance'], $porcentajeGap3['porcentaje']);

        return view('admin.analisisdebrechas2022.edit', compact('empleados', 'analisisBrecha', 'cuentas'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('analisis_de_brechas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre' => ['required'],
            'fecha' => ['required'],
            'porcentaje_implementacion' => ['nullable'],
            'id_elaboro' => ['required'],
            'estatus' => ['required'],
        ]);

        $analisisBrecha = AnalisisBrechasIso::find($id);

        $analisisBrecha->update([
            'nombre' =>  $request->nombre,
            'fecha' =>  $request->fecha,
            'id_elaboro' =>  $request->id_elaboro,
            'porcentaje_implementacion' => $request->porcentaje_implementacion,
            'estatus' =>  $request->estatus,
        ]);

        return redirect()->route('admin.analisisdebrechas-2022.index')->with('success', 'Editado con éxito');
    }

    public function destroy($AnalisisBrecha)
    {
        abort_if(Gate::denies('analisis_de_brechas_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $AnalisisBrecha = AnalisisBrechasIso::find($AnalisisBrecha);
        $AnalisisBrecha->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyAnalisisBrechasRequest $request)
    {
        AnalisisBrechasIso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
