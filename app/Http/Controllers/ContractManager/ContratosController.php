<?php

namespace App\Http\Controllers\ContractManager;

use App\Exports\ReporteClienteExport;
use App\Functions\CierreContratoData;
use App\Functions\EntregablesData;
use App\Functions\FormatearFecha;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use App\Models\Area;
use App\Models\ContractManager\CedulaCumplimiento;
use App\Models\ContractManager\CierreContrato;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\ConveniosModificatorios;
use App\Models\ContractManager\DolaresContrato;
use App\Models\ContractManager\EntregaMensual;
use App\Models\ContractManager\Factura;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\TimesheetCliente;
use App\Models\User;
use App\Repositories\ContratoRepository;
use App\Rules\NumeroContrato;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class ContratosController extends AppBaseController
{
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
        abort_if(Gate::denies('katbol_contratos_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario_actual = Empleado::getAll()->find(User::getCurrentUser()->empleado->id);
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
        // $dolares = DolaresContrato::where('contrato_id', $id)->first();
        $dolares = null;
        $proveedores = TimesheetCliente::select('id', 'razon_social', 'nombre')->get();

        return view('contract_manager.contratos-katbol.create', compact('dolares', 'organizacion', 'areas'))->with('proveedores', $proveedores)->with('contratos', $contratos);
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
            'no_contrato' => 'required_unless:identificador_privado,1|max:255',
            'nombre_servicio' => 'required|max:255',
            'tipo_contrato' => 'required',
            'proveedor_id' => 'required',
            'area_id' => 'required',
            'objetivo' => 'required|max:255',
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
            'fecha_firma' => 'required|after_or_equal:fecha_inicio|before_or_equal:fecha_fin',
            'no_pagos' => ['required', 'numeric', 'lte:500000'],
            'tipo_cambio' => 'required',
            'monto_pago' => ['required', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
            'minimo' => ['nullable', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/", 'required'],
            'maximo' => ['nullable', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/", 'required'],
            'pmp_asignado' => 'required',
            // 'signed' => 'required',
        ], [
            'monto_pago.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'maximo.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'minimo.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
            'fecha_firma.before_or_equal' => 'La fecha firma no puede ser después de la fecha inicio del contrato',
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
            $no_contrato_sin_slashes = 'privado' . '' . $ultimo_id->id + 1 . '-' . $date;
        }
        $no_contrato_sin_slashes = preg_replace('[/]', '-', $request->no_contrato);

        if ($request->identificador_privado == true) {
            $num_contrato = 'privado' . '-' . $ultimo_id->id + 1 . '-' . $date;
        } else {
            $num_contrato = $no_contrato_sin_slashes;
        }

        // forma de contrato
        // $folderPath = storage_path('app/firmas/');

        // $image_parts = explode(";base64,", $request->signed);

        // $image_type_aux = explode("image/", $image_parts[0]);

        // $image_type = $image_type_aux[1];

        // $image_base64 = base64_decode($image_parts[1]);

        // $firma = uniqid() . '.'.$image_type;

        // $file = $folderPath . $firma;

        // file_put_contents($file, $image_base64);

        // dd($firma, $file);

        // dd($this->contratoRepository);
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
            'file_contrato' => null,
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
        ], $input);

        // dd($contrato);

        $dolares = DolaresContrato::create([
            'contrato_id' => $contrato->id,
            'monto_dolares' => $resultado5,
            'maximo_dolares' => $resultado6,
            'minimo_dolares' => $resultado7,
            'valor_dolar' => $resultado8,
        ]);

        //########## SE CREAN DIRECTORIOS VACÍOS ###################

        if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/niveles servicio')) {
            Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/niveles servicio');
            Storage::copy('public/contratos/.gitignore', 'public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/niveles servicio');
        }
        if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/entregables mensuales')) {
            Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/entregables mensuales');
            Storage::copy('public/contratos/.gitignore', 'public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/entregables mensuales');
        }
        if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/cierre contrato')) {
            Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/cierre contrato');
        }
        if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/pdf')) {
            Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/pdf');
        }
        if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/xml')) {
            Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/xml');
        }

        // firma
        // if(File::exists($file)){
        //     Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/firmas');
        //     $newfile = storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/firmas/'.$contrato->firma1);
        //     // $newfile = storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/firmas');
        //     File::move($file, $newfile);
        // }
        //############## FIN ##############################

        //############# GESTIÓN ARCHIVOS ##################
        $file = $request->file('documento');
        if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato)) {
            Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato);
        }

        if ($file != null) {
            $nombre = $file->getClientOriginalName();

            if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones')) {
                Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones');
            }
            $file->storeAs('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones', $contrato->id . $fecha_inicio . $nombre);
            $contratos = Contrato::find($contrato->id);
            $contratos->documento = $contrato->id . $fecha_inicio . $nombre;
            $contratos->save();
        }

        $ruta_file_contrato = null;
        $nombre_f = null;
        if ($request->file('file_contrato') != null) {
            $nombre = $request->file('file_contrato')->getClientOriginalName();
            $nombre_f = $contrato->id . $fecha_inicio . $nombre;
            // dd($request->file('file_contrato'), $contrato->id, $contrato->no_contrato, $nombre_f);
            $archivo =
                $request->file('file_contrato')
                ->storeAs(trim('public/contratos/' . $contrato->id .
                    '_contrato_' . $contrato->no_contrato, $nombre_f .
                    '/entregables mensuales'), $nombre_f);
            // $ruta_file_contrato = Storage::url($archivo);
        }
        // Move file from tmp directory if name is send
        if ($request->file_contrato) {
            if (Storage::disk('local')->exists('katbol-contratos-tmp/' . $request->file_contrato)) {
                $nombre_f = $contrato->id . $fecha_inicio . $request->file_contrato;
                Storage::move('katbol-contratos-tmp/' . $request->file_contrato, "public/contratos/{$contrato->id}_contrato_{$contrato->no_contrato}/{$nombre_f}");
                // Storage::disk('local')->delete("katbol-contratos-tmp/{$request->file_contrato}");
            }
        }
        $contrato->update([
            'file_contrato' => $nombre_f,
        ]);
        // dd($contrato->nombre_f);

        //############# FIN REESTRUCTURACION DE ARCHIVOS ##################

        // $dataEnt = new EntregablesData();
        // $res = $dataEnt->TraerDatos($contrato->id);

        // EntregaMensual::insert($res);

        $dataCieCont = new CierreContratoData();
        $cie = $dataCieCont->TraerDatos($contrato->id);

        CierreContrato::insert($cie);

        CedulaCumplimiento::create([
            'contrato_id' => $contrato->id,
            'elaboro' => '',
            'reviso' => '',
            'autorizo' => '',
            'cumple' => true,
        ]);

        // dd('Guarda todo bien');
        // notify()->success('¡El registro fue cargado exitosamente!');

        //return redirect(route('contratos.index'));
        return redirect('contract_manager/contratos-katbol/contratoinsert/' . $contrato->id);
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
            if (empty($contrato)) {
                // notify()->error('¡El registro no fue encontrado!');

                return redirect(route('contract_manager.contratos-katbol.index'));
            }
            $proveedor_id = $contrato->proveedor_id;
            $contratos = Contrato::with('ampliaciones')->find($id);
            $proveedores = TimesheetCliente::get();
            $contrato->fecha_inicio = $contrato->fecha_inicio;
            $contrato->fecha_fin = $contrato->fecha_fin;
            $contrato->fecha_firma = $contrato->fecha_firma;
            $descargar_archivo =
                '/public/storage/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/' . $contrato->file_contrato;
            $convenios = ConveniosModificatorios::where('contrato_id', '=', $contratos->id)->get();
            $dolares = DolaresContrato::where('contrato_id', $id)->first();

            //dd($descargar_archivo);
            return view('contract_manager.contratos-katbol.show', compact('proveedor_id', 'dolares', 'areas'))->with('contrato', $contrato)->with('proveedores', $proveedores)->with('contratos', $contratos)->with('ids', $id)->with('descargar_archivo', $descargar_archivo)->with('convenios', $convenios)->with('organizacion', $organizacion);
        } catch (\Exception $e) {
            return redirect()->route('contract_manager.contratos-katbol.index')->with('error', $e->getMessage());
        }
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
            if (empty($contrato)) {
                // toastr()->error('Contratos not found.');

                return redirect(route('contract_manager.contratos-katbol.index'));
            }
            $proveedor_id = $contrato->proveedor_id;
            $contratos = Contrato::with('ampliaciones', 'dolares')->find($id);
            // dd($contratos);
            $proveedores = TimesheetCliente::get();
            if (!is_null($contrato->fecha_inicio)) {
                $contrato->fecha_inicio = $contrato->fecha_inicio;
            }
            if (!is_null($contrato->fecha_fin)) {
                $contrato->fecha_fin = $contrato->fecha_fin;
            }
            if (!is_null($contrato->fecha_firma)) {
                $contrato->fecha_firma = $contrato->fecha_firma;
            } else {
                $fecha_firma = null;
            }

            $descargar_archivo = '/public/storage/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/' . $contrato->file_contrato;

            $convenios = ConveniosModificatorios::where('contrato_id', '=', $contratos->id)->get();
            // dd($convenios);
            $dolares = DolaresContrato::where('contrato_id', $id)->first();

            $organizacion = Organizacion::getFirst();

            return view('contract_manager.contratos-katbol.edit', compact('proveedor_id', 'dolares', 'organizacion', 'areas'))->with('contrato', $contrato)->with('proveedores', $proveedores)->with('contratos', $contratos)->with('ids', $id)->with('descargar_archivo', $descargar_archivo)->with('convenios', $convenios)->with('organizacion', $organizacion);
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
        // dd($request->signed);
        $validatedData = $request->validate([
            'no_contrato' => ['required|max:255', new NumeroContrato($id)],
            'nombre_servicio' => 'required|max:255',
            'tipo_contrato' => 'required',
            'proveedor_id' => 'required',
            'objetivo' => 'required|max:255',
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
            'fecha_firma' => 'required|after_or_equal:fecha_inicio|before_or_equal:fecha_fin',
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
            'fecha_firma.after_or_equal' => 'La fecha firma no puede ser antes de la fecha inicio del contrato',

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

        if (empty($contrato)) {
            // notify()->error('¡Contrato not found!');

            return redirect(route('contract_manager.contratos-katbol.index'));
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
            if (Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato)) {
                Storage::move('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato, 'public/contratos/' . $contrato->id . '_contrato_' . $request->no_contrato); //rename folder
            }
        }
        $no_contrato_sin_slashes = preg_replace('[/]', '-', $request->no_contrato);
        //### RESTRUCTURACION DE CARPETAS UPDATE #############

        $areas = Area::getIdNameAll();

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

        // firma
        // if($request->signed != null){
        //     $ruta_firma_ant = storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/firmas/'.$contrato->firma1);
        //     if(File::exists($ruta_firma_ant)){
        //         // dd($ruta_firma_ant);
        //         File::delete($ruta_firma_ant);

        //         $folderPath = storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/firmas/');
        //         $image_parts = explode(";base64,", $request->signed);
        //         $image_type_aux = explode("image/", $image_parts[0]);
        //         $image_type = $image_type_aux[1];
        //         $image_base64 = base64_decode($image_parts[1]);
        //         $firma = uniqid() . '.'.$image_type;
        //         $file = $folderPath . $firma;

        //         file_put_contents($file, $image_base64);

        //         $contrato = $this->contratoRepository->update([
        //             'firma1' => $firma,
        //         ], $id);
        //     }
        // }

        $ruta_file_contrato = null;
        $nombre_f = $contrato->file_contrato;
        if ($request->file('file_contrato') != null) {
            //esto agregamos 25-03-2021//
            $isExists = Storage::disk('public')->exists('contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/' . $contrato->file_contrato);
            if ($isExists) {
                if ($contrato->file_contrato != null) {
                    //dd(Storage::disk('public'));
                    unlink(storage_path('app/public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/' . $contrato->file_contrato));
                }
            }

            $nombre = $request->file('file_contrato')->getClientOriginalName();
            $nombre_f = $contrato->id . $fecha_inicio . $nombre;
            $archivo = $request->file('file_contrato')->storeAs('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato, $nombre_f);
            // $ruta_file_contrato = Storage::url($archivo);
            $contrato->update([
                'file_contrato' => $nombre_f,
            ]);
        }

        // dd($request->file('documento'));

        $file = $request->file('documento');
        if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato)) {
            Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato);
        }
        if ($file != null) {
            $isExists = Storage::disk('public')->exists('contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones' . '/' . $contrato->documento);
            if ($isExists) {
                if ($contrato->documento != null) {
                    //dd(Storage::disk('public'));
                    unlink(storage_path('app/public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones' . '/' . $contrato->documento));
                }
            }
            $nombre = $file->getClientOriginalName();

            if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones')) {
                Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones');
            }

            $file->storeAs('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones', $contrato->id . $fecha_inicio . $nombre);
            $contratos = Contrato::find($contrato->id);
            $contratos->documento = $contrato->id . $fecha_inicio . $nombre;
            $contratos->save();
        }
        //## FIN UPDATE REES####
        // notify()->success('¡Se ha actualizado la información del contrato satisfactoriamente!');

        return redirect(route('contract_manager.contratos-katbol.index'));
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
            'file' => 'required|mimes:' . $mines . '|max:' . $tamaño_limite,
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