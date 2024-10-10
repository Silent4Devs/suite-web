<?php

namespace App\Http\Controllers\ContractManager;

use App\Exports\ReporteClienteExport;
use App\Functions\CierreContratoData;
use App\Functions\EntregablesData;
use App\Functions\FormatearFecha;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use App\Mail\AprobadorFirmaContratoMail;
use App\Models\AprobadorFirmaContrato;
use App\Models\AprobadorFirmaContratoHistorico;
use App\Models\Area;
use App\Models\ContractManager\CedulaCumplimiento;
use App\Models\ContractManager\CierreContrato;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\ConveniosModificatorios;
use App\Models\ContractManager\DolaresContrato;
use App\Models\ContractManager\EntregaMensual;
use App\Models\ContractManager\Factura;
use App\Models\ConvergenciaContratos;
use App\Models\Empleado;
use App\Models\FirmaModule;
use App\Models\Organizacion;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\User;
use App\Repositories\ContratoRepository;
use App\Rules\NumeroContrato;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ContractManager\Sucursal;

class ContratosController extends AppBaseController
{
    use ObtenerOrganizacion;

    /** @var ContratoRepository */
    private $contratoRepository;

    public function __construct(ContratoRepository $contratoRepo)
    {
        $this->contratoRepository = $contratoRepo;
    }

    /**
     * Display a listing of the Contratos.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = User::getCurrentUser();

        abort_if(Gate::denies('katbol_contratos_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario_actual = Empleado::getAll()->find($user->empleado_id);
        $areas = Area::getIdNameAll();

        $contratos = Contrato::SELECT('contratos.*', 'cedula_cumplimiento.cumple', 'timesheet_clientes.nombre')
            ->join('timesheet_clientes', 'contratos.proveedor_id', '=', 'timesheet_clientes.id')
            ->leftjoin('cedula_cumplimiento', 'contratos.id', '=', 'cedula_cumplimiento.contrato_id')
            ->get();

        $organizacion = Organizacion::getFirst();

        return view('contract_manager.contratos-katbol.index', compact('usuario_actual', 'areas'))
            ->with('contratos', $contratos);
    }

    /**
     * Show the form for creating a new Contrato.
     *
     * @return Response
     */
    public function create()
    {
        abort_if(Gate::denies('katbol_contratos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contratos = new Contrato;
        $areas = Area::getAll();
        $organizacion = Organizacion::getFirst();
        $proyectos = TimesheetProyecto::getAll()->where('estatus', 'proceso');
        // $dolares = DolaresContrato::where('contrato_id', $id)->first();
        $dolares = null;
        $proveedores = TimesheetCliente::select('id', 'razon_social', 'nombre')->get();
        $razones_sociales = Sucursal::getArchivoFalse();

        $firma = FirmaModule::where('modulo_id', '2')->where('submodulo_id', '7')->first();

        return view('contract_manager.contratos-katbol.create', compact('dolares', 'organizacion', 'areas', 'proyectos', 'firma', 'razones_sociales'))->with('proveedores', $proveedores)->with('contratos', $contratos);
    }

    /**
     * Store a newly created Contratos in storage.
     *
     * @param  CreateContratoRequest  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'no_contrato' => 'required_unless:identificador_privado,1',
            'nombre_servicio' => 'required|max:500',
            'tipo_contrato' => 'required',
            'proveedor_id' => 'required',
            'area_id' => 'required',
            'objetivo' => 'required|max:500',
            'estatus' => 'required|max:255',
            'cargo_administrador' => 'max:250',
            'area_administrador' => 'max:250',
            'puesto' => 'max:250',
            'area' => 'max:250',
            'file_contrato' => 'required',
            'fase' => 'required|max:255',
            'vigencia_contrato' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required|after:fecha_inicio',
            'fecha_firma' => 'required|before_or_equal:fecha_fin',
            'no_pagos' => ['required', 'numeric', 'lte:500000'],
            'tipo_cambio' => 'required',
            'monto_pago' => ['required', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
            'minimo' => ['nullable', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/", 'required'],
            'maximo' => ['nullable', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/", 'required'],
            'pmp_asignado' => 'required',
            // 'signed' => 'required',
            // "creacion_proyecto" => "nullable|boolean",
            'no_proyecto' => 'required_if:creacion_proyecto,false|string',
            'identificador' => 'required_if:creacion_proyecto,true|string|max:255',
            'tipo' => 'required_if:creacion_proyecto,true|string|max:255',
            'proyecto_name' => 'required_if:creacion_proyecto,true|string|max:255',
            'sede_id' => 'nullable|integer|exists:sedes,id', //required_if:creacion_proyecto,true|
            'fecha_inicio_proyecto' => 'nullable|date', //required_if:creacion_proyecto,true|
            'fecha_fin_proyecto' => 'nullable|date|after_or_equal:fecha_inicio_proyecto', //required_if:creacion_proyecto,true|
            'horas_proyecto' => 'nullable|integer|min:0',
            'razon_soc_id' => 'required|integer',
        ], [
            'no_proyecto.int' => 'Debe seleccionar un proyecto o crear uno.',
            'monto_pago.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'maximo.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'minimo.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'fecha_firma.after_or_equal' => 'La fecha firma no puede ser antes de la fecha inicio del contrato',
            'no_contrato.required_unless' => 'Solo los Contratos privados no requieren Numero de Contrato',
        ]);

        $resultado = null;
        $resultado2 = null;
        $resultado3 = null;
        $resultado4 = null;
        $resultado5 = null;
        $resultado6 = null;
        $resultado7 = null;
        $resultado8 = null;

        if (isset($request->monto_pago)) {
            $resultado = str_replace('$', '', $request->monto_pago);
            $resultado2 = str_replace(',', '', $resultado);
        }

        if (isset($request->minimo)) {
            $resultado = str_replace('$', '', $request->minimo);
            $resultado3 = str_replace(',', '', $resultado);
        }

        if (isset($request->maximo)) {
            $resultado = str_replace('$', '', $request->maximo);
            $resultado4 = str_replace(',', '', $resultado);
        }

        if (isset($request->monto_dolares)) {
            $resultado = str_replace('$', '', $request->monto_dolares);
            $resultado5 = str_replace(',', '', $resultado);
        }

        if (isset($request->maximo_dolares)) {
            $resultado = str_replace('$', '', $request->maximo_dolares);
            $resultado6 = str_replace(',', '', $resultado);
        }

        if (isset($request->minimo_dolares)) {
            $resultado = str_replace('$', '', $request->minimo_dolares);
            $resultado7 = str_replace(',', '', $resultado);
        }

        if (isset($request->valor_dolar)) {
            $resultado = str_replace('$', '', $request->valor_dolar);
            $resultado8 = str_replace(',', '', $resultado);
        }

        $input = $request->all();

        $ultimo_id = Contrato::get('id')->last();
        $date = Carbon::now()->format('dmY');

        $formatoFecha = new FormatearFecha;
        // dd($request->fecha_inicio);
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        // $fecha_inicio = $formatoFecha->formatearFecha($request->fecha_inicio, 'd-m-Y', 'Y-m-d');
        // $fecha_fin = $formatoFecha->formatearFecha($request->fecha_fin, 'd-m-Y', 'Y-m-d');
        if ($request->fecha_firma != null) {
            // $fecha_firma = $formatoFecha->formatearFecha($request->fecha_firma, 'd-m-Y', 'Y-m-d');
            $fecha_firma = $request->fecha_firma;
        } else {
            $fecha_firma = null;
        }
        if ($request->identificador_privado == true) {
            $no_contrato_sin_slashes = 'privado'.''.$ultimo_id->id + 1 .'-'.$date;
        }
        $no_contrato_sin_slashes = preg_replace('[/]', '-', $request->no_contrato);

        if ($request->identificador_privado == true) {
            $num_contrato = 'privado'.'-'.$ultimo_id->id + 1 .'-'.$date;
        } else {
            $num_contrato = $no_contrato_sin_slashes;
        }

        if ($request->creacion_proyecto) {
            $proyecto = TimesheetProyecto::create([
                'identificador' => $request->identificador,
                'tipo' => $request->tipo,
                'proyecto' => $request->proyecto_name,
                'sede_id' => $request->sede_id,
                'fecha_inicio' => $request->fecha_inicio_proyecto,
                'fecha_fin' => $request->fecha_fin_proyecto,
                'horas_proyecto' => $request->horas_proyecto,
                'cliente_id' => $request->proveedor_id,
            ]);

            $proyecto_area = TimesheetProyectoArea::create([
                'area_id' => $request->area_id,
                'proyecto_id' => $proyecto->id,
            ]);
        } else {
            $proyecto = TimesheetProyecto::select('id', 'identificador')->where('identificador', $request->no_proyecto)->first();
        }

        $contrato = $this->contratoRepository->create([
            'tipo_contrato' => $request->tipo_contrato,
            'identificador_privado' => $request->identificador_privado,
            'no_contrato' => $num_contrato,
            'nombre_servicio' => $request->nombre_servicio,
            'proveedor_id' => $request->proveedor_id,
            'objetivo' => $request->objetivo,
            'vigencia_contrato' => $request->vigencia_contrato,
            'estatus' => $request->estatus,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'administrador_contrato' => $request->administrador_contrato,
            'file_contrato' => $request->file_contrato,
            'cargo_administrador' => $request->cargo_administrador,
            'fecha_firma' => $fecha_firma,
            'no_pagos' => $request->no_pagos,
            'monto_pago' => $resultado2,
            'minimo' => $resultado3,
            'maximo' => $resultado4,
            'fase' => $request->fase,
            'pmp_asignado' => $request->pmp_asignado,
            'puesto' => $request->puesto,
            'area' => $request->area,
            'folio' => $request->folio,
            'tipo_cambio' => $request->tipo_cambio,
            'area_administrador' => $request->area_administrador,
            'no_proyecto' => $request->no_proyecto,
            'area_id' => $request->area_id,
            // 'firma1' => $firma,
            'razon_soc_id' => $request->razon_soc_id,
        ], $input);

        $convergencia = ConvergenciaContratos::create([
            'timesheet_proyecto_id' => $proyecto->id,
            'timesheet_cliente_id' => $request->proveedor_id,
            'contrato_id' => $contrato->id,
        ]);

        $dolares = DolaresContrato::create([
            'contrato_id' => $contrato->id,
            'monto_dolares' => $resultado5,
            'maximo_dolares' => $resultado6,
            'minimo_dolares' => $resultado7,
            'valor_dolar' => $resultado8,
        ]);

        //########## SE CREAN DIRECTORIOS VACÍOS ###################

        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/niveles servicio')) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/niveles servicio');
            Storage::copy('public/contratos/.gitignore', 'public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/niveles servicio');
        }
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/entregables mensuales')) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/entregables mensuales');
            Storage::copy('public/contratos/.gitignore', 'public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/entregables mensuales');
        }
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/cierre contrato')) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/cierre contrato');
        }
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/facturas/pdf')) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/facturas/pdf');
        }
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/facturas/xml')) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/facturas/xml');
        }

        //############# GESTIÓN ARCHIVOS ##################

        $file = $request->file('documento');
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato)) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato);
        }

        if ($file != null) {
            $nombre = $file->getClientOriginalName();

            if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/penalizaciones')) {
                Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/penalizaciones');
            }

            $ruta = 'contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/penalizaciones';

            // Guardar el archivo en el disco 'public' con la ruta específica
            Storage::disk('public')->put($ruta.'/'.$contrato->id.$fecha_inicio.$nombre, file_get_contents($file));

            $ruta_carpeta = storage_path('app/public/'.$ruta);

            // Dar permisos chmod 777 a la carpeta
            chmod($ruta_carpeta, 0777);

            $contratos = Contrato::find($contrato->id);
            $contratos->documento = $contrato->id.$fecha_inicio.$nombre;
            $contratos->save();
        }

        $ruta_file_contrato = null;
        $nombre_f = null;
        if ($request->file('file_contrato') != null) {
            $nombre = $request->file('file_contrato')->getClientOriginalName();
            $nombre_f = $contrato->id.$fecha_inicio.$nombre;

            $file = $request->file('file_contrato');

            // Ruta completa donde se guardará el archivo
            $ruta = 'contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato;

            // Guardar el archivo en el disco 'public' con la ruta específica
            Storage::disk('public')->put($ruta.'/'.$nombre_f, file_get_contents($file));

            $ruta_carpeta = storage_path('app/public/'.$ruta);

            // Dar permisos chmod 777 a la carpeta
            chmod($ruta_carpeta, 0777);
        }

        // Move file from tmp directory if name is send
        if ($request->file_contrato) {
            if (Storage::disk('local')->exists('katbol-contratos-tmp/'.$request->file_contrato)) {
                $nombre_f = $contrato->id.$fecha_inicio.$request->file_contrato;
                Storage::move('katbol-contratos-tmp/'.$request->file_contrato, "public/contratos/{$contrato->id}_contrato_{$contrato->no_contrato}/{$nombre_f}");
                // Storage::disk('local')->delete("katbol-contratos-tmp/{$request->file_contrato}");
            }
        }
        $contrato->update([
            'file_contrato' => $nombre_f,
        ]);

        //############# FIN REESTRUCTURACION DE ARCHIVOS ##################

        // $dataEnt = new EntregablesData();
        // $res = $dataEnt->TraerDatos($contrato->id);

        // EntregaMensual::insert($res);

        $dataCieCont = new CierreContratoData;
        $cie = $dataCieCont->TraerDatos($contrato->id);

        CierreContrato::insert($cie);

        CedulaCumplimiento::create([
            'contrato_id' => $contrato->id,
            'elaboro' => '',
            'reviso' => '',
            'autorizo' => '',
            'cumple' => true,
        ]);

        // aprobadores
        if (isset($request->aprobadores_firma)) {
            foreach ($request->aprobadores_firma as $aprobador_id) {
                $aprobador_firma_contrato = AprobadorFirmaContrato::create([
                    'contrato_id' => $contrato->id,
                    'aprobador_id' => $aprobador_id,
                    'solicitante_id' => User::getCurrentUser()->empleado->id,
                ]);

                if (isset($aprobador_firma_contrato->aprobador->email)) {

                    try {
                        Mail::to(removeUnicodeCharacters($aprobador_firma_contrato->aprobador->email))->queue(new AprobadorFirmaContratoMail($aprobador_firma_contrato));
                    } catch (\Throwable $th) {
                    }
                }
            }
        }
        $aprobador_firma_contrato_historico = AprobadorFirmaContratoHistorico::create([
            'contrato_id' => $contrato->id,
            'solicitante_id' => User::getCurrentUser()->empleado->id,
            'empleado_update_id' => User::getCurrentUser()->empleado->id,
            'firma_check' => isset($request->firma_check) ? true : false,
        ]);

        //return redirect(route('contratos.index'));
        return redirect('contract_manager/contratos-katbol/contratoinsert/'.$contrato->id);
    }

    /**
     * Display the specified Contratos.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $contrato = $this->contratoRepository->find($id);
            $formatoFecha = new FormatearFecha;
            $organizacion = Organizacion::getFirst();
            $areas = Area::getIdNameAll();
            if (! $contrato) {
                return redirect()->route('contract_manager.contratos-katbol.index')->with('error', 'Ocurrio un error.');
            }
            $proveedor_id = $contrato->proveedor_id;
            $contratos = Contrato::with('ampliaciones')->find($id);
            $proveedores = TimesheetCliente::get();
            $contrato->fecha_inicio = $contrato->fecha_inicio;
            $contrato->fecha_fin = $contrato->fecha_fin;
            $contrato->fecha_firma = $contrato->fecha_firma;
            $descargar_archivo =
                '/public/storage/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/'.$contrato->file_contrato;
            $convenios = ConveniosModificatorios::where('contrato_id', '=', $contratos->id)->get();
            $dolares = DolaresContrato::where('contrato_id', $id)->first();

            $proyectos = TimesheetProyecto::getAll()->where('estatus', 'proceso');

            $razones_sociales = Sucursal::getArchivoFalse();

            // aprobadores
            $aprobacionFirmaContrato = AprobadorFirmaContrato::where('contrato_id', $id)->get();
            $firmar = false;
            $firmado = false;
            foreach ($aprobacionFirmaContrato as $firma_item) {
                if ($firma_item->aprobador_id == User::getCurrentUser()->empleado->id) {
                    if (! isset($firma_item->firma)) {
                        $firmar = true;
                    }
                }
                if ($firma_item->firma) {
                    $firmado = true;
                }
            }

            return view('contract_manager.contratos-katbol.show', compact('razones_sociales', 'proveedor_id', 'dolares', 'areas', 'proyectos', 'aprobacionFirmaContrato', 'firmar', 'firmado'))->with('contrato', $contrato)->with('proveedores', $proveedores)->with('contratos', $contratos)->with('ids', $id)->with('descargar_archivo', $descargar_archivo)->with('convenios', $convenios)->with('organizacion', $organizacion);
        } catch (\Exception $e) {
            return redirect()->route('contract_manager.contratos-katbol.index')->with('error', 'Ocurrio un error.');
        }
    }

    public function aprobacionFirma(Request $request)
    {

        $contrato = Contrato::find($request->contrato_id);

        $aprobacionFirmaContrato = AprobadorFirmaContrato::where('contrato_id', $request->contrato_id)->where('aprobador_id', User::getCurrentUser()->empleado->id)->first();

        $base64Image = $request->firma_base;

        // Eliminar el prefijo 'data:image/png;base64,' si existe
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]); // png, jpg, gif

            if (! in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('Tipo de imagen inválido');
            }
        } else {
            throw new \Exception('Datos de imagen base64 inválidos');
        }

        // Decodificar la cadena Base64
        $image = base64_decode($base64Image);

        if (strpos($base64Image, 'data:image/') === 0) {
            [$type, $base64Image] = explode(';', $base64Image);
            [, $base64Image] = explode(',', $base64Image);
        }

        // Generar un nombre único para la imagen
        $imageName = uniqid().'.'.$type;
        // Guardar la imagen en el sistema de archivos

        $ruta_carpeta = storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/aprobacionFirma');

        Storage::put('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/aprobacionFirma/'.$imageName, $image);

        // Dar permisos chmod 777 a la carpeta
        chmod($ruta_carpeta, 0777);

        // Obtener la URL de la imagen guardada
        $imageUrl = Storage::url('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/aprobacionFirma/'.$imageName);

        $aprobacionFirmaContrato->update([
            'firma' => $imageName,
        ]);

        return redirect('contract_manager/contratos-katbol/contratoinsert/'.$contrato->id);
    }

    public function historicoAprobacion()
    {
        $aprobaciones_historico = AprobadorFirmaContratoHistorico::get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('contract_manager.contratos-katbol.aprobacion-firma-historico', compact('aprobaciones_historico', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    /**
     * Show the form for editing the specified Contratos.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            abort_if(Gate::denies('katbol_contratos_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $contrato = $this->contratoRepository->find($id);
            $areas = Area::getAll();
            // dd($areas->count());
            $formatoFecha = new FormatearFecha;
            if (! $contrato) {
                return redirect()->route('contract_manager.contratos-katbol.index')->with('error', 'Ocurrio un error.');
            }
            $proveedor_id = $contrato->proveedor_id;
            $contratos = Contrato::with('ampliaciones', 'dolares')->find($id);
            // dd($contratos);
            $proveedores = TimesheetCliente::get();
            if (! is_null($contrato->fecha_inicio)) {
                $contrato->fecha_inicio = $contrato->fecha_inicio;
            }
            if (! is_null($contrato->fecha_fin)) {
                $contrato->fecha_fin = $contrato->fecha_fin;
            }
            if (! is_null($contrato->fecha_firma)) {
                $contrato->fecha_firma = $contrato->fecha_firma;
            } else {
                $fecha_firma = null;
            }

            $descargar_archivo = '/public/storage/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/'.$contrato->file_contrato;

            $convenios = ConveniosModificatorios::where('contrato_id', '=', $contratos->id)->get();
            // dd($convenios);
            $dolares = DolaresContrato::where('contrato_id', $id)->first();

            $organizacion = Organizacion::getFirst();

            $proyectos = TimesheetProyecto::getAll()->where('estatus', 'proceso');

            $razones_sociales = Sucursal::getArchivoFalse();

            // firmas aprobadores
            $firma = FirmaModule::where('modulo_id', '2')->where('submodulo_id', '7')->first();
            // dd($firma->aprobadores);
            // $exampleVar = $firma->aprobadores[0];
            $aprobacionFirmaContrato = AprobadorFirmaContrato::where('contrato_id', $contrato->id)->get();
            $firmar = false;
            $firmado = false;
            foreach ($aprobacionFirmaContrato as $firma_item) {
                if ($firma_item->aprobador_id == User::getCurrentUser()->empleado->id) {
                    if (! isset($firma_item->firma)) {
                        $firmar = true;
                    }
                }
                if ($firma_item->firma) {
                    $firmado = true;
                }
            }
            $aprobacionFirmaContratoHisotricoLast = AprobadorFirmaContratoHistorico::where('contrato_id', $contrato->id)->orderBy('id', 'DESC')->first();

            return view('contract_manager.contratos-katbol.edit', compact('razones_sociales','proyectos', 'proveedor_id', 'dolares', 'organizacion', 'areas', 'firma', 'firmar', 'firmado', 'aprobacionFirmaContrato', 'aprobacionFirmaContratoHisotricoLast'))->with('contrato', $contrato)->with('proveedores', $proveedores)->with('contratos', $contratos)->with('ids', $id)->with('descargar_archivo', $descargar_archivo)->with('convenios', $convenios)->with('organizacion', $organizacion);
        } catch (\Exception $e) {
            return redirect()->route('contract_manager.contratos-katbol.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified Contratos in storage.
     *
     * @param  int  $id
     * @param  UpdateContratoRequest  $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'no_contrato' => ['required', new NumeroContrato($id)],
            'no_proyecto' => 'required',
            'nombre_servicio' => 'required|max:500',
            'tipo_contrato' => 'required',
            'proveedor_id' => 'required',
            'objetivo' => 'required|max:500',
            'estatus' => 'required|max:255',
            //  'file_contrato' => 'required',
            'cargo_administrador' => 'max:250',
            'area_administrador' => 'max:250',
            'puesto' => 'max:250',
            'area' => 'max:250',
            'fase' => 'required',
            'vigencia_contrato' => 'required|max:255',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required|after:fecha_inicio',
            'area_id' => 'required',
            // 'fecha_firma' => 'after:fecha_fin|before:fecha_inicio',
            'fecha_firma' => 'required|before_or_equal:fecha_fin',
            'no_pagos' => ['required', 'numeric', 'lte:500000'],
            'tipo_cambio' => 'required',
            'monto_pago' => ['required', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
            'minimo' => ['nullable', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
            'maximo' => ['nullable', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
        ], [
            'monto_pago.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'maximo.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'minimo.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'fecha_firma.before_or_equal' => 'La fecha firma no puede ser después de la fecha inicio del contrato',
        ]);

        $resultado = null;
        $resultado2 = null;
        $resultado3 = null;
        $resultado4 = null;
        $resultado5 = null;
        $resultado6 = null;
        $resultado7 = null;
        $resultado8 = null;

        if (isset($request->monto_pago)) {
            $resultado = str_replace('$', '', $request->monto_pago);
            $resultado2 = str_replace(',', '', $resultado);
        }

        if (isset($request->minimo)) {
            $resultado = str_replace('$', '', $request->minimo);
            $resultado3 = str_replace(',', '', $resultado);
        }

        if (isset($request->maximo)) {
            $resultado = str_replace('$', '', $request->maximo);
            $resultado4 = str_replace(',', '', $resultado);
        }

        if (isset($request->monto_dolares)) {
            $resultado = str_replace('$', '', $request->monto_dolares);
            $resultado5 = str_replace(',', '', $resultado);
        }

        if (isset($request->maximo_dolares)) {
            $resultado = str_replace('$', '', $request->maximo_dolares);
            $resultado6 = str_replace(',', '', $resultado);
        }

        if (isset($request->minimo_dolares)) {
            $resultado = str_replace('$', '', $request->minimo_dolares);
            $resultado7 = str_replace(',', '', $resultado);
        }

        if (isset($request->valor_dolar)) {
            $resultado = str_replace('$', '', $request->valor_dolar);
            $resultado8 = str_replace(',', '', $resultado);
        }

        // if ($request->cumple == 'on') {
        //     $request->merge(['cumple' => "Si"]);
        // } elseif (isset($request->cumple)) {
        //     $request->merge(['cumple' => NULL]);
        // } else {
        //     $request->merge(['cumple' => NULL]);
        // }

        $contrato = $this->contratoRepository->find($id);

        if (! $contrato) {
            return redirect()->route('contract_manager.contratos-katbol.index')->with('error', 'Ocurrio un error.');
        }

        $formatoFecha = new FormatearFecha;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        if ($request->fecha_firma != null) {
            $fecha_firma = $request->fecha_firma;
        } else {
            $fecha_firma = null;
        }

        //#Cambiar nombre de carpeta
        if ($contrato->no_contrato != $request->no_contrato) {
            if (Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato)) {
                Storage::move('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato, 'public/contratos/'.$contrato->id.'_contrato_'.$request->no_contrato); //rename folder
            }
        }
        $no_contrato_sin_slashes = preg_replace('[/]', '-', $request->no_contrato);
        //### RESTRUCTURACION DE CARPETAS UPDATE #############

        $areas = Area::getIdNameAll();

        $proyecto = TimesheetProyecto::select('id', 'identificador')->where('identificador', $request->no_proyecto)->first();

        $contrato = $this->contratoRepository->update([
            'tipo_contrato' => $request->tipo_contrato,
            'no_contrato' => $no_contrato_sin_slashes,
            'nombre_servicio' => $request->nombre_servicio,
            'proveedor_id' => $request->proveedor_id,
            'objetivo' => $request->objetivo,
            'vigencia_contrato' => $request->vigencia_contrato,
            'estatus' => $request->estatus,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'administrador_contrato' => $request->administrador_contrato,
            'cargo_administrador' => $request->cargo_administrador,
            'fecha_firma' => $fecha_firma,
            'no_pagos' => $request->no_pagos,
            'monto_pago' => $resultado2,
            'minimo' => $resultado3,
            'maximo' => $resultado4,
            'fase' => $request->fase,
            'pmp_asignado' => $request->pmp_asignado,
            'puesto' => $request->puesto,
            'area' => $request->area,
            'folio' => $request->folio,
            'tipo_cambio' => $request->tipo_cambio,
            'area_id' => $areas->count() > 0 ? $request->area_id : null,
            'area_administrador' => $request->area_administrador,
            'no_proyecto' => $request->no_proyecto,
            'updated_by' => User::getCurrentUser()->empleado->id,
        ], $id);

        $convergencia = ConvergenciaContratos::where('contrato_id', $contrato->id)->first();

        if (isset($convergencia)) {
            $convergencia->update([
                'timesheet_proyecto_id' => $proyecto->id,
                'timesheet_cliente_id' => $request->proveedor_id,
            ]);
        }

        $dolares = DolaresContrato::where('contrato_id', $id)->first();
        if ($dolares) {
            $dolares->update([
                'monto_dolares' => $resultado5,
                'maximo_dolares' => $resultado6,
                'minimo_dolares' => $resultado7,
                'valor_dolar' => $resultado8,
            ]);
        } else {
            $dolares = DolaresContrato::create([
                'contrato_id' => $id,
                'monto_dolares' => $resultado5,
                'maximo_dolares' => $resultado6,
                'minimo_dolares' => $resultado7,
                'valor_dolar' => $resultado8,
            ]);
        }

        $ruta_file_contrato = null;
        $nombre_f = $contrato->file_contrato;
        if ($request->file('file_contrato') != null) {
            $storagePath = 'public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato;
            $currentFilePath = $storagePath.'/'.$contrato->file_contrato;

            // Verificar si el archivo ya existe y eliminarlo
            if (Storage::disk('public')->exists($currentFilePath)) {
                Storage::disk('public')->delete($currentFilePath);
            }

            // Obtener el nombre original del archivo
            $nombre = $request->file('file_contrato')->getClientOriginalName();
            $nombre_f = $contrato->id.$fecha_inicio.$nombre;

            $ruta = 'contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato;

            // Guardar el archivo en el disco 'public' con la ruta específica
            Storage::disk('public')->put($ruta.'/'.$nombre_f, file_get_contents($request->file('file_contrato')));

            $ruta_carpeta = storage_path('app/public/'.$ruta);

            // Dar permisos chmod 777 a la carpeta
            chmod($ruta_carpeta, 0777);

            // $ruta_file_contrato = Storage::url($archivo);
            $contrato->update([
                'file_contrato' => $nombre_f,
            ]);
        }

        // dd($request->file('documento'));

        $file = $request->file('documento');
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato)) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato);
        }
        if ($file != null) {
            $isExists = Storage::disk('public')->exists('contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/penalizaciones'.'/'.$contrato->documento);
            if ($isExists) {
                if ($contrato->documento != null) {
                    unlink(storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/penalizaciones'.'/'.$contrato->documento));
                }
            }
            $nombre = $file->getClientOriginalName();

            if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/penalizaciones')) {
                Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/penalizaciones');
            }

            $ruta = 'contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/penalizaciones';

            // Guardar el archivo en el disco 'public' con la ruta específica
            Storage::disk('public')->put($ruta.'/'.$contrato->id.$fecha_inicio.$nombre, file_get_contents($file));

            $ruta_carpeta = storage_path('app/public/'.$ruta);

            // Dar permisos chmod 777 a la carpeta
            chmod($ruta_carpeta, 0777);

            $contratos = Contrato::find($contrato->id);
            $contratos->documento = $contrato->id.$fecha_inicio.$nombre;
            $contratos->save();
        }

        // aprobadores
        if (isset($request->aprobadores_firma) && isset($request->firma_check)) {
            $aprobacionFirmaContrato = AprobadorFirmaContrato::where('contrato_id', $contrato->id)->get();
            foreach ($aprobacionFirmaContrato as $aprobador_old) {
                $aprobador_old->delete();
            }
            foreach ($request->aprobadores_firma as $aprobador_id) {
                $aprobador_firma_contrato = AprobadorFirmaContrato::create([
                    'contrato_id' => $contrato->id,
                    'aprobador_id' => $aprobador_id,
                    'solicitante_id' => User::getCurrentUser()->empleado->id,
                ]);

                if (isset($aprobador_firma_contrato->aprobador->email)) {

                    try {
                        Mail::to(removeUnicodeCharacters($aprobador_firma_contrato->aprobador->email))->queue(new AprobadorFirmaContratoMail($aprobador_firma_contrato));
                    } catch (\Throwable $th) {
                    }
                }
            }
        }
        $aprobador_firma_contrato_historico = AprobadorFirmaContratoHistorico::create([
            'contrato_id' => $contrato->id,
            'solicitante_id' => User::getCurrentUser()->empleado->id,
            'empleado_update_id' => User::getCurrentUser()->empleado->id,
            'firma_check' => isset($request->firma_check) ? true : false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => '¡Contrato actualizado correctamente!',
        ]);
        // return redirect(route('contract_manager.contratos-katbol.index'));
    }

    /**
     * Remove the specified Contratos from storage.
     *
     * @param  int  $id
     * @return Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('katbol_contratos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = $this->contratoRepository->find($id);

        if (empty($contrato)) {
            // notify()->error('¡Se ha actualizado la información del contrato satisfactoriamente!');

            return redirect(route('contract_manager.contratos-katbol.index'));
        }

        $this->contratoRepository->delete($id);
        // notify()->success('¡Se ha eliminado la información del contrato satisfactoriamente.!');

        return redirect(route('contract_manager.contratos-katbol.index'));
    }

    public function Campos(Request $request, $id)
    {
        if ($request->ajax()) {
            switch ($request->name) {
                case 'no_pagos':
                    $gapun = Contrato::findOrFail($id);
                    $gapun->no_pagos = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'tipo_contrato':
                    $gapun = Contrato::findOrFail($id);
                    $gapun->tipo_contrato = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'nombre_servicio':
                    $gapun = Contrato::findOrFail($id);
                    $gapun->nombre_servicio = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
            }
        }

        /*$planaccionCorrectiva->update($request->all());
        return redirect()->route('admin.planaccion-correctivas.index');*/
    }

    public function revisarSiNumeroContratoExiste(Request $request)
    {
        if (isset($request->id_contrato)) {
            $id_contrato = $request->id_contrato;
            $no_contrato = $request->no_contrato;
            $pertenece_no_contrato_editable = Contrato::where('id', '=', $id_contrato)->where('no_contrato', '=', $no_contrato)->exists();

            if ($no_contrato != '' || $no_contrato != null) {
                $existeNumeroContrato = Contrato::where('no_contrato', '=', $no_contrato)->exists();

                return ['existe' => $existeNumeroContrato, 'pertenece' => $pertenece_no_contrato_editable];
            }
        } else {
            $no_contrato = $request->no_contrato;
            if ($no_contrato != '' || $no_contrato != null) {
                $existeNumeroContrato = Contrato::where('no_contrato', '=', $no_contrato)->exists();

                return ['existe' => $existeNumeroContrato];
            }
        }

        return 0;
    }

    public function updateAmpliacion(Request $request, $id)
    {
        abort_if(Gate::denies('katbol_contratos_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $is_ampliado = $request->ampliado; // 0 -> no ampliado, 1 -> ampliado
        $contrato = Contrato::find($id);
        $usuario = User::getCurrentUser();
        if ($is_ampliado) {
            $contrato->update([
                'contrato_ampliado' => $is_ampliado,
                'updated_by' => $usuario->empleado->id,
            ]);
        } else {
            $contrato->update([
                'contrato_ampliado' => $is_ampliado,
                'updated_by' => $usuario->empleado->id,
            ]);
        }

        return response()->json(['success' => $is_ampliado]);
    }

    public function updateConvenios(Request $request, $id)
    {
        // $this->authorize('haveaccess', 'contratos.edit');
        $is_convenio = $request->convenio; // 0 -> no convenios, 1 -> convenios
        $contrato = Contrato::find($id);
        $usuario = User::getCurrentUser();
        if ($is_convenio) {
            $contrato->update([
                'convenio_modificatorio' => $is_convenio,
                'updated_by' => $usuario->empleado->id,
            ]);
        } else {
            $contrato->update([
                'convenio_modificatorio' => $is_convenio,
                'updated_by' => $usuario->empleado->id,
            ]);
        }

        return response()->json(['success' => $is_convenio]);
    }

    public function uploadInTmpDirectory(Request $request)
    {
        // dd(Storage::disk('local')->exists('katbol-contratos-tmp/KaZoUut5PEQV81GC0Saw79Tt2K3eFvdlQ39ATXAY.pdf'));
        $organizacion = Organizacion::getFirst();

        $mines = str_replace('.', '', $organizacion ? $organizacion->formatos : '.docx,.pdf,.doc,.xlsx,.pptx,.txt');

        $tamaño_limite = ($organizacion->config_megas_permitido_docs) * 1024;

        $request->validate([
            'file' => 'required|mimes:'.$mines.'|max:'.$tamaño_limite,
        ]);
        $storagePath = Storage::disk('local')->put('katbol-contratos-tmp/', $request->file);
        $storageName = basename($storagePath);

        return response()->json(['status' => 'success', 'fileName' => $storageName]);
    }

    public function validateDocument(Request $request)
    {
        // $organizacion = Organizacion::first();

        // $mines = str_replace('.', '', $organizacion ? $organizacion->formatos : '.docx,.pdf,.doc,.xlsx,.pptx,.txt');

        // $tamaño_limite = ($organizacion->config_megas_permitido_docs) * 1024;

        // $request->validate([
        //     'file' => 'required|mimes:'.$mines.'|max:'.$tamaño_limite,
        // ]);

        return response()->json(['status' => 'success']);
    }

    public function exportTo()
    {
        // abort_if(AccessGate::denies('configuracion_area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd('Hola');
        return Excel::download(new ReporteClienteExport, 'cliente.xlsx');
    }

    // public function downloadFile(Request $request){
    //     // dd($request->file_contrato);
    //     // $file = '/7factura-0.pdf';
    //     // $path = '/app/public/contratos/1_contrato_01/entregables/pdf';

    //     return response()->download(storage_path($path.$file));

    // }

    public function obtenerArchivos(Request $request)
    {
        $contrato_id = $request->contratoId;

        $contrato = Contrato::find($contrato_id);
        $facturas = Factura::where('contrato_id', $contrato_id)->get();
        $entregables = EntregaMensual::where('contrato_id', $contrato_id)->get();
        $convenios = ConveniosModificatorios::where('contrato_id', $contrato_id)->get();

        return response()->json([
            'contrato' => $contrato,
            'facturas' => $facturas,
            'entregables' => $entregables,
            'convenios' => $convenios,
        ]);
    }

    public function checkCode(Request $request)
    {
        if ($request->ajax()) {
            $no_contrato = $request->no_contrato;
            $documentoExists = Contrato::where('no_contrato', '=', $no_contrato)->exists();
            if ($documentoExists) {
                return response()->json(['exists' => true]);
            } else {
                return response()->json(['exists' => false]);
            }
        }
    }

    public function evaluacion($id)
    {
        return view('contract_manager.contratos-katbol.evaluacion')->with('ids', $id);
    }
}
