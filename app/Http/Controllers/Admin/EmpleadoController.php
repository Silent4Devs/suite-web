<?php

namespace App\Http\Controllers\Admin;

use App\Functions\CountriesFunction;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\CertificacionesEmpleados;
use App\Models\CursosDiplomasEmpleados;
use App\Models\EducacionEmpleados;
use App\Models\Empleado;
use App\Models\EvidenciasCertificadosEmpleados;
use App\Models\EvidenciasDocumentosEmpleados;
use App\Models\ExperienciaEmpleados;
use App\Models\PerfilEmpleado;
use App\Models\Puesto;
use App\Models\RH\BeneficiariosEmpleado;
use App\Models\RH\ContactosEmergenciaEmpleado;
use App\Models\RH\DependientesEconomicosEmpleados;
use App\Models\RH\EntidadCrediticia;
use App\Models\RH\TipoContratoEmpleado;
use App\Models\Sede;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('configuracion_empleados_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            // $query = DB::table('empleados')->select(DB::raw('id,
            // name,
            // foto,
            // area,
            // puesto,
            // jefe,
            // antiguedad as "fecha ingreso",
            // if(estatus = 1, "Activo", "Inactivo") as "estado",
            // concat(timestampdiff(year, antiguedad, NOW()), " año con ",
            // FLOOR(( datediff(now(), antiguedad) / 365.25 - FLOOR(datediff(now(), antiguedad) / 365.25)) * 12), " meses y ",
            // DAY(CURDATE()) - DAY(antiguedad) +30 * (DAY(CURDATE()) < DAY(antiguedad)) , " días."
            // ) as antiguedad,
            // email,
            // telefono,
            // n_empleado,
            // estatus,
            // n_registro
            // '))->whereNull('deleted_at')->get();
            $query = Empleado::orderByDesc('id')->get();
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();

            $table->editColumn('actions', function ($row) {
                $viewGate = 'configuracion_empleados_show';
                $editGate = 'configuracion_empleados_edit';
                $deleteGate = 'configuracion_empleados_delete';
                $crudRoutePart = 'empleados';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('avatar', function ($row) {
                return $row->avatar ? $row->avatar : '';
            });

            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area->area : '';
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : '';
            });
            $table->editColumn(
                'jefe',
                function ($row) {
                    return $row->supervisor ? $row->supervisor->name : '';
                }
            );
            $table->editColumn('antiguedad', function ($row) {
                return Carbon::parse(Carbon::parse($row->antiguedad))->diffForHumans(Carbon::now()->subDays());
            });
            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? $row->estatus : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('telefono', function ($row) {
                return $row->telefono ? $row->telefono : '';
            });

            $table->editColumn('n_empleado', function ($row) {
                return $row->n_empleado ? $row->n_empleado : '';
            });

            $table->editColumn('n_registro', function ($row) {
                return $row->n_registro ? $row->n_registro : '';
            });

            $table->editColumn('sede', function ($row) {
                return $row->sede ? $row->sede->sede : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();

        return view('admin.empleados.index', compact('ceo_exists'));
    }

    public function getCertificaciones($empleado)
    {
        $certificaciones = CertificacionesEmpleados::where('empleado_id', intval($empleado))->orderBy('id')->get();

        return datatables()->of($certificaciones)->toJson();
    }

    public function getEducacion($empleado)
    {
        $educacions = EducacionEmpleados::where('empleado_id', intval($empleado))->get();

        return datatables()->of($educacions)->toJson();
    }

    public function getExperiencia($empleado)
    {
        $experiencias = ExperienciaEmpleados::where('empleado_id', intval($empleado))->get();

        return datatables()->of($experiencias)->toJson();
    }

    public function getCursos($empleado)
    {
        $cursos = CursosDiplomasEmpleados::where('empleado_id', intval($empleado))->get();

        return datatables()->of($cursos)->toJson();
    }

    public function create()
    {
        abort_if(Gate::denies('configuracion_empleados_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::get();
        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $areas = Area::get();
        $sedes = Sede::get();
        $experiencias = ExperienciaEmpleados::get();
        $educacions = EducacionEmpleados::get();
        $cursos = CursosDiplomasEmpleados::get();
        $documentos = EvidenciasDocumentosEmpleados::get();
        $certificaciones = CertificacionesEmpleados::get();
        $puestos = Puesto::get();
        $perfiles = PerfilEmpleado::get();
        $perfiles_seleccionado = null;
        $puestos_seleccionado = null;
        $puestos = Puesto::all();
        $perfiles = PerfilEmpleado::all();
        $tipoContratoEmpleado = TipoContratoEmpleado::select('id', 'name', 'slug', 'description')->get();
        $entidadesCrediticias = EntidadCrediticia::select('id', 'entidad')->get();
        $empleado = new Empleado;

        $globalCountries = new CountriesFunction;
        $countries = $globalCountries->getCountries('ES');

        return view('admin.empleados.create', compact('empleados', 'ceo_exists', 'areas', 'sedes', 'experiencias', 'educacions', 'cursos', 'documentos', 'certificaciones', 'puestos', 'perfiles', 'tipoContratoEmpleado', 'entidadesCrediticias', 'empleado', 'countries', 'perfiles', 'perfiles_seleccionado', 'puestos_seleccionado'));
    }

    public function onlyStore($request)
    {
        $experiencias = json_decode($request->experiencia);
        $educacions = json_decode($request->educacion);
        $cursos = json_decode($request->curso);
        $certificados = json_decode($request->certificado);
        // dd($cursos);

        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $validateSupervisor = 'nullable|exists:empleados,id';
        if ($ceo_exists) {
            $validateSupervisor = 'required|exists:empleados,id';
        }

        $request->validate([
            'name' => 'required|string',
            'n_empleado' => 'required|unique:empleados',
            'area_id' => 'required|exists:areas,id',
            'supervisor_id' => $validateSupervisor,
            'puesto_id' => 'required|exists:puestos,id',
            'antiguedad' => 'required',
            'estatus' => 'required',
            'email' => 'required|email',
            // 'sede_id' => 'required|exists:sedes,id',
            'perfil_empleado_id' => 'required|exists:perfil_empleados,id',

        ], [
            'n_empleado.unique' => 'El número de empleado ya ha sido tomado',
        ]);
        $sede = Sede::select('id', 'direccion')->find($request->sede_id);
        if ($sede) {
            $request->query->set('direccion', $sede->direccion);
        }

        $this->validateDynamicForms($request);
        $empleado = $this->createEmpleado($request);
        $image = null;
        if ($request->snap_foto && $request->file('foto')) {
            if ($request->snap_foto) {
                if (preg_match('/^data:image\/(\w+);base64,/', $request->snap_foto)) {
                    $value = substr($request->snap_foto, strpos($request->snap_foto, ',') + 1);
                    $value = base64_decode($value);

                    $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';
                    $image = $new_name_image;
                    $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                    $img_intervention = Image::make($request->snap_foto);
                    $img_intervention->resize(480, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($route);
                }
            }
        } elseif ($request->snap_foto && !$request->file('foto')) {
            if ($request->snap_foto) {
                if (preg_match('/^data:image\/(\w+);base64,/', $request->snap_foto)) {
                    $value = substr($request->snap_foto, strpos($request->snap_foto, ',') + 1);
                    $value = base64_decode($value);

                    $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';
                    $image = $new_name_image;
                    $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                    $img_intervention = Image::make($request->snap_foto);
                    $img_intervention->resize(480, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($route);
                }
            }
        } else {
            if ($request->file('foto') != null or !empty($request->file('foto'))) {
                $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
                $name_image = basename(pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);
                $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.' . $extension;
                $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                $image = $new_name_image;
                //Usamos image_intervention para disminuir el peso de la imagen
                $img_intervention = Image::make($request->file('foto'));
                $img_intervention->resize(480, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($route);
            }
        }

        $empleado->update([
            'foto' => $image,
        ]);

        return $empleado;
    }

    public function containsOnlyNull($collection)
    {
        $onlyNull = true;
        foreach ($collection as $collect) {
            foreach ($collect as $item) {
                if (!is_null($item)) {
                    $onlyNull = false;

                    return $onlyNull;
                }
            }
        }

        return $onlyNull;
    }

    public function validateDynamicForms($request)
    {
        if (isset($request->dependientes)) {
            if (!$this->containsOnlyNull($request->dependientes)) {
                if (count($request->dependientes)) {
                    $request->validate([
                        'dependientes.*.nombre' => 'required|string',
                        'dependientes.*.parentesco' => 'required|string',
                    ]);
                }
            }
        }

        if (isset($request->contactos_emergencia)) {
            if (!$this->containsOnlyNull($request->contactos_emergencia)) {
                if (count($request->contactos_emergencia)) {
                    $request->validate([
                        'contactos_emergencia.*.nombre' => 'required|string|max:255',
                        'contactos_emergencia.*.telefono' => 'required|string|max:255',
                        'contactos_emergencia.*.parentesco' => 'required|string|max:255',
                    ]);
                }
            }
        }

        if (isset($request->beneficiarios)) {
            if (!$this->containsOnlyNull($request->beneficiarios)) {
                if (count($request->beneficiarios)) {
                    $request->validate([
                        'beneficiarios.*.nombre' => 'required|string',
                        'beneficiarios.*.parentesco' => 'required|string',
                        'beneficiarios.*.porcentaje' => 'required|numeric',
                    ]);
                }
            }
        }
    }

    public function createEmpleado($request)
    {
        $empleado = Empleado::create([
            'name' => $request->name,
            'area_id' =>  $request->area_id,
            'puesto_id' =>  $request->puesto_id,
            'perfil_empleado_id' => $request->perfil_empleado_id,
            'supervisor_id' =>  $request->supervisor_id,
            'antiguedad' =>  $request->antiguedad,
            'estatus' =>  $request->estatus,
            'email' =>  $request->email,
            'telefono' =>  $request->telefono,
            'genero' =>  $request->genero,
            'n_empleado' =>  $request->n_empleado,
            'n_registro' =>  $request->n_registro,
            'sede_id' =>  $request->sede_id,
            'resumen' =>  $request->resumen,
            'cumpleaños' => $request->cumpleaños,
            'direccion' => $request->direccion,
            'telefono_movil' => $request->telefono_movil,
            'extension' => $request->extension,
            'direccion' => $request->direccion,
            'tipo_contrato_empleados_id' => $request->tipo_contrato_empleados_id,
            'terminacion_contrato' => $request->terminacion_contrato,
            'renovacion_contrato' => $request->renovacion_contrato,
            'esquema_contratacion' => $request->esquema_contratacion,
            'proyecto_asignado' => $request->proyecto_asignado,
            'domicilio_personal' => $request->domicilio_personal,
            'telefono_casa' => $request->telefono_casa,
            'correo_personal' => $request->correo_personal,
            'estado_civil' => $request->estado_civil,
            'NSS' => $request->NSS,
            'CURP' => $request->CURP,
            'RFC' => $request->RFC,
            'lugar_nacimiento' => $request->lugar_nacimiento,
            'nacionalidad' => $request->nacionalidad,
            'entidad_crediticias_id' => $request->entidad_crediticias_id,
            'numero_credito' => $request->numero_credito,
            'descuento' => $request->descuento,
            'banco' => $request->banco,
            'cuenta_bancaria' => $request->cuenta_bancaria,
            'clabe_interbancaria' => $request->clabe_interbancaria,
            'centro_costos' => $request->centro_costos,
            'salario_bruto' => $request->salario_bruto ? preg_replace('/([^0-9\.])/i', '', $request->salario_bruto) : null,
            'salario_diario' => $request->salario_diario ? preg_replace('/([^0-9\.])/i', '', $request->salario_diario) : null,
            'salario_diario_integrado' => $request->salario_diario_integrado ? preg_replace('/([^0-9\.])/i', '', $request->salario_diario_integrado) : null,
            'salario_base_mensual' => $request->salario_base_mensual ? preg_replace('/([^0-9\.])/i', '', $request->salario_base_mensual) : null,
            'pagadora_actual' => $request->pagadora_actual,
            'periodicidad_nomina' => $request->periodicidad_nomina,
        ]);

        $this->assignDependenciesModel($request, $empleado);

        return $empleado;
    }

    public function assignDependenciesModel($request, $empleado)
    {
        if (isset($request->dependientes)) {
            if (!$this->containsOnlyNull($request->dependientes)) {
                if (count($request->dependientes)) {
                    foreach ($request->dependientes as $dependiente) {
                        $dependienteModel = DependientesEconomicosEmpleados::where('id', $dependiente['id']);
                        $dependienteAlreadyExists = $dependienteModel->exists();
                        if ($dependienteAlreadyExists) {
                            $dependienteData = $dependienteModel->first();
                            $dependienteData->update([
                                'nombre' => $dependiente['nombre'],
                                'parentesco' => $dependiente['parentesco'],
                            ]);
                        } else {
                            DependientesEconomicosEmpleados::create([
                                'empleado_id' => $empleado->id,
                                'nombre' => $dependiente['nombre'],
                                'parentesco' => $dependiente['parentesco'],
                            ]);
                        }
                    }
                }
            }
        }
        // dd(isset($request->contactos_emergencia));
        if (isset($request->contactos_emergencia)) {
            if (!$this->containsOnlyNull($request->contactos_emergencia)) {
                if (count($request->contactos_emergencia)) {
                    foreach ($request->contactos_emergencia as $contactos_emergencia) {
                        $model = ContactosEmergenciaEmpleado::where('id', $contactos_emergencia['id']);
                        $registerAlreadyExists = $model->exists();
                        if ($registerAlreadyExists) {
                            $dataModel = $model->first();
                            $dataModel->update([
                                'nombre' => $contactos_emergencia['nombre'],
                                'telefono' => $contactos_emergencia['telefono'],
                                'parentesco' => $contactos_emergencia['parentesco'],
                            ]);
                        } else {
                            ContactosEmergenciaEmpleado::create([
                                'empleado_id' => $empleado->id,
                                'nombre' => $contactos_emergencia['nombre'],
                                'telefono' => $contactos_emergencia['telefono'],
                                'parentesco' => $contactos_emergencia['parentesco'],
                            ]);
                        }
                    }
                }
            }
        }

        if (isset($request->beneficiarios)) {
            if (!$this->containsOnlyNull($request->beneficiarios)) {
                if (count($request->beneficiarios)) {
                    foreach ($request->beneficiarios as $beneficiario) {
                        $model = BeneficiariosEmpleado::where('id', $beneficiario['id']);
                        $registerAlreadyExists = $model->exists();
                        if ($registerAlreadyExists) {
                            $dataModel = $model->first();
                            $dataModel->update([
                                'nombre' => $beneficiario['nombre'],
                                'parentesco' => $beneficiario['parentesco'],
                                'porcentaje' => $beneficiario['porcentaje'],
                            ]);
                        } else {
                            BeneficiariosEmpleado::create([
                                'empleado_id' => $empleado->id,
                                'nombre' => $beneficiario['nombre'],
                                'parentesco' => $beneficiario['parentesco'],
                                'porcentaje' => $beneficiario['porcentaje'],
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function store(Request $request)
    {
        $empleado = $this->onlyStore($request);

        return response()->json(['status' => 'success', 'message' => 'Empleado agregado'], 200);

        // return redirect()->route('admin.empleados.index')->with('success', 'Guardado con éxito');
    }

    public function storeWithCompetencia(Request $request)
    {
        $empleado = $this->onlyStore($request);

        return redirect()->route('admin.empleados.edit', $empleado)->with('success', 'Guardado con éxito');

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/documentos_empleados', $file, $file->getClientOriginalName())) {
                    EvidenciasDocumentosEmpleados::create([
                        'documentos' => $file->getClientOriginalName(),
                        'empleado_id' => $empleado->id,
                    ]);
                }
            }
        }
        // dd($request->hasFile('files'));

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/certificados_empleados', $file, $file->getClientOriginalName())) {
                    EvidenciasCertificadosEmpleados::create([
                        'evidencia' => $file->getClientOriginalName(),
                        'empleado_id' => $empleado->id,
                    ]);
                }
            }
        }
    }

    public function storeResumen(Request $request, $empleado)
    {
        $request->validate([
            'resumen' => 'required|string|max:4000',
        ]);
        if ($request->ajax()) {
            $empleado = Empleado::find(intval($empleado));
            $empleado->update([
                'resumen' => $request->resumen,
            ]);
            if ($empleado) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function storeCertificaciones(Request $request, $empleado)
    {
        if ($request->esVigente == 'true') {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'documento' => 'nullable|mimes:pdf|max:10000',
                'vigencia' => 'required|date|max:255',
                'estatus' => 'required|string|max:255',
            ]);
        } else {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'documento' => 'nullable|mimes:pdf|max:10000',
            ]);
        }
        // dd($request->all());
        if ($request->ajax()) {
            $empleado = Empleado::find(intval($empleado));
            $certificado = CertificacionesEmpleados::create([
                'empleado_id' => $empleado->id,
                'nombre' => $request->nombre,
                'estatus' =>  $request->estatus,
                'vigencia' =>  $request->vigencia,
            ]);
            if ($request->hasFile('documento')) {
                $filenameWithExt = $request->file('documento')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('documento')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->file('documento')->storeAs('public/certificados_empleados', $fileNameToStore);

                $certificado->update([
                    'documento' => $fileNameToStore,
                ]);
            }
            if ($empleado) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function updateCertificaciones(Request $request, CertificacionesEmpleados $certificacion)
    {
        if (isset($request->name)) {
            $request->validate([
                'nombre' => 'required|string|max:255',
            ]);
        }
        if (isset($request->vigencia)) {
            $request->validate([
                'vigencia' => 'required|date',
                'estatus' => 'required|string|max:255',
            ]);
        }
        if (isset($request->documento)) {
            $request->validate([
                'documento' => 'required|mimes:pdf|max:10000',
            ]);
        }

        if ($request->hasFile('documento')) {
            $filenameWithExt = $request->file('documento')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('documento')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('documento')->storeAs('public/certificados_empleados', $fileNameToStore);

            $certificacion->update([
                'documento' => $fileNameToStore,
            ]);
        } else {
            $certificacion->update($request->all());
        }

        return response()->json(['status' => 'success', 'message' => 'Certificado Actualizado']);
    }

    public function deleteFileCertificacion(Request $request, CertificacionesEmpleados $certificacion)
    {
        $certificacion->update([
            'documento' => null,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Certificado Actualizado']);
    }
    // public function deleteDocumento(Request $request,  $certificacion)
    // {
    //     $certificacion->update([
    //         'documento' => null
    //     ]);
    //     return response()->json(['status' => 'success', 'message' => 'Certificado Actualizado']);
    // }

    public function storeCursos(Request $request, $empleado)
    {
        $request->validate([
            'curso_diploma' => 'required|string|max:255',
            'tipo' => 'required',
            'año' => 'required|date',
            'duracion' => 'required',
            'empleado_id' => 'required|exists:empleados,id',
        ]);
        // dd($request->all());
        if ($request->ajax()) {
            $empleado = Empleado::find(intval($empleado));
            $curso = CursosDiplomasEmpleados::create([
                'empleado_id' => $empleado->id,
                'curso_diploma' => $request->curso_diploma,
                'tipo' =>  $request->tipo,
                'año' =>  $request->año,
                'duracion' =>  $request->duracion,
            ]);

            if ($curso) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function updateCurso(Request $request, CursosDiplomasEmpleados $curso)
    {
        if (array_key_exists('curso_diploma', $request->all())) {
            $request->validate([
                'curso_diploma' => 'required|string|max:255',
            ]);
        }

        if (array_key_exists('tipo', $request->all())) {
            $request->validate([
                'tipo' => 'required|string|max:255',
            ]);
        }
        if (array_key_exists('año', $request->all())) {
            $request->validate([
                'año' => 'required|date',
            ]);
        }
        if (array_key_exists('duracion', $request->all())) {
            $request->validate([
                'duracion' => 'required|numeric|min:1',
            ]);
        }

        $curso->update($request->all());

        return response()->json(['status' => 'success', 'message' => 'Curso Actualizado']);
    }

    public function storeExperiencia(Request $request, $empleado)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
            'puesto' => 'required|string|max:255',
            'inicio_mes' => 'required|date',
            'fin_mes' => 'required|date',
            'descripcion' => 'required',
            'empleado_id' => 'required|exists:empleados,id',

        ]);
        // dd($request->all());
        if ($request->ajax()) {
            $empleado = Empleado::find(intval($empleado));
            $experiencia = ExperienciaEmpleados::create([
                'empleado_id' => $empleado->id,
                'empresa' => $request->empresa,
                'puesto' =>  $request->puesto,
                'inicio_mes' =>  $request->inicio_mes,
                'fin_mes' =>  $request->fin_mes,
                'descripcion' =>  $request->descripcion,
            ]);
            if ($experiencia) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function updateExperiencia(Request $request, ExperienciaEmpleados $experiencia)
    {
        if (array_key_exists('empresa', $request->all())) {
            $request->validate([
                'empresa' => 'required|string|max:255',
            ]);
        }

        if (array_key_exists('puesto', $request->all())) {
            $request->validate([
                'puesto' => 'required|string|max:255',
            ]);
        }
        if (array_key_exists('descripcion', $request->all())) {
            $request->validate([
                'descripcion' => 'required|string|max:1500',
            ]);
        }
        if (array_key_exists('inicio_mes', $request->all())) {
            $request->validate([
                'inicio_mes' => 'required|date',
            ]);
        }
        if (array_key_exists('fin_mes', $request->all())) {
            $request->validate([
                'fin_mes' => 'required|date',
            ]);
        }

        $experiencia->update($request->all());

        return response()->json(['status' => 'success', 'message' => 'Registro Actualizado']);
    }

    public function storeEducacion(Request $request, $empleado)
    {
        $request->validate([
            'institucion' => 'required|string|max:255',
            'nivel' => 'required',
            'año_inicio' => 'required|date',
            'año_fin' => 'required|date',
            'empleado_id' => 'required|exists:empleados,id',

        ]);
        // dd($request->all());
        if ($request->ajax()) {
            $empleado = Empleado::find(intval($empleado));
            $educacion = EducacionEmpleados::create([
                'empleado_id' => $empleado->id,
                'institucion' => $request->institucion,
                'nivel' =>  $request->nivel,
                'año_inicio' =>  $request->año_inicio,
                'año_fin' =>  $request->año_fin,
            ]);

            if ($educacion) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function updateEducacion(Request $request, EducacionEmpleados $educacion)
    {
        if (array_key_exists('institucion', $request->all())) {
            $request->validate([
                'institucion' => 'required|string|max:255',
            ]);
        }
        if (array_key_exists('nivel', $request->all())) {
            $request->validate([
                'nivel' => 'required|string|max:1500',
            ]);
        }
        if (array_key_exists('año_inicio', $request->all())) {
            $request->validate([
                'año_inicio' => 'required|date',
            ]);
        }
        if (array_key_exists('año_fin', $request->all())) {
            $request->validate([
                'año_fin' => 'required|date',
            ]);
        }

        $educacion->update($request->all());

        return response()->json(['status' => 'success', 'message' => 'Registro Actualizado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('configuracion_empleados_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleado = Empleado::find(intval($id));
        $empleados = Empleado::get();
        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $areas = Area::get();
        $area = Area::find($empleado->area_id);
        $sedes = Sede::get();
        $sede = Sede::find($empleado->sede_id);
        $experiencias = ExperienciaEmpleados::get();
        $educacions = EducacionEmpleados::get();
        $cursos = CursosDiplomasEmpleados::get();
        $documentos = EvidenciasDocumentosEmpleados::get();
        $puestos = Puesto::all();
        $perfiles = PerfilEmpleado::all();
        $tipoContratoEmpleado = TipoContratoEmpleado::select('id', 'name', 'description', 'slug')->get();
        $entidadesCrediticias = EntidadCrediticia::select('id', 'entidad')->get();
        $puestos = Puesto::get();
        $perfiles = PerfilEmpleado::get();
        $perfiles_seleccionado = $empleado->perfil_empleado_id;
        $puestos_seleccionado = $empleado->puesto_id;

        $globalCountries = new CountriesFunction;
        $countries = $globalCountries->getCountries('ES');
        $isEditAdmin = true;

        return view('admin.empleados.edit', compact('empleado', 'empleados', 'ceo_exists', 'areas', 'area', 'sede', 'sedes', 'experiencias', 'educacions', 'cursos', 'documentos', 'puestos', 'perfiles', 'tipoContratoEmpleado', 'entidadesCrediticias', 'countries', 'perfiles', 'perfiles_seleccionado', 'puestos_seleccionado', 'isEditAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ceo = Empleado::select('id')->whereNull('supervisor_id')->first();
        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $validateSupervisor = 'nullable|exists:empleados,id';

        if ($ceo_exists) {
            if ($ceo->id == intval($id)) {
                $validateSupervisor = 'nullable|exists:empleados,id';
            } else {
                $validateSupervisor = 'required|exists:empleados,id';
            }
        }

        $request->validate([
            'name' => 'required|string',
            'n_empleado' => 'unique:empleados,n_empleado,' . $id,
            'area_id' => 'required|exists:areas,id',
            'supervisor_id' => $validateSupervisor,
            'puesto_id' => 'required|exists:puestos,id',
            'antiguedad' => 'required',
            'estatus' => 'required',
            'email' => 'required|email',
            // 'sede_id' => 'required|exists:sedes,id',
            'perfil_empleado_id' => 'required|exists:perfil_empleados,id',

        ], [
            'n_empleado.unique' => 'El número de empleado ya ha sido tomado',
        ]);

        $this->validateDynamicForms($request);
        $empleado = Empleado::find($id);
        $image = $empleado->foto;
        if ($request->snap_foto && $request->file('foto')) {
            if ($request->snap_foto) {
                if (preg_match('/^data:image\/(\w+);base64,/', $request->snap_foto)) {
                    $value = substr($request->snap_foto, strpos($request->snap_foto, ',') + 1);
                    $value = base64_decode($value);

                    $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';
                    $image = $new_name_image;
                    $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                    $img_intervention = Image::make($request->snap_foto);
                    $img_intervention->resize(480, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($route);
                }
            }
        } elseif (
            $request->snap_foto && !$request->file('foto')
        ) {
            if ($request->snap_foto) {
                if (preg_match('/^data:image\/(\w+);base64,/', $request->snap_foto)) {
                    $value = substr($request->snap_foto, strpos($request->snap_foto, ',') + 1);
                    $value = base64_decode($value);

                    $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';
                    $image = $new_name_image;
                    $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                    $img_intervention = Image::make($request->snap_foto);
                    $img_intervention->resize(480, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($route);
                }
            }
        } else {
            if (
                $request->file('foto') != null or !empty($request->file('foto'))
            ) {
                $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
                $name_image = basename(pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);
                $new_name_image = 'UID_' . $empleado->id . '_' . $request->name . '.' . $extension;
                $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                $image = $new_name_image;
                //Usamos image_intervention para disminuir el peso de la imagen
                $img_intervention = Image::make($request->file('foto'));
                $img_intervention->resize(480, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($route);
            }
        }

        // if ($request->hasFile('files')) {
        //     $files = $request->file('files');
        //     foreach ($files as $file) {
        //         if (Storage::putFileAs('public/documentos_empleados', $file, $file->getClientOriginalName())) {
        //             EvidenciasDocumentosEmpleados::create([
        //                 'documentos' => $file->getClientOriginalName(),
        //                 'empleado_id' => $empleado->id,
        //             ]);
        //         }
        //     }
        // }

        $empleado->update([
            'name' => $request->name,
            'area_id' =>  $request->area_id,
            'puesto_id' =>  $request->puesto_id,
            'perfil_empleado_id' => $request->perfil_empleado_id,
            'supervisor_id' =>  $request->supervisor_id,
            'antiguedad' =>  $request->antiguedad,
            'estatus' =>  $request->estatus,
            'email' =>  $request->email,
            'telefono' =>  $request->telefono,
            'genero' =>  $request->genero,
            'n_empleado' =>  $request->n_empleado,
            'n_registro' =>  $request->n_registro,
            'sede_id' =>  $request->sede_id,
            // 'resumen' =>  $request->resumen,
            'cumpleaños' => $request->cumpleaños,
            'direccion' => $request->direccion,
            'telefono_movil' => $request->telefono_movil,
            'extension' => $request->extension,
            'cumpleaños' => $request->cumpleaños,
            'direccion' => $request->direccion,
            'tipo_contrato_empleados_id' => $request->tipo_contrato_empleados_id,
            'terminacion_contrato' => $request->terminacion_contrato,
            'renovacion_contrato' => $request->renovacion_contrato,
            'esquema_contratacion' => $request->esquema_contratacion,
            'proyecto_asignado' => $request->proyecto_asignado,
            'domicilio_personal' => $request->domicilio_personal,
            'telefono_casa' => $request->telefono_casa,
            'correo_personal' => $request->correo_personal,
            'estado_civil' => $request->estado_civil,
            'NSS' => $request->NSS,
            'CURP' => $request->CURP,
            'RFC' => $request->RFC,
            'lugar_nacimiento' => $request->lugar_nacimiento,
            'nacionalidad' => $request->nacionalidad,
            'entidad_crediticias_id' => $request->entidad_crediticias_id,
            'numero_credito' => $request->numero_credito,
            'descuento' => $request->descuento,
            'banco' => $request->banco,
            'cuenta_bancaria' => $request->cuenta_bancaria,
            'clabe_interbancaria' => $request->clabe_interbancaria,
            'centro_costos' => $request->centro_costos,
            'salario_bruto' => $request->salario_bruto ? preg_replace('/([^0-9\.])/i', '', $request->salario_bruto) : null,
            'salario_diario' => $request->salario_diario ? preg_replace('/([^0-9\.])/i', '', $request->salario_diario) : null,
            'salario_diario_integrado' => $request->salario_diario_integrado ? preg_replace('/([^0-9\.])/i', '', $request->salario_diario_integrado) : null,
            'salario_base_mensual' => $request->salario_base_mensual ? preg_replace('/([^0-9\.])/i', '', $request->salario_base_mensual) : null,
            'pagadora_actual' => $request->pagadora_actual,
            'periodicidad_nomina' => $request->periodicidad_nomina,
        ]);

        $this->assignDependenciesModel($request, $empleado);

        return response()->json(['status' => 'success', 'message' => 'Empleado Actualizado', 'from' => 'rh'], 200);
        // return redirect()->route('admin.empleados.index')->with('success', 'Editado con éxito');
    }

    public function updateFromCurriculum(Request $request, Empleado $empleado)
    {
        $request->validate([
            'files.*' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:10000',
        ]);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/documentos_empleados', $file, $file->getClientOriginalName())) {
                    EvidenciasDocumentosEmpleados::create([
                        'documentos' => $file->getClientOriginalName(),
                        'empleado_id' => $empleado->id,
                    ]);
                }
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Curriculum Actualizado', 'from' => 'curriculum'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        abort_if(Gate::denies('configuracion_empleados_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleado->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function deleteCertificaciones(Request $request, $certificacion)
    {
        if ($request->ajax()) {
            $certificacion = CertificacionesEmpleados::find(intval($certificacion));
            $u_certificacion = $certificacion->delete();
            if ($u_certificacion) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function deleteCursos(Request $request, $curso)
    {
        if ($request->ajax()) {
            $curso = CursosDiplomasEmpleados::find(intval($curso));
            $u_curso = $curso->delete();
            if ($u_curso) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function deleteEducacion(Request $request, $educacion)
    {
        if ($request->ajax()) {
            $educacion = EducacionEmpleados::find(intval($educacion));
            $u_educacion = $educacion->delete();
            if ($u_educacion) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function deleteExperiencia(Request $request, $experiencia)
    {
        if ($request->ajax()) {
            $experiencia = ExperienciaEmpleados::find(intval($experiencia));
            $u_experiencia = $experiencia->delete();
            if ($u_experiencia) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function getEmpleados(Request $request)
    {
        if ($request->ajax()) {
            $nombre = $request->nombre;
            if ($nombre != null) {
                $usuarios = Empleado::with('area')->where('name', 'ILIKE', '%' . $nombre . '%')->take(5)->get();
                $lista = "<ul class='list-group' id='empleados-lista'>";
                foreach ($usuarios as $usuario) {
                    $lista .= "<button type='button' class='px-2 py-1 text-muted list-group-item list-group-item-action' onClick='seleccionarUsuario(" . $usuario . ");'><i class='mr-2 fas fa-user-circle'></i>" . $usuario->name . '</button>';
                }
                $lista .= '</ul>';

                return $lista;
            }
        }
    }

    public function getListaEmpleados(Request $request)
    {
        if ($request->ajax()) {
            $nombre = $request->nombre;
            if ($nombre != null) {
                $usuarios = Empleado::with('area')->where('name', 'ILIKE', '%' . $nombre . '%')->take(5)->get();

                return json_encode($usuarios);
            }
        }
    }

    public function getAllEmpleados(Request $request)
    {
        $empleados = Empleado::select('id', 'name')->get();

        return json_encode($empleados);
        if ($request->ajax()) {
            $empleados = Empleado::select('id', 'name')->get();

            return json_encode($empleados);
        }
    }

    public function updateImageProfile(Request $request)
    {
        $empleado = auth()->user()->empleado;
        if (preg_match('/^data:image\/(\w+);base64,/', $request->image)) {
            $value = substr($request->image, strpos($request->image, ',') + 1);
            $value = base64_decode($value);
            $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';

            $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
            $img_intervention = Image::make($request->image);
            $img_intervention->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($route);
            $empleado->update([
                'foto' => $new_name_image,
            ]);

            return response()->json(['success' => 'Imágen actualizada']);
        } else {
            return response()->json(['error' => 'Ocurrió un error, intente nuevamente']);
        }
        // $folderPath = public_path('upload/');
        // $image_parts = explode(";base64,", $request->image);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[1]);

        // $imageName = uniqid() . '.png';

        // $imageFullPath = $folderPath . $imageName;

        // file_put_contents($imageFullPath, $image_base64);

        // $saveFile = new Picture;
        // $saveFile->name = $imageName;
        // $saveFile->save();
    }

    public function updateInformationProfile(Request $request)
    {
        $empleadoID = auth()->user()->empleado->id;
        $empleado = Empleado::find($empleadoID);
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email'=>'required|email|max:255',
            'cumpleaños' => 'required|date',
            'telefono_movil' => 'nullable|string|max:255',
        ]);
        $empleado->update([
            'name' => $request->name,
            // 'email'=>$request->email,
            'cumpleaños' => $request->cumpleaños,
            'telefono_movil' => $request->telefono_movil,
        ]);

        return redirect()->back()->with(['success' => 'Información actualizada']);
    }

    public function updateInformacionRelacionadaProfile(Request $request)
    {
        $empleadoID = auth()->user()->empleado->id;
        $empleado = Empleado::find($empleadoID);
        $this->validateDynamicForms($request);
        $this->assignDependenciesModel($request, $empleado);

        return redirect()->back()->with(['success' => 'Información actualizada']);
    }

    public function storeDocumentos(Request $request, Empleado $empleado)
    {
        $request->merge([
            'empleado_id' => $empleado->id,
        ]);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'documentos' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:10000',
            'empleado_id' => 'required|exists:empleados,id',
        ]);

        // dd($empleado);
        $evidencia = EvidenciasDocumentosEmpleados::create($request->all());

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if (Storage::putFileAs('public/expedientes/' . Str::slug($empleado->name), $file, $file->getClientOriginalName())) {
                $evidencia->update([
                    'documentos' => $file->getClientOriginalName(),
                ]);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Documento registrado']);
    }

    public function updateDocumento(Request $request, EvidenciasDocumentosEmpleados $documento)
    {
        $empleado = $documento->empleados_documentos;
        if (array_key_exists('nombre', $request->all())) {
            $request->validate([
                'nombre' => 'required|string|min:2|max:255',
            ]);
            $documento->update($request->all());
        }

        if (array_key_exists('numero', $request->all())) {
            $request->validate([
                'numero' => 'required|string|min:5|max:255',
            ]);
            $documento->update($request->all());
        }

        if (array_key_exists('file', $request->all())) {
            $request->validate([
                'file' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:10000',
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                if (Storage::putFileAs('public/expedientes/' . Str::slug($empleado->name), $file, $file->getClientOriginalName())) {
                    $documento->update([
                        'documentos' => $file->getClientOriginalName(),
                    ]);
                }
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Registro Actualizado']);
    }

    public function getDocumentos(Empleado $empleado)
    {
        $documentos = EvidenciasDocumentosEmpleados::where('empleado_id', $empleado->id)->get();

        return datatables()->of($documentos)->toJson();
        // return response()->json(['documentos' => $documentos]);
    }

    public function deleteDocumento(EvidenciasDocumentosEmpleados $documento)
    {
        $documento->delete();

        return response()->json(['status' => 'success', 'message' => 'Documento eliminado']);
    }

    public function deleteFileDocumento(EvidenciasDocumentosEmpleados $documento)
    {
        if (Storage::disk('public')->exists($documento->ruta_absoluta_documento)) {
            Storage::disk('public')->delete($documento->ruta_absoluta_documento);
        }
        $documento->update([
            'documentos' => null,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Archivo eliminado']);
    }
}
