<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdiomaEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IdiomasEmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empleado)
    {
        $idiomas = IdiomaEmpleado::where('empleado_id', intval($empleado))->get();

        return datatables()->of($idiomas)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'nombre' => 'required|string',
            'id_language' => 'required',
            'nivel' => 'required|string',
            'porcentaje' => 'nullable|numeric|min:1|max:100',
            'certificado' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf',
        ]);
        $idioma = IdiomaEmpleado::create($request->all());

        if ($request->hasFile('certificado')) {
            $filenameWithExt = $request->file('certificado')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('certificado')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('certificado')->storeAs('public/idiomas_empleados', $fileNameToStore);

            $idioma->update([
                'certificado' => $fileNameToStore,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Idioma agregado con éxito']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdiomaEmpleado $idiomaEmpleado)
    {
        // if (array_key_exists('nombre', $request->all())) {
        //     $request->validate([
        //         'nombre' => 'required|string|max:255',
        //     ]);
        //     $idiomaEmpleado->update($request->all());
        // }

        if (array_key_exists('id_language', $request->all())) {
            $request->validate([
                'id_language' => 'required',
            ]);
            $idiomaEmpleado->update($request->all());
        }

        if (array_key_exists('nivel', $request->all())) {
            $request->validate([
                'nivel' => 'required|string|max:255',
            ]);
            $idiomaEmpleado->update($request->all());
        }

        if (array_key_exists('porcentaje', $request->all())) {
            $request->validate([
                'porcentaje' => 'nullable|numeric|min:1|max:100',
            ]);

            $idiomaEmpleado->update($request->all());
        }

        if (array_key_exists('certificado', $request->all())) {
            $request->validate([
                'certificado' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf',
            ]);

            if ($request->hasFile('certificado')) {
                $filenameWithExt = $request->file('certificado')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('certificado')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->file('certificado')->storeAs('public/idiomas_empleados', $fileNameToStore);

                $idiomaEmpleado->update([
                    'certificado' => $fileNameToStore,
                ]);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Idioma Actualizado', 'idioma' => $idiomaEmpleado]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idiomaEmpleado = IdiomaEmpleado::find($id);
        $idiomaEmpleado->delete();

        return response()->json(['status' => 'success', 'message' => 'Idioma Eliminado', 'idioma' => $idiomaEmpleado]);
    }

    public function deleteCertificado(IdiomaEmpleado $idiomaEmpleado)
    {
        if (Storage::disk('public')->exists($idiomaEmpleado->ruta_absoluta_documento)) {
            Storage::disk('public')->delete($idiomaEmpleado->ruta_absoluta_documento);
        }
        $idiomaEmpleado->update([
            'certificado' => null,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Idioma Eliminado', 'idioma' => $idiomaEmpleado]);
    }
}
