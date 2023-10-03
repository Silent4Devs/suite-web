<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPuestoRequest;
use App\Http\Requests\StorePuestoRequest;
use App\Http\Requests\UpdatePuestoRequest;
use App\Models\Area;
use App\Models\ContactosExternosPuestos;
use App\Models\Empleado;
use App\Models\HerramientasPuestos;
use App\Models\Language;
use App\Models\PerfilEmpleado;
use App\Models\Puesto;
use App\Models\PuestoContactos;
use App\Models\PuestoIdiomaPorcentajePivot;
use App\Models\PuestoResponsabilidade;
use App\Models\PuestosCertificado;
use App\Models\RH\Competencia;
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
        abort_if(Gate::denies('lista_de_perfiles_de_puesto_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Puesto::with(['area'])->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'puestos_ver';
                $editGate = 'puestos_editar';
                $deleteGate = 'puestos_eliminar';
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
                return $row->id ? $row->id : 'n/a';
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : 'n/a';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? html_entity_decode(strip_tags($row->descripcion), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area->area : 'n/a';
            });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        //$teams = Team::get();
        $areas = Area::getAll();

        return view('admin.puestos.index', compact('teams', 'areas'));
    }

    public function create()
    {
        abort_if(Gate::denies('puestos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        $areas = Area::getAll();
        $reportas = Empleado::getaltaAll();
        $idis = Language::all();
        $competencias = Competencia::getAll();
        $responsabilidades = PuestoResponsabilidade::get();
        $certificados = PuestosCertificado::get();
        $herramientas = HerramientasPuestos::get();
        $contactos = PuestoContactos::get();
        $puesto = Puesto::getAll();
        $empleados = Empleado::getaltaAll();
        $perfiles = PerfilEmpleado::all();
        $puestos = Puesto::getAll();
        $externos = ContactosExternosPuestos::all();
        // dd($idis);

        return view('admin.puestos.create', compact('externos', 'areas', 'reportas', 'lenguajes', 'idis', 'competencias', 'responsabilidades', 'certificados', 'puesto', 'herramientas', 'contactos', 'empleados', 'perfiles'));
    }

    public function store(StorePuestoRequest $request)
    {
        abort_if(Gate::denies('puestos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'puesto' => 'required|unique:puestos,puesto',
        ]);
        $puesto = Puesto::create($request->all());
        if (array_key_exists('ajax', $request->all())) {
            return response()->json(['success' => true, 'puesto' => $puesto]);
        }
        // $this->saveOrUpdateLanguage($request->idiomas, $puesto);
        // $this->saveOrUpdateLanguage($request, $puesto);
        $this->saveUpdateResponsabilidades($request->responsabilidades, $puesto);
        $this->saveUpdateCertificados($request->certificados, $puesto);
        $this->saveUpdateHerramientas($request->herramientas, $puesto);
        $this->saveUpdateContactos($request->contactos, $puesto);
        $this->saveUpdateContactosExternos($request->externos, $puesto);
        $this->saveOrUpdateLanguage($request->id_language, $puesto);

        return redirect()->route('admin.puestos.index');
    }

    public function edit(Puesto $puesto)
    {
        abort_if(Gate::denies('puestos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        // $this->saveOrUpdateSchedule($request, $puesto);
        $lenguajes = (json_decode($json));
        $areas = Area::getAll();
        $reportas = Empleado::getaltaAll();
        $puesto->load(['contactos' => function ($query) {
            $query->with(['puesto' => function ($query) {
                $query->with('area');
            }]);
        }]);
        $contactosEdit = $puesto->contactos;
        // dd($puesto);
        $reportaras = Puesto::getAll();
        $competencias = Competencia::getAll();
        $idis = Language::all();
        $responsabilidades = PuestoResponsabilidade::get();
        // dd($puesto);
        $certificados = PuestosCertificado::get();
        $herramientas = HerramientasPuestos::get();
        $contactos = PuestoContactos::get();
        $empleados = Empleado::getaltaAll();
        $language = PuestoIdiomaPorcentajePivot::get();
        $puestos = Puesto::getAll();
        $externos = ContactosExternosPuestos::all();

        return view('admin.puestos.edit', compact('reportaras', 'externos', 'contactosEdit', 'puesto', 'areas', 'reportas', 'lenguajes', 'competencias', 'idis', 'responsabilidades', 'certificados', 'herramientas', 'contactos', 'empleados', 'language', 'puestos'));
    }

    public function update(UpdatePuestoRequest $request, Puesto $puesto)
    {
        abort_if(Gate::denies('puestos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $puesto->update($request->all());
        $request->validate([
            'puesto' => 'required|unique:puestos,puesto,' . $puesto->id,
        ]);
        // $this->saveUpdateResponsabilidades($request->responsabilidades, $puesto);
        // $this->saveOrUpdateLanguage($request, $puesto);
        $this->saveUpdateResponsabilidades($request->responsabilidades, $puesto);

        $this->saveUpdateCertificados($request->certificados, $puesto);
        $this->saveUpdateHerramientas($request->herramientas, $puesto);
        $this->saveUpdateContactos($request->contactos, $puesto);
        $this->saveUpdateContactosExternos($request->externos, $puesto);
        $this->saveOrUpdateLanguage($request->id_language, $puesto);

        return redirect()->route('admin.puestos.index');
    }

    public function show(Puesto $puesto)
    {
        abort_if(Gate::denies('puestos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->load('team');
        // $empleados = Empleado::with('area')->get();
        // $idiomas = PuestoIdiomaPorcentajePivot::get();
        $competencias = Competencia::getAll();
        $responsabilidades = PuestoResponsabilidade::get();
        $certificados = PuestosCertificado::get();
        $idiomas = PuestoIdiomaPorcentajePivot::where('id_puesto', '=', $puesto->id)->get();
        $herramientas = HerramientasPuestos::get();
        $contactos = PuestoContactos::get();
        $empleados = Empleado::getaltaAll();
        $areas = Area::getAll();

        return view('admin.puestos.show', compact('puesto', 'idiomas', 'competencias', 'responsabilidades', 'certificados', 'idiomas', 'herramientas', 'contactos', 'empleados', 'areas'));
    }

    public function destroy(Puesto $puesto)
    {
        abort_if(Gate::denies('puestos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->delete();

        return back();
    }

    public function massDestroy(MassDestroyPuestoRequest $request)
    {
        Puesto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function consultaPuestos(Request $request)
    {
        abort_if(Gate::denies('consulta_perfiles_de_puesto_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.puestos.consultapuestos');
    }

    public function saveOrUpdateLanguage($languajes, $puesto)
    {
        if (!is_null($languajes)) {
            foreach ($languajes as $languaje) {
                // dd($languaje);
                // dd(PuestoResponsabilidade::exists($languaje['id']));
                if (PuestoIdiomaPorcentajePivot::find($languaje['id']) != null) {
                    PuestoIdiomaPorcentajePivot::find($languaje['id'])->update([
                        'id_language' => $languaje['language'],
                        'porcentaje' => $languaje['porcentaje'],
                        'nivel' => $languaje['nivel'],
                        'id_puesto' => $puesto->id,
                    ]);
                } else {
                    PuestoIdiomaPorcentajePivot::create([
                        'id_puesto' => $puesto->id,
                        'porcentaje' => $languaje['porcentaje'],
                        'nivel' => $languaje['nivel'],
                        'id_language' => $languaje['language'],
                    ]);
                }
            }
        }
    }

    public function deleteLanguage(Request $request)
    {
        $language = $request->lenguajeId;
        // dd($language);
        $languageModel = PuestoIdiomaPorcentajePivot::find($language);
        // dd($languageModel);
        $languageModel->delete();

        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }

    public function saveUpdateResponsabilidades($responsabilidades, $puesto)
    {
        if (!is_null($responsabilidades)) {
            foreach ($responsabilidades as $responsabilidad) {
                // dd($responsabilidad);
                // dd(PuestoResponsabilidade::exists($responsabilidad['id']));
                if (PuestoResponsabilidade::find($responsabilidad['id']) != null) {
                    PuestoResponsabilidade::find($responsabilidad['id'])->update([
                        'tiempo_asignado' => $responsabilidad['tiempo_asignado'],
                        'indicador' => $responsabilidad['indicador'],
                        'resultado' => $responsabilidad['resultado'],
                        'actividad' => $responsabilidad['actividad'],
                    ]);
                } else {
                    PuestoResponsabilidade::create([
                        'puesto_id' => $puesto->id,
                        'tiempo_asignado' => $responsabilidad['tiempo_asignado'],
                        'indicador' => $responsabilidad['indicador'],
                        'resultado' => $responsabilidad['resultado'],
                        'actividad' => $responsabilidad['actividad'],
                    ]);
                }
            }
        }
        // dd($responsabilidades);
    }

    public function deleteResponsabilidades(Request $request, $responsabilidades)
    {
        $responsabilidades = PuestoResponsabilidade::find($responsabilidades);
        $responsabilidades->delete();

        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }

    public function saveUpdateCertificados($certificados, $puesto)
    {
        if (!is_null($certificados)) {
            foreach ($certificados as $certificado) {
                // dd(PuestoResponsabilidade::exists($responsabilidad['id']));
                if (PuestosCertificado::find($certificado['id']) != null) {
                    PuestosCertificado::find($certificado['id'])->update([
                        'nombre' => $certificado['nombre'],
                        'requisito' => $certificado['requisito'],
                    ]);
                } else {
                    PuestosCertificado::create([
                        'puesto_id' => $puesto->id,
                        'nombre' => $certificado['nombre'],
                        'requisito' => $certificado['requisito'],
                    ]);
                }
            }
        }
        // dd($responsabilidades);
    }

    public function deleteCertificados(Request $request, $certificados)
    {
        $certificados = PuestosCertificado::find($certificados);
        $certificados->delete();

        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }

    public function saveUpdateHerramientas($herramientas, $puesto)
    {
        if (!is_null($herramientas)) {
            foreach ($herramientas as $herramienta) {
                // dd(PuestoResponsabilidade::exists($responsabilidad['id']));
                if (HerramientasPuestos::find($herramienta['id']) != null) {
                    HerramientasPuestos::find($herramienta['id'])->update([
                        'nombre_herramienta' => $herramienta['nombre_herramienta'],
                        'descripcion_herramienta' => $herramienta['descripcion_herramienta'],
                    ]);
                } else {
                    HerramientasPuestos::create([
                        'puesto_id' => $puesto->id,
                        'nombre_herramienta' => $herramienta['nombre_herramienta'],
                        'descripcion_herramienta' => $herramienta['descripcion_herramienta'],
                    ]);
                }
            }
        }
        // dd($responsabilidades);
    }

    public function deleteHerramientas(Request $request, $herramientas)
    {
        $herramientas = HerramientasPuestos::find($herramientas);
        $herramientas->delete();

        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }

    public function saveUpdateContactos($contactos, $puesto)
    {
        if (!is_null($contactos)) {
            foreach ($contactos as $contacto) {
                // dd(PuestoResponsabilidade::exists($responsabilidad['id']));
                if (PuestoContactos::find($contacto['id']) != null) {
                    PuestoContactos::find($contacto['id'])->update([
                        'contacto_puesto_id' => $contacto['contacto_puesto_id'],
                        'descripcion_contacto' => $contacto['descripcion_contacto'],
                    ]);
                } else {
                    PuestoContactos::create([
                        'puesto_id' => $puesto->id,
                        'contacto_puesto_id' => $contacto['contacto_puesto_id'],
                        'descripcion_contacto' => $contacto['descripcion_contacto'],
                    ]);
                }
            }
        }
        // dd($contactos);
    }

    public function deleteContactos(Request $request, $contactos)
    {
        $contactos = PuestoContactos::find($contactos);
        $contactos->delete();

        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }

    public function saveUpdateContactosExternos($externos, $puesto)
    {
        if (!is_null($externos)) {
            foreach ($externos as $externo) {
                // dd(PuestoResponsabilidade::exists($responsabilidad['id']));
                if (ContactosExternosPuestos::find($externo['id']) != null) {
                    ContactosExternosPuestos::find($externo['id'])->update([
                        'nombre_contacto_int' => $externo['nombre_contacto_int'],
                        'proposito' => $externo['proposito'],
                    ]);
                } else {
                    ContactosExternosPuestos::create([
                        'puesto_id' => $puesto->id,
                        'nombre_contacto_int' => $externo['nombre_contacto_int'],
                        'proposito' => $externo['proposito'],
                    ]);
                }
            }
        }
        // dd($responsabilidades);
    }
}
