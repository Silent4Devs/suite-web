<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Area;
use App\Models\User;
use App\Models\Puesto;
use App\Models\Empleado;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $existsEmpleado = DB::table('empleados')->exists();
        $existsOrganizacion = DB::table('organizacions')->exists();
        $existsAreas = DB::table('areas')->exists();
        $existsPuesto = DB::table('puestos')->exists();
        $existsVinculoEmpleadoAdmin = DB::table('users')->orderBy('id')->first()->empleado_id != null ? true : false;
        if (
            !$existsEmpleado ||
            !$existsOrganizacion ||
            !$existsAreas ||
            !$existsPuesto ||
            !$existsVinculoEmpleadoAdmin
        ) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        return $next($request);
    }
}
