<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateVulnerabilidadRequest;
use App\Http\Requests\UpdateVulnerabilidadRequest;
use App\Models\Amenaza;
use App\Models\Vulnerabilidad;
use App\Repositories\VulnerabilidadRepository;
use App\Traits\ObtenerOrganizacion;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class VulnerabilidadController extends AppBaseController
{
    use ObtenerOrganizacion;

    /** @var VulnerabilidadRepository */
    private $vulnerabilidadRepository;

    public function __construct(VulnerabilidadRepository $vulnerabilidadRepo)
    {
        $this->vulnerabilidadRepository = $vulnerabilidadRepo;
    }

    /**
     * Display a listing of the Vulnerabilidad.
     *
     *
     * @return Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('vulnerabilidades_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Vulnerabilidad::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'vulnerabilidades_ver';
                $editGate = 'vulnerabilidades_editar';
                $deleteGate = 'vulnerabilidades_eliminar';
                $crudRoutePart = 'vulnerabilidads';

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
            $table->editColumn('amenaza', function ($row) {
                return $row->idAmenaza ? $row->idAmenaza->nombre : '';
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

        return view('admin.vulnerabilidads.index', compact('logo_actual', 'empresa_actual'));
    }

    /**
     * Show the form for creating a new Vulnerabilidad.
     *
     * @return Response
     */
    public function create()
    {
        abort_if(Gate::denies('vulnerabilidades_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $amenazas = Amenaza::get();

        return view('admin.vulnerabilidads.create', compact('amenazas'));
    }

    public function store(CreateVulnerabilidadRequest $request)
    {
        abort_if(Gate::denies('vulnerabilidades_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $input = $request->all();

        $vulnerabilidad = $this->vulnerabilidadRepository->create($input);

        Flash::success('Vulnerabilidad añadida satistactoriamente.');

        return redirect(route('admin.vulnerabilidads.index'));
    }

    public function show(Request $request, $id)
    {
        abort_if(Gate::denies('vulnerabilidades_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vulnerabilidad = Vulnerabilidad::with('idAmenaza')->find($id);
        // dd($vulnerabilidad);
        return view('admin.vulnerabilidads.show')->with('vulnerabilidad', $vulnerabilidad);
    }

    public function edit($id)
    {
        abort_if(Gate::denies('vulnerabilidades_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vulnerabilidad = $this->vulnerabilidadRepository->find($id);

        if (empty($vulnerabilidad)) {
            Flash::error('Vulnerabilidad not found');

            return redirect(route('vulnerabilidads.index'));
        }

        $amenazas = Amenaza::get();

        return view('admin.vulnerabilidads.edit', compact('amenazas'))->with('vulnerabilidad', $vulnerabilidad);
    }

    public function update($id, UpdateVulnerabilidadRequest $request)
    {
        abort_if(Gate::denies('vulnerabilidades_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vulnerabilidad = $this->vulnerabilidadRepository->find($id);

        if (empty($vulnerabilidad)) {
            Flash::error('Vulnerabilidad not found');

            return redirect(route('admin.vulnerabilidads.index'));
        }

        $vulnerabilidad = $this->vulnerabilidadRepository->update($request->all(), $id);

        Flash::success('Vulnerabilidad actualizada satistactoriamente.');

        return redirect(route('admin.vulnerabilidads.index'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('vulnerabilidades_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vulnerabilidad = $this->vulnerabilidadRepository->find($id);

        if (empty($vulnerabilidad)) {
            Flash::error('Vulnerabilidad not found');

            return redirect(route('admin.vulnerabilidads.index'));
        }

        $this->vulnerabilidadRepository->delete($id);

        Flash::success('Vulnerabilidad eliminada satistactoriamente.');

        return redirect(route('admin.vulnerabilidads.index'));
    }
}
