<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrganizacionRequest;
use App\Http\Requests\UpdateOrganizacionRequest;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\PanelOrganizacion;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OrganizacionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mi_organizacion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::getFirst();

        $schedule = collect();
        if ($organizacions) {
            $schedule = $organizacions->schedules;
        }

        // dd($schedule);
        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];

        $panel_rules = PanelOrganizacion::select('empresa', 'direccion', 'telefono', 'correo', 'pagina_web', 'giro', 'servicios', 'mision', 'vision', 'valores', 'team_id', 'antecedentes', 'logotipo', 'razon_social', 'rfc', 'representante_legal', 'fecha_constitucion', 'num_empleados', 'tamano', 'schedule', 'linkedln', 'facebook', 'youtube', 'twitter')->get()->first();
        if (empty($organizacions)) {
            $count = Organizacion::get()->count();

            $empty = false;

            return view('admin.organizacions.index')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty)->with('panel_rules', $panel_rules)->with('schedule', $schedule);
        } else {
            $empty = true;
            $count = Organizacion::getAll()->count();
            $logotipo = $organizacions->logotipo;
            // dd($schedule);

            return view('admin.organizacions.index')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty)->with('logotipo', $logotipo)->with('schedule', $schedule)->with('dias', $dias)->with('panel_rules', $panel_rules);
        }
    }

    public function create()
    {
        $countEmpleados = Empleado::getaltaAll()->count();

        if ($countEmpleados == 0) {
            $tamanoEmpresa = 'debe registrar a los empleados';
        } elseif ($countEmpleados >= 1 && $countEmpleados <= 249) {
            $tamanoEmpresa = 'Chica (menos de 250 empleados)';
        } elseif ($countEmpleados >= 250 && $countEmpleados <= 1000) {
            $tamanoEmpresa = 'Mediana (entre 250 y 1000 empleados)';
        } elseif ($countEmpleados >= 1000) {
            $tamanoEmpresa = 'Grande (más de 1000 empleados)';
        }

        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        $count = Organizacion::getAll()->count();
        if ($count == 0) {
            abort_if(Gate::denies('mi_organizacion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            return view('admin.organizacions.create')->with('countEmpleados', $countEmpleados)->with('tamanoEmpresa', $tamanoEmpresa)->with('dias', $dias);
        } else {
            Alert::warning('atención', 'Ya existe un registro en la base de datos');

            return redirect()->route('admin.organizacions.index');
        }
    }

    public function store(Request $request)
    {
        // dd($request->working);
        // abort_if(Gate::denies('mi_organizacion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::create([
            'empresa' => $request->empresa,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'pagina_web' => $request->pagina_web,
            'servicios' => $request->servicios,
            'giro' => $request->giro,
            'mision' => $request->mision,
            'vision' => $request->vision,
            'valores' => $request->valores,
            'antecedentes' => $request->antecedentes,
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,
            'representante_legal' => $request->representante_legal,
            'fecha_constitucion' => $request->fecha_constitucion,
            'num_empleados' => $request->num_empleados,
            'tamano' => $request->tamano,
            'linkedln' => $request->linkedln,
            'youtube' => $request->youtube,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
        ]);
        $this->saveOrUpdateSchedule($request, $organizacions);

        if ($request->hasFile('logotipo')) {
            $this->validate($request, [
                'logotipo' => 'mimetypes:image/jpeg,image/bmp,image/png',
            ]);
        }
        // if ($request->file('logotipo') != null or !empty($request->file('logotipo'))) {
        //     $extension = pathinfo($request->file('logotipo')->getClientOriginalName(), PATHINFO_EXTENSION);
        //     $name_image = basename(pathinfo($request->file('logotipo')->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);
        //     $new_name_image = 'UID_' . $organizacions->id . '_' . $name_image . '.' . $extension;
        //     Storage::makeDirectory("public/images");
        //     $route = public_path("storage/images");
        //     // $route = asset('images/'.$new_name_image);
        //     $image = $new_name_image;
        //     //Usamos image_intervention para disminuir el peso de la imagen
        //     $img_intervention = Image::make($request->file('logotipo'));
        //     $img_intervention->resize(256, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save($route);
        //     $organizacions->update(['logotipo' => $image]);
        // }

        $file = $request->file('logotipo');
        if ($file != null) {
            Storage::makeDirectory('public/images');
            $ruta = public_path('storage/images');
            $nombre = $file->getClientOriginalName();
            $file->move($ruta, $file->getClientOriginalName());
            $organizacions->logotipo = $nombre;
            $organizacions->save();
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $organizacions->id]);
        }

        return redirect()->route('admin.organizacions.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Organizacion $organizacion)
    {
        $countEmpleados = Empleado::alta()->get()->count();
        $organizacion->fecha_constitucion = Carbon::parse($organizacion->fecha_constitucion)->format('Y-m-d');
        // dd($organizacion->fecha_constitucion);

        if ($countEmpleados == 0) {
            $tamanoEmpresa = 'debe registrar a los empleados';
        } elseif ($countEmpleados >= 1 && $countEmpleados <= 249) {
            $tamanoEmpresa = 'Chica (menos de 250 empleados)';
        } elseif ($countEmpleados >= 250 && $countEmpleados <= 1000) {
            $tamanoEmpresa = 'Mediana (entre 250 y 1000 empleados)';
        } elseif ($countEmpleados >= 1000) {
            $tamanoEmpresa = 'Grande (más de 1000 empleados)';
        }

        abort_if(Gate::denies('mi_organizacion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->load('team');
        $schedule = Organizacion::getAll()->find(1)->schedules;

        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];

        return view('admin.organizacions.edit', compact('organizacion', 'dias', 'schedule', 'countEmpleados', 'tamanoEmpresa'));
    }

    public function update(UpdateOrganizacionRequest $request, Organizacion $organizacion)
    {
        abort_if(Gate::denies('mi_organizacion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->update($request->all());

        if ($request->hasFile('logotipo')) {
            $this->validate($request, [
                'logotipo' => 'mimetypes:image/jpeg,image/bmp,image/png',
            ]);
        }
        $file = $request->file('logotipo');
        if ($file != null) {
            Storage::makeDirectory('public/images');
            $ruta = public_path('storage/images');
            $nombre = $file->getClientOriginalName();
            $file->move($ruta, $file->getClientOriginalName());
            $organizacions = Organizacion::find(request()->org_id);
            $organizacions->logotipo = $nombre;
            $organizacions->save();
        }
        $this->saveOrUpdateSchedule($request, $organizacion);
        // example:
        Alert::success('éxito', 'Registro actualizado con éxito');

        return redirect()->route('admin.organizacions.index');
    }

    public function show(Organizacion $organizacion)
    {
        abort_if(Gate::denies('mi_organizacion_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->load('team');

        return view('admin.organizacions.show', compact('organizacion'));
    }

    public function destroy(Organizacion $organizacion)
    {
        abort_if(Gate::denies('mi_organizacion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyOrganizacionRequest $request)
    {
        abort_if(Gate::denies('mi_organizacion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Organizacion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        $model = new Organizacion();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function visualizarOrganizacion()
    {
        $organizacions = Organizacion::getFirst();
        // dd($organizacions);
        $schedule = collect();
        if ($organizacions) {
            $schedule = $organizacions->schedules;
        }

        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];

        $panel_rules = PanelOrganizacion::select('empresa', 'direccion', 'telefono', 'correo', 'pagina_web', 'giro', 'servicios', 'mision', 'vision', 'valores', 'team_id', 'antecedentes', 'logotipo', 'razon_social', 'rfc', 'representante_legal', 'fecha_constitucion', 'num_empleados', 'tamano', 'schedule', 'linkedln', 'facebook', 'youtube', 'twitter')->get()->first();

        if (empty($organizacions)) {
            $count = Organizacion::getAll()->count();
            $empty = false;

            return view('admin.organizacions.visualizarorganizacion')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty)->with('schedule', $schedule)->with('dias', $dias)->with('panel_rules', $panel_rules);
        } else {
            $empty = true;
            $count = Organizacion::getAll()->count();
            $logotipo = $organizacions->logotipo;
        }

        // $var = $this->index();

        // dd($organizacion);
        return view('admin.organizacions.visualizarorganizacion')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty)->with('logotipo', $logotipo)->with('schedule', $schedule)->with('dias', $dias)->with('panel_rules', $panel_rules);
    }

    public function saveOrUpdateSchedule($request, $organizacions)
    {
        $id = $organizacions->id;

        $i = 0;
        if (isset($request->working)) {
            if (count($request->working)) {
                foreach ($request->working as $w) {
                    // dd($w);

                    if (isset($w['id'])) {
                        $model = Schedule::where('id', $w['id']);
                        $registerAlreadyExists = $model->exists();

                        if ($registerAlreadyExists) {
                            $dataModel = $model->first();

                            $dataModel->update([
                                'working_day' => $w['day'][$i],
                                'start_work_time' => $w['start_time'][$i],
                                'end_work_time' => $w['end_time'][$i],

                            ]);
                        }
                    } else {
                        $schedule = Schedule::create([
                            'working_day' => $w['day'][$i],
                            'start_work_time' => $w['start_time'][$i],
                            'end_work_time' => $w['end_time'][$i],
                            'organizacions_id' => $id,
                        ]);
                    }
                }
            }
        }
    }

    public function updateSchedule(Request $request, $schedule)
    {
        // dd($schedule);
        $schedule = Schedule::find($schedule);

        $schedule->update([
            $request->typeInput => $request->value,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Dato Actualizado']);
    }

    public function deleteSchedule(Request $request, $schedule)
    {
        $schedule = Schedule::find($schedule);
        $schedule->delete();

        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }
}
