<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AreasExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAreaRequest;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Grupo;
use App\Models\Organizacion;
use App\Models\Team;
use Gate;
use Illuminate\Auth\Access\Gate as AccessGate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AreasController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('crear_area_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Area::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'crear_area_ver';
                $editGate = 'crear_area_editar';
                $deleteGate = 'crear_area_eliminar';
                $crudRoutePart = 'areas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : '';
            });
            $table->editColumn('foto_ruta', function ($row) {
                return $row->foto_ruta ? $row->foto_ruta : '';
            });

            $table->editColumn('grupo', function ($row) {
                return $row->grupo ? $row->grupo->nombre : '';
            });
            $table->editColumn(
                'reporta',
                function ($row) {
                    return $row->supervisor ? $row->supervisor->area : '';
                }
            );
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $teams = Team::get();
        $grupoarea = Grupo::get();
        $numero_areas = Area::count();

        return view('admin.areas.index', compact('teams', 'direccion_exists', 'numero_areas', 'grupoarea'));
    }

    public function create()
    {
        abort_if(Gate::denies('crear_area_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoareas = Grupo::get();
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $areas = Area::with('areas')->get();
        $empleados = Empleado::getaltaAll();
        $area = new Area();

        return view('admin.areas.create', compact('grupoareas', 'direccion_exists', 'areas', 'empleados', 'area'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('crear_area_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();

        $validateReporta = 'nullable|exists:areas,id';
        if ($direccion_exists) {
            $validateReporta = 'required|exists:areas,id';
        }
        $request->validate([
            'area' => 'required|string|max:255',
            'id_reporta' => $validateReporta,
        ], [
            'id_reporta.required' => 'El área a la que reporta es requerido',
        ]);

        if (!$request->hasFile('foto_area')) {
            $mensajeError = 'Intentelo de nuevo, Ingrese  el campo foto';

            return Redirect::back()->with('mensajeError', $mensajeError);
        }

        $area = Area::create($request->all());

        $image = null;

        if ($request->hasFile('foto_area')) {
            $file = $request->file('foto_area');
            $extension = $file->getClientOriginalExtension();
            $name_image = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $new_name_image = 'UID_' . $area->id . '_' . $name_image . '.' . $extension;
            $route = storage_path('/app/public/areas/' . $new_name_image);

            $image = Image::make($file)->encode('png', 70)->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save($route);
        }

        $area->update([
            'foto_area' => $new_name_image,
        ]);

        return redirect()->route('admin.areas.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Area $area)
    {
        abort_if(Gate::denies('crear_area_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoareas = Grupo::get();
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $areas = Area::with('areas')->get();
        $reportas = Empleado::getaltaAll();

        return view('admin.areas.edit', compact('grupoareas', 'direccion_exists', 'areas', 'area', 'reportas'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('crear_area_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $primer_nodo = Area::select('id', 'id_reporta')->whereNull('id_reporta')->first();
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $validateReporta = 'nullable|exists:areas,id';
        $area = Area::find($id);

        if ($direccion_exists) {
            if ($primer_nodo->id == intval($area->id)) {
                $validateReporta = 'nullable|exists:areas,id';
            } else {
                $validateReporta = 'required|exists:areas,id';
            }
        }

        $request->validate([
            'area' => 'required|string|max:255',
            'id_reporta' => $validateReporta,
        ], [
            'id_reporta.required' => 'El área a la que reporta es requerido',
        ]);

        $image = $area->foto_area;

        if ($request->hasFile('foto_area')) {
            //Si existe la imagen entonces se elimina al editarla
            $file = $request->file('foto_area');

            $filePath = '/app/public/areas/' . $area->foto_area;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $extension = $file->getClientOriginalExtension();
            $name_image = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $new_name_image = 'UID_' . $area->id . '_' . $name_image . '.' . $extension;
            $route = storage_path('/app/public/areas/' . $new_name_image);
            $image = Image::make($file)->encode('png', 70)->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save($route);
        } else {

            $mensajeError = 'Intentelo de nuevo, Ingrese  el campo foto';

            return Redirect::back()->with('mensajeError', $mensajeError);
        }

        $area->update([
            'area' => $request->area,
            'id_grupo' => $request->id_grupo,
            'id_reporta' => $request->id_reporta,
            'descripcion' => $request->descripcion,
            'empleados_id' => $request->empleados_id,
            'foto_area' => $new_name_image,

        ]);

        return redirect()->route('admin.areas.index')->with('success', 'Editado con éxito');
    }

    public function show(Area $area)
    {
        abort_if(Gate::denies('crear_area_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area->load('team', 'grupo');

        return view('admin.areas.show', compact('area'));
    }

    public function destroy(Area $area)
    {
        abort_if(Gate::denies('crear_area_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyAreaRequest $request)
    {
        Area::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function obtenerAreasPorGrupo()
    {
        $grupos = Grupo::with('areas')->orderByDesc('id')->get();
        $numero_grupos = Grupo::count();

        return view('admin.areas.areas-grupo', compact('grupos', 'numero_grupos'));
    }

    public function renderJerarquia(Request $request)
    {
        abort_if(Gate::denies('niveles_jerarquicos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $numero_grupos = Grupo::count();

        $areasTree = Area::getExists(); //Eager loading
        // dd($areasTree);

        $rutaImagenes = asset('storage/empleados/imagenes/');
        $grupos = Grupo::with('areas')->orderBy('id')->get();
        $organizacionDB = Organizacion::getFirst();
        $organizacion = !is_null($organizacionDB) ? Organizacion::getFirst()->empresa : 'la organización';
        $org_foto = !is_null($organizacionDB) ? url('images/' . DB::table('organizacions')->select('logotipo')->first()->logotipo) : url('img/Silent4Business-Logo-Color.png');
        $areas_sin_grupo = Area::whereDoesntHave('grupo')->get();
        $organizacion = Organizacion::getFirst();

        return view('admin.areas.jerarquia', compact('areasTree', 'rutaImagenes', 'organizacion', 'org_foto', 'grupos', 'numero_grupos', 'areas_sin_grupo', 'organizacion'));
    }

    public function obtenerJerarquia(Request $request)
    {
        abort_if(Gate::denies('niveles_jerarquicos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areasTree = Area::with(['lider', 'supervisor.children', 'supervisor.supervisor', 'grupo', 'children.supervisor', 'children.children'])->whereNull('id_reporta')->first(); //Eager loading

        return json_encode($areasTree);
    }

    public function exportTo()
    {
        // abort_if(AccessGate::denies('configuracion_area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return Excel::download(new AreasExport, 'areas.csv');
    }

    public function pdf()
    {
        $areas = Area::get();
        $pdf = PDF::loadView('areas', compact('areas'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('areas.pdf');
    }
}