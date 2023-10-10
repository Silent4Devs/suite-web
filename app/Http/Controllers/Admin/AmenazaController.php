<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\CreateAmenazaRequest;
use App\Http\Requests\UpdateAmenazaRequest;
use App\Models\Amenaza;
use App\Repositories\AmenazaRepository;
use App\Traits\ObtenerOrganizacion;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class AmenazaController extends AppBaseController
{
    use CsvImportTrait;
    use ObtenerOrganizacion;

    /** @var AmenazaRepository */
    private $amenazaRepository;

    public function __construct(AmenazaRepository $amenazaRepo)
    {
        $this->amenazaRepository = $amenazaRepo;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('amenazas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Amenaza::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'amenazas';

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
            $table->editColumn('categoria', function ($row) {
                return $row->categoria ? $row->categoria : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.amenazas.index', compact('logo_actual', 'empresa_actual'));
    }

    /**
     * Show the form for creating a new Amenaza.
     *
     * @return Response
     */
    public function create()
    {
        abort_if(Gate::denies('amenazas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $amenaza = new Amenaza();

        return view('admin.amenazas.create', compact('amenaza'));
    }

    /**
     * Store a newly created Amenaza in storage.
     *
     *
     * @return Response
     */
    public function store(CreateAmenazaRequest $request)
    {
        abort_if(Gate::denies('amenazas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $input = $request->all();

        $amenaza = $this->amenazaRepository->create($input);

        Flash::success('Amenaza añadida satisfactoriamente.');

        return redirect(route('admin.amenazas.index'));
    }

    public function show(Amenaza $amenaza)
    {
        abort_if(Gate::denies('amenazas_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.amenazas.show')->with('amenaza', $amenaza);
    }

    public function edit($id)
    {
        abort_if(Gate::denies('amenazas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $amenaza = $this->amenazaRepository->find($id);

        if (empty($amenaza)) {
            Flash::error('Amenaza not found');

            return redirect(route('admin.amenazas.index'));
        }

        return view('admin.amenazas.edit')->with('amenaza', $amenaza);
    }

    public function update($id, UpdateAmenazaRequest $request)
    {
        abort_if(Gate::denies('amenazas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $amenaza = $this->amenazaRepository->find($id);

        if (empty($amenaza)) {
            Flash::error('Amenaza not found');

            return redirect(route('amenazas.index'));
        }

        $amenaza = $this->amenazaRepository->update($request->all(), $id);

        Flash::success('Amenaza actualizada.');

        return redirect(route('admin.amenazas.index'));
    }

    /**
     * Remove the specified Amenaza from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('amenazas_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $amenaza = $this->amenazaRepository->find($id);

        if (empty($amenaza)) {
            Flash::error('Amenaza not found');

            return redirect(route('amenazas.index'));
        }

        $this->amenazaRepository->delete($id);

        Flash::success('Amenaza eliminada satisfactoriamente.');

        return redirect(route('admin.amenazas.index'));
    }

    public function massDestroy(Request $request)
    {
        Amenaza::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
