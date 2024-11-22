<?php

namespace App\Livewire;

use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\Contrato as KatbolContrato;
use App\Models\ContractManager\Producto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Sucursal as KatbolSucursal;
use App\Models\HistorialEdicionesReq;
use Livewire\Component;
use Livewire\WithPagination;

class TablaHistoricoRequisiciones extends Component
{
    use WithPagination; // Esto habilita la paginación en Livewire

    public $id_req; // ID de la requisición

    public $perPage = 5; // Número de cambios por página

    public $paginaPorVersion = []; // Página actual para cada versión

    public function mount($idReq)
    {
        $this->id_req = $idReq;

        // Inicializar las páginas para cada versión
        $this->paginaPorVersion = [
            1 => 1,
            2 => 1,
            3 => 1,
        ];
    }

    public function actualizarPagina($version, $pagina)
    {
        $this->paginaPorVersion[$version] = $pagina;
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

        // Iterar sobre las versiones agrupadas
        foreach ($agrupadosPorVersionRequisiciones as $version => $cambios) {
            // Si no hay cambios para la versión, se omite
            if ($cambios->isEmpty()) {
                continue;
            }

            // Formatear los valores
            $cambios = $this->formatearValoresId($cambios);

            // Paginación personalizada para cada versión
            $paginaActual = $this->paginaPorVersion[$version] ?? 1;
            $cambiosPaginados = $cambios->forPage($paginaActual, $this->perPage);

            $resultadoRequisiciones[] = [
                'version' => $version,
                'cambios' => $cambiosPaginados,
                'total' => $cambios->count(),
                'paginaActual' => $paginaActual,
            ];
        }

        return view('livewire.tabla-historico-requisiciones', compact('resultadoRequisiciones'));
    }

    public function formatearValoresId($cambios)
    {
        // Precargar datos relacionados para evitar múltiples consultas
        $contratos = KatbolContrato::pluck('no_contrato', 'id');
        $servicios = KatbolContrato::pluck('nombre_servicio', 'id');
        $compradores = KatbolComprador::pluck('nombre', 'id');
        $sucursales = KatbolSucursal::pluck('empresa', 'id');
        $productos = Producto::pluck('descripcion', 'id');
        $proveedores = KatbolProveedorOC::get()->keyBy('id');

        foreach ($cambios as $registro) {
            switch ($registro->campo) {
                case 'contrato_id':
                    $registro->valor_anterior = isset($contratos[$registro->valor_anterior])
                        ? $contratos[$registro->valor_anterior] . ' - ' . $servicios[$registro->valor_anterior]
                        : 'Sin valor anterior registrado';
                    $registro->valor_nuevo = isset($contratos[$registro->valor_nuevo])
                        ? $contratos[$registro->valor_nuevo] . ' - ' . $servicios[$registro->valor_nuevo]
                        : 'Sin valor nuevo registrado';
                    break;

                case 'comprador_id':
                    $registro->valor_anterior = $compradores[$registro->valor_anterior] ?? 'Sin valor anterior registrado';
                    $registro->valor_nuevo = $compradores[$registro->valor_nuevo] ?? 'Sin valor nuevo registrado';
                    break;

                case 'sucursal_id':
                    $registro->valor_anterior = $sucursales[$registro->valor_anterior] ?? 'Sin valor anterior registrado';
                    $registro->valor_nuevo = $sucursales[$registro->valor_nuevo] ?? 'Sin valor nuevo registrado';
                    break;

                case 'producto_id':
                    $registro->valor_anterior = $productos[$registro->valor_anterior] ?? 'Sin valor anterior registrado';
                    $registro->valor_nuevo = $productos[$registro->valor_nuevo] ?? 'Sin valor nuevo registrado';
                    break;

                case 'proveedor_id':
                case 'proveedoroc_id':
                    $registro->valor_anterior = isset($proveedores[$registro->valor_anterior])
                        ? $proveedores[$registro->valor_anterior]->razon_social . ' - ' . $proveedores[$registro->valor_anterior]->nombre
                        : 'Sin valor anterior registrado';
                    $registro->valor_nuevo = isset($proveedores[$registro->valor_nuevo])
                        ? $proveedores[$registro->valor_nuevo]->razon_social . ' - ' . $proveedores[$registro->valor_nuevo]->nombre
                        : 'Sin valor nuevo registrado';
                    break;

                default:
                    break;
            }
        }

        return $cambios;
    }
}
