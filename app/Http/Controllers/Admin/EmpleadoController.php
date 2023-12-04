<?php

namespace App\Http\Controllers\Admin;

use App\Functions\CountriesFunction;
use App\Http\Controllers\Controller;
use App\Mail\EnviarCorreoBienvenidaTabantaj;
use App\Models\Area;
use App\Models\CertificacionesEmpleados;
use App\Models\CursosDiplomasEmpleados;
use App\Models\EducacionEmpleados;
use App\Models\Empleado;
use App\Models\EvidenciaDocumentoEmpleadoArchivo;
use App\Models\EvidenciasCertificadosEmpleados;
use App\Models\EvidenciasDocumentosEmpleados;
use App\Models\ExperienciaEmpleados;
use App\Models\Language;
use App\Models\ListaDocumentoEmpleado;
use App\Models\Organizacion;
use App\Models\PerfilEmpleado;
use App\Models\Puesto;
use App\Models\RH\BeneficiariosEmpleado;
use App\Models\RH\ContactosEmergenciaEmpleado;
use App\Models\RH\DependientesEconomicosEmpleados;
use App\Models\RH\EntidadCrediticia;
use App\Models\RH\TipoContratoEmpleado;
use App\Models\Role;
use App\Models\Sede;
use App\Models\User;
use App\Rules\MonthAfterOrEqual;
use App\Traits\GeneratePassword;
use App\Traits\ObtenerOrganizacion;
use Barryvdh\DomPDF\Facade as PDF;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    use GeneratePassword;
    use ObtenerOrganizacion;

    public function getListaEmpleadosIndex()
    {
        $empleados = Empleado::with('area', 'sede', 'supervisor')->alta()->orderByDesc('id')->get();

        return dataTables()->of($empleados)->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('bd_empleados_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::select('id', 'n_empleado', 'name', 'foto', 'genero', 'email', 'telefono', 'area_id', 'puesto_id', 'supervisor_id', 'antiguedad', 'estatus', 'sede_id', 'cumpleaños')->orderBy('id', 'DESC')->alta()->get()
            ->map(function ($empleado) {
                $empleado['avatar_ruta'] = $empleado->avatar_ruta; // Access the computed attribute

                return $empleado;
            });
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.empleados.index', compact('empleados', 'logo_actual', 'empresa_actual'));
    }

    public function getCertificaciones($empleado)
    {
        $certificaciones = CertificacionesEmpleados::where('empleado_id', intval($empleado))->orderBy('id')->get();

        return datatables()->of($certificaciones)->toJson();
    }

    public function getEducacion($empleado)
    {
        $educacions = EducacionEmpleados::where('empleado_id', intval($empleado))->orderBy('id')->get();

        return datatables()->of($educacions)->toJson();
    }

    public function getExperiencia($empleado)
    {
        $experiencias = ExperienciaEmpleados::where('empleado_id', intval($empleado))->orderByDesc('inicio_mes')->get();

        // dd($experiencias);
        return datatables()->of($experiencias)->toJson();
    }

    public function getCursos($empleado)
    {
        $cursos = CursosDiplomasEmpleados::where('empleado_id', intval($empleado))->get();

        return datatables()->of($cursos)->toJson();
    }

    public function create()
    {
        abort_if(Gate::denies('bd_empleados_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getaltaAll();
        $ceo_exists = Empleado::getCeoExists();
        $areas = Area::getAll();
        $sedes = Sede::getAll();
        $experiencias = ExperienciaEmpleados::getAll();
        $educacions = EducacionEmpleados::get();
        $cursos = CursosDiplomasEmpleados::get();
        $documentos = EvidenciasDocumentosEmpleados::getAll();
        $certificaciones = CertificacionesEmpleados::get();
        $puestos = Puesto::getAll();
        $perfiles = PerfilEmpleado::getAll();
        $perfiles_seleccionado = null;
        $puestos_seleccionado = null;
        //$perfiles = PerfilEmpleado::all();
        $tipoContratoEmpleado = TipoContratoEmpleado::select('id', 'name', 'slug', 'description')->get();
        $entidadesCrediticias = EntidadCrediticia::select('id', 'entidad')->get();
        $empleado = new Empleado;
        $idiomas = Language::get();
        $globalCountries = new CountriesFunction;
        $organizacion = Organizacion::getFirst();
        $countries = $globalCountries->getCountries('ES');

        return view('admin.empleados.create', compact('empleados', 'ceo_exists', 'areas', 'sedes', 'experiencias', 'educacions', 'cursos', 'documentos', 'certificaciones', 'puestos', 'perfiles', 'tipoContratoEmpleado', 'entidadesCrediticias', 'empleado', 'countries', 'perfiles_seleccionado', 'puestos_seleccionado', 'idiomas', 'organizacion'));
    }

    public function onlyStore($request)
    {
        $experiencias = json_decode($request->experiencia);
        $educacions = json_decode($request->educacion);
        $cursos = json_decode($request->curso);
        $certificados = json_decode($request->certificado);
        // dd($cursos);

        $ceo_exists = Empleado::getCeoExists();
        $validateSupervisor = 'nullable|exists:empleados,id';
        if ($ceo_exists) {
            $validateSupervisor = 'required|exists:empleados,id';
        }

        $request->validate([
            'name' => 'required|string',
            'n_empleado' => 'nullable|unique:empleados',
            'area_id' => 'required|exists:areas,id',
            'supervisor_id' => $validateSupervisor,
            'puesto_id' => 'required|exists:puestos,id',
            'antiguedad' => 'required',
            'email' => 'required|email',
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
                // if (!is_null($item) && (array_key_exists('id', $collect) && $collect['id'] != '0')) {
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
        // dd($request);
        $empleado = Empleado::create([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'puesto_id' => $request->puesto_id,
            'perfil_empleado_id' => $request->perfil_empleado_id,
            'supervisor_id' => $request->supervisor_id,
            'antiguedad' => $request->antiguedad,
            'email' => removeUnicodeCharacters($request->email),
            'estatus' => 'alta',
            'telefono' => $request->telefono,
            'genero' => $request->genero,
            'n_empleado' => $request->n_empleado,
            'n_registro' => $request->n_registro,
            'sede_id' => $request->sede_id,
            'resumen' => $request->resumen,
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
            // 'domicilio_personal' => $request->domicilio_personal,
            'calle' => $request->calle,
            'num_exterior' => $request->num_exterior,
            'domicilio_personal' => $request->domicilio_personal,
            'num_interior' => $request->num_interior,
            'colonia' => $request->colonia,
            'delegacion' => $request->delegacion,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'cp' => $request->cp,
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
            'semanas_min_timesheet' => $request->semanas_min_timesheet,
        ]);
        $this->createUserFromEmpleado($empleado);
        $this->assignDependenciesModel($request, $empleado);

        return $empleado;
    }

    public function createUserFromEmpleado($empleado)
    {
        $generatedPassword = $this->generatePassword();
        $user = User::create([
            'name' => $empleado->name,
            'email' => removeUnicodeCharacters($empleado->email),
            'password' => $generatedPassword['hash'],
            'n_empleado' => $empleado->n_empleado,
            'empleado_id' => $empleado->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if (Role::find(4) != null) {
            User::findOrFail($user->id)->roles()->sync(4);
        }
        //Send email with generated password
        Mail::to(removeUnicodeCharacters($empleado->email))->send(new EnviarCorreoBienvenidaTabantaj($empleado, $generatedPassword['password']));

        return $user;
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
                                'edad' => $beneficiario['edad'],
                                'parentesco' => $beneficiario['parentesco'],
                                'porcentaje' => $beneficiario['porcentaje'],
                            ]);
                        } else {
                            BeneficiariosEmpleado::create([
                                'empleado_id' => $empleado->id,
                                'nombre' => $beneficiario['nombre'],
                                'edad' => $beneficiario['edad'],
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
                'estatus' => $request->estatus,
                'vigencia' => $request->vigencia,
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
        $request->merge(['duracion' => Carbon::parse($request->año)->diffInDays($request->fecha_fin) + 1]);
        $request->validate([
            'curso_diploma' => 'required|string|max:255',
            'tipo' => 'required',
            'año' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:año',
            'duracion' => 'required',
            'empleado_id' => 'required|exists:empleados,id',
        ], [
            'curso_diploma.required' => 'El campo nombre es requerido',
            'año.required' => 'El campo fecha inicio es requerido',
        ]);
        if ($request->ajax()) {
            $empleado = Empleado::find(intval($empleado));
            $curso = CursosDiplomasEmpleados::create([
                'empleado_id' => $empleado->id,
                'curso_diploma' => $request->curso_diploma,
                'tipo' => $request->tipo,
                'año' => $request->año,
                'fecha_fin' => $request->fecha_fin,
                'duracion' => $request->duracion,
            ]);

            if ($request->hasFile('file')) {
                $filenameWithExt = $request->file('file')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('file')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->file('file')->storeAs('public/cursos_empleados', $fileNameToStore);

                $curso->update([
                    'file' => $fileNameToStore,
                ]);
            }
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
            $curso->update($request->all());
        }

        if (array_key_exists('tipo', $request->all())) {
            $request->validate([
                'tipo' => 'required|string|max:255',
            ]);
            $curso->update($request->all());
        }

        if (array_key_exists('año', $request->all())) {
            $request->validate([
                'año' => "required|date|before_or_equal:{$curso->fecha_fin}",
            ]);

            $curso->update($request->all());
            $curso->update([
                'duracion' => Carbon::parse($curso->año)->diffInDays($curso->fecha_fin) + 1,
            ]);
        }
        if (array_key_exists('fecha_fin', $request->all())) {
            $request->validate([
                'fecha_fin' => "required|date|after_or_equal:{$curso->año}",
            ]);

            $curso->update($request->all());
            $curso->update([
                'duracion' => Carbon::parse($curso->año)->diffInDays($curso->fecha_fin) + 1,
            ]);
        }

        if (array_key_exists('duracion', $request->all())) {
            $request->validate([
                'duracion' => 'required|numeric|min:1',
            ]);
            $curso->update($request->all());
        }

        if ($request->hasFile('file')) {
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/cursos_empleados', $fileNameToStore);

            $curso->update([
                'file' => $fileNameToStore,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Curso Actualizado', 'curso' => $curso]);
    }

    public function deleteFileCurso(Request $request, CursosDiplomasEmpleados $curso)
    {
        $curso->update([
            'file' => null,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Curso Actualizado']);
    }

    public function storeExperiencia(Request $request, $empleado)
    {
        // dd($request->trabactualmente);
        $request->validate([
            'empresa' => 'required|string|max:255',
            'puesto' => 'required|string|max:255',
            'inicio_mes' => 'required',
            'fin_mes' => ['nullable', new MonthAfterOrEqual($request->inicio_mes, $request->fin_mes)],
            'descripcion' => 'required',
            'empleado_id' => 'required|exists:empleados,id',

        ]);

        $fechaFin = null;
        if ($request->trabactualmente == 'false') {
            $request->validate(['fin_mes' => 'required']);
            $fechaFin = $request->fin_mes;
        }
        // dd($request->all());
        if ($request->ajax()) {
            $empleado = Empleado::find(intval($empleado));
            $experiencia = ExperienciaEmpleados::create([
                'empleado_id' => $empleado->id,
                'empresa' => $request->empresa,
                'puesto' => $request->puesto,
                'inicio_mes' => $request->inicio_mes,
                'fin_mes' => $fechaFin,
                'descripcion' => $request->descripcion,
                'trabactualmente' => $request->trabactualmente,
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
        if (array_key_exists('trabactualmente', $request->all())) {
            if ($request->trabactualmente == 'true') {
                $isTrabActualmente = true;
            } else {
                $isTrabActualmente = false;
            }
            $request->replace(['trabactualmente' => $isTrabActualmente]);
        }
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
                'inicio_mes' => ['required', new MonthAfterOrEqual($request->inicio_mes, $experiencia->fin_mes)],
            ]);
        }
        if ($request->trabactualmente == 'false' || $request->trabactualmente == null) {
            if (array_key_exists('fin_mes', $request->all())) {
                if ($request->fin_mes != 'undefided') {
                    $request->validate([
                        'fin_mes' => ['required', new MonthAfterOrEqual($experiencia->inicio_mes, $request->fin_mes)],
                    ]);
                }
            }
        }

        $experiencia->update($request->all());

        return response()->json(['status' => 'success', 'message' => 'Registro Actualizado']);
    }

    public function storeEducacion(Request $request, $empleado)
    {
        $request->validate([
            'institucion' => 'required|string|max:255',
            'nivel' => 'required',
            'año_inicio' => ['required', new MonthAfterOrEqual($request->año_inicio, $request->año_fin)],
            'año_fin' => ['nullable', new MonthAfterOrEqual($request->año_inicio, $request->año_fin)],
            'empleado_id' => 'required|exists:empleados,id',
            'titulo_obtenido' => 'required|string|max:255',
        ]);
        $fechaFin = null;
        if ($request->estudactualmente == 'false') {
            $request->validate(['año_fin' => ['required', new MonthAfterOrEqual($request->año_inicio, $request->año_fin)]]);
            $fechaFin = $request->año_fin;
        }
        // dd($request->all());
        if ($request->ajax()) {
            $empleado = Empleado::find(intval($empleado));
            $educacion = EducacionEmpleados::create([
                'empleado_id' => $empleado->id,
                'institucion' => $request->institucion,
                'nivel' => $request->nivel,
                'año_inicio' => $request->año_inicio,
                'año_fin' => $fechaFin,
                'titulo_obtenido' => $request->titulo_obtenido,
                'estudactualmente' => $request->estudactualmente,
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
        if (array_key_exists('estudactualmente', $request->all())) {
            if ($request->estudactualmente == 'true') {
                $isEstdActualmente = true;
            } else {
                $isEstdActualmente = false;
            }
            $request->replace(['estudactualmente' => $isEstdActualmente]);
        }
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
                'año_inicio' => ['required', new MonthAfterOrEqual($request->año_inicio, $educacion->año_fin)],
            ]);
        }
        if ($request->estudactualmente == 'false' || $request->estudactualmente == null) {
            if (array_key_exists('año_fin', $request->all())) {
                if ($request->año_fin != 'undefided') {
                    $request->validate([
                        'año_fin' => ['required', new MonthAfterOrEqual($educacion->año_inicio, $request->año_fin)],
                    ]);
                }
            }
        }
        if (array_key_exists('titulo_obtenido', $request->all())) {
            $request->validate([
                'titulo_obtenido' => 'required|string|max:255',
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
        abort_if(Gate::denies('bd_empleados_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visualizarEmpleados = Empleado::with('supervisor', 'sede', 'perfil')->find(intval($id));
        $contactos = ContactosEmergenciaEmpleado::where('empleado_id', intval($id))->get();
        $dependientes = DependientesEconomicosEmpleados::where('empleado_id', intval($id))->get();
        $beneficiarios = BeneficiariosEmpleado::where('empleado_id', intval($id))->get();
        $certificados = CertificacionesEmpleados::where('empleado_id', intval($id))->get();
        $capacitaciones = CursosDiplomasEmpleados::where('empleado_id', intval($id))->get();
        $expedientes = EvidenciasDocumentosEmpleados::getAll()->where('empleado_id', intval($id));
        $empleado = Empleado::getaltaAll();

        return view('admin.empleados.datosEmpleado', compact('visualizarEmpleados', 'empleado', 'contactos', 'dependientes', 'beneficiarios', 'certificados', 'capacitaciones', 'expedientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('bd_empleados_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleado = Empleado::find($id);
        $empleados = Empleado::get();
        $ceo_exists = Empleado::getCeoExists();
        $areas = Area::get();
        $area = null;
        if ($empleado && $empleado->area_id !== null) {
            $area = $areas->find($empleado->area_id);
        }
        $sedes = DB::table('sedes')->get();
        $sede = Sede::getbyId($empleado->sede_id);
        $experiencias = DB::table('experiencia_empleados')->get();
        $educacions = DB::table('educacion_empleados')->get();
        $cursos = DB::table('cursos_diplomados_empleados')->get();
        $documentos = DB::table('evidencias_documentos_empleados')->get();
        $puestos = DB::table('puestos')->get();
        $perfiles = DB::table('perfil_empleados')->get();
        $tipoContratoEmpleado = TipoContratoEmpleado::select('id', 'name', 'description', 'slug')->get();
        $entidadesCrediticias = EntidadCrediticia::select('id', 'entidad')->get();
        $perfiles_seleccionado = $empleado->perfil_empleado_id;
        $puestos_seleccionado = $empleado->puesto_id;
        $idiomas = Language::get();
        $organizacion = Organizacion::getFirst();
        $globalCountries = new CountriesFunction;
        $countries = $globalCountries->getCountries('ES');
        $isEditAdmin = true;
        $id_empleado = $id;
        $empleado = Empleado::find($id_empleado);
        $lista_docs = $this->getListaDocumentos($id_empleado);
        $docs_empleado = EvidenciasDocumentosEmpleados::where('empleado_id', $id_empleado)->where('archivado', false)->get();
        // expediente ------------------------------------------------------------

        $organizacion = Organizacion::getFirst();

        return view('admin.empleados.edit', compact('empleado', 'empleados', 'ceo_exists', 'areas', 'area', 'sede', 'sedes', 'experiencias', 'educacions', 'cursos', 'documentos', 'puestos', 'perfiles', 'tipoContratoEmpleado', 'entidadesCrediticias', 'countries', 'perfiles', 'perfiles_seleccionado', 'puestos_seleccionado', 'isEditAdmin', 'idiomas', 'lista_docs', 'docs_empleado', 'organizacion'));
    }

    public function getListaDocumentos($id_empleado)
    {
        $lista_docs_model = ListaDocumentoEmpleado::getAll();
        $lista_docs = collect();
        $documento_versiones = '';
        foreach ($lista_docs_model as $doc) {
            $documentos_empleado = EvidenciasDocumentosEmpleados::getAll()->where('empleado_id', $id_empleado)->where('lista_documentos_empleados_id', $doc->id)->first();
            if ($documentos_empleado) {
                $doc_empleado_id = $documentos_empleado->id;
                $documento = EvidenciaDocumentoEmpleadoArchivo::where('evidencias_documentos_empleados_id', $documentos_empleado->id)->where('archivado', false)->first();
                $documento_versiones = EvidenciaDocumentoEmpleadoArchivo::where('evidencias_documentos_empleados_id', $documentos_empleado->id)->where('archivado', true)->get();
                if ($documento) {
                    $doc_viejo = $documento->ruta_documento;
                    $nombre_doc = $documento->documento;
                } else {
                    $doc_viejo = null;
                    $nombre_doc = null;
                }
            } else {
                $doc_viejo = null;
                $nombre_doc = null;
                $doc_empleado_id = null;
            }
            $lista_docs->push((object) [
                'id' => $doc->id,
                'documento' => $doc->documento,
                'tipo' => $doc->tipo,
                'empleado' => $documentos_empleado,
                'ruta_documento' => $doc_viejo,
                'nombre_doc' => $nombre_doc,
                'documento_versiones' => $documento_versiones,
                'evidencia_viejo_id' => $doc_empleado_id,
            ]);
        }

        return $lista_docs;
    }

    public function expedienteUpdate(Request $request)
    {
        if ($request->name == 'file') {
            $fileName = time() . $request->file('value')->getClientOriginalName();
            // dd($request->file('value'));
            $empleado = Empleado::find($request->empleadoId);
            $request->file('value')->storeAs('public/expedientes/' . Str::slug($empleado->name), $fileName);
            $expediente = EvidenciasDocumentosEmpleados::updateOrCreate(['empleado_id' => $request->empleadoId, 'lista_documentos_empleados_id' => $request->documentoId], [$request->name => $request->value]);

            $doc_viejo = EvidenciaDocumentoEmpleadoArchivo::where('evidencias_documentos_empleados_id', $expediente->id)->where('archivado', false)->first();
            if ($doc_viejo) {
                $doc_viejo->update([
                    'archivado' => true,
                ]);
            }

            $archivo = EvidenciaDocumentoEmpleadoArchivo::create([
                'evidencias_documentos_empleados_id' => $expediente->id,
                'documento' => $fileName,
                'archivado' => false,
            ]);

            return response()->json(['status' => 201, 'message' => 'Registro Actualizado']);
        } else {
            $expediente = EvidenciasDocumentosEmpleados::updateOrCreate(['empleado_id' => $request->empleadoId, 'lista_documentos_empleados_id' => $request->documentoId], [$request->name => $request->value]);
        }

        // $expediente->update([
        //     $request->name => $request->value,
        // ]);

        return response()->json(['status' => 200, 'message' => 'Registro Actualizado']);
    }

    public function expedienteRestaurar(Request $request)
    {
        $doc_viejo = EvidenciaDocumentoEmpleadoArchivo::where('evidencias_documentos_empleados_id', $request->expediente_id)->where('archivado', false)->first();
        if ($doc_viejo) {
            $doc_viejo->update([
                'archivado' => true,
            ]);
        }
        $evidencia_doc_archivo = EvidenciaDocumentoEmpleadoArchivo::find($request->id);
        $evidencia_doc_archivo->update([
            'archivado' => false,
        ]);

        return response()->json(['status' => 200, 'message' => 'Registro Actualizado']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ceo = Empleado::select('id')->whereNull('supervisor_id')->first();
        $ceo_exists = Empleado::getCeoExists();
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
            'n_empleado' => 'nullable|unique:empleados,n_empleado,' . $id,
            'area_id' => 'required|exists:areas,id',
            'supervisor_id' => $validateSupervisor,
            'puesto_id' => 'required|exists:puestos,id',
            'antiguedad' => 'required',
            // 'email' => 'required|email',
        ], [
            'n_empleado.unique' => 'El número de empleado ya ha sido tomado',
        ]);

        $this->validateDynamicForms($request);
        $empleado = Empleado::getAll()->find($id);
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
            if ($request->file('foto')) {
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
            'area_id' => $request->area_id,
            'puesto_id' => $request->puesto_id,
            'perfil_empleado_id' => $request->perfil_empleado_id,
            'supervisor_id' => $request->supervisor_id,
            'antiguedad' => $request->antiguedad,
            'estatus' => $request->estatus,
            'email' => removeUnicodeCharacters($request->email),
            'telefono' => $request->telefono,
            'genero' => $request->genero,
            'estatus' => 'alta',
            'n_empleado' => $request->n_empleado,
            'n_registro' => $request->n_registro,
            'sede_id' => $request->sede_id,
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
            // 'domicilio_personal' => $request->domicilio_personal,
            'calle' => $request->calle,
            'num_exterior' => $request->num_exterior,
            'domicilio_personal' => $request->domicilio_personal,
            'num_interior' => $request->num_interior,
            'colonia' => $request->colonia,
            'delegacion' => $request->delegacion,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'cp' => $request->cp,
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
            'foto' => $image,
            'semanas_min_timesheet' => $request->semanas_min_timesheet,
        ]);

        $usuario = User::where('empleado_id', $empleado->id)->orWhere('n_empleado', $empleado->n_empleado)->first();
        $usuario->update([
            'n_empleado' => $request->n_empleado,
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

        return response()->json(['status' => 'success', 'message' => 'Curriculum Actualizado', 'from' => 'curriculum'], 200, $request->all());
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
        // $empleado->delete();
        $empleado->update(['estatus' => 'baja']);

        return response()->json(['success' => true, 'empleado' => $empleado->name, 'message' => 'Empleado dado de baja', 'from' => 'rh'], 200);
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
                $usuarios = Empleado::alta()->with('area')->where('name', 'ILIKE', '%' . $nombre . '%')->take(5)->get();

                // dd(compact('usuarios'));
                return compact('usuarios');
            }
        }
        /*
        if ($request->ajax()) {
            $nombre = $request->nombre;
            if ($nombre != null) {
                $usuarios = Empleado::with('area')->where('name', 'ILIKE', '%' . $nombre . '%')->take(5)->get();
                $lista = "<ul class='list-group' id='empleados-lista'>";
                foreach ($usuarios as $usuario) {
                    $lista .= "<button type='button' class='px-2 py-1 text-muted list-group-item list-group-item-action' onClick='seleccionarUsuario(".$usuario.")' > <i class='mr-2 fas fa-user-circle'></i>" . $usuario->name . '</button>';
                }
                $lista .= '</ul>';
                return $lista;
            }
        }
        */
    }

    public function getListaEmpleados(Request $request)
    {
        if ($request->ajax()) {
            $nombre = $request->nombre;
            if ($nombre != null) {
                $usuarios = Empleado::alta()->with('area')->where('name', 'ILIKE', '%' . $nombre . '%')->take(5)->get();

                return json_encode($usuarios);
            }
        }
    }

    public function getAllEmpleados(Request $request)
    {
        $empleados = Empleado::select('id', 'name')->alta()->get();

        return json_encode($empleados);
        if ($request->ajax()) {
            $empleados = Empleado::select('id', 'name')->alta()->get();

            return json_encode($empleados);
        }
    }

    public function updateImageProfile(Request $request)
    {
        $empleado = User::getCurrentUser()->empleado;
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
        $empleadoID = User::getCurrentUser()->empleado->id;
        $empleado = Empleado::find($empleadoID);
        $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email'=>'required|email|max:255',
            'cumpleaños' => 'required|date',
            'telefono_movil' => 'nullable|string|max:255',
        ]);
        $empleado->update([
            // 'name' => $request->name,
            // 'email'=>$request->email,
            'mostrar_telefono' => $request->has('mostrar_telefono'),
            'cumpleaños' => $request->cumpleaños,
            'telefono_movil' => $request->telefono_movil,
        ]);

        return redirect()->back()->with(['success' => 'Información actualizada']);
    }

    public function updateInformacionRelacionadaProfile(Request $request)
    {
        $empleadoID = User::getCurrentUser()->empleado->id;
        $empleado = Empleado::find($empleadoID);
        $this->validateDynamicForms($request);
        $this->assignDependenciesModel($request, $empleado);

        return redirect()->back()->with(['success' => 'Información actualizada']);
    }

    public function storeDocumentos(Request $request, Empleado $empleado)
    {
        $doc_viejo = EvidenciasDocumentosEmpleados::where('nombre', $request->nombre)->where('archivado', false)->first();
        if ($doc_viejo) {
            $doc_viejo->update([
                'archivado' => true,
            ]);
        }

        $request->merge([
            'empleado_id' => $empleado->id,
        ]);
        $request->validate([
            'nombre' => 'required|string|max:255',
            // 'numero' => 'string|max:255',
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
        $documentos = EvidenciasDocumentosEmpleados::getAll()->where('empleado_id', $empleado->id);

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

    public function buscarEmpleadoPorCorreo(Request $request)
    {
        $participantes = $request->participantes;

        $empleados = Empleado::getaltaAll()->whereIn('email', $participantes)->get();

        return $empleados;
    }

    public function obtenerEmpleadoPorNombre($nombre)
    {
        $empleado_bd = Empleado::getaltaAll()->select('id', 'name')->where('name', $nombre)->first();

        return $empleado_bd->id;
    }

    public function datosEmpleado($id)
    {
        $visualizarEmpleados = Empleado::with('supervisor', 'sede', 'perfil')->find(intval($id));
        $contactos = ContactosEmergenciaEmpleado::where('empleado_id', intval($id))->get();
        $dependientes = DependientesEconomicosEmpleados::where('empleado_id', intval($id))->get();
        $beneficiarios = BeneficiariosEmpleado::where('empleado_id', intval($id))->get();
        $certificados = CertificacionesEmpleados::where('empleado_id', intval($id))->get();
        $capacitaciones = CursosDiplomasEmpleados::where('empleado_id', intval($id))->get();
        $expedientes = EvidenciasDocumentosEmpleados::getAll()->where('empleado_id', intval($id));
        $empleado = Empleado::getaltaAll();

        return view('admin.empleados.datosEmpleado', compact('visualizarEmpleados', 'empleado', 'contactos', 'dependientes', 'beneficiarios', 'certificados', 'capacitaciones', 'expedientes'));
    }

    public function removerVacante(Request $request)
    {
        $empleado = Empleado::find($request->id);
        $empleado->update([
            'vacante_activa' => false,
        ]);

        return response()->json(['status' => 200, 'message' => 'Vacante eliminada']);
    }

    public function solicitudBaja(Empleado $empleado)
    {
        return view('admin.empleados.solicitudBaja', compact('empleado'));
    }

    // public function imprimir($id){

    //     // PDF::setOptions(['isRemoteEnabled' => TRUE, 'enable_javascript' => TRUE]);
    //     // $dompdf = new Dompdf();
    //     // $html = view('empleados.datosEmpleado')->render();
    //     // $dompdf->loadHtml($html);
    //     // $dompdf->render();
    //     // return $dompdf->download('empleado.pdf');

    //     // $fun = $this->show('');
    //     $visualizarEmpleados = Empleado::with('supervisor','sede','perfil')->find(intval($id));
    //     $contactos = ContactosEmergenciaEmpleado::where('empleado_id', intval($id))->get();
    //     $dependientes = DependientesEconomicosEmpleados::where('empleado_id', intval($id))->get();
    //     $beneficiarios = BeneficiariosEmpleado::where('empleado_id', intval($id))->get();
    //     $certificados = CertificacionesEmpleados::where('empleado_id', $id)->get();
    //     $capacitaciones = CursosDiplomasEmpleados::where('empleado_id', intval($id))->get();
    //     $expedientes = EvidenciasDocumentosEmpleados::getAll()->where('empleado_id', intval($id));
    //     $empleado = Empleado::getAll();

    //     $pdf = PDF::loadView('admin.empleados.datosEmpleado', compact('visualizarEmpleados', 'contactos','dependientes', 'beneficiarios', 'certificados', 'capacitaciones', 'expedientes', 'empleado'))->setOptions(['defaultFont' => 'sans-serif'])->render();;
    //     $dompdf->loadHtml($pdf);
    //     $dompdf->render();
    //     return $pdf->download('empleado.pdf');

    public function borradoMultiple(Request $request)
    {
        if ($request->ajax()) {
            if (count($request->all()) >= 1) {
                foreach ($request->all() as $key => $value) {
                    $empleado = Empleado::find($value);
                    $empleado->each->delete();

                    return response()->json(['success' => 'deleted successfully!', $request->all()]);
                }
            }
        }
    }

    public function importar()
    {
        return view('admin.empleados.importar');
    }
}
