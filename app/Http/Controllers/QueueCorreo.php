<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\Requsicion;
use App\Models\PlanImplementacion;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Storage;

class QueueCorreo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Benchmark::dd(fn () => DB::query("plan_implementacions")->select("id","tasks")->where("id",15)->toArray());//find(15));
        // Benchmark::dd(fn () => PlanImplementacion::find(15));
        // Send welcome email
        // for ($i = 0; $i < 1; $i++) {
        //     //Benchmark::dd(fn () => Mail::to('luis.vargas@silent4business.com')->queue(new TestMail()));
        //     Mail::to('luis.vargas@silent4business.com')->queue(new TestMail());
        // }
        // Now, $data contains all the values from the Redis table
        // dd('al ready sent');

        $documentos = Contrato::select('id', 'no_contrato', 'file_contrato')->where('deleted_at', null)->get();
        $tabla = '';
        foreach ($documentos as $key => $documento) {
            // code...
            $validacion = Storage::exists('/public/contratos/'.$documento->id.'_contrato_'.$documento->no_contrato.'/'.$documento->file_contrato);

            if (! $validacion) {
                $contratos_faltantes[] = [
                    'no_contrato' => $documento->no_contrato,
                    'archivo' => $documento->file_contrato,
                ];

                $tabla = '<html><ul><li>'.$documento->id.'&nbsp;-&nbsp;'.$documento->no_contrato.'&nbsp;-&nbsp;'.$documento->file_contrato.'</li></ul></html>';
            }
            echo $tabla;
        }
        echo '<hr>';
        echo $documentos->count();
    }

    public function insertarFirmadoresFinanzas()
    {
        $lay = 10;
        $aur = 277;
        $lou = 11;

        $datos = [
            ['requisicion_id' => 1, 'id_usuario' => $lou],
            ['requisicion_id' => 83, 'id_usuario' => $lou],
            ['requisicion_id' => 87, 'id_usuario' => $lou],
            ['requisicion_id' => 88, 'id_usuario' => $lou],
            ['requisicion_id' => 90, 'id_usuario' => $lou],
            ['requisicion_id' => 91, 'id_usuario' => $lou],
            ['requisicion_id' => 92, 'id_usuario' => $lou],
            ['requisicion_id' => 93, 'id_usuario' => $lou],
            ['requisicion_id' => 94, 'id_usuario' => $lou],
            ['requisicion_id' => 95, 'id_usuario' => $lou],
            ['requisicion_id' => 96, 'id_usuario' => $lou],
            ['requisicion_id' => 97, 'id_usuario' => $lou],
            ['requisicion_id' => 98, 'id_usuario' => $lou],
            ['requisicion_id' => 99, 'id_usuario' => $lou],
            ['requisicion_id' => 100, 'id_usuario' => $lou],
            ['requisicion_id' => 101, 'id_usuario' => $lou],
            ['requisicion_id' => 102, 'id_usuario' => $lou],
            ['requisicion_id' => 103, 'id_usuario' => $lou], //posible lay
            ['requisicion_id' => 104, 'id_usuario' => $lou],
            ['requisicion_id' => 105, 'id_usuario' => $lou],
            ['requisicion_id' => 108, 'id_usuario' => $lou],
            ['requisicion_id' => 109, 'id_usuario' => $lou],
            ['requisicion_id' => 110, 'id_usuario' => $lou], //posible lay
            ['requisicion_id' => 111, 'id_usuario' => $lou],
            ['requisicion_id' => 113, 'id_usuario' => $lou], //posible lay
            ['requisicion_id' => 114, 'id_usuario' => $lou],
            ['requisicion_id' => 116, 'id_usuario' => $lou], //posible lay
            ['requisicion_id' => 117, 'id_usuario' => $lou],
            ['requisicion_id' => 119, 'id_usuario' => $lou],
            ['requisicion_id' => 127, 'id_usuario' => $lou],
            ['requisicion_id' => 134, 'id_usuario' => $lou],
            ['requisicion_id' => 150, 'id_usuario' => $lou],
            ['requisicion_id' => 156, 'id_usuario' => $lou],
            ['requisicion_id' => 158, 'id_usuario' => $lou],
            ['requisicion_id' => 163, 'id_usuario' => $lou],
            ['requisicion_id' => 164, 'id_usuario' => $lou],
            ['requisicion_id' => 165, 'id_usuario' => $lou],
            ['requisicion_id' => 166, 'id_usuario' => $lou],
            ['requisicion_id' => 167, 'id_usuario' => $lou],
            ['requisicion_id' => 170, 'id_usuario' => $lou],
            ['requisicion_id' => 171, 'id_usuario' => $lou],
            ['requisicion_id' => 172, 'id_usuario' => $lou],
            ['requisicion_id' => 173, 'id_usuario' => $lou],
            ['requisicion_id' => 180, 'id_usuario' => $lou],
            ['requisicion_id' => 182, 'id_usuario' => $lou],
            ['requisicion_id' => 184, 'id_usuario' => $lou],
            ['requisicion_id' => 185, 'id_usuario' => $lou],
            ['requisicion_id' => 186, 'id_usuario' => $lou],
            ['requisicion_id' => 187, 'id_usuario' => $lou],
            ['requisicion_id' => 188, 'id_usuario' => $lou],
            ['requisicion_id' => 189, 'id_usuario' => $lou],
            ['requisicion_id' => 190, 'id_usuario' => $lou],
            ['requisicion_id' => 191, 'id_usuario' => $lou],
            ['requisicion_id' => 195, 'id_usuario' => $lay], //posible lay
            ['requisicion_id' => 196, 'id_usuario' => $lay], //posible lay
            ['requisicion_id' => 199, 'id_usuario' => $lay], //posible lay
            ['requisicion_id' => 200, 'id_usuario' => $lay], //posible lay
            ['requisicion_id' => 203, 'id_usuario' => $lou],
            ['requisicion_id' => 204, 'id_usuario' => $lou],
            ['requisicion_id' => 205, 'id_usuario' => $lou],
            ['requisicion_id' => 206, 'id_usuario' => $lou],
            ['requisicion_id' => 208, 'id_usuario' => $lou],
            ['requisicion_id' => 209, 'id_usuario' => $lou],
            ['requisicion_id' => 215, 'id_usuario' => $lou],
            ['requisicion_id' => 217, 'id_usuario' => $lou],
            ['requisicion_id' => 218, 'id_usuario' => $lou],
            ['requisicion_id' => 219, 'id_usuario' => $lou],
            ['requisicion_id' => 221, 'id_usuario' => $lou],
            ['requisicion_id' => 222, 'id_usuario' => $lou],
            ['requisicion_id' => 223, 'id_usuario' => $lou],
            ['requisicion_id' => 224, 'id_usuario' => $lou],
            ['requisicion_id' => 226, 'id_usuario' => $lou],
            ['requisicion_id' => 227, 'id_usuario' => $lou],
            ['requisicion_id' => 228, 'id_usuario' => $lou],
            ['requisicion_id' => 229, 'id_usuario' => $lou],
            ['requisicion_id' => 230, 'id_usuario' => $lou],
            ['requisicion_id' => 231, 'id_usuario' => $lou],
            ['requisicion_id' => 232, 'id_usuario' => $lou],
            ['requisicion_id' => 233, 'id_usuario' => $lou],
            ['requisicion_id' => 234, 'id_usuario' => $lou],
            ['requisicion_id' => 238, 'id_usuario' => $lou],
            ['requisicion_id' => 239, 'id_usuario' => $lou],
            ['requisicion_id' => 240, 'id_usuario' => $lou],
            ['requisicion_id' => 241, 'id_usuario' => $lou],
            ['requisicion_id' => 243, 'id_usuario' => $lou],
            ['requisicion_id' => 244, 'id_usuario' => $lou],
            ['requisicion_id' => 246, 'id_usuario' => $lou],
            ['requisicion_id' => 247, 'id_usuario' => $lou],
            ['requisicion_id' => 248, 'id_usuario' => $lou],
            ['requisicion_id' => 250, 'id_usuario' => $lou],
            ['requisicion_id' => 251, 'id_usuario' => $lou],
            ['requisicion_id' => 252, 'id_usuario' => $lou],
            ['requisicion_id' => 253, 'id_usuario' => $lou],
            ['requisicion_id' => 256, 'id_usuario' => $lou],
            ['requisicion_id' => 259, 'id_usuario' => $lou],
            ['requisicion_id' => 260, 'id_usuario' => $lou],
            ['requisicion_id' => 262, 'id_usuario' => $lou],
            ['requisicion_id' => 263, 'id_usuario' => $lou],
            ['requisicion_id' => 265, 'id_usuario' => $lay],
            ['requisicion_id' => 266, 'id_usuario' => $lay],
            ['requisicion_id' => 267, 'id_usuario' => $lay],
            ['requisicion_id' => 268, 'id_usuario' => $lou],
            ['requisicion_id' => 269, 'id_usuario' => $lou],
            ['requisicion_id' => 271, 'id_usuario' => $lou],
            ['requisicion_id' => 272, 'id_usuario' => $lou],
            ['requisicion_id' => 273, 'id_usuario' => $lou],
            ['requisicion_id' => 274, 'id_usuario' => $lou],
            ['requisicion_id' => 276, 'id_usuario' => $lou],
            ['requisicion_id' => 277, 'id_usuario' => $lou],
            ['requisicion_id' => 278, 'id_usuario' => $lou],
            ['requisicion_id' => 279, 'id_usuario' => $lou],
            ['requisicion_id' => 280, 'id_usuario' => $lou],
            ['requisicion_id' => 281, 'id_usuario' => $lou],
            ['requisicion_id' => 283, 'id_usuario' => $lou],
            ['requisicion_id' => 286, 'id_usuario' => $lou],
            ['requisicion_id' => 287, 'id_usuario' => $lou],
            ['requisicion_id' => 288, 'id_usuario' => $lou],
            ['requisicion_id' => 291, 'id_usuario' => $lou],
            ['requisicion_id' => 292, 'id_usuario' => $lou],
            ['requisicion_id' => 293, 'id_usuario' => $lou],
            ['requisicion_id' => 294, 'id_usuario' => $lou],
            ['requisicion_id' => 295, 'id_usuario' => $lou],
            ['requisicion_id' => 296, 'id_usuario' => $lou],
            ['requisicion_id' => 297, 'id_usuario' => $lou],
            ['requisicion_id' => 298, 'id_usuario' => $lou],
            ['requisicion_id' => 299, 'id_usuario' => $lou],
            ['requisicion_id' => 300, 'id_usuario' => $lou],
            ['requisicion_id' => 302, 'id_usuario' => $lou],
            ['requisicion_id' => 303, 'id_usuario' => $lou],
            ['requisicion_id' => 304, 'id_usuario' => $lou],
            ['requisicion_id' => 307, 'id_usuario' => $lou],
            ['requisicion_id' => 308, 'id_usuario' => $lou],
            ['requisicion_id' => 309, 'id_usuario' => $lou],
            ['requisicion_id' => 310, 'id_usuario' => $lou],
            ['requisicion_id' => 311, 'id_usuario' => $lou],
            ['requisicion_id' => 312, 'id_usuario' => $lou],
            ['requisicion_id' => 313, 'id_usuario' => $lou],
            ['requisicion_id' => 315, 'id_usuario' => $lou],
            ['requisicion_id' => 316, 'id_usuario' => $lou],
            ['requisicion_id' => 320, 'id_usuario' => $lou],
            ['requisicion_id' => 321, 'id_usuario' => $lou],
            ['requisicion_id' => 322, 'id_usuario' => $lou],
            ['requisicion_id' => 323, 'id_usuario' => $lou],
            ['requisicion_id' => 324, 'id_usuario' => $lou],
            ['requisicion_id' => 325, 'id_usuario' => $lou],
            ['requisicion_id' => 326, 'id_usuario' => $lou],
            ['requisicion_id' => 327, 'id_usuario' => $lou],
            ['requisicion_id' => 328, 'id_usuario' => $lou],
            ['requisicion_id' => 329, 'id_usuario' => $lou],
            ['requisicion_id' => 330, 'id_usuario' => $lou],
            ['requisicion_id' => 332, 'id_usuario' => $lou],
            ['requisicion_id' => 333, 'id_usuario' => $lou],
            ['requisicion_id' => 334, 'id_usuario' => $lou],
            ['requisicion_id' => 336, 'id_usuario' => $lay],
            ['requisicion_id' => 337, 'id_usuario' => $lay],
            ['requisicion_id' => 338, 'id_usuario' => $lou],
            ['requisicion_id' => 339, 'id_usuario' => $lou],
            ['requisicion_id' => 416, 'id_usuario' => $lou],
            ['requisicion_id' => 415, 'id_usuario' => $lou],
            ['requisicion_id' => 414, 'id_usuario' => $lou],
            ['requisicion_id' => 413, 'id_usuario' => $lou],
            ['requisicion_id' => 412, 'id_usuario' => $lou],
            ['requisicion_id' => 411, 'id_usuario' => $lou],
            ['requisicion_id' => 408, 'id_usuario' => $lay],
            ['requisicion_id' => 407, 'id_usuario' => $lou],
            ['requisicion_id' => 405, 'id_usuario' => $lou],
            ['requisicion_id' => 404, 'id_usuario' => $lou],
            ['requisicion_id' => 403, 'id_usuario' => $lou],
            ['requisicion_id' => 402, 'id_usuario' => $lou],
            ['requisicion_id' => 401, 'id_usuario' => $lou],
            ['requisicion_id' => 400, 'id_usuario' => $lou],
            ['requisicion_id' => 399, 'id_usuario' => $lou],
            ['requisicion_id' => 398, 'id_usuario' => $lou],
            ['requisicion_id' => 397, 'id_usuario' => $lou],
            ['requisicion_id' => 396, 'id_usuario' => $lou],
            ['requisicion_id' => 394, 'id_usuario' => $lou],
            ['requisicion_id' => 393, 'id_usuario' => $lou],
            ['requisicion_id' => 392, 'id_usuario' => $lou],
            ['requisicion_id' => 390, 'id_usuario' => $lou],
            ['requisicion_id' => 389, 'id_usuario' => $lou],
            ['requisicion_id' => 387, 'id_usuario' => $lou],
            ['requisicion_id' => 385, 'id_usuario' => $lou],
            ['requisicion_id' => 383, 'id_usuario' => $lou],
            ['requisicion_id' => 381, 'id_usuario' => $lou],
            ['requisicion_id' => 379, 'id_usuario' => $lou],
            ['requisicion_id' => 378, 'id_usuario' => $lou],
            ['requisicion_id' => 376, 'id_usuario' => $lou],
            ['requisicion_id' => 375, 'id_usuario' => $lou],
            ['requisicion_id' => 374, 'id_usuario' => $lou],
            ['requisicion_id' => 373, 'id_usuario' => $lou],
            ['requisicion_id' => 369, 'id_usuario' => $lou],
            ['requisicion_id' => 368, 'id_usuario' => $lou],
            ['requisicion_id' => 363, 'id_usuario' => $lou],
            ['requisicion_id' => 361, 'id_usuario' => $lou],
            ['requisicion_id' => 357, 'id_usuario' => $lou],
            ['requisicion_id' => 355, 'id_usuario' => $lou],
            ['requisicion_id' => 353, 'id_usuario' => $lou],
            ['requisicion_id' => 352, 'id_usuario' => $lou],
            ['requisicion_id' => 351, 'id_usuario' => $lou],
            ['requisicion_id' => 350, 'id_usuario' => $lou],
            ['requisicion_id' => 349, 'id_usuario' => $lou],
            ['requisicion_id' => 348, 'id_usuario' => $lou],
            ['requisicion_id' => 346, 'id_usuario' => $lou],
            ['requisicion_id' => 344, 'id_usuario' => $lou],
            ['requisicion_id' => 342, 'id_usuario' => $lou],
            ['requisicion_id' => 341, 'id_usuario' => $lou],
        ];

        foreach ($datos as $dato) {
            $id_tabla = $dato['requisicion_id'];
            $id_usuario = $dato['id_usuario'];

            // Actualizar el registro usando Eloquent
            $requisicion = Requsicion::find($id_tabla);

            if ($requisicion) {
                $requisicion->id_finanzas = $id_usuario;
                $requisicion->save();

                echo "Actualización exitosa para el ID de tabla: $id_tabla<br>";
            } else {
                echo "No se encontró la requisición con el ID de tabla: $id_tabla<br>";
            }
        }

        dd('Proceso finalizado', 'total: '.count($datos));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
