<?php

namespace App\Livewire;

use App\Models\HistorialEdicionesReq;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\Contrato as KatbolContrato;
use App\Models\ContractManager\ProvedorRequisicionCatalogo as KatbolProvedorRequisicionCatalogo;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use App\Models\ContractManager\Sucursal as KatbolSucursal;
use App\Models\ContractManager\Producto;
use Livewire\Component;

class TablaHistoricoRequisiciones extends Component
{
    public $id_req;

    public function mount($idReq)
    {
        $this->id_req = $idReq;
    }

    public function render()
    {
        // Obtener los historiales de la requisición específica
        $historialesRequisicion = HistorialEdicionesReq::with('version', 'empleado')
        ->where('requisicion_id', $this->id_req)
        ->get();

        // Agrupar los historiales por versión
        $agrupadosPorVersionRequisiciones = $historialesRequisicion->groupBy(function ($item) {
            return $item->version->version; // Suponiendo que 'version' es una columna en la relación
        });

        $resultadoRequisiciones = [];
        foreach ($agrupadosPorVersionRequisiciones as $version => $cambios) {
            // dd($cambios);
            $cambios = $this->formatearValoresId($cambios);

            $resultadoRequisiciones[] = [
                'version' => $version,
                'cambios' => $cambios,
            ];
        }
        // dd($resultadoRequisiciones);
        // Obtener el valor máximo de la versión del array de resultados
        $maximaVersion = collect($resultadoRequisiciones)->max('version');

        $contadorEdit = 3 - $maximaVersion;

        return view('livewire.tabla-historico-requisiciones');
    }

    public function formatearValoresId($cambios)
    {
        foreach ($cambios as $keyCambio => $registro) {

            switch ($registro->campo) {
                case 'contrato_id':
                    $valor_anterior = KatbolContrato::where('id', $registro->valor_anterior)->first();
                    $valor_nuevo = KatbolContrato::where('id', $registro->valor_nuevo)->first();

                    $va = $valor_anterior->no_contrato . ' - ' . $valor_anterior->nombre_servicio;
                    $vn = $valor_nuevo->no_contrato . ' - ' . $valor_nuevo->nombre_servicio;

                    $registro->valor_anterior = $va;
                    $registro->valor_nuevo = $vn;

                    break;

                case 'comprador_id':
                    $valor_anterior = KatbolComprador::where('id', $registro->valor_anterior)->first();
                    $valor_nuevo = KatbolComprador::where('id', $registro->valor_nuevo)->first();

                    $va = $valor_anterior->nombre;
                    $vn = $valor_nuevo->nombre;

                    $registro->valor_anterior = $va;
                    $registro->valor_nuevo = $vn;
                    break;

                case 'sucursal_id':
                    $valor_anterior = KatbolSucursal::where('id', $registro->valor_anterior)->first();
                    $valor_nuevo = KatbolSucursal::where('id', $registro->valor_nuevo)->first();

                    $va = $valor_anterior->empresa;
                    $vn = $valor_nuevo->empresa;

                    $registro->valor_anterior = $va;
                    $registro->valor_nuevo = $vn;
                    break;

                case 'producto_id':

                    $valor_anterior = Producto::where('id', $registro->valor_anterior)->first();
                    $valor_nuevo = Producto::where('id', $registro->valor_nuevo)->first();

                    $va = $valor_anterior->descripcion;
                    $vn = $valor_nuevo->descripcion;

                    $registro->valor_anterior = $va;
                    $registro->valor_nuevo = $vn;
                    break;

                case 'proveedor_id':
                    $valor_anterior = KatbolProveedorOC::where('id', $registro->valor_anterior)->first();
                    $valor_nuevo = KatbolProveedorOC::where('id', $registro->valor_nuevo)->first();

                    $va = $valor_anterior->razon_social . ' - ' . $valor_anterior->nombre;
                    $vn = $valor_nuevo->razon_social . ' - ' . $valor_nuevo->nombre;

                    $registro->valor_anterior = $va;
                    $registro->valor_nuevo = $vn;
                    break;

                case 'proveedoroc_id':
                    $valor_anterior = KatbolProveedorOC::where('id', $registro->valor_anterior)->first();
                    $valor_nuevo = KatbolProveedorOC::where('id', $registro->valor_nuevo)->first();

                    $va = $valor_anterior->razon_social . ' - ' . $valor_anterior->nombre;
                    $vn = $valor_nuevo->razon_social . ' - ' . $valor_nuevo->nombre;

                    $registro->valor_anterior = $va;
                    $registro->valor_nuevo = $vn;
                    break;

                default:
                    // Nada, no se modifica el registro
                    break;
            };
        }

        return $cambios;
    }
}
