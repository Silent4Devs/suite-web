<?php

namespace App\Livewire;

use App\Mail\RequisicionesEmail;
use App\Mail\RequisicionesFirmaDuplicadaEmail;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\Contrato as KatbolContrato;
use App\Models\ContractManager\Producto as KatbolProducto;
use App\Models\ContractManager\ProductoRequisicion as KatbolProductoRequisicion;
use App\Models\ContractManager\ProvedorRequisicionCatalogo as KatbolProvedorRequisicionCatalogo;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\ProveedorRequisicion as KatbolProveedorRequisicion;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use App\Models\ContractManager\Sucursal as KatbolSucursal;
use App\Models\FirmasRequisiciones;
use App\Models\ListaDistribucion;
use App\Models\Organizacion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class RequisicionesCreateComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $user;

    public $paso = 1;

    public $sucursales;

    public $compradores;

    public $contratos;

    public $proveedores;

    public $productos;

    public $organizacion;

    public $requisicion_id;

    #[Validate('required')]
    public $fecha_solicitud;

    #[Validate('required|int')]
    public $sucursal_id = "";

    #[Validate('required')]
    public $user_name;

    #[Validate('required')]
    public $user_area;

    #[Validate('required|max:255')]
    public $descripcion;

    #[Validate('required|int')]
    public $comprador_id = "";

    #[Validate('required|int')]
    public $contrato_id = "";

    #[Validate('required|int|min:1')]
    public $cantidad_oblig = 0;

    #[Validate('required|int')]
    public $producto_oblig = "";

    #[Validate('required|max:500')]
    public $especificaciones_oblig = "";

    public $array_productos = [];

    public $array_proveedores = [];

    public $nueva_requisicion;

    public $productos_view;

    public $proveedores_view;

    public $products_servs_count;

    public $proveedores_count = 0;

    public $proveedores_catalogo;

    public $provedores_colllection_catalogo;

    public $provedores_indistinto_catalogo;

    public $proveedores_show;

    // contizaciones
    public $cotizaciones = [];

    // tabs
    public $habilitar_firma = false;

    public $habilitar_alerta_cotizacion = false;

    public $habilitar_alerta = false;

    public $habilitar_proveedores = false;

    public $habilitar_url = false;

    public $active = 'active';

    public $disabled = '';

    public $requisicion;

    public $area;

    public $isVisible;

    public $selectedInput = [];

    public $selectOption = [];

    public $provedores_colllection;

    public $requisicionCreada = null;

    protected $listeners = ['actualizarCountProveedores' => 'actualizarCountProveedores'];

    public $filename;

    public $path;

    public $chatOpen = false;

    public $pdf;

    public $filePath;

    public $question;

    public $respuesta;

    public $bandera = false;

    public $saludo = true;

    public $alerta_jefes = false;

    public function actualizarCountProveedores()
    {
        $this->proveedores_count = $this->proveedores_count + 1;
    }

    public function mount()
    {
        $this->user = User::getCurrentUser();

        $this->sucursales = KatbolSucursal::getArchivoFalse();
        $this->proveedores = KatbolProveedorOC::getEstadoFalse();
        $this->compradores = KatbolComprador::getArchivoFalse();
        $this->contratos = KatbolContrato::getAll();
        $this->productos = KatbolProducto::getArchivoFalse();
        $this->organizacion = Organizacion::getFirst();

        $this->user_name = $this->user->name;
        $this->user_area = $this->user->empleado->area->area;

        $collections = [
            'sucursales' => 'Sucursales',
            'proveedores' => 'Proveedores',
            'compradores' => 'Compradores',
            'contratos' => 'Contratos',
            'productos' => 'Productos',
        ];

        foreach ($collections as $property => $name) {
            if ($this->$property->isEmpty()) {
                $this->dispatch('sin_registros', $name);
            }
        }

        $this->array_proveedores[] = [
            'proveedor_id' => "",
            'fechaInicio' => null,
            'fechaFin' => null,
            'select_otro' => "",
            'detalles' => null,
            'tipo' => null,
            'comentarios' => null,
            'nombre_contacto' => null,
            'telefono_contacto' => null,
            'correo_contacto' => null,
            'url_contacto' => null,
            'archivo' => null
        ];
    }

    public function render()
    {
        return view('livewire.requisiciones-create-component');
    }

    public function hydrate()
    {
        $this->dispatch('select2');
    }

    public function addProductos()
    {
        $this->array_productos[] = [
            'cantidad' => 0,
            'producto' => "",
            'especificaciones' => "",
        ];
    }

    public function removeProductos($key)
    {
        unset($this->array_productos[$key]);
    }

    public function agregarProveedor()
    {
        $this->array_proveedores[] = [
            'proveedor_id' => "",
            'fechaInicio' => null,
            'fechaFin' => null,
            'select_otro' => "",
            'detalles' => null,
            'tipo' => null,
            'comentarios' => null,
            'nombre_contacto' => null,
            'telefono_contacto' => null,
            'correo_contacto' => null,
            'url_contacto' => null,
            'archivo' => null
        ];
    }

    public function removeProveedor($key)
    {
        unset($this->array_proveedores[$key]);
    }

    public function servicioStore()
    {
        $this->validate();
        // dd($data);

        $this->nueva_requisicion = [
            'fecha' => $this->fecha_solicitud,
            'sucursal_id' => $this->sucursal_id,
            'user' => $this->user_name,
            'area' => $this->user_area,
            'referencia' => $this->descripcion,
            'comprador_id' => $this->comprador_id,
            'contrato_id' => $this->contrato_id,
            'id_user' => $this->user->id,
        ];

        $this->array_productos[] =
            [
                'cantidad' => $this->cantidad_oblig,
                'producto' => $this->producto_oblig,
                'especificaciones' => $this->especificaciones_oblig,
            ];

        // dd(
        //     $this->nueva_requisicion,
        //     $this->array_productos
        // );

        //Poner despues
        // $firmas_requi = FirmasRequisiciones::create([
        //     'requisicion_id' => $this->nueva_requisicion->id,
        //     'solicitante_id' => $this->user->empleado->id,
        //     // 'jefe_id' => $responsable->id,
        //     // 'responsable_finanzas_id' => $responsable->id,
        //     // 'comprador_id' => $comprador->user->empleado->id,
        // ]);

        $this->habilitar_proveedores = true;
        $this->dispatch('cambiarTab', 'profile');
        $this->active = 'desActive';
    }

    public function proveedoresStore()
    {
        $this->habilitar_firma = false;
        $this->provedores_colllection = collect();

        $dataProvedoresIndistintoCatalogo = [];
        $dataProveedoresSugeridos = [];
        $dataProvedoresCatalogo = [];

        foreach ($this->array_proveedores as $keyProv => $proveedor) {

            if ($proveedor["proveedor_id"] == "otro") {
                if ($proveedor["select_otro"] == "indistinto") {
                    $dataProvedoresIndistintoCatalogo[] = [
                        // 'requisicion_id' => $this->nueva_requisicion->id,
                        'fecha_inicio' => $proveedor['fechaInicio'],
                        'fecha_fin' => $proveedor['fechaFin'],
                    ];

                    // $this->dataProvedoresIndistintoCatalogo = KatbolProveedorIndistinto::create([
                    //     // 'requisicion_id' => $this->nueva_requisicion->id,
                    //     'fecha_inicio' => $data['fechaInicio'],
                    //     'fecha_fin' => $data['fechaFin'],
                    // ]);
                } elseif ($proveedor["select_otro"] == "sugerido") {
                    // KatbolProveedorRequisicion
                    // $name = 'requisicion_' . $this->requisicion_id . 'cotizacion_' . $cotizacion_count . '_' . uniqid() . '.' . $proveedor['archivo']->getClientOriginalExtension();
                    // dd($proveedor);
                    $dataProveedoresSugeridos[] = [
                        'proveedor' => $proveedor['proveedor_id'],
                        'detalles' => $proveedor['detalles'],
                        'tipo' => $proveedor['tipo'],
                        'comentarios' => $proveedor['comentarios'],
                        'contacto' => $proveedor['nombre_contacto'],
                        'cel' => $proveedor['telefono_contacto'],
                        'contacto_correo' => $proveedor['correo_contacto'],
                        'url' => $proveedor['url_contacto'],
                        'fecha_inicio' => $proveedor['fechaInicio'],
                        'fecha_fin' => $proveedor['fechaFin'],
                        'extArchivo' => $proveedor['archivo']->getClientOriginalExtension(),
                        // 'cotizacion' => null,
                        // 'requisiciones_id' => $proveedor[''],
                    ];
                }
            } else {
                $proveedor_catalogo = KatbolProveedorOC::where('id', $proveedor['proveedor_id'],)->first();
                $dataProvedoresCatalogo[] = [
                    // 'requisicion_id' => $this->nueva_requisicion->id,
                    'proveedor_id' => $proveedor['proveedor_id'],
                    'fecha_inicio' => $proveedor['fechaInicio'],
                    'fecha_fin' => $proveedor['fechaFin'],
                ];

                // $this->provedores_colllection_catalogo = KatbolProvedorRequisicionCatalogo::create([
                //     // 'requisicion_id' => $this->nueva_requisicion->id,
                //     'proveedor_id' => $proveedor['proveedor_id'],
                //     'fecha_inicio' => $proveedor['fechaInicio'],
                //     'fecha_fin' => $proveedor['fechaFin'],
                // ]);

                $proveedor_catalogo->update([
                    'fecha_inicio' => $proveedor['fechaInicio'],
                    'fecha_fin' => $proveedor['fechaFin'],
                ]);

                //Agregar cuando se cree la requisicion (Para que sirve?, cambia por cada proveedor registrado)
                // $this->nueva_requisicion->update([
                //     'proveedor_catalogo' => $this->proveedores_catalogo->nombre,
                //     'proveedoroc_id' => $this->proveedores_catalogo->id,
                // ]);

                // $proveedores_escogidos = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $this->nueva_requisicion->id)->pluck('proveedor_id')->toArray();

                // $this->proveedores_show = KatbolProveedorOC::whereIn('id', $proveedores_escogidos)->get();
                $this->provedores_colllection->push($proveedor_catalogo);
            }
        }

        $this->crearRequisicion($dataProvedoresIndistintoCatalogo, $dataProveedoresSugeridos, $dataProvedoresCatalogo);

        $this->habilitar_proveedores = true;
    }

    public function crearRequisicion($dataProvedoresIndistintoCatalogo, $dataProveedoresSugeridos, $dataProvedoresCatalogo)
    {
        DB::beginTransaction();
        try {

            $this->requisicionCreada = KatbolRequsicion::create(
                [
                    'fecha' => $this->nueva_requisicion['fecha'],
                    'sucursal_id' => $this->nueva_requisicion['sucursal_id'],
                    'user' => $this->nueva_requisicion['user'],
                    'area' => $this->nueva_requisicion['area'],
                    'referencia' => $this->nueva_requisicion['referencia'],
                    'comprador_id' => $this->nueva_requisicion['comprador_id'],
                    'contrato_id' => $this->nueva_requisicion['contrato_id'],
                    'id_user' => $this->nueva_requisicion['id_user'],
                ]
            );

            $this->requisicion_id = $this->requisicionCreada->id;

            foreach ($this->array_productos as $keyProductos => $producto) {
                KatbolProductoRequisicion::create([
                    'requisiciones_id' => $this->requisicionCreada->id,
                    'espesificaciones' => $producto['especificaciones'],
                    'cantidad' => $producto['cantidad'],
                    'producto_id' => $producto['producto'],
                ]);
            }

            foreach ($dataProvedoresIndistintoCatalogo as $key => $provInd) {
                KatbolProveedorIndistinto::create([
                    'requisicion_id' => $this->requisicionCreada->id,
                    'fecha_inicio' => $provInd['fecha_inicio'],
                    'fecha_fin' => $provInd['fecha_fin'],
                ]);
            }

            foreach ($dataProveedoresSugeridos as $key => $provSug) {
                $name = 'requisicion_' . $this->requisicion_id . 'cotizacion_' . $key + 1 . '_' . uniqid() . '.' . $provSug['extArchivo'];
                KatbolProveedorRequisicion::create([
                    'requisiciones_id' => $this->requisicionCreada->id,
                    'proveedor' => $provSug['proveedor'],
                    'detalles' => $provSug['detalles'],
                    'tipo' => $provSug['tipo'],
                    'comentarios' => $provSug['comentarios'],
                    'contacto' => $provSug['contacto'],
                    'cel' => $provSug['cel'],
                    'contacto_correo' => $provSug['contacto_correo'],
                    'url' => $provSug['url'],
                    'fecha_inicio' => $provSug['fecha_inicio'],
                    'fecha_fin' => $provSug['fecha_fin'],
                    'cotizacion' => $name,
                ]);
            }

            foreach ($dataProvedoresCatalogo as $key => $provCat) {
                KatbolProvedorRequisicionCatalogo::create([
                    'requisicion_id' => $this->requisicionCreada->id,
                    'proveedor_id' => $provCat['proveedor_id'],
                    'fecha_inicio' => $provCat['fecha_inicio'],
                    'fecha_fin' => $provCat['fecha_fin'],
                ]);
            }

            $this->alert('success', 'Requisicion Creada con exito');
            DB::commit();
            $this->dataFirma();
            $this->dispatch('cambiarTab', 'contact');
            $this->disabled = 'disabled';
        } catch (Throwable $e) {
            $this->forgetCache();
            DB::rollback();
            dd($e);
        }
    }

    public function dataFirma()
    {
        $this->habilitar_proveedores = false;

        $this->productos_view = KatbolProductoRequisicion::where('requisiciones_id', $this->requisicion_id)->get();
        $this->proveedores_view = KatbolProveedorRequisicion::where('requisiciones_id', $this->requisicion_id)->get();
        $requisicion = $this->requisicion = KatbolRequsicion::with('comprador.user', 'sucursal')->find($this->requisicion_id);
        $comprador = KatbolComprador::where('id', $requisicion->comprador_id)->first();
        $contrato = KatbolContrato::where('id', $requisicion->contrato_id)->first();
        $this->dispatch('render_firma');
        $this->validacionLista();
        $this->habilitar_firma = true;
    }

    public function validacionLista()
    {
        $alerta = false;
        $responsable = null;

        $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
        //Traemos participantes
        $listaPart = $listaReq->participantes;

        $jefe = $this->user->empleado->supervisor;
        //Buscamos al supervisor por su id
        $supList = $listaPart->where('empleado_id', $jefe->id)->first();

        //Buscamos en que nivel se encuentra el supervisor
        $nivel = $supList->nivel;

        //traemos a todos los participantes correspondientes a ese nivel
        $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

        //Buscamos 1 por 1 los participantes del nivel (area)
        foreach ($participantesNivel as $key => $partNiv) {
            //Si su estado esta activo se le manda el correo
            if ($partNiv->empleado->disponibilidad->disponibilidad == 1) {

                $responsable = $partNiv->empleado;
                $supervisor = $responsable->email;

                break;
            }
        }

        if (empty($responsable)) {
            $this->dispatch('sin_responsables');
        }
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }

    public function Firmar($data)
    {
        $this->habilitar_proveedores = false;

        if ($data['firma']) {
            $this->requisicionCreada->update([
                'firma_solicitante' => $data['firma'],
                'estado' => 'curso',
                'email' => $this->user->email,
            ]);

            $fecha = date('d-m-Y');
            $this->requisicionCreada->fecha_firma_solicitante_requi = $fecha;
            $this->requisicionCreada->save();

            $tipo_firma = 'firma_solicitante';
            $organizacion = Organizacion::first();

            $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
            //Traemos participantes
            $listaPart = $listaReq->participantes;

            $jefe = $this->user->empleado->supervisor;
            //Buscamos al supervisor por su id
            $supList = $listaPart->where('empleado_id', $jefe->id)->first();

            //Buscamos en que nivel se encuentra el supervisor
            $nivel = $supList->nivel;

            //traemos a todos los participantes correspondientes a ese nivel
            $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

            //Buscamos 1 por 1 los participantes del nivel (area)
            foreach ($participantesNivel as $key => $partNiv) {
                //Si su estado esta activo se le manda el correo
                if ($partNiv->empleado->disponibilidad->disponibilidad == 1) {

                    $responsable = $partNiv->empleado;
                    $supervisor = $responsable->email;

                    break;
                }
            }

            $firmas_requi = FirmasRequisiciones::where('requisicion_id', $this->nueva_requisicion->id)->first();

            $firmas_requi->update([
                'jefe_id' => $responsable->id,
                // 'responsable_finanzas_id' => $responsable->id,
                // 'comprador_id' => $comprador->user->empleado->id,
            ]);

            if ($responsable->id == $this->user->empleado->id) {
                Mail::to(trim($this->removeUnicodeCharacters($supervisor)))->queue(new RequisicionesFirmaDuplicadaEmail($this->nueva_requisicion, $organizacion, $tipo_firma));
            } else {
                Mail::to(trim($this->removeUnicodeCharacters($supervisor)))->queue(new RequisicionesEmail($this->nueva_requisicion, $organizacion, $tipo_firma));
            }

            return redirect(route('contract_manager.requisiciones'));
        }
    }
}