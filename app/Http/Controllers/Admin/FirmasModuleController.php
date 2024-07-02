<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\Modulo;
use App\Models\Submodulo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FirmasModuleController extends Controller
{
    public function index(Request $request)
    {
        $firmaModules = FirmaModule::with('modulo', 'submodulo')->get();

        // Obtener detalles de los empleados
        foreach ($firmaModules as $firma) {
            $participantesIds = json_decode($firma->participantes);
            if ($participantesIds) {
                $firma->empleados = User::whereIn('id', $participantesIds)->get();
            } else {
                $firma->empleados = collect();
            }
        }
        return view('admin.firmas.index', compact('firmaModules'));
    }


    public function create()
    {

        $empleados = User::orderBy('name', 'asc')
            ->get();

        $modulos = Modulo::all();

        $submodulos = Submodulo::all();

        return view('admin.firmas.create', compact('modulos', 'submodulos', 'empleados'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'modulos' => 'required|exists:modulos,id',
            'submodulos' => 'required|exists:submodulos,id',
            'participantes' => 'required|array', // Asegúrate de que participantes sea un array
        ]);

        $existingRecord = FirmaModule::where('modulo_id', $request->modulos)
            ->where('submodulo_id', $request->submodulos)
            ->exists();

        if ($existingRecord) {
            // Manejar el caso de error
            return back()->withInput()->withErrors(['error' => 'Ya existe un registro con este módulo y submódulo.']);
        }

        // Crear un nuevo registro de FirmaModule
        $firmaModule = FirmaModule::create([
            'modulo_id' => $request->modulos,
            'submodulo_id' => $request->submodulos,
            'participantes' => json_encode($request->participantes), // Guardar el array de IDs como JSON
        ]);

        return redirect()->route('admin.module_firmas')->with('success', 'Guardado con éxito');
    }
}
