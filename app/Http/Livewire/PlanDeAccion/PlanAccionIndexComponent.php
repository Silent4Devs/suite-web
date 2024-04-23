<?php

namespace App\Http\Livewire\PlanDeAccion;

use App\Models\PlanImplementacion;
use App\Models\User;
use Livewire\Component;

class PlanAccionIndexComponent extends Component
{
    public $perPage = 5;

    public $tab;

    public function mount($tab)
    {
        $this->tab = $tab;
    }

    public function render()
    {
        $usuario = User::getCurrentUser();

        // Filtrar los planes de acción del usuario actual
        $planImplementacions = PlanImplementacion::where('es_plan_trabajo_base', false)
            ->where('elaboro_id', $usuario->empleado->id)
            ->with('elaborador')
            ->get();

        // Obtener todos los planes de acción globales
        $planImplementacionsGlobal = PlanImplementacion::where('es_plan_trabajo_base', false)
            ->with('elaborador')
            ->get();

        // Inicializar un array para almacenar los planes de acción asignados al usuario
        $planImplementacionsAssigs = [];

        // Iterar sobre los planes de acción globales
        foreach ($planImplementacionsGlobal as $plan) {
            // Verificar si el usuario está asignado a alguna tarea en este plan de acción
            foreach ($plan->tasks as $task) {
                if (property_exists($task, 'assigs')) {
                    foreach ($task->assigs as $assig) {
                        if ($assig->resourceId == $usuario->empleado->id) {
                            // Si el usuario está asignado a alguna tarea en este plan de acción,
                            // agregamos este plan de acción a $planImplementacionsAssigs
                            $planImplementacionsAssigs[] = $plan;
                            // Rompemos el bucle, ya que no es necesario seguir buscando en este plan de acción
                            break 2;
                        }
                    }
                }
            }
        }

        // Determinar el mensaje según la pestaña seleccionada
        switch ($this->tab) {
            case 1:
                $message = 'TbTableUsuario';
                break;
            case 2:
                $message = 'TbTableAsignado';
                break;
            case 3:
                $message = 'TbTableArea';
                break;
            default:
                $message = 'TbTableNull';
                break;
        }

        // Contar el número de resultados de los planes de acción del usuario actual
        $planImplementacionsCount = $planImplementacions->count();

        // Pasar los resultados a la vista
        return view('livewire.plan-de-accion.plan-accion-index-component', [
            'planImplementacions' => $planImplementacions,
            'planImplementacionsCount' => $planImplementacionsCount,
            'planImplementacionsAssigs' => $planImplementacionsAssigs,
            'message' => $message,
        ]);
    }
}
