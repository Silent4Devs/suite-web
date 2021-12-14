<?php

namespace App\Http\Controllers\Admin;

use Flash;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreOrganizacionRequest;
use App\Http\Requests\UpdateOrganizacionRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrganizacionRequest;
use App\Models\Empleado;
use App\Models\Schedule;
// use App\Schedule;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

use function Sodium\compare;

class OrganizacionController extends Controller
{
    use MediaUploadingTrait;


    public function index(Request $request)
    {
        abort_if(Gate::denies('organizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::first();

        $schedule = Organizacion::find(1)->schedules;

        $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes');
        // dd($organizacions);

        // dd($schedule);
        // $schedule = Schedule::all();
        // dd($organizacion);
        // $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes');


        if (empty($organizacions)) {
            $count = Organizacion::get()->count();

            $empty = false;

            return view('admin.organizacions.index')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty);
        } else {
            $empty = true;
            $count = Organizacion::get()->count();
            $logotipo = $organizacions->logotipo;
            // dd($schedule);

            return view('admin.organizacions.index')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty)->with('logotipo', $logotipo)->with('schedule', $schedule)->with('dias', $dias);
        }
    }

    public function create()
    {

        $countEmpleados = Empleado::get()->count();


        if ($countEmpleados == 0) {
            $tamanoEmpresa = "debe registrar a los empleados";
        } else if ($countEmpleados >= 1 && $countEmpleados <= 249) {
            $tamanoEmpresa = "Chica (menos de 250 empleados)";
        } else if ($countEmpleados >= 250 && $countEmpleados <= 1000) {
            $tamanoEmpresa = "Mediana (entre 250 y 1000 empleados)";
        } else if ($countEmpleados >= 1000) {
            $tamanoEmpresa = "Grande (más de 1000 empleados)";
        }

        // dd($tamanoEmpresa);

        $dias = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');

        $count = Organizacion::get()->count();
        if ($count == 0) {
            abort_if(Gate::denies('organizacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            return view('admin.organizacions.create')->with('countEmpleados', $countEmpleados)->with('tamanoEmpresa', $tamanoEmpresa)->with('dias', $dias);
        } else {
            Flash::warning("<h5 align='center'>Ya existe un registro en la base de datos</h5>");

            return redirect()->route('admin.organizacions.index');
        }
    }

    public function store(StoreOrganizacionRequest $request)
    {
        // dd($request->working);
        abort_if(Gate::denies('organizacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            Storage::makeDirectory("public/images");
            $ruta = public_path("storage/images");
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
        abort_if(Gate::denies('organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->load('team');
        $schedule = Organizacion::find(1)->schedules;

        $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes');
        return view('admin.organizacions.edit', compact('organizacion', 'dias', 'schedule'));
    }

    public function update(UpdateOrganizacionRequest $request, Organizacion $organizacion)
    {
        abort_if(Gate::denies('organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->update($request->all());
        // dd($organizacion);

        if ($request->hasFile('logotipo')) {
            $this->validate($request, [
                'logotipo' => 'mimetypes:image/jpeg,image/bmp,image/png',
            ]);
        }
        $file = $request->file('logotipo');
        if ($file != null) {
            Storage::makeDirectory("public/images");
            $ruta = public_path("storage/images");
            $nombre = $file->getClientOriginalName();
            $file->move($ruta, $file->getClientOriginalName());
            $organizacions = Organizacion::find(request()->org_id);
            $organizacions->logotipo = $nombre;
            $organizacions->save();
        }
        $this->saveOrUpdateSchedule($request, $organizacion);

        return redirect()->route('admin.organizacions.index')->with('success', 'Editado con éxito');
    }

    public function show(Organizacion $organizacion)
    {
        abort_if(Gate::denies('organizacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->load('team');

        return view('admin.organizacions.show', compact('organizacion'));
    }

    public function destroy(Organizacion $organizacion)
    {
        abort_if(Gate::denies('organizacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyOrganizacionRequest $request)
    {
        abort_if(Gate::denies('organizacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Organizacion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('organizacion_create') && Gate::denies('organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Organizacion();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function visualizarOrganizacion()
    {
        $organizacions = Organizacion::first();

        if (empty($organizacions)) {
            $count = Organizacion::get()->count();
            $empty = false;
            return view('admin.organizacions.visualizarorganizacion')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty);
        } else {
            $empty = true;
            $count = Organizacion::get()->count();
            $logotipo = $organizacions->logotipo;
        }


        // $var = $this->index();


        // dd($organizacion);
        return view('admin.organizacions.visualizarorganizacion')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty)->with('logotipo', $logotipo);
    }
    public function saveOrUpdateSchedule($request, $organizacions)
    {
        $id = $organizacions->id;


        $i = 0;
        if (isset($request->working)) {
            if (count($request->working)) {
                foreach ($request->working as $w) {
                    $model = Schedule::where('id', $w['id']);

                    $registerAlreadyExists = $model->exists();

                    if ($registerAlreadyExists) {

                        $dataModel = $model->first();

                        $dataModel->update([
                            'working_day'  => $w['day'][$i],
                            'start_work_time' =>  $w['start_time'][$i],
                            'end_work_time' => $w['end_time'][$i],

                        ]);
                    } else {

                        $schedule = Schedule::create([
                            'working_day'  => $w['day'][$i],
                            'start_work_time' =>  $w['start_time'][$i],
                            'end_work_time' => $w['end_time'][$i],
                            'organizacions_id'=> $id
                        ]);

                    }
                }
            }
        }
    }

    public function updateSchedule(Request $request,  $schedule)
    {
        // dd($schedule);
        $schedule = Schedule::find($schedule);

        $schedule->update([
            $request->typeInput => $request->value
        ]);
        return response()->json(['status' => 'success', 'message' => 'Dato Actualizado']);
    }
    public function deleteSchedule(Request $request,  $schedule)
    {
        $schedule = Schedule::find($schedule);
        $schedule->delete();
        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }
}
