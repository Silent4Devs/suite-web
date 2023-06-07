<?php

namespace App\Http\Controllers\Admin\iso27;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;

use App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso;
use App\Models\Iso27\GapDosCatalogoIso;
use App\Models\Iso27\GapTresCatalogoIso;
use App\Models\Iso27\GapUnoConcentratoIso;
use App\Models\Iso27\GapDosConcentradoIso;
use App\Models\Iso27\GapTresConcentradoIso;

use App\Traits\ObtenerOrganizacion;

class DeclaracionAplicabilidadConcentradoIsoController extends Controller
{
    use ObtenerOrganizacion;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('declaracion_de_aplicabilidad_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapa5 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')
        ->with('gapdos.clasificacion')
        ->whereHas('gapdos', function($query){
            return $query->where('control_iso', 'LIKE', "A.5.".'%');
        })->orderBy('id', 'ASC')->get();

        $gapa6 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
        ->whereHas('gapdos', function($query){
            return $query->where('control_iso', 'LIKE', "A.6.".'%');
        })->orderBy('id', 'ASC')->get();

        $gapa7 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
        ->whereHas('gapdos', function($query){
            return $query->where('control_iso', 'LIKE', "A.7.".'%');
        })->orderBy('id', 'ASC')->get();

        $gapa8 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
        ->whereHas('gapdos', function($query){
            return $query->where('control_iso', 'LIKE', "A.8.".'%');
        })->orderBy('id', 'ASC')->get();

        dd($gapa5, $gapa6, $gapa7, $gapa8);

        return view('admin.declaracionaplicabilidad.index', compact('conteoAplica', 'conteoNoaplica', 'A5', 'A5No', 'A6', 'A6No', 'A7', 'A7No', 'A8', 'A8No', 'A9', 'A9No', 'A10', 'A10No', 'A11', 'A11No', 'A12', 'A12No', 'A13', 'A13No', 'A14', 'A14No', 'A15', 'A15No', 'A16', 'A16No', 'A17', 'A17No', 'A18', 'A18No'))
        ->with('gapda6s', $gapa6)->with('gapda5s', $gapa5)
        ->with('gapda7s', $gapa71)->with('gapda8s', $gapa81)
        ->with('lista_archivos_declaracion', $lista_archivos_declaracion)
        ->with('ISO27001_SoA_PATH', $ISO27001_SoA_PATH)
        ->with('aprobadores', $aprobadores)
        ->with('responsables', $responsables);
    }

    public function tabla(Request $request)
    {
        // dd("Llega a la tabla");
        if ($request->ajax()) {
            $controles = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
            ->orderBy('id')->get();

            return datatables()->of($controles)->toJson();
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.declaracionaplicabilidad2022.tabla', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $control)
    {
        $control = GapDosCatalogoIso::with('clasificacion')->find($control);
        // dd($control);

        return view('admin.declaracionaplicabilidad2022.tabla-edit', compact('control'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */

     public function updateTabla(Request $request, $control)
     {
        dd($request);
         $request->validate([
             'anexo_politica' => 'required',
             'anexo_descripcion' => 'required',
         ]);

         $control = GapDosCatalogoIso::find($control);
         $control->update([
             'anexo_politica' => $request->anexo_politica,
             'anexo_descripcion' => $request->anexo_descripcion,
         ]);

         return redirect()->route('admin.declaracion-aplicabilidad.tabla')->with('success', 'Declaración de aplicabilidad actualizada con éxito');
     }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
