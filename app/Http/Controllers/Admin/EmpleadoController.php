<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Area;
use App\Models\Sede;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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


        // abort_if(Gate::denies('empleados_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            // $query = DB::table('empleados')->select(DB::raw('id,
            // name,
            // foto,
            // area,
            // puesto,
            // jefe,
            // antiguedad as "fecha ingreso",
            // if(estatus = 1, "Activo", "Inactivo") as "estado",
            // concat(timestampdiff(year, antiguedad, NOW()), " año con ",
            // FLOOR(( datediff(now(), antiguedad) / 365.25 - FLOOR(datediff(now(), antiguedad) / 365.25)) * 12), " meses y ",
            // DAY(CURDATE()) - DAY(antiguedad) +30 * (DAY(CURDATE()) < DAY(antiguedad)) , " días."
            // ) as antiguedad,
            // email,
            // telefono,
            // n_empleado,
            // estatus,
            // n_registro
            // '))->whereNull('deleted_at')->get();
            $query = Empleado::get();
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
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
                return $row->foto ? $row->foto : '';
            });

            // $dt = CarbonLocale::now();
            // dd($dt->diffForHumans($dt->copy()->subMinutes(15)));

            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area->area : "";
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : "";
            });
            $table->editColumn(
                'jefe',
                function ($row) {
                    return $row->supervisor ? $row->supervisor->name : "";
                }
            );
            $table->editColumn('antiguedad', function ($row) {
                return Carbon::parse(Carbon::parse($row->antiguedad))->diffForHumans(Carbon::now()->subDays());
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
                return $row->n_registro ? $row->n_registro : "";
            });

            $table->editColumn('sede', function ($row) {
                return $row->sede ? $row->sede->sede : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        return view('admin.empleados.index', compact('ceo_exists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // abort_if(Gate::denies('empleados_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::get();
        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $areas = Area::get();
        $sedes = Sede::get();
        return view('admin.empleados.create', compact('empleados', 'ceo_exists', 'areas', 'sedes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $validateSupervisor = 'nullable|exists:empleados,id';
        if ($ceo_exists) {
            $validateSupervisor = 'required|exists:empleados,id';
        }

        $request->validate([
            'name' => 'required|string',
            'n_empleado' => 'required|unique:empleados',
            'area_id' => 'required|exists:areas,id',
            'supervisor_id' => $validateSupervisor,
            'puesto' => 'required|string',
            'antiguedad' => 'required',
            'estatus' => 'required',
            'email' => 'required|email',
            'sede_id' => 'required|exists:sedes,id',

        ], [
            'n_empleado.unique' => 'El número de empleado ya ha sido tomado'
        ]);

        $empleado = Empleado::create([
            "name" => $request->name,
            "area_id" =>  $request->area_id,
            "puesto" =>  $request->puesto,
            "supervisor_id" =>  $request->supervisor_id,
            "antiguedad" =>  $request->antiguedad,
            "estatus" =>  $request->estatus,
            "email" =>  $request->email,
            "telefono" =>  $request->telefono,
            "genero" =>  $request->genero,
            "n_empleado" =>  $request->n_empleado,
            "n_registro" =>  $request->n_registro,
            "sede_id" =>  $request->sede_id
        ]);
        $image = null;
        if ($request->snap_foto && $request->file('foto')) {
            if ($request->snap_foto) {
                if (preg_match('/^data:image\/(\w+);base64,/', $request->snap_foto)) {
                    $value = substr($request->snap_foto, strpos($request->snap_foto, ',') + 1);
                    $value = base64_decode($value);

                    $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';
                    $image = $new_name_image;
                    $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                    $img_intervention = Image::make($request->snap_foto);
                    $img_intervention->resize(480, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($route);
                }
            }
        } else if ($request->snap_foto && !$request->file('foto')) {
            if ($request->snap_foto) {
                if (preg_match('/^data:image\/(\w+);base64,/', $request->snap_foto)) {
                    $value = substr($request->snap_foto, strpos($request->snap_foto, ',') + 1);
                    $value = base64_decode($value);

                    $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';
                    $image = $new_name_image;
                    $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                    $img_intervention = Image::make($request->snap_foto);
                    $img_intervention->resize(480, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($route);
                }
            }
        } else {
            if ($request->file('foto') != null or !empty($request->file('foto'))) {
                $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
                $name_image = basename(pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);
                $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.' . $extension;
                $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                $image = $new_name_image;
                //Usamos image_intervention para disminuir el peso de la imagen
                $img_intervention = Image::make($request->file('foto'));
                $img_intervention->resize(480, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($route);
            }
        }

        $empleado->update([
            'foto' => $image
        ]);

        $gantt_path = 'storage/gantt/gantt_inicial.json';
        $path = public_path($gantt_path);

        


        
        $json_code = json_decode(file_get_contents($path), true);
        $json_code['resources'] = Empleado::select('id', 'name', 'foto', 'genero')->get()->toArray();
        $write_empleados = $json_code;
        file_put_contents($path, json_encode($write_empleados));

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


        // abort_if(Gate::denies('empleados_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleado = Empleado::findOrfail($id);
        $empleados = Empleado::get();
        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $areas = Area::get();
        $area = Area::findOrfail($empleado->area_id);
        $sedes = Sede::get();
        $sede = Sede::findOrfail($empleado->sede_id);
        return view('admin.empleados.edit', compact('empleado', 'empleados', 'ceo_exists', 'areas', 'area', 'sede', 'sedes'));
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
        //dd($request->all());
        $ceo = Empleado::select('id')->whereNull('supervisor_id')->first();

        $ceo_exists = Empleado::select('supervisor_id')->whereNull('supervisor_id')->exists();
        $validateSupervisor = 'nullable|exists:empleados,id';

        if ($ceo_exists) {
            if ($ceo->id == intval($id)) {
                $validateSupervisor = 'nullable|exists:empleados,id';
            } else {
                $validateSupervisor = 'required|exists:empleados,id';
            }
        }

        $request->validate([
            'name' => 'required|string',
            'n_empleado' => 'unique:empleados,n_empleado,' . $id,
            'area_id' => 'required|exists:areas,id',
            'supervisor_id' => $validateSupervisor,
            'puesto' => 'required|string',
            'antiguedad' => 'required',
            'estatus' => 'required',
            'email' => 'required|email',
            'sede_id' => 'required|exists:sedes,id',

        ], [
            'n_empleado.unique' => 'El número de empleado ya ha sido tomado'
        ]);


        $empleado = Empleado::find($id);
        $image = $empleado->foto;
        $image = null;
        if ($request->snap_foto && $request->file('foto')) {
            if ($request->snap_foto) {
                if (preg_match('/^data:image\/(\w+);base64,/', $request->snap_foto)) {
                    $value = substr($request->snap_foto, strpos($request->snap_foto, ',') + 1);
                    $value = base64_decode($value);

                    $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';
                    $image = $new_name_image;
                    $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                    $img_intervention = Image::make($request->snap_foto);
                    $img_intervention->resize(480, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($route);
                }
            }
        } else if (
            $request->snap_foto && !$request->file('foto')
        ) {
            if ($request->snap_foto) {
                if (preg_match('/^data:image\/(\w+);base64,/', $request->snap_foto)) {
                    $value = substr($request->snap_foto, strpos($request->snap_foto, ',') + 1);
                    $value = base64_decode($value);

                    $new_name_image = 'UID_' . $empleado->id . '_' . $empleado->name . '.png';
                    $image = $new_name_image;
                    $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                    $img_intervention = Image::make($request->snap_foto);
                    $img_intervention->resize(480, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($route);
                }
            }
        } else {
            if (
                $request->file('foto') != null or !empty($request->file('foto'))
            ) {
                $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
                $name_image = basename(pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);
                $new_name_image = 'UID_' . $empleado->id . '_' . $request->name . '.' . $extension;
                $route = storage_path() . '/app/public/empleados/imagenes/' . $new_name_image;
                $image = $new_name_image;
                //Usamos image_intervention para disminuir el peso de la imagen
                $img_intervention = Image::make($request->file('foto'));
                $img_intervention->resize(480, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($route);
            }
        }

        $empleado->update([

            'name' => $request->name,
            "area_id" =>  $request->area_id,
            "puesto" =>  $request->puesto,
            "supervisor_id" =>  $request->supervisor_id,
            "antiguedad" =>  $request->antiguedad,
            "estatus" =>  $request->estatus,
            "email" =>  $request->email,
            "telefono" =>  $request->telefono,
            "genero" =>  $request->genero,
            "n_empleado" =>  $request->n_empleado,
            "n_registro" =>  $request->n_empleado,
            'foto' => $image,
            "sede_id" => $request->sede_id
        ]);

        $gantt_path = 'storage/gantt/gantt_inicial.json';
        $path = public_path($gantt_path);

        


        
        $json_code = json_decode(file_get_contents($path), true);
        $json_code['resources'] = Empleado::select('id', 'name', 'foto', 'genero')->get()->toArray();
        $write_empleados = $json_code;
        file_put_contents($path, json_encode($write_empleados));





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
        // abort_if(Gate::denies('empleados_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado->delete();

        return back();
    }

    public function getEmpleados(Request $request)
    {
        if ($request->ajax()) {
            $nombre = $request->nombre;
            if ($nombre != null) {
                $usuarios = Empleado::select('id', 'name', 'email')->where('name', 'LIKE', '%' . $nombre . '%')->take(5)->get();
                $lista = "<ul class='list-group' id='empleados-lista'>";
                foreach ($usuarios as $usuario) {
                    $lista .= "<button type='button' class='px-2 py-1 text-muted list-group-item list-group-item-action' onClick='seleccionarUsuario(" . $usuario . ");'><i class='mr-2 fas fa-user-circle'></i>" . $usuario->name . "</button>";
                }
                $lista .= "</ul>";
                return $lista;
            }
        }
    }
}
