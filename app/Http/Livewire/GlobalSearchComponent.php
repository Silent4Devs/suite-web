<?php

namespace App\Http\Livewire;

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
            $routes = Route::getRoutes()->getRoutes(); // Get all routes

            $filteredRoutes = collect($routes)->filter(function ($route) {
                // Exclude specific route patterns and HTTP methods
                $uri = $route->uri();
                $uriSegments = explode('/', $route->uri());
                $methods = $route->methods();

                // Filter URI segments to check if any segment matches the search term
                $matchingSegments = array_filter($uriSegments, function ($segment) {
                    return strpos($segment, $this->search) !== false;
                });

                return
                    ! in_array('POST', $methods) // Exclude POST method
                    && ! in_array('PUT', $methods) // Exclude PUT method
                    && ! in_array('PATCH', $methods) // Exclude PATCH method
                    && ! in_array('DELETE', $methods) // Exclude DELETE method
                    && count($uriSegments) <= 2
                    && ! preg_match('/password\/reset/', $uri) // Exclude specific route pattern
                    && ! preg_match('/create/', $uri) // Exclude specific route pattern
                    && ! preg_match('/edit/', $uri) // Exclude specific route pattern
                    && ! preg_match('/store/', $uri) // Exclude specific route pattern
                    && ! preg_match('/eliminados/', $uri) // Exclude specific route pattern
                    && ! preg_match('/team-members/', $uri) // Exclude specific route pattern
                    && ! preg_match('/admin\/teams/', $uri) // Exclude specific route pattern
                    && ! preg_match('/admin\/audit-logs/', $uri) // Exclude specific route pattern
                    && ! preg_match('/admin\/visualizar-logs/', $uri) // Exclude specific route pattern
                    && ! preg_match('/global-search/', $uri) // Exclude specific route pattern
                    && ! preg_match('/File-manager/', $uri) // Exclude specific route pattern
                    && ! preg_match('/Sanctum/', $uri) // Exclude specific route pattern
                    && ! preg_match('/Livewire/', $uri) // Exclude specific route pattern
                    && ! preg_match('/Register/', $uri) // Exclude specific route pattern
                    && ! preg_match('/Password/', $uri) // Exclude specific route pattern
                    && ! preg_match('/exportar/', $uri) // Exclude specific route pattern
                    && strpos($uri, '{') === false // Exclude routes with curly braces {}
                    && strpos($uri, 'get') === false // Exclude routes with curly braces {}
                    && strpos($uri, 'Export') === false // Exclude routes with curly braces {}
                    && ! empty($matchingSegments); // At least one segment matches the search term
            })->map(function ($route) {
                // Map routes to an array of route information
                return [
                    'uri' => $route->uri(),
                    //'method' => implode('|', $route->methods()),
                    //'name' => $route->getName(),
                    // Add more route details as needed
                ];
            })->values()->all();

            $this->result = $filteredRoutes;
        } else {
            $this->result = []; // Clear results if the search term is empty
        }

    }

    public function render()
    {
        return view('livewire.global-search-component');
    }
}
