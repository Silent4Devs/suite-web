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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class RequisicionesEditComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editRequisicion = null;

    public $currentUser;

    public $user;

    public $paso = 1;

    public $test = 'display: none;';

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
    public $sucursal_id = '';

    #[Validate('required')]
    public $user_name;

    #[Validate('required')]
    public $user_area;

    #[Validate('required')]
    public $user_email;

    #[Validate('required|max:255')]
    public $descripcion;

    #[Validate('required|int')]
    public $comprador_id = '';

    #[Validate('required|int')]
    public $contrato_id = '';

    #[Validate('required|int|min:1')]
    public $cantidad_oblig = 0;

    #[Validate('required|int')]
    public $producto_oblig = '';

    public $id_registro_oblig = null;

    #[Validate('required|max:500')]
    public $especificaciones_oblig = '';

    public $array_productos = [];

    public $array_proveedores = [];

    #[Validate('required')]
    public $fecha_solicitud;

    #[Validate('required|int')]
    public $sucursal_id = '';

    #[Validate('required')]
    public $user_name;

    #[Validate('required')]
    public $user_area;

    #[Validate('required')]
    public $user_email;

    #[Validate('required|max:255')]
    public $descripcion;

    #[Validate('required|int')]
    public $comprador_id = '';

    #[Validate('required|int')]
    public $contrato_id = '';

    #[Validate('required|int|min:1')]
    public $cantidad_oblig = 0;

    #[Validate('required|int')]
    public $producto_oblig = '';

    public $id_registro_oblig = null;

    #[Validate('required|max:500')]
    public $especificaciones_oblig = '';

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

    // public $requisicionCreada = null;

    protected $listeners = [
        'actualizarCountProveedores' => 'actualizarCountProveedores',
        'redirigirFaltantes' => 'redirigirFaltantes',
        'removeProductoConfirmed' => 'removeProductoConfirmed',
        'removeProveedorConfirmed' => 'removeProveedorConfirmed',
    ];

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

    public function mount($id_requisiciondata)
    {
        $this->editRequisicion = KatbolRequsicion::where('id', $id_requisiciondata)->first();

        $this->currentUser = User::getCurrentUser();

        $this->user = User::where('id', $this->editRequisicion->id_user)->first();

        $this->sucursales = KatbolSucursal::getArchivoFalse();
        $this->proveedores = KatbolProveedorOC::getEstadoFalse();
        $this->compradores = KatbolComprador::getArchivoFalse();
        $this->contratos = KatbolContrato::getAll();
        $this->productos = KatbolProducto::getArchivoFalse();
        $this->organizacion = Organizacion::getFirst();

        $this->user_name = $this->editRequisicion->user;
        $this->user_area = $this->editRequisicion->area;
        $this->user_email = $this->user->email;

        $collections = [
            'sucursales' => 'Sucursales',
            'proveedores' => 'Proveedores',
            'compradores' => 'Compradores',
            'contratos' => 'Contratos',
            'productos' => 'Productos',
        ];

        foreach ($collections as $property => $name) {
            if ($this->$property->isEmpty()) {
                $this->alertaRegistrosFaltantes($name);
                // $this->dispatch('sin_registros', $name);
            }
        }

        $this->fecha_solicitud = $this->editRequisicion->fecha;
        $this->sucursal_id = $this->editRequisicion->sucursal_id;
        $this->descripcion = $this->editRequisicion->referencia;
        $this->comprador_id = $this->editRequisicion->comprador_id;
        $this->contrato_id = $this->editRequisicion->contrato_id;

        foreach ($this->editRequisicion->productos_requisiciones as $keyProducto => $producto) {
            if ($keyProducto == 0) {
                $this->producto_oblig = $producto->producto_id;
                $this->cantidad_oblig = $producto->cantidad;
                $this->especificaciones_oblig = $producto->espesificaciones;
                $this->id_registro_oblig = $producto->id;
            } else {
                $this->array_productos[] = [
                    'id_registro' => $producto->id,
                    'cantidad' => $producto->producto_id,
                    'producto' => $producto->cantidad,
                    'especificaciones' => $producto->espesificaciones,
                ];
            }
        }

        foreach ($this->editRequisicion->provedores_requisiciones_catalogo as $keyrequisiciones_catalogo => $prov_requisiciones) {
            // code...
            $this->array_proveedores[] = [
                'proveedor_id' => $prov_requisiciones->proveedor_id,
                'fechaInicio' => $prov_requisiciones->fecha_inicio,
                'fechaFin' => $prov_requisiciones->fecha_fin,
                'select_otro' => '',
                'detalles' => null,
                'tipo' => null,
                'comentarios' => null,
                'nombre_contacto' => null,
                'telefono_contacto' => null,
                'correo_contacto' => null,
                'url_contacto' => null,
                'archivo' => null,
                'id_registro' => $prov_requisiciones->id ?? null,
                'tabla_origen' => 'ProvedorRequisicionCatalogo',
            ];
        }
        foreach ($this->editRequisicion->provedores_indistintos_requisiciones as $keyindistintos_requisiciones => $prov_indistintos_requisiciones) {
            // code...
            $this->array_proveedores[] = [
                'proveedor_id' => 'otro',
                'fechaInicio' => $prov_indistintos_requisiciones->fecha_inicio,
                'fechaFin' => $prov_indistintos_requisiciones->fecha_fin,
                'select_otro' => 'indistinto',
                'detalles' => null,
                'tipo' => null,
                'comentarios' => null,
                'nombre_contacto' => null,
                'telefono_contacto' => null,
                'correo_contacto' => null,
                'url_contacto' => null,
                'archivo' => null,
                'id_registro' => $prov_indistintos_requisiciones->id ?? null,
                'tabla_origen' => 'ProveedorIndistinto',
            ];
        }

        foreach ($this->editRequisicion->provedores_requisiciones as $keyrequisiciones => $prov_requisiciones_catalogo) {
            // code...
            $this->array_proveedores[] = [
                'proveedor_id' => $prov_requisiciones_catalogo->proveedor,
                'fechaInicio' => $prov_requisiciones_catalogo->fecha_inicio,
                'fechaFin' => $prov_requisiciones_catalogo->fecha_fin,
                'select_otro' => 'sugerido',
                'detalles' => $prov_requisiciones_catalogo->detalles,
                'tipo' => $prov_requisiciones_catalogo->tipo,
                'comentarios' => $prov_requisiciones_catalogo->comentarios,
                'nombre_contacto' => $prov_requisiciones_catalogo->contacto,
                'telefono_contacto' => $prov_requisiciones_catalogo->cel,
                'correo_contacto' => $prov_requisiciones_catalogo->contacto_correo,
                'url_contacto' => $prov_requisiciones_catalogo->url,
                'archivo' => $prov_requisiciones_catalogo->cotizacion,
                'id_registro' => $prov_requisiciones_catalogo->id ?? null,
                'tabla_origen' => 'ProveedorRequisicion',
            ];
        }
    }

    public function render()
    {
        return view('livewire.requisiciones-edit-component');
    }

    public function hydrate()
    {
        $this->dispatch('select2');
    }

    public function alertaRegistrosFaltantes($name)
    {
        $this->alert('warning', 'Sin Registros', [
            'position' => 'center',
            'timer' => '', // Mantén la alerta visible hasta que el usuario interactúe
            'backdrop' => true, // Desactiva la interacción con el fondo
            'allowOutsideClick' => false, // Evita cerrar la alerta al hacer clic fuera de ella
            'toast' => false, // Desactivar el modo toast para permitir el backdrop
            'showConfirmButton' => true,
            'width' => '1000px', // Asegúrate de que el ancho esté en píxeles
            'onConfirmed' => 'redirigirFaltantes',
            'timerProgressBar' => false,
            'text' => 'No hay registros en la selección de '.$name.', contacte al administrador.',
            'confirmButtonText' => 'Entendido.',
        ]);
    }

    public function alertaResponsablesFaltantes()
    {
        $this->alert('warning', 'Colaboradores no disponibles', [
            'position' => 'center',
            'timer' => '', // Mantén la alerta visible hasta que el usuario interactúe
            'backdrop' => true, // Desactiva la interacción con el fondo
            'allowOutsideClick' => false, // Evita cerrar la alerta al hacer clic fuera de ella
            'toast' => false, // Desactivar el modo toast para permitir el backdrop
            'showConfirmButton' => true,
            'width' => '1000px', // Asegúrate de que el ancho esté en píxeles
            'onConfirmed' => 'redirigirFaltantes',
            'timerProgressBar' => false,
            'text' => 'Los colaboradores asignados se encuentran ausentes. Es necesario acercarse con el administrador para solicitar que se agregue  un responsable, de lo contrario no podra firmar la requisición.',
            'confirmButtonText' => 'Entendido.',
        ]);
    }

    public function redirigirFaltantes()
    {
        redirect(route('contract_manager.requisiciones'));
        // Do something
    }

    public function addProductos()
    {
        $this->array_productos[] = [
            'id_registro' => null,
            'cantidad' => 0,
            'producto' => '',
            'especificaciones' => '',
        ];
    }

    public function removeProductoConfirmed($key)
    {
        if ($this->array_productos[$key]['id_registro'] == null) {
            unset($this->array_productos[$key]);
        } elseif ($this->array_productos[$key]['id_registro'] != null) {

            $deleteProducto = KatbolProductoRequisicion::where('id', $this->array_productos[$key]['id_registro'])->delete();

            unset($this->array_productos[$key]);

            $this->alert('success', 'Registro Eliminado');
        }
    }

    public function agregarProveedor()
    {
        $this->array_proveedores[] = [
            'proveedor_id' => '',
            'fechaInicio' => null,
            'fechaFin' => null,
            'select_otro' => '',
            'detalles' => null,
            'tipo' => null,
            'comentarios' => null,
            'nombre_contacto' => null,
            'telefono_contacto' => null,
            'correo_contacto' => null,
            'url_contacto' => null,
            'archivo' => null,
            'id_registro' => null,
            'tabla_origen' => null,
        ];
    }

    public function removeProveedorConfirmed($keyP)
    {
        if ($this->array_proveedores[$keyP]['id_registro'] == null) {

            unset($this->array_proveedores[$keyP]);
        } elseif ($this->array_proveedores[$keyP]['id_registro'] != null) {

            switch ($this->array_proveedores[$keyP]['tabla_origen']) {
                case 'ProvedorRequisicionCatalogo':
                    KatbolProvedorRequisicionCatalogo::where('id', $this->array_proveedores[$keyP]['id_registro'])->delete();
                    // code...
                    $this->alert('success', 'Registro Eliminado');

                    break;
                case 'ProveedorIndistinto':
                    KatbolProveedorIndistinto::where('id', $this->array_proveedores[$keyP]['id_registro'])->delete();
                    // code...
                    $this->alert('success', 'Registro Eliminado');

                    break;

                case 'ProveedorRequisicion':
                    KatbolProveedorRequisicion::where('id', $this->array_proveedores[$keyP]['id_registro'])->delete();
                    // code...
                    $this->alert('success', 'Registro Eliminado');

                    break;
                default:
                    $this->alert('error', 'Error al buscar el registro.');
                    // code...
                    break;
            }

            unset($this->array_proveedores[$keyP]);
        }
    }

    public function servicioStore()
    {
        $this->validate();

        $this->nueva_requisicion = [
            'fecha' => $this->fecha_solicitud,
            'sucursal_id' => $this->sucursal_id,
            'user' => $this->user_name,
            'area' => $this->user_area,
            'referencia' => $this->descripcion,
            'comprador_id' => $this->comprador_id,
            'contrato_id' => $this->contrato_id,
            'id_user' => $this->user->id,
            'email' => $this->user_email,
        ];

        $this->array_productos[] =
            [
                'id_registro' => $this->id_registro_oblig,
                'cantidad' => $this->cantidad_oblig,
                'producto' => $this->producto_oblig,
                'especificaciones' => $this->especificaciones_oblig,
            ];

        $this->habilitar_proveedores = true;

        $this->dispatch('cambiarTab', 'profile');
        $this->active = 'desActive';

        $this->paso = 2;
    }

    public function proveedoresStore()
    {
        $this->habilitar_firma = false;
        $this->provedores_colllection = collect();

        $dataProvedoresIndistintoCatalogo = [];
        $dataProveedoresSugeridos = [];
        $dataProvedoresCatalogo = [];

        foreach ($this->array_proveedores as $keyProv => $proveedor) {

            if ($proveedor['proveedor_id'] == 'otro') {
                if ($proveedor['select_otro'] == 'indistinto') {

                    if ($proveedor['tabla_origen'] != 'ProveedorIndistinto') {
                        switch ($proveedor['tabla_origen']) {
                            case 'ProvedorRequisicionCatalogo':
                                KatbolProvedorRequisicionCatalogo::where('id', $proveedor['id_registro'])->delete();
                                // code...
                                $this->alert('success', 'Registro Eliminado');

                                break;

                            case 'ProveedorRequisicion':
                                KatbolProveedorRequisicion::where('id', $proveedor['id_registro'])->delete();
                                // code...
                                $this->alert('success', 'Registro Eliminado');

                                break;
                            default:
                                $this->alert('error', 'Error al buscar el registro.');
                                // code...
                                break;
                        }
                    }

                    $dataProvedoresIndistintoCatalogo[] = [
                        // 'requisicion_id' => $this->nueva_requisicion->id,
                        'id_registro' => $proveedor['id_registro'],
                        'fecha_inicio' => $proveedor['fechaInicio'],
                        'fecha_fin' => $proveedor['fechaFin'],
                    ];

                    // $this->dataProvedoresIndistintoCatalogo = KatbolProveedorIndistinto::create([
                    //     // 'requisicion_id' => $this->nueva_requisicion->id,
                    //     'fecha_inicio' => $data['fechaInicio'],
                    //     'fecha_fin' => $data['fechaFin'],
                    // ]);
                } elseif ($proveedor['select_otro'] == 'sugerido') {
                    // KatbolProveedorRequisicion
                    // $name = 'requisicion_' . $this->requisicion_id . 'cotizacion_' . $cotizacion_count . '_' . uniqid() . '.' . $proveedor['archivo']->getClientOriginalExtension();
                    // dd($proveedor);

                    if ($proveedor['tabla_origen'] != 'ProveedorRequisicion') {
                        switch ($proveedor['tabla_origen']) {
                            case 'ProvedorRequisicionCatalogo':
                                KatbolProvedorRequisicionCatalogo::where('id', $proveedor['id_registro'])->delete();
                                // code...
                                break;

                            case 'ProveedorIndistinto':
                                KatbolProveedorIndistinto::where('id', $proveedor['id_registro'])->delete();
                                // code...
                                break;

                            default:
                                // code...
                                break;
                        }
                    }

                    $dataProveedoresSugeridos[] = [
                        'id_registro' => $proveedor['id_registro'],
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
                $proveedor_catalogo = KatbolProveedorOC::where('id', $proveedor['proveedor_id'])->first();

                if ($proveedor['tabla_origen'] != 'ProvedorRequisicionCatalogo') {
                    switch ($proveedor['tabla_origen']) {
                        case 'ProveedorIndistinto':
                            KatbolProveedorIndistinto::where('id', $proveedor['id_registro'])->delete();
                            // code...
                            break;

                        case 'ProveedorRequisicion':
                            KatbolProveedorRequisicion::where('id', $proveedor['id_registro'])->delete();
                            // code...
                            break;
                        default:
                            // code...
                            break;
                    }
                }

                $dataProvedoresCatalogo[] = [
                    // 'requisicion_id' => $this->nueva_requisicion->id,
                    'id_registro' => $proveedor['id_registro'],
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
        $this->paso = 3;
        $this->test = 'display: block;';
        $this->dispatch('probando');
        $this->habilitar_proveedores = true;
    }

    public function crearRequisicion($dataProvedoresIndistintoCatalogo, $dataProveedoresSugeridos, $dataProvedoresCatalogo)
    {
        DB::beginTransaction();
        try {

            $this->editRequisicion->update(
                [
                    'fecha' => $this->nueva_requisicion['fecha'],
                    'sucursal_id' => $this->nueva_requisicion['sucursal_id'],
                    'user' => $this->nueva_requisicion['user'],
                    'email' => $this->nueva_requisicion['email'],
                    'area' => $this->nueva_requisicion['area'],
                    'referencia' => $this->nueva_requisicion['referencia'],
                    'comprador_id' => $this->nueva_requisicion['comprador_id'],
                    'contrato_id' => $this->nueva_requisicion['contrato_id'],
                    'id_user' => $this->nueva_requisicion['id_user'],
                    'estado' => 'curso',
                    'estado_orden' => null,
                ]
            );

            $this->requisicion_id = $this->editRequisicion->id;

            foreach ($this->array_productos as $keyProductos => $producto) {
                KatbolProductoRequisicion::updateOrCreate(
                    [
                        'id' => $producto['id_registro'],
                        'requisiciones_id' => $this->editRequisicion->id,
                    ],
                    [
                        'espesificaciones' => $producto['especificaciones'],
                        'cantidad' => $producto['cantidad'],
                        'producto_id' => $producto['producto'],
                    ]
                );
            }

            foreach ($dataProvedoresIndistintoCatalogo as $key => $provInd) {
                KatbolProveedorIndistinto::updateOrCreate(
                    [
                        'id' => $provInd['id_registro'],
                        'requisicion_id' => $this->editRequisicion->id,
                    ],
                    [
                        'fecha_inicio' => $provInd['fecha_inicio'],
                        'fecha_fin' => $provInd['fecha_fin'],
                    ]
                );
            }

            foreach ($dataProveedoresSugeridos as $key => $provSug) {
                $name = 'requisicion_'.$this->requisicion_id.'cotizacion_'.$key + 1 .'_'.uniqid().'.'.$provSug['extArchivo'];
                KatbolProveedorRequisicion::updateOrCreate(
                    [
                        'id' => $provSug['id_registro'],
                        'requisiciones_id' => $this->editRequisicion->id,
                    ],
                    [
                        'requisiciones_id' => $this->editRequisicion->id,
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
                    ]
                );
            }

            foreach ($dataProvedoresCatalogo as $key => $provCat) {
                KatbolProvedorRequisicionCatalogo::updateOrCreate(
                    [
                        'id' => $provCat['id_registro'],
                        'requisicion_id' => $this->editRequisicion->id,
                    ],
                    [
                        'requisicion_id' => $this->editRequisicion->id,
                        'proveedor_id' => $provCat['proveedor_id'],
                        'fecha_inicio' => $provCat['fecha_inicio'],
                        'fecha_fin' => $provCat['fecha_fin'],
                    ]
                );
            }

            foreach ($this->provedores_colllection as $keyProvCol => $provCol) {
                $this->editRequisicion->update([
                    'proveedor_catalogo' => $provCol->nombre,
                    // 'proveedoroc_id' => $this->provCol->id,
                ]);
            }

            $proveedores_escogidos = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $this->editRequisicion->id)->pluck('proveedor_id')->toArray();

            $this->proveedores_show = KatbolProveedorOC::whereIn('id', $proveedores_escogidos)->get();

            $firmas_requi = FirmasRequisiciones::updateOrCreate(
                [
                    'id' => $this->editRequisicion->registroFirmas->id ?? null,
                    'requisicion_id' => $this->editRequisicion->id,
                ],
                [
                    'solicitante_id' => $this->user->empleado->id,
                    // 'jefe_id' => $responsable->id,
                    // 'responsable_finanzas_id' => $responsable->id,
                    // 'comprador_id' => $comprador->user->empleado->id,
                ]
            );

            $this->alert('success', 'Requisicion Creada con exito');
            DB::commit();
        } catch (Throwable $e) {
            $this->forgetCache();
            DB::rollback();
            dd($e);
        }

        if ($this->currentUser->id == $this->user->id) {
            $this->dataFirma();
            $this->dispatch('cambiarTab', 'contact');
            $this->disabled = 'disabled';
        } else {
            return redirect(route('contract_manager.requisiciones'));
        }
    }

    public function dataFirma()
    {
        // $this->habilitar_proveedores = false;

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
            $this->alertaResponsablesFaltantes();
            // $this->dispatch('sin_responsables');
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
            $this->editRequisicion->update([
            $this->editRequisicion->update([
                'firma_solicitante' => $data['firma'],
                'estado' => 'curso',
                'email' => $this->user->email,
            ]);

            $fecha = date('d-m-Y');
            $this->editRequisicion->fecha_firma_solicitante_requi = $fecha;
            $this->editRequisicion->save();
            $fecha = date('d-m-Y');
            $this->editRequisicion->fecha_firma_solicitante_requi = $fecha;
            $this->editRequisicion->save();

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

            $firmas_requi = FirmasRequisiciones::where('requisicion_id', $this->editRequisicion->id)->first();

            $firmas_requi->update([
                'jefe_id' => $responsable->id,
                // 'responsable_finanzas_id' => $responsable->id,
                // 'comprador_id' => $comprador->user->empleado->id,
            ]);

            if ($responsable->id == $this->user->empleado->id) {
                Mail::to(trim($this->removeUnicodeCharacters($supervisor)))->queue(new RequisicionesFirmaDuplicadaEmail($this->editRequisicion, $organizacion, $tipo_firma));
            } else {
                Mail::to(trim($this->removeUnicodeCharacters($supervisor)))->queue(new RequisicionesEmail($this->editRequisicion, $organizacion, $tipo_firma));
            }
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

            $firmas_requi = FirmasRequisiciones::where('requisicion_id', $this->editRequisicion->id)->first();

            $firmas_requi->update([
                'jefe_id' => $responsable->id,
                // 'responsable_finanzas_id' => $responsable->id,
                // 'comprador_id' => $comprador->user->empleado->id,
            ]);

            if ($responsable->id == $this->user->empleado->id) {
                Mail::to(trim($this->removeUnicodeCharacters($supervisor)))->queue(new RequisicionesFirmaDuplicadaEmail($this->editRequisicion, $organizacion, $tipo_firma));
            } else {
                Mail::to(trim($this->removeUnicodeCharacters($supervisor)))->queue(new RequisicionesEmail($this->editRequisicion, $organizacion, $tipo_firma));
            }

            return redirect(route('contract_manager.requisiciones'));
        }
    }

    public function forgetCache()
    {
        Cache::forget('Requisiciones:all');
        Cache::forget('Requisiciones:archivo_false_all');
        Cache::forget('Requisiciones:ordenes_compra_false');
        Cache::forget('Requisiciones:archivo_true_all');
    }
}
