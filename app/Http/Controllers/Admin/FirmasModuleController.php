<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\Modulo;
use App\Models\Submodulo;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

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


    public function edit($id)
    {
        $firma_module = FirmaModule::findOrFail($id); // Usa findOrFail para manejo de errores
        $modulos = Modulo::all();
        $submodulos = Submodulo::all();
        $empleados = User::orderBy('name', 'asc')->get();

        // Convertir la cadena de participantes a un array si es una cadena delimitada
        $participantes = [];
        if (!empty($firma_module->participantes)) {
            $cleanString = str_replace(['[', ']', '"'], '', $firma_module->participantes);
            $participantes = explode(',', $cleanString);
            $participantes = array_map('trim', $participantes);
        }

        return view('admin.firmas.edit', compact('modulos', 'submodulos', 'empleados', 'firma_module', 'participantes'));
    }


    public function update(Request $request, $id)
    {
        $firma = FirmaModule::find($id);

        $firma->update([
            'modulo_id' => $firma->modulo_id,
            'submodulo_id' => $firma->submodulo_id,
            'participantes' => json_encode($request->participantes),
        ]);

        return redirect()->route('admin.module_firmas')->with('success', 'Actualizado con éxito');
    }

    public function seguridad(Request $request)
    {
        $firmaModule = FirmaCentroAtencion::create([
            'modulo_id' => 1,
            'submodulo_id' => 1,
            'user_id' => Auth::id(),
            'firma' => $request->firma,
        ]);

        return redirect()->route('admin.module_firmas')->with('success', 'Actualizado con éxito');
    }

    public function riesgos(Request $request)
    {
        $modulo = 1;
        $submodulo = 4;

        $firmaModule = FirmaCentroAtencion::create([
            'modulo_id' => $modulo,
            'submodulo_id' => $submodulo,
            'user_id' => Auth::id(),
            'firma' => $request->firma,
        ]);

        return redirect()->route('admin.module_firmas')->with('success', 'Actualizado con éxito');
    }

    public function mejoras(Request $request)
    {
        $modulo = 1;

        $submodulo = 2;

        $firmaModule = FirmaCentroAtencion::create([
            'modulo_id' => $modulo,
            'submodulo_id' => $submodulo,
            'user_id' => Auth::id(),
            'firma' => $request->firma,
        ]);

        return redirect()->route('admin.module_firmas')->with('success', 'Actualizado con éxito');
    }

    public function denuncias(Request $request)
    {
        $modulo = 1;
        $submodulo = 6;

        $firmaModule = FirmaCentroAtencion::create([
            'modulo_id' => $modulo,
            'submodulo_id' => $submodulo,
            'user_id' => Auth::id(),
            'firma' => $request->firma,
        ]);

        return redirect()->route('admin.module_firmas')->with('success', 'Actualizado con éxito');
    }

    public function quejas(Request $request)
    {
        $modulo = 1;

        $submodulo = 3;

        $firmaModule = FirmaCentroAtencion::create([
            'modulo_id' => $modulo,
            'submodulo_id' => $submodulo,
            'user_id' => Auth::id(),
            'firma' => $request->firma,
        ]);

        return redirect()->route('admin.module_firmas')->with('success', 'Actualizado con éxito');
    }

    public function sugerencias(Request $request)
    {
        $modulo = 1;
        $submodulo = 5;

        $firmaModule = FirmaCentroAtencion::create([
            'modulo_id' => $modulo,
            'submodulo_id' => $submodulo,
            'user_id' => Auth::id(),
            'firma' => $request->firma,
        ]);

        return redirect()->route('admin.module_firmas')->with('success', 'Actualizado con éxito');
    }
}