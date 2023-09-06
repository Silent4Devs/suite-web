<?php

namespace App\Http\Controllers\Admin;

use App\Functions\GenerateAnalisisB;
use App\Functions\Porcentaje;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAnalisisBrechasRequest;
use App\Models\AnalisisBrecha;
use App\Models\Empleado;
use App\Models\GapDo;
use App\Models\GapTre;
use App\Models\GapUno;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AnalisisBrechaController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('analisis_de_brechas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AnalisisBrecha::with(['empleado', 'gap_logro_tres', 'gap_logro_dos', 'gap_logro_unos'])->orderByDesc('id')->get();
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
                $gap1porcentaje = GapUno::latest()->select('id', 'valoracion', 'analisis_brechas_id')->get()->where('analisis_brechas_id', '=', $row->id)->skip(3)->take(12);
                $gap12porcentaje = GapUno::select('id', 'valoracion', 'analisis_brechas_id')->orderBy('id', 'asc')->get()->where('analisis_brechas_id', '=', $row->id)->take(3);
                $gap2porcentaje = GapDo::select('id', 'valoracion')->where('valoracion', '!=', '4')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap2satisfactorio = GapDo::select('id', 'valoracion')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap2parcialmente = GapDo::select('id', 'valoracion')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap3porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap31porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap3satisfactorios = GapTre::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap3parcialmente = GapTre::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap3asatisfactorios = GapTre::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap3aparcialmente = GapTre::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', $row->id)->count();
                $gap2noaplica = GapDo::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', $row->id)->count();
                $total = 114 - $gap2noaplica;
                $gapunoPorc = new Porcentaje();
                $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
                $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorio, $gap2parcialmente);
                $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap3satisfactorios, $gap3parcialmente, $gap31porcentaje, $gap3asatisfactorios, $gap3aparcialmente);

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

        return view('admin.analisisdebrechas.index', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('analisis_de_brechas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getaltaAll();

        return view('admin.analisisdebrechas.create', compact('empleados'));
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

        $analisisBrecha = AnalisisBrecha::create($request->all());

        $dataCieCont = new GenerateAnalisisB();
        $datosgapuno = $dataCieCont->TraerDatos($analisisBrecha->id);
        // dd($cie);
        GapUno::insert($datosgapuno);
        $datosgapdos = $dataCieCont->TraerDatosDos($analisisBrecha->id);
        GapDo::insert($datosgapdos);
        $datosgaptres = $dataCieCont->TraerDatosTres($analisisBrecha->id);
        GapTre::insert($datosgaptres);

        return redirect()->route('admin.analisisdebrechas.index');
    }

    public function show(AnalisisBrecha $analisisBrecha)
    {
    }

    public function edit($id)
    {
        abort_if(Gate::denies('analisis_de_brechas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getaltaAll();

        $analisisBrecha = AnalisisBrecha::find($id);

        $gap1porcentaje = GapUno::latest()->select('id', 'valoracion', 'analisis_brechas_id')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id)->skip(3)->take(12);
        $gap12porcentaje = GapUno::select('id', 'valoracion', 'analisis_brechas_id')->orderBy('id', 'asc')->get()->where('analisis_brechas_id', '=', $analisisBrecha->id)->take(3);
        $gap2porcentaje = GapDo::select('id', 'valoracion')->where('valoracion', '!=', '4')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2satisfactorio = GapDo::select('id', 'valoracion')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2parcialmente = GapDo::select('id', 'valoracion')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap31porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3satisfactorios = GapTre::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3parcialmente = GapTre::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3asatisfactorios = GapTre::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap3aparcialmente = GapTre::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $gap2noaplica = GapDo::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', $analisisBrecha->id)->count();
        $total = 114 - $gap2noaplica;
        $gapunoPorc = new Porcentaje();
        $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
        $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorio, $gap2parcialmente);
        $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap3satisfactorios, $gap3parcialmente, $gap31porcentaje, $gap3asatisfactorios, $gap3aparcialmente);

        $cuentas = $gapunoPorc->GAPTotal($porcentajeGap1, $porcentajeGap2['Avance'], $porcentajeGap3['porcentaje']);

        // dd( $analisisBrecha);
        return view('admin.analisisdebrechas.edit', compact('empleados', 'analisisBrecha', 'gap1porcentaje', 'gap12porcentaje', 'gap2porcentaje', 'gap2satisfactorio', 'gap2parcialmente', 'gap3porcentaje', 'gap31porcentaje', 'gap2noaplica', 'total', 'gapunoPorc', 'porcentajeGap1', 'porcentajeGap2', 'porcentajeGap3', 'cuentas'));
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

        $analisisBrecha = AnalisisBrecha::find($id);

        $analisisBrecha->update([
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'id_elaboro' => $request->id_elaboro,
            'porcentaje_implementacion' => $request->porcentaje_implementacion,
            'estatus' => $request->estatus,
        ]);

        return redirect()->route('admin.analisisdebrechas.index')->with('success', 'Editado con éxito');
    }

    public function destroy($AnalisisBrecha)
    {
        abort_if(Gate::denies('analisis_de_brechas_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $AnalisisBrecha = AnalisisBrecha::find($AnalisisBrecha);
        $AnalisisBrecha->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyAnalisisBrechasRequest $request)
    {
        AnalisisBrecha::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
