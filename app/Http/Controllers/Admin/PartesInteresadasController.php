<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPartesInteresadaRequest;
use App\Models\Clausula;
use App\Models\ParteInteresadaExpectativaNecesidad;
use App\Models\PartesInteresada;
use App\Models\Team;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PartesInteresadasController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('partes_interesadas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PartesInteresada::with('clausulas', 'expectativasNecesidadesWithNormas')->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'partes_interesadas_ver';
                $editGate = 'partes_interesadas_editar';
                $deleteGate = 'partes_interesadas_eliminar';
                $crudRoutePart = 'partes-interesadas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('expectativas', function ($row) {
                return $row->expectativasNecesidadesWithNormas ? $row->expectativasNecesidadesWithNormas : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.partesInteresadas.index', compact('teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('partes_interesadas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $clausulas = Clausula::get();

        return view('admin.partesInteresadas.create', compact('clausulas'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('partes_interesadas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'parteinteresada' => ['required'],
        ]);

        $partes = PartesInteresada::create($request->all());
        if (array_key_exists('ajax', $request->all())) {
            return response()->json(['success' => true, 'activo' => $partes]);
        }

        return redirect()->route('admin.partes-interesadas.edit', ['id' => $partes]);
    }

    public function edit(Request $request, $id)
    {
        abort_if(Gate::denies('partes_interesadas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $partesInteresada = PartesInteresada::find($id);
        $clausulas = Clausula::get();
        $partesInteresada->load('team');

        return view('admin.partesInteresadas.edit', ['id' => $partesInteresada], compact('partesInteresada', 'clausulas'));
    }

    public function update(Request $request, $partesInteresada)
    {
        abort_if(Gate::denies('partes_interesadas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'parteinteresada' => ['required'],
        ]);

        $partesInteresada = PartesInteresada::find($partesInteresada);
        $partesInteresada->update($request->all());
        $clausulas = Clausula::get();

        return redirect()->route('admin.partes-interesadas.index')->with('success', 'Editado con éxito');
    }

    public function show(PartesInteresada $partesInteresada)
    {
        abort_if(Gate::denies('partes_interesadas_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partesInteresada->load('clausulas');

        $requisitos = ParteInteresadaExpectativaNecesidad::with('normas')->where('id_interesada', '=', $partesInteresada->id)->get();
        $result = ParteInteresadaExpectativaNecesidad::where('id_interesada', '=', $partesInteresada->id)->exists();

        return view('admin.partesInteresadas.show', compact('partesInteresada', 'requisitos', 'result'));
    }

    public function destroy(PartesInteresada $partesInteresada)
    {
        abort_if(Gate::denies('partes_interesadas_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partesInteresada->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyPartesInteresadaRequest $request)
    {
        PartesInteresada::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
