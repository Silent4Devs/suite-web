<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateVulnerabilidadRequest;
use App\Http\Requests\UpdateVulnerabilidadRequest;
use App\Models\Amenaza;
use App\Models\Vulnerabilidad;
use App\Repositories\VulnerabilidadRepository;
use Flash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VulnerabilidadController extends AppBaseController
{
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
        if ($request->ajax()) {
            $query = Vulnerabilidad::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
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

        return view('frontend.vulnerabilidads.index');
    }

    /**
     * Show the form for creating a new Vulnerabilidad.
     *
     * @return Response
     */
    public function create()
    {
        $amenazas = Amenaza::get();

        return view('frontend.vulnerabilidads.create', compact('amenazas'));
    }

    /**
     * Store a newly created Vulnerabilidad in storage.
     *
     *
     * @return Response
     */
    public function store(CreateVulnerabilidadRequest $request)
    {
        $input = $request->all();

        $vulnerabilidad = $this->vulnerabilidadRepository->create($input);

        Flash::success('Vulnerabilidad añadida satistactoriamente.');

        return redirect(route('vulnerabilidads.index'));
    }

    /**
     * Display the specified Vulnerabilidad.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $vulnerabilidad = $this->vulnerabilidadRepository->find($id);

        if (empty($vulnerabilidad)) {
            Flash::error('Vulnerabilidad not found');

            return redirect(route('vulnerabilidads.index'));
        }

        return view('frontend.vulnerabilidads.show')->with('vulnerabilidad', $vulnerabilidad);
    }

    /**
     * Show the form for editing the specified Vulnerabilidad.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $vulnerabilidad = $this->vulnerabilidadRepository->find($id);

        if (empty($vulnerabilidad)) {
            Flash::error('Vulnerabilidad not found');

            return redirect(route('vulnerabilidads.index'));
        }

        $amenazas = Amenaza::get();

        return view('frontend.vulnerabilidads.edit', compact('amenazas'))->with('vulnerabilidad', $vulnerabilidad);
    }

    /**
     * Update the specified Vulnerabilidad in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateVulnerabilidadRequest $request)
    {
        $vulnerabilidad = $this->vulnerabilidadRepository->find($id);

        if (empty($vulnerabilidad)) {
            Flash::error('Vulnerabilidad not found');

            return redirect(route('vulnerabilidads.index'));
        }

        $vulnerabilidad = $this->vulnerabilidadRepository->update($request->all(), $id);

        Flash::success('Vulnerabilidad actualizada satistactoriamente.');

        return redirect(route('vulnerabilidads.index'));
    }

    /**
     * Remove the specified Vulnerabilidad from storage.
     *
     * @param  int  $id
     * @return Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vulnerabilidad = $this->vulnerabilidadRepository->find($id);

        if (empty($vulnerabilidad)) {
            Flash::error('Vulnerabilidad not found');

            return redirect(route('vulnerabilidads.index'));
        }

        $this->vulnerabilidadRepository->delete($id);

        Flash::success('Vulnerabilidad eliminada satistactoriamente.');

        return redirect(route('vulnerabilidads.index'));
    }
}
