<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\PlanImplementacion;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QueueCorreo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Benchmark::dd(fn () => DB::query("plan_implementacions")->select("id","tasks")->where("id",15)->toArray());//find(15));
        Benchmark::dd(fn () => PlanImplementacion::find(15));
        // Send welcome email
        // for ($i = 0; $i < 1; $i++) {
        //     //Benchmark::dd(fn () => Mail::to('luis.vargas@silent4business.com')->queue(new TestMail()));
        //     Mail::to('luis.vargas@silent4business.com')->queue(new TestMail());
        // }
        // Now, $data contains all the values from the Redis table
        dd('al ready sent');
    }

    public function insertarFirmadoresFinanzas(){
        $lay = 10;
        $aur = 277;
        $lou = 11;

        $datos = array(
            array('requisicion_id' => 1, 'id_usuario' => $lou),
            array('requisicion_id' => 83, 'id_usuario' => $lou),
            array('requisicion_id' => 87, 'id_usuario' => $lou),
            array('requisicion_id' => 88, 'id_usuario' => $lou),
            array('requisicion_id' => 90, 'id_usuario' => $lou),
            array('requisicion_id' => 91, 'id_usuario' => $lou),
            array('requisicion_id' => 92, 'id_usuario' => $lou),
            array('requisicion_id' => 93, 'id_usuario' => $lou),
            array('requisicion_id' => 94, 'id_usuario' => $lou),
            array('requisicion_id' => 95, 'id_usuario' => $lou),
            array('requisicion_id' => 96, 'id_usuario' => $lou),
            array('requisicion_id' => 97, 'id_usuario' => $lou),
            array('requisicion_id' => 98, 'id_usuario' => $lou),
            array('requisicion_id' => 99, 'id_usuario' => $lou),
            array('requisicion_id' => 100, 'id_usuario' => $lou),
            array('requisicion_id' => 101, 'id_usuario' => $lou),
            array('requisicion_id' => 102, 'id_usuario' => $lou),
            array('requisicion_id' => 103, 'id_usuario' => $lou), #posible lay
            array('requisicion_id' => 104, 'id_usuario' => $lou),
            array('requisicion_id' => 105, 'id_usuario' => $lou),
            array('requisicion_id' => 108, 'id_usuario' => $lou),
            array('requisicion_id' => 109, 'id_usuario' => $lou),
            array('requisicion_id' => 110, 'id_usuario' => $lou), #posible lay
            array('requisicion_id' => 111, 'id_usuario' => $lou),
            array('requisicion_id' => 113, 'id_usuario' => $lou), #posible lay
            array('requisicion_id' => 114, 'id_usuario' => $lou),
            array('requisicion_id' => 116, 'id_usuario' => $lou), #posible lay
            array('requisicion_id' => 117, 'id_usuario' => $lou),
            array('requisicion_id' => 119, 'id_usuario' => $lou),
            array('requisicion_id' => 127, 'id_usuario' => $lou),
            array('requisicion_id' => 134, 'id_usuario' => $lou),
            array('requisicion_id' => 150, 'id_usuario' => $lou),
            array('requisicion_id' => 156, 'id_usuario' => $lou),
            array('requisicion_id' => 158, 'id_usuario' => $lou),
            array('requisicion_id' => 163, 'id_usuario' => $lou),
            array('requisicion_id' => 164, 'id_usuario' => $lou),
            array('requisicion_id' => 165, 'id_usuario' => $lou),
            array('requisicion_id' => 166, 'id_usuario' => $lou),
            array('requisicion_id' => 167, 'id_usuario' => $lou),
            array('requisicion_id' => 170, 'id_usuario' => $lou),
            array('requisicion_id' => 171, 'id_usuario' => $lou),
            array('requisicion_id' => 172, 'id_usuario' => $lou),
            array('requisicion_id' => 173, 'id_usuario' => $lou),
            array('requisicion_id' => 180, 'id_usuario' => $lou),
            array('requisicion_id' => 182, 'id_usuario' => $lou),
            array('requisicion_id' => 184, 'id_usuario' => $lou),
            array('requisicion_id' => 185, 'id_usuario' => $lou),
            array('requisicion_id' => 186, 'id_usuario' => $lou),
            array('requisicion_id' => 187, 'id_usuario' => $lou),
            array('requisicion_id' => 188, 'id_usuario' => $lou),
            array('requisicion_id' => 189, 'id_usuario' => $lou),
            array('requisicion_id' => 190, 'id_usuario' => $lou),
            array('requisicion_id' => 191, 'id_usuario' => $lou),
            array('requisicion_id' => 195, 'id_usuario' => $lay), #posible lay
            array('requisicion_id' => 196, 'id_usuario' => $lay), #posible lay
            array('requisicion_id' => 199, 'id_usuario' => $lay), #posible lay
            array('requisicion_id' => 200, 'id_usuario' => $lay), #posible lay
            array('requisicion_id' => 203, 'id_usuario' => $lou),
            array('requisicion_id' => 204, 'id_usuario' => $lou),
            array('requisicion_id' => 205, 'id_usuario' => $lou),
            array('requisicion_id' => 206, 'id_usuario' => $lou),
            array('requisicion_id' => 208, 'id_usuario' => $lou),
            array('requisicion_id' => 209, 'id_usuario' => $lou),
            array('requisicion_id' => 215, 'id_usuario' => $lou),
            array('requisicion_id' => 217, 'id_usuario' => $lou),
            array('requisicion_id' => 218, 'id_usuario' => $lou),
            array('requisicion_id' => 219, 'id_usuario' => $lou),
            array('requisicion_id' => 221, 'id_usuario' => $lou),
            array('requisicion_id' => 222, 'id_usuario' => $lou),
            array('requisicion_id' => 223, 'id_usuario' => $lou),
            array('requisicion_id' => 224, 'id_usuario' => $lou),
            array('requisicion_id' => 226, 'id_usuario' => $lou),
            array('requisicion_id' => 227, 'id_usuario' => $lou),
            array('requisicion_id' => 228, 'id_usuario' => $lou),
            array('requisicion_id' => 229, 'id_usuario' => $lou),
            array('requisicion_id' => 230, 'id_usuario' => $lou),
            array('requisicion_id' => 231, 'id_usuario' => $lou),
            array('requisicion_id' => 232, 'id_usuario' => $lou),
            array('requisicion_id' => 233, 'id_usuario' => $lou),
            array('requisicion_id' => 234, 'id_usuario' => $lou),
            array('requisicion_id' => 238, 'id_usuario' => $lou),
            array('requisicion_id' => 239, 'id_usuario' => $lou),
            array('requisicion_id' => 240, 'id_usuario' => $lou),
            array('requisicion_id' => 241, 'id_usuario' => $lou),
            array('requisicion_id' => 243, 'id_usuario' => $lou),
            array('requisicion_id' => 244, 'id_usuario' => $lou),
            array('requisicion_id' => 246, 'id_usuario' => $lou),
            array('requisicion_id' => 247, 'id_usuario' => $lou),
            array('requisicion_id' => 248, 'id_usuario' => $lou),
            array('requisicion_id' => 250, 'id_usuario' => $lou),
            array('requisicion_id' => 251, 'id_usuario' => $lou),
            array('requisicion_id' => 252, 'id_usuario' => $lou),
            array('requisicion_id' => 253, 'id_usuario' => $lou),
            array('requisicion_id' => 256, 'id_usuario' => $lou),
        );
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
