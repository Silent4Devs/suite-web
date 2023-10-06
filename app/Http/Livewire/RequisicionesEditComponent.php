<?php

namespace App\Http\Livewire;

use App\Mail\RequisicionesEmail;
use App\Models\ContractManager\Comprador as ContractManagerComprador;
use App\Models\ContractManager\Contrato as ContractManagerContrato;
use App\Models\ContractManager\Producto as ContractManagerProducto;
use App\Models\ContractManager\ProductoRequisicion as ContractManagerProductoRequisicion;
use App\Models\ContractManager\ProvedorRequisicionCatalogo as ContractManagerProvedorRequisicionCatalogo;
use App\Models\ContractManager\ProveedorIndistinto as ContractManagerProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as ContractManagerProveedorOC;
use App\Models\ContractManager\ProveedorRequisicion as ContractManagerProveedorRequisicion;
use App\Models\ContractManager\Requsicion as ContractManagerRequsicion;
use App\Models\ContractManager\Sucursal as ContractManagerSucursal;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\User;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class RequisicionesEditComponent extends Component
{
    use WithFileUploads;

    public $sucursales;
    public $compradores;
    public $contratos;
    public $user_tabantaj;
    public $productos;
    public $organizacion;
    public $requisicion_id;
    public $nueva_requisicion;
    public $productos_view;
    public $proveedores_view;
    public $users;
    public $editar_requisicion;

    public $requisiciondata;

    public $products_servs_count;
    public $proveedores_count;
    public $proveedores;

    public $proveedores_indistintos_count;
    public $proveedores_count_catalogo;

    public $editrequisicion;

    // contizaciones
    public $cotizaciones = [];
    public $proveedores_show;

    // tasbs
    public $habilitar_firma = false;
    public $habilitar_proveedores = false;
    public $habilitar_alerta = false;
    public $proveedor_sugerido = false;
    public $provedores_indistinto_catalogo;

    public $habilitar_url = false;
    public $requisicion;

    public $selectedInput = [];
    public $selectOption = [];

    public $id_catalogo = [];

    public $provedores_colllection;
    public $proveedores_catalogo;
    public $provedores_colllection_catalogo;

    public $requi_firmar;

    protected $listeners = ['actualizarCountProveedores' => 'actualizarCountProveedores'];

    public function mount($requisiciondata)
    {
        $this->sucursales = ContractManagerSucursal::where('archivo', false)->get();
        $this->compradores = ContractManagerComprador::with('user')->where('archivo', false)->get();
        $this->contratos = ContractManagerContrato::get();
        $this->productos = ContractManagerProducto::where('archivo', false)->get();
        $this->user_tabantaj = ModelsUser::with('empleado')->get();
        $this->organizacion = Organizacion::first();
        // $this->users = Empleado::get();
        $this->proveedores = ContractManagerProveedorOC::where('estado', false)->get();
        $this->editrequisicion =
            ContractManagerRequsicion::with('sucursal', 'comprador', 'contrato', 'productos_requisiciones', 'provedores_requisiciones', 'provedores_indistintos_requisiciones', 'provedores_requisiciones_catalogo')
            ->with('productos_requisiciones.producto')->where('archivo', false)
            ->find($requisiciondata->id);

        $this->proveedores_indistintos_count = $this->editrequisicion->provedores_indistintos_requisiciones->count();
        $this->proveedores_count = $this->editrequisicion->provedores_requisiciones->count();
        $this->proveedores_count_catalogo = $this->editrequisicion->provedores_requisiciones_catalogo->count();
    }

    public function render()
    {
        return view('livewire.requisiciones-edit-component');
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function servicioUpdate($data, $editrequisicion)
    {
        $this->habilitar_firma = false;

        $this->editar_requisicion = ContractManagerRequsicion::find($editrequisicion);

        $this->editar_requisicion->update([
            'fecha' => $data['fecha'],
            'referencia' => $data['descripcion'],
            'user' => $data['user'],
            'area' => $data['area'],
            'contrato_id' => $data['contrato_id'],
            'comprador_id' => $data['comprador_id'],
            'sucursal_id' => $data['sucursal_id'],
        ]);
        $productos_existentes = ContractManagerProductoRequisicion::where('requisiciones_id', $this->editar_requisicion->id)->get();
        if ($productos_existentes->count() > 0) {
            foreach ($productos_existentes as $product) {
                $product->delete();
            }
        }

        for ($i = 1; $i <= $this->products_servs_count; $i++) {
            if (isset($data['cantidad_' . $i])) {
                $producto_req = new ContractManagerProductoRequisicion();

                $producto_req->espesificaciones = $data['especificaciones_' . $i];
                $producto_req->cantidad = $data['cantidad_' . $i];
                $producto_req->producto_id = $data['producto_' . $i];
                $producto_req->requisiciones_id = $this->editar_requisicion->id;
                $producto_req->save();
            }
        }

        $this->requisicion_id = $this->editar_requisicion->id;

        $this->habilitar_proveedores = true;
        $this->emit('cambiarTab', 'profile');
    }

    public function proveedoresUpdate($data, $editrequisicion)
    {
        $this->habilitar_firma = false;

        $proveedores_exitentes = ContractManagerProveedorRequisicion::where('requisiciones_id', $editrequisicion)->get();
        $names_cotizaciones = [];
        if ($proveedores_exitentes->count() > 0) {
            foreach ($proveedores_exitentes as $proveedor_requi) {
                array_push($names_cotizaciones, $proveedor_requi->cotizacion);
                $proveedor_requi->delete();
            }
        }

        // $proveedores_exitentes = ProvedorRequisicionCatalogo::where('requisicion_id', $editrequisicion)->get();
        // if($proveedores_exitentes->count() > 0){
        //     foreach ($proveedores_exitentes as $proveedor) {
        //         $proveedor->delete();
        //     }
        // }

        $proveedor_indistinto = ContractManagerProveedorIndistinto::where('requisicion_id', $editrequisicion)->get();
        if ($proveedor_indistinto->count() > 0) {
            foreach ($proveedor_indistinto as $proveedor_indistinto) {
                $proveedor_indistinto->delete();
            }
        }

        if ($this->proveedores_indistintos_count) {
            $prove_count = 0;
            for ($i = 0; $i <= $this->proveedores_indistintos_count; $i++) {
                $this->provedores_indistinto_catalogo = ContractManagerProveedorIndistinto::create([
                    'requisicion_id' =>   $editrequisicion,
                    'fecha_inicio' => $data['contacto_fecha_inicio_' . $i],
                    'fecha_fin' => $data['contacto_fecha_fin_' . $i],
                ]);

                $this->emit('cambiarTab', 'contact');

                $this->dataFirma($editrequisicion);
            }
        }

        if ($this->proveedores_count) {
            $cotizacion_count = 0;
            $prove_count = 0;
            $this->provedores_colllection = collect();
            for ($i = 0; $i <= $this->proveedores_count; $i++) {
                if (isset($data['detalles_' . $i])) {
                    // nuevo proveedor
                    $proveedor_req = new ContractManagerProveedorRequisicion();
                    $proveedor_req->proveedor = $data['proveedor_' . $i];
                    $proveedor_req->detalles = $data['detalles_' . $i];
                    $proveedor_req->tipo = $data['tipo_' . $i];
                    $proveedor_req->comentarios = $data['comentarios_' . $i];
                    $proveedor_req->contacto = $data['contacto_' . $i];
                    $proveedor_req->cel = $data['contacto_telefono_' . $i];
                    $proveedor_req->contacto_correo = $data['contacto_correo_' . $i];
                    $proveedor_req->url = $data['contacto_url_' . $i];
                    $proveedor_req->fecha_inicio = $data['contacto_fecha_inicio_' . $i];
                    $proveedor_req->fecha_fin = $data['contacto_fecha_fin_' . $i];
                    $proveedor_req->requisiciones_id = $this->requisicion_id;

                    // cotizacion y validacion
                    if (isset($this->cotizaciones[$cotizacion_count])) {
                        $cotizacion_actual = $this->cotizaciones[$cotizacion_count];
                        $name_cotizacion = 'requisicion_' . $editrequisicion . '_cotizazcion_' . $cotizacion_count . '_' . uniqid() . '.' . $cotizacion_actual->getClientOriginalExtension();
                        $ruta_cotizacion = $cotizacion_actual->storeAs('public/cotizaciones_requisiciones_proveedores/', $name_cotizacion);
                    } else {
                        //  $name_cotizacion = $names_cotizaciones[$i];
                    }
                    //  $proveedor_req->cotizacion  =  $name_cotizacion;

                    $proveedor_req->save();

                    $cotizacion_count = $cotizacion_count + 1;

                    $this->emit('cambiarTab', 'contact');

                    $this->dataFirma($editrequisicion);

                    $prove_count = $prove_count + 1;
                    $cotizacion_count = $cotizacion_count + 1;
                }
            }
        }

        if ($this->proveedores_count_catalogo) {
            $prove_count = 0;
            // $this->provedores_colllection = collect();
            for ($i = 0; $i < $this->proveedores_count_catalogo; $i++) {
                if (isset($this->selectedInput[$prove_count])) {
                    $this->proveedores_catalogo = ContractManagerProveedorOC::where('id', $this->selectedInput[$prove_count])->first();

                    if (isset($data['id_catalogo_' . $i])) {
                        $provedores_requi_catalogo_delete = ContractManagerProvedorRequisicionCatalogo::find($data['id_catalogo_' . $i]);
                        if ($provedores_requi_catalogo_delete) {
                            $provedores_requi_catalogo_delete->delete();
                        } else {
                            $provedores_requi_catalogo_delete_regreso = ContractManagerProvedorRequisicionCatalogo::where('proveedor_id', $this->selectedInput[$prove_count])->where('requisicion_id', $this->editrequisicion->id)->first();
                            if ($provedores_requi_catalogo_delete_regreso) {
                                $provedores_requi_catalogo_delete_regreso->delete();
                            }
                        }
                    }

                    $this->provedores_colllection_catalogo = ContractManagerProvedorRequisicionCatalogo::create([
                        'requisicion_id' =>   $editrequisicion,
                        'proveedor_id' => $this->selectedInput[$prove_count],
                        'fecha_inicio'  => $data['contacto_fecha_inicio_' . $i],
                        'fecha_fin'  => $data['contacto_fecha_fin_' . $i],
                    ]);
                }

                $proveedores_escogidos = ContractManagerProvedorRequisicionCatalogo::where('requisicion_id', $editrequisicion)->pluck('proveedor_id')->toArray();

                $this->proveedores_show = ContractManagerProveedorOC::whereIn('id', $proveedores_escogidos)->get();

                $prove_count = $prove_count + 1;

                $this->emit('cambiarTab', 'contact');

                $this->dataFirma($editrequisicion);
            }
        }

        $this->habilitar_proveedores = true;
    }

    public function dataFirma($editrequisicion)
    {
        $this->habilitar_proveedores = false;
        $this->requi_firmar = ContractManagerRequsicion::find($editrequisicion);
        $this->productos_view = ContractManagerProductoRequisicion::where('requisiciones_id', $editrequisicion)->get();
        $this->proveedores_view = ContractManagerProveedorRequisicion::where('requisiciones_id', $editrequisicion)->get();
        $requisicion = $this->requisicion = ContractManagerRequsicion::find($editrequisicion);
        $comprador = ContractManagerComprador::where('id', $requisicion->comprador_id)->first();
        $contrato = ContractManagerContrato::where('id', $requisicion->contrato_id)->first();
        $this->emit('render_firma');
        $this->habilitar_firma = true;
    }

    public function Firmar($data)
    {
        $this->habilitar_proveedores = false;

        $fecha = date('d-m-Y');

        if ($data['firma']) {
            $this->editrequisicion->update([
                'firma_solicitante' => $data['firma'],
                'estado' => 'curso',
            ]);

            $this->editrequisicion->fecha_firma_solicitante_requi = $fecha;
            $this->editrequisicion->save();

            $tipo_firma = 'firma_solicitante';
            $organizacion = Organizacion::first();

            $supervisor = User::getCurrentUser()->empleado->supervisor->email;

            Mail::to(trim($this->removeUnicodeCharacters($supervisor)))->send(new RequisicionesEmail($this->editrequisicion, $organizacion, $tipo_firma));

            return redirect(route('contract_manager.requisiciones'));
        }
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }
}
