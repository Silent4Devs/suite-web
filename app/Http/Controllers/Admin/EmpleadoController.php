<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    abort_if(Gate::denies('empleados_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        

        if ($request->ajax()) {
            $query=DB::table('empleados')->select(DB::raw('id,
            name,
            foto,
            area,
            puesto,
            jefe,
            antiguedad as "fecha ingreso",
            if(estatus = 1, "Activo", "Inactivo") as "estado",
            concat(timestampdiff(year, antiguedad, NOW()), " año con ",
            FLOOR(( datediff(now(), antiguedad) / 365.25 - FLOOR(datediff(now(), antiguedad) / 365.25)) * 12), " meses y ",
            DAY(CURDATE()) - DAY(antiguedad) +30 * (DAY(CURDATE()) < DAY(antiguedad)) , " días."
            ) as antiguedad,
            email,
            telefono,
            n_empleado,
            estatus,
            n_registro
            '))->whereNull('deleted_at')->get();
            $table = DataTables::of($query);

      
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'empleados_show';
                $editGate      = 'empleados_edit';
                $deleteGate    = 'empleados_delete';
                $crudRoutePart = 'empleados';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            // $table->editColumn('foto',function($row){

            //     return "<img src=".public_path() . '/storage/empleados/imagenes/' .$row->foto.">";
            // });
            
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->editColumn('foto', function ($row) {
                return $row->foto ? $row->foto:'';
                
            });

           // $dt = CarbonLocale::now();
           // dd($dt->diffForHumans($dt->copy()->subMinutes(15)));

            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : "";
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : "";
            });
            $table->editColumn('jefe', function ($row) {
                return $row->jefe ? $row->jefe : "";
            });
            $table->editColumn('antiguedad', function ($row) {
            return $row->antiguedad ? $row->antiguedad :"";
            });
            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? $row->estatus : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });

            $table->editColumn('telefono', function ($row) {
                return $row->telefono ? $row->telefono : "";
            });

            $table->editColumn('n_empleado', function ($row) {
                return $row->n_empleado ? $row->n_empleado : "";
            });

            $table->editColumn('n_registro', function ($row) {
                return $row->n_empleado ? $row->n_registro : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        
        return view('admin.empleados.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('empleados_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.empleados.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'n_empleado'=>'unique:empleados'], ['n_empleado.unique' => 'El número de empleado ya ha sido tomado'
        ]);
       
        $empleado = Empleado::create([
            "name" => $request->name,
            "area" =>  $request->area,
            "puesto" =>  $request->puesto,
            "jefe" =>  $request->jefe,
            "antiguedad" =>  $request->antiguedad,
            "estatus" =>  $request->estatus,
            "email" =>  $request->email,
            "telefono" =>  $request->telefono,
            "n_empleado" =>  $request->n_empleado,
            "n_registro" =>  $request->n_empleado,
        ]);
        $image = null;
        if ($request->file('foto') != null or !empty($request->file('foto'))) {
            $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
            $name_image = basename(pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);
            $new_name_image = 'UID_' . $empleado->id . '_' . $name_image . '.' . $extension;
            $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
            $image = $new_name_image;
            //Usamos image_intervention para disminuir el peso de la imagen
            $img_intervention = Image::make($request->file('foto'));
            $img_intervention->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($route);
        }

        $empleado->update([
            'foto' => $image
        ]);



        return redirect()->route('admin.empleados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        abort_if(Gate::denies('empleados_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleado=Empleado::findOrfail($id);
        

        return view('admin.empleados.edit',compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$empleado->update($request->all());
       // dump($request->all());
        //die();
        $request->validate([
       'n_empleado'=>'unique:empleados,n_empleado,'.$id], ['n_empleado.unique' => 'El número de empleado ya ha sido tomado'
        ]);
        
        $empleado = Empleado::find($id);
        $image = $empleado->foto;
        if ($request->file('foto') != null or !empty($request->file('foto'))) {

            //Si existe la imagen entonces se elimina al editarla
        
            $isExists = Storage::disk('public')->exists('empleados/imagenes/' . $empleado->foto);
            if ($isExists) {
                if ($empleado->foto != null) {
                    unlink(storage_path('/app/public/empleados/imagenes/' . $empleado->foto));
                }
            }
            $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
            $name_image = basename(pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);
            $new_name_image = 'UID_' . $empleado->id . '_' . $name_image . '.' . $extension;
            $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
            $image = $new_name_image;
            //Usamos image_intervention para disminuir el peso de la imagen
            $img_intervention = Image::make($request->file('foto'));
            $img_intervention->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($route);
        }

        $empleado->update([
            'name'=>$request->name,
            "area" =>  $request->area,
            "puesto" =>  $request->puesto,
            "jefe" =>  $request->jefe,
            "antiguedad" =>  $request->antiguedad,
            "estatus" =>  $request->estatus,
            "email" =>  $request->email,
            "telefono" =>  $request->telefono,
            "n_empleado" =>  $request->n_empleado,
            "n_registro" =>  $request->n_empleado,
            'foto' => $image
        ]);



        return redirect()->route('admin.empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        abort_if(Gate::denies('empleados_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado->delete();

        return back();  
    }


}

