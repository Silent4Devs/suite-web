<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class GlobalSearchComponent extends Component
{
    public $search = '';

    public $result = [];

    public $lugar = '';

    public function mount(string $lugar)
    {
        $this->lugar = $lugar;
        $this->result = [];
    }

    public function updatedSearch()
    {
        if (! empty($this->search)) {
            $routes = Route::getRoutes()->getRoutes(); // Obtener todas las rutas

            $filteredRoutes = collect($routes)->filter(function ($route) {
                // Excluir patrones específicos de ruta y métodos HTTP
                $uri = $route->uri();
                $uriSegments = explode('/', $route->uri());
                $methods = $route->methods();

                // Filtrar segmentos de URI para verificar si algún segmento coincide con el término de búsqueda
                $matchingSegments = array_filter($uriSegments, function ($segment) {
                    return strpos($segment, $this->search) !== false;
                });

                return
                    ! in_array('POST', $methods) // Excluir método POST
                    && ! in_array('PUT', $methods) // Excluir método PUT
                    && ! in_array('PATCH', $methods) // Excluir método PATCH
                    && ! in_array('DELETE', $methods) // Excluir método DELETE
                    && count($uriSegments) <= 2
                    && ! preg_match('/password\/reset/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/create/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/edit/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/store/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/eliminados/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/team-members/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/admin\/teams/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/admin\/audit-logs/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/admin\/visualizar-logs/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/global-search/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/file-manager/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/File-manager/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/Sanctum/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/Livewire/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/Register/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/Password/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/password/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/exportar/', $uri) // Excluir patrón específico de ruta
                    && ! preg_match('/Contract_manager/', $uri) // Excluir patrón específico de ruta
                    && strpos($uri, '{') === false // Excluir rutas con llaves {}
                    && strpos($uri, 'get') === false // Excluir rutas con llaves {}
                    && strpos($uri, 'Export') === false // Excluir rutas con llaves {}
                    && strpos($uri, 'File-manager') === false // Excluir rutas con llaves {}
                    && strpos($uri, 'Contract_manager') === false // Excluir rutas con llaves {}
                    && strpos($uri, 'Two factor') === false // Excluir rutas con llaves {}
                    && ! empty($matchingSegments); // Al menos un segmento coincide con el término de búsqueda
            })->map(function ($route) {
                // Mapear rutas a un arreglo de información de ruta
                return [
                    'uri' => $route->uri(),
                    // 'method' => implode('|', $route->methods()),
                    // 'name' => $route->getName(),
                    // Agregar más detalles de ruta según sea necesario
                ];
            })->values()->all();

            $this->result = $filteredRoutes;
        } else {
            $this->result = []; // Limpiar resultados si el término de búsqueda está vacío
        }
    }

    public function render()
    {
        return view('livewire.global-search-component');
    }
}
