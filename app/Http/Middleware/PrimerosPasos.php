<?php

namespace App\Http\Middleware;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\Puesto;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class PrimerosPasos
{
    protected $except = [
        '/admin/inicioUsuario',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $existsEmpleado = Empleado::exists();
        $existsOrganizacion = Organizacion::exists();
        $existsAreas = Area::exists();
        $existsPuesto = Puesto::exists();
        $existsVinculoEmpleadoAdmin = User::orderBy('id')->first()->empleado_id != null ? true : false;
        if (
            ! $existsEmpleado ||
            ! $existsOrganizacion ||
            ! $existsAreas ||
            ! $existsPuesto ||
            ! $existsVinculoEmpleadoAdmin
        ) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        return $next($request);
    }
}
