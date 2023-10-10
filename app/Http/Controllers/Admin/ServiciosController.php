<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MatrizOctaveServicio;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiciosController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MatrizOctaveServicio::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_riesgos_vulnerabilidades_edit';
                $editGate = 'analisis_de_riesgos_vulnerabilidades_show';
                $deleteGate = 'analisis_de_riesgos_vulnerabilidades_delete';
                $crudRoutePart = 'carta-aceptacion';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('servicio', function ($row) {
                return $row->servicio ? $row->servicio : '';
            });

            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.servicios.index');
    }

    public function create(Request $request)
    {
        return view('admin.servicios.create');
    }

    public function store(Request $request)
    {
        $servicios = MatrizOctaveServicio::create([
            'servicio' => $request->servicio,
            'descripcion' => $request->descripcion,

        ]);

        return redirect(route('admin.servicios.index'));
    }

    public function update(Request $request, MatrizOctaveServicio $servicios)
    {
        $servicios->update($request->all());
        // $cartaAceptacion = CartaAceptacion::create($request->all());

        return redirect(route('admin.servicios.index'));
    }

    public function edit($servicios)
    {
        return view('admin.servicios.edit');
    }
}
