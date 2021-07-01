<?php


namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Team;
use App\Models\Grupo;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreGrupoRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGrupoAreaRequest;



class GrupoAreaController extends Controller
{
     use CsvImportTrait;

     public function index(Request $request)
     {

        abort_if(Gate::denies('grupoarea_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Grupo::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'grupoarea_show';
                $editGate      = 'grupoarea_edit';
                $deleteGate    = 'grupoarea_delete';
                $crudRoutePart = 'grupoarea';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : "";
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

         return view ('admin.grupoarea.index', compact('teams'));
     }

    public function create()
    {
        abort_if(Gate::denies('grupoarea_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.grupoarea.create');
    }

    public function store(Request $request)
    {


        $request->validate(
            [
                'nombre' => 'required|string',
                'descripcion' => 'required|string'
            ],
        );

        $grupoarea = Grupo::create($request->all());
        Flash::success('<h5 class="text-center">Grupo agregado satisfactoriamente</h5>');
        return redirect()->route('admin.grupoarea.index');
    }

    public function show(Grupo $grupoarea)
    {
        abort_if(Gate::denies('grupoarea_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoarea->load('team');

        return view('admin.grupoarea.show', compact('grupoarea'));
    }

    public function edit(Grupo $grupoarea)
    {
        abort_if(Gate::denies('grupoarea_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoarea->load('team');

        return view('admin.grupoarea.edit', compact('grupoarea'));
    }

    public function update(Request $request, Grupo $grupoarea)
    {
        $request->validate(
            [
                'nombre' => 'required|string',
                'descripcion' => 'required|string'
            ],
        );
        $grupoarea->update($request->all());
        Flash::success('<h5 class="text-center">Grupo actualizado satisfactoriamente</h5>');
        return redirect()->route('admin.grupoarea.index');
    }



    public function destroy(GrupoArea $grupoarea)
    {
        abort_if(Gate::denies('grupoarea_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoarea->delete();

        return back();
    }

    public function massDestroy(MassDestroyGrupoAreaRequest $request)
    {
        Grupo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
