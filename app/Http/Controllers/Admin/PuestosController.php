<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPuestoRequest;
use App\Http\Requests\StorePuestoRequest;
use App\Http\Requests\UpdatePuestoRequest;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Language;
use App\Models\Puesto;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PuestosController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('puesto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Puesto::with(['team'])->select(sprintf('%s.*', (new Puesto)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'puesto_show';
                $editGate = 'puesto_edit';
                $deleteGate = 'puesto_delete';
                $crudRoutePart = 'puestos';

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
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? html_entity_decode(strip_tags($row->descripcion), ENT_QUOTES, 'UTF-8') : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.puestos.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('puesto_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $json = '[{
                    "abr":"zh",
                    "idioma":"Chinese"
                },
                {
                    "abr":"en",
                    "idioma":"English"
                },
                {
                    "abr":"fr",
                    "idioma":"French"
                },
                {
                    "abr":"id",
                    "idioma":"Indonesian"
                },
                {
                    "abr":"it",
                    "idioma":"Italian"
                },
                {
                    "abr":"ja",
                    "idioma":"Japanese"
                },
                {
                    "abr":"pt",
                    "idioma":"Portuguese"
                },
                {
                    "abr":"es",
                    "idioma":"Spanish; Castilian"
                }]
        ';

        $lenguajes = (json_decode($json));

        // dd($lenguajes);

        /*
        $lenguajes = [
            1=>{
                "abr" => "zh",
                "idioma"=>"Chinese",
            },
            2=>[
                "abr" => "en",
                "idioma"=>"English",
            ],
            3=>[
                "abr" => "fr",
                "idioma"=>"French",

            ],
            4=>[
                "abr" => "id",
                "idioma"=>"Indonesian",
            ],
            5=>[
                "abr" => "it",
                "idioma"=>"Italian",
            ],
            6=>[
                "abr" => "ja",
                "idioma"=>"Japanese",
            ],
            7=>[
                "abr" => "pt",
                "idioma"=>"Portuguese",
            ],

            8=>[
                "abr" => "es",
                "idioma"=>"Spanish; Castilian",
            ],
        ];
        */
        // dd($lenguajes);
        $areas = Area::get();
        $reportas = Empleado::get();
        $idis = Language::all();
        // dd($idis);

        return view('admin.puestos.create', compact('areas', 'reportas', 'lenguajes', 'idis'));
    }

    public function store(StorePuestoRequest $request)
    {
        $puesto = Puesto::create($request->all());

        return redirect()->route('admin.puestos.index');
    }

    public function edit(Puesto $puesto)
    {
        abort_if(Gate::denies('puesto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $json = '[{
                    "abr":"zh",
                    "idioma":"Chinese"
                },
                {
                    "abr":"en",
                    "idioma":"English"
                },
                {
                    "abr":"fr",
                    "idioma":"French"
                },
                {
                    "abr":"id",
                    "idioma":"Indonesian"
                },
                {
                    "abr":"it",
                    "idioma":"Italian"
                },
                {
                    "abr":"ja",
                    "idioma":"Japanese"
                },
                {
                    "abr":"pt",
                    "idioma":"Portuguese"
                },
                {
                    "abr":"es",
                    "idioma":"Spanish; Castilian"
                }]
        ';

        $lenguajes = (json_decode($json));
        $areas = Area::get();
        $reportas = Empleado::get();
        $puesto->load('team');

        return view('admin.puestos.edit', compact('puesto', 'areas', 'reportas', 'lenguajes'));
    }

    public function update(UpdatePuestoRequest $request, Puesto $puesto)
    {
        $puesto->update($request->all());

        return redirect()->route('admin.puestos.index');
    }

    public function show(Puesto $puesto)
    {
        abort_if(Gate::denies('puesto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->load('team');

        return view('admin.puestos.show', compact('puesto'));
    }

    public function destroy(Puesto $puesto)
    {
        abort_if(Gate::denies('puesto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->delete();

        return back();
    }

    public function massDestroy(MassDestroyPuestoRequest $request)
    {
        Puesto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
