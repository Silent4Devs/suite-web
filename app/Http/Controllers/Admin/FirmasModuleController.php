<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denuncias;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\IncidentesSeguridad;
use App\Models\Mejoras;
use App\Models\Minutasaltadireccion;
use App\Models\Modulo;
use App\Models\Quejas;
use App\Models\RiesgoIdentificado;
use App\Models\Submodulo;
use App\Models\Sugerencias;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
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

        $modulos = Modulo::get();

        $submodulos = Submodulo::get();

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
        $modulos = Modulo::get();
        $submodulos = Submodulo::get();
        $empleados = User::orderBy('name', 'asc')->get();

        // Convertir la cadena de participantes a un array si es una cadena delimitada
        $participantes = [];
        if (! empty($firma_module->participantes)) {
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

    public function seguridad(Request $request, $id)
    {
        $seguridad = IncidentesSeguridad::where('id', $id)->first();

        if ($seguridad->estatus === 'Cerrado' || $seguridad->estatus === 'No procedente') {

            $existingRecord = FirmaCentroAtencion::where('id_seguridad', $id)->where('user_id', Auth::id())->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $base64Image = $request->firma;

            // Eliminar el prefijo 'data:image/png;base64,' si existe
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, gif

                if (! in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Tipo de imagen inválido');
                }
            } else {
                throw new \Exception('Datos de imagen base64 inválidos');
            }

            // Decodificar la cadena Base64
            $image = base64_decode($base64Image);

            if (strpos($base64Image, 'data:image/') === 0) {
                [$type, $base64Image] = explode(';', $base64Image);
                [, $base64Image] = explode(',', $base64Image);
            }

            // Generar un nombre único para la imagen
            $imageName = uniqid().'.'.$type;
            // Guardar la imagen en el sistema de archivos

            $ruta_carpeta = storage_path('app/public/seguridad/'.$seguridad->id.'/firma');

            if (! is_dir($ruta_carpeta)) {
                mkdir($ruta_carpeta, 0777, true);
            }

            chmod($ruta_carpeta, 0777);

            Storage::put('public/seguridad/'.$seguridad->id.'/firma/'.$imageName, $image);

            // Obtener la URL de la imagen guardada
            $imageUrl = Storage::url('public/seguridad/'.$seguridad->id.'/firma/'.$imageName);

            $firmaModule = FirmaCentroAtencion::create([
                'modulo_id' => 1,
                'submodulo_id' => 1,
                'empleado_id' => User::getCurrentUser()->empleado->id,
                'firma' => $imageName,
                'user_id' => Auth::id(),
                'id_seguridad' => $id,
            ]);

            return redirect()->route('admin.desk.index')->with('success', 'Actualizado con éxito');
        } else {
            return redirect()->route('admin.desk.index')->with('error', 'El registro aun no cuenta con un status  para poder ser aprobado');
        }
    }

    public function riesgos(Request $request, $id)
    {
        $modulo = 1;
        $submodulo = 4;

        $riesgo = RiesgoIdentificado::where('id', $id)->first();

        if ($riesgo->estatus === 'cerrado' || $riesgo->estatus === 'cancelado') {
            $existingRecord = FirmaCentroAtencion::where('id_riesgos', $id)->where('user_id', Auth::id())->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $base64Image = $request->firma;

            // Eliminar el prefijo 'data:image/png;base64,' si existe
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, gif

                if (! in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Tipo de imagen inválido');
                }
            } else {
                throw new \Exception('Datos de imagen base64 inválidos');
            }

            // Decodificar la cadena Base64
            $image = base64_decode($base64Image);

            if (strpos($base64Image, 'data:image/') === 0) {
                [$type, $base64Image] = explode(';', $base64Image);
                [, $base64Image] = explode(',', $base64Image);
            }

            // Generar un nombre único para la imagen
            $imageName = uniqid().'.'.$type;
            // Guardar la imagen en el sistema de archivos

            $ruta_carpeta = storage_path('app/public/riesgos/'.$riesgo->id.'/firma');

            if (! is_dir($ruta_carpeta)) {
                mkdir($ruta_carpeta, 0777, true);
            }

            chmod($ruta_carpeta, 0777);

            Storage::put('public/riesgos/'.$riesgo->id.'/firma/'.$imageName, $image);

            // Obtener la URL de la imagen guardada
            $imageUrl = Storage::url('public/riesgos/'.$riesgo->id.'/firma/'.$imageName);

            $firmaModule = FirmaCentroAtencion::create([
                'modulo_id' => $modulo,
                'submodulo_id' => $submodulo,
                'user_id' => Auth::id(),
                'firma' => $imageName,
                'id_riesgos' => $id,
            ]);

            return redirect()->route('admin.desk.index')->with('success', 'Actualizado con éxito');
        } else {
            return redirect()->route('admin.desk.index')->with('error', 'El registro aun no cuenta con un status  para poder ser aprobado');
        }
    }

    public function mejoras(Request $request, $id)
    {
        $modulo = 1;

        $submodulo = 2;

        $mejoras = Mejoras::where('id', $id)->first();

        if ($mejoras->estatus === 'cerrado' || $mejoras->estatus === 'cancelado') {
            $existingRecord = FirmaCentroAtencion::where('id_mejoras', $id)->where('user_id', Auth::id())->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $base64Image = $request->firma;

            // Eliminar el prefijo 'data:image/png;base64,' si existe
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, gif

                if (! in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Tipo de imagen inválido');
                }
            } else {
                throw new \Exception('Datos de imagen base64 inválidos');
            }

            // Decodificar la cadena Base64
            $image = base64_decode($base64Image);

            if (strpos($base64Image, 'data:image/') === 0) {
                [$type, $base64Image] = explode(';', $base64Image);
                [, $base64Image] = explode(',', $base64Image);
            }

            // Generar un nombre único para la imagen
            $imageName = uniqid().'.'.$type;
            // Guardar la imagen en el sistema de archivos

            $ruta_carpeta = storage_path('app/public/mejoras/'.$mejoras->id.'/firma');

            if (! is_dir($ruta_carpeta)) {
                mkdir($ruta_carpeta, 0777, true);
            }

            chmod($ruta_carpeta, 0777);

            Storage::put('public/mejoras/'.$mejoras->id.'/firma/'.$imageName, $image);

            // Obtener la URL de la imagen guardada
            $imageUrl = Storage::url('public/mejoras/'.$mejoras->id.'/firma/'.$imageName);

            $firmaModule = FirmaCentroAtencion::create([
                'modulo_id' => $modulo,
                'submodulo_id' => $submodulo,
                'user_id' => Auth::id(),
                'firma' => $imageName,
                'id_mejoras' => $id,
            ]);

            return redirect()->route('admin.desk.index')->with('success', 'Actualizado con éxito');
        } else {
            return redirect()->route('admin.desk.index')->with('error', 'El registro aun no cuenta con un status  para poder ser aprobado');
        }
    }

    public function denuncias(Request $request, $id)
    {
        $modulo = 1;
        $submodulo = 6;

        $denuncia = Denuncias::where('id', $id)->first();

        if ($denuncia->estatus === 'cerrado' || $denuncia->estatus === 'cancelado') {
            $existingRecord = FirmaCentroAtencion::where('id_denuncias', $id)->where('user_id', Auth::id())->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $base64Image = $request->firma;

            // Eliminar el prefijo 'data:image/png;base64,' si existe
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, gif

                if (! in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Tipo de imagen inválido');
                }
            } else {
                throw new \Exception('Datos de imagen base64 inválidos');
            }

            // Decodificar la cadena Base64
            $image = base64_decode($base64Image);

            if (strpos($base64Image, 'data:image/') === 0) {
                [$type, $base64Image] = explode(';', $base64Image);
                [, $base64Image] = explode(',', $base64Image);
            }

            // Generar un nombre único para la imagen
            $imageName = uniqid().'.'.$type;
            // Guardar la imagen en el sistema de archivos

            $ruta_carpeta = storage_path('app/public/denuncias/'.$denuncia->id.'/firma');

            if (! is_dir($ruta_carpeta)) {
                mkdir($ruta_carpeta, 0777, true);
            }

            chmod($ruta_carpeta, 0777);

            Storage::put('public/denuncias/'.$denuncia->id.'/firma/'.$imageName, $image);

            // Obtener la URL de la imagen guardada
            $imageUrl = Storage::url('public/denuncias/'.$denuncia->id.'/firma/'.$imageName);

            $firmaModule = FirmaCentroAtencion::create([
                'modulo_id' => $modulo,
                'submodulo_id' => $submodulo,
                'user_id' => Auth::id(),
                'firma' => $imageName,
                'id_denuncias' => $id,
            ]);

            return redirect()->route('admin.desk.index')->with('success', 'Actualizado con éxito');
        } else {
            return redirect()->route('admin.desk.index')->with('error', 'El registro aun no cuenta con un status  para poder ser aprobado');
        }
    }

    public function quejas(Request $request, $id)
    {
        $modulo = 1;

        $submodulo = 3;

        $quejas = Quejas::where('id', $id)->first();

        if ($quejas->estatus === 'cerrado' || $quejas->estatus === 'cancelado') {
            $existingRecord = FirmaCentroAtencion::where('id_quejas', $id)->where('user_id', Auth::id())->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $base64Image = $request->firma;

            // Eliminar el prefijo 'data:image/png;base64,' si existe
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, gif

                if (! in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Tipo de imagen inválido');
                }
            } else {
                throw new \Exception('Datos de imagen base64 inválidos');
            }

            // Decodificar la cadena Base64
            $image = base64_decode($base64Image);

            if (strpos($base64Image, 'data:image/') === 0) {
                [$type, $base64Image] = explode(';', $base64Image);
                [, $base64Image] = explode(',', $base64Image);
            }

            // Generar un nombre único para la imagen
            $imageName = uniqid().'.'.$type;
            // Guardar la imagen en el sistema de archivos

            $ruta_carpeta = storage_path('app/public/quejas/'.$quejas->id.'/firma');

            if (! is_dir($ruta_carpeta)) {
                mkdir($ruta_carpeta, 0777, true);
            }

            chmod($ruta_carpeta, 0777);

            Storage::put('public/quejas/'.$quejas->id.'/firma/'.$imageName, $image);

            // Obtener la URL de la imagen guardada
            $imageUrl = Storage::url('public/quejas/'.$quejas->id.'/firma/'.$imageName);

            $firmaModule = FirmaCentroAtencion::create([
                'modulo_id' => $modulo,
                'submodulo_id' => $submodulo,
                'user_id' => Auth::id(),
                'firma' => $imageName,
                'id_quejas' => $id,
            ]);

            return redirect()->route('admin.desk.index')->with('success', 'Actualizado con éxito');
        } else {
            return redirect()->route('admin.desk.index')->with('error', 'El registro aun no cuenta con un status  para poder ser aprobado');
        }
    }

    public function sugerencias(Request $request, $id)
    {
        $modulo = 1;
        $submodulo = 5;

        $sugerencias = Sugerencias::where('id', $id)->first();

        if ($sugerencias->estatus === 'cerrado' || $sugerencias->estatus === 'cancelado') {
            $existingRecord = FirmaCentroAtencion::where('id_sugerencias', $id)->where('user_id', Auth::id())->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $base64Image = $request->firma;

            // Eliminar el prefijo 'data:image/png;base64,' si existe
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, gif

                if (! in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Tipo de imagen inválido');
                }
            } else {
                throw new \Exception('Datos de imagen base64 inválidos');
            }

            // Decodificar la cadena Base64
            $image = base64_decode($base64Image);

            if (strpos($base64Image, 'data:image/') === 0) {
                [$type, $base64Image] = explode(';', $base64Image);
                [, $base64Image] = explode(',', $base64Image);
            }

            // Generar un nombre único para la imagen
            $imageName = uniqid().'.'.$type;
            // Guardar la imagen en el sistema de archivos

            $ruta_carpeta = storage_path('app/public/sugerencias/'.$sugerencias->id.'/firma');

            if (! is_dir($ruta_carpeta)) {
                mkdir($ruta_carpeta, 0777, true);
            }

            chmod($ruta_carpeta, 0777);

            Storage::put('public/sugerencias/'.$sugerencias->id.'/firma/'.$imageName, $image);

            // Obtener la URL de la imagen guardada
            $imageUrl = Storage::url('public/sugerencias/'.$sugerencias->id.'/firma/'.$imageName);

            $firmaModule = FirmaCentroAtencion::create([
                'modulo_id' => $modulo,
                'submodulo_id' => $submodulo,
                'user_id' => Auth::id(),
                'firma' => $imageName,
                'id_sugerencias' => $id,
            ]);

            return redirect()->route('admin.desk.index')->with('success', 'Actualizado con éxito');
        } else {
            return redirect()->route('admin.desk.index')->with('error', 'El registro aun no cuenta con un status  para poder ser aprobado');
        }
    }

    public function minutas(Request $request, $id)
    {

        $minuta = Minutasaltadireccion::where('id', $id)->first();

        $base64Image = $request->firma;

        // Eliminar el prefijo 'data:image/png;base64,' si existe
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]); // png, jpg, gif

            if (! in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('Tipo de imagen inválido');
            }
        } else {
            throw new \Exception('Datos de imagen base64 inválidos');
        }

        // Decodificar la cadena Base64
        $image = base64_decode($base64Image);

        if (strpos($base64Image, 'data:image/') === 0) {
            [$type, $base64Image] = explode(';', $base64Image);
            [, $base64Image] = explode(',', $base64Image);
        }

        // Generar un nombre único para la imagen
        $imageName = uniqid().'.'.$type;
        // Guardar la imagen en el sistema de archivos

        $ruta_carpeta = storage_path('app/public/minuta/'.$minuta->id.'/firma');

        if (! is_dir($ruta_carpeta)) {
            mkdir($ruta_carpeta, 0777, true);
        }

        chmod($ruta_carpeta, 0777);

        Storage::put('public/minuta/'.$minuta->id.'/firma/'.$imageName, $image);

        // Obtener la URL de la imagen guardada
        $imageUrl = Storage::url('public/minuta/'.$minuta->id.'/firma/'.$imageName);

        $firmaModule = FirmaCentroAtencion::create([
            'modulo_id' => 3,
            'submodulo_id' => 8,
            'empleado_id' => User::getCurrentUser()->empleado->id,
            'firma' => $imageName,
            'id_minutas' => $id,
            'user_id' => User::getCurrentUser()->id,
        ]);

        return redirect()->back()->with('success', 'Actualizado con éxito');
    }
}
