<?php

namespace App\Livewire;

use App\Models\PermisosCargaObjetivos;
use Livewire\Component;

class PermisosCargaObjetivosVista extends Component
{
    public $permisos;

    public function render()
    {
        $this->permisos = PermisosCargaObjetivos::select('id', 'perfil', 'permisos_asignacion', 'permiso_objetivos', 'permiso_escala')->orderBy('id')->get();

        // dd($this->permisos);
        return view('livewire.permisos-carga-objetivos-vista');
    }

    public function cambioPermiso($perfil, $valor)
    {
        // dd($perfil, $valor);
        switch ($perfil) {
            case 'administradores':
                PermisosCargaObjetivos::where('perfil', 'Administrador')->update(['permisos_asignacion' => $valor]);
                break;

            case 'jefes-inmediatos':
                PermisosCargaObjetivos::where('perfil', 'Jefe Inmediato')->update(['permisos_asignacion' => $valor]);
                break;

            case 'colaboradores':
                PermisosCargaObjetivos::where('perfil', 'Colaborador')
                    ->update([
                        'permisos_asignacion' => $valor,
                        'permiso_objetivos' => $valor,
                        'permiso_escala' => $valor,
                    ]);
                break;

            case 'colaboradores-objetivos':
                PermisosCargaObjetivos::where('perfil', 'Colaborador')
                    ->update([
                        'permiso_objetivos' => $valor,
                    ]);
                break;

            case 'colaboradores-escalas':
                PermisosCargaObjetivos::where('perfil', 'Colaborador')
                    ->update([
                        'permiso_escala' => $valor,
                    ]);
                break;

            default:
                // code...
                break;
        }
    }
}
