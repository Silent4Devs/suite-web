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
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
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

        $request->validate([
            'empresa' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|max:255',
            'pagina_web' => 'required|max:255',
            'servicios' => 'required|max:255',
            'giro' => 'required|max:255',
            'mision' => 'required|max:255',
            'vision' => 'required|max:255',
            'valores' => 'required|max:255',
            'antecedentes' => 'required|max:255',
            'razon_social' => 'required|max:255',
            'rfc' => 'required|max:255',
            'representante_legal' => 'required|max:255',
        ], [
            'empresa.max' => 'La empresa no debe exceder de 255 caracteres',
            'direccion.max' => 'La direccion no debe exceder de 255 caracteres',
            'telefono.max' => 'El telefono no debe exceder de 255 caracteres',
            'correo.max' => 'El correo no debe exceder de 255 caracteres',
            'pagina_web.max' => 'La pagina_web no debe exceder de 255 caracteres',
            'servicios' => 'El servicios no debe exceder de 255 caracteres',
            'giro' => 'El giro no debe exceder de 255 caracteres',
            'mision' => 'La mision no debe exceder de 255 caracteres',
            'vision' => 'La vision no debe exceder de 255 caracteres',
            'valores' => 'Los valores no debe exceder de 255 caracteres',
            'antecedentes' => 'Los antecedentes no debe exceder de 255 caracteres',
            'razon_social' => 'La razon_social no debe exceder de 255 caracteres',
            'rfc' => 'El rfc no debe exceder de 255 caracteres',
            'representante_legal' => 'La representante_legal no debe exceder de 255 caracteres',

        ]);

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

            $file = $request->file('logotipo');
            //$name_image = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $hash_name = pathinfo($file->hashName(), PATHINFO_FILENAME);
            //$fileName = 'UID_'.$organizacions->id.'_'.$file->getClientOriginalName();
            $new_name_image = 'UID_'.$organizacions->id.'_'.$hash_name.'.png';

            // Call the ImageService to consume the external API
            $apiResponse = ImageService::consumeImageCompresorApi($file);

            // Compress and save the image
            if ($apiResponse['status'] == 200) {
                $rutaGuardada = '/public/images/'.$new_name_image;
                //file_put_contents(storage_path('app/public/'.$rutaGuardada), $apiResponse['body']);

                Storage::put($rutaGuardada, $apiResponse['body']);

                $organizacions->update(['logotipo' => $new_name_image]);
            } else {
                $mensajeError = 'Error al recibir la imagen de la API externa: '.$apiResponse['body'];

                return Redirect::back()->with('error', $mensajeError);
            }
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $organizacions->id]);
        }

        return redirect()->route('admin.organizacions.index')->with('success', 'Guardado con éxito');
    }

    public function edit($organizacionId)
    {
        try {
            $organizacion = Organizacion::findOrFail($organizacionId);

            $countEmpleados = Empleado::alta()->count();
            $organizacion->fecha_constitucion = Carbon::parse($organizacion->fecha_constitucion)->format('Y-m-d');

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

            $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

            return view('admin.organizacions.edit', compact('organizacion', 'dias', 'schedule', 'countEmpleados', 'tamanoEmpresa'));
        } catch (QueryException $e) {
            abort(404);
        }
    }

    public function update(UpdateOrganizacionRequest $request, Organizacion $organizacion)
    {
        abort_if(Gate::denies('mi_organizacion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'empresa' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|max:255',
            'pagina_web' => 'required|max:255',
            'servicios' => 'required|max:255',
            'giro' => 'required|max:255',
            'mision' => 'required|max:255',
            'vision' => 'required|max:255',
            'valores' => 'required|max:255',
            'antecedentes' => 'required|max:255',
            'razon_social' => 'required|max:255',
            'rfc' => 'required|max:255',
            'representante_legal' => 'required|max:255',
        ], [
            'empresa.max' => 'La empresa no debe exceder de 255 caracteres',
            'direccion.max' => 'La direccion no debe exceder de 255 caracteres',
            'telefono.max' => 'El telefono no debe exceder de 255 caracteres',
            'correo.max' => 'El correo no debe exceder de 255 caracteres',
            'pagina_web.max' => 'La pagina_web no debe exceder de 255 caracteres',
            'servicios' => 'El servicios no debe exceder de 255 caracteres',
            'giro' => 'El giro no debe exceder de 255 caracteres',
            'mision' => 'La mision no debe exceder de 255 caracteres',
            'vision' => 'La vision no debe exceder de 255 caracteres',
            'valores' => 'Los valores no debe exceder de 255 caracteres',
            'antecedentes' => 'Los antecedentes no debe exceder de 255 caracteres',
            'razon_social' => 'La razon_social no debe exceder de 255 caracteres',
            'rfc' => 'El rfc no debe exceder de 255 caracteres',
            'representante_legal' => 'La representante_legal no debe exceder de 255 caracteres',

        ]);

        $organizacion->update($request->all());

        if ($request->hasFile('logotipo')) {
            $this->validate($request, [
                'logotipo' => 'mimetypes:image/jpeg,image/bmp,image/png',
            ]);

            $file = $request->file('logotipo');
            //$name_image = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $hash_name = pathinfo($file->hashName(), PATHINFO_FILENAME);
            //$fileName = 'UID_'.$organizacion->id.'_'.$file->getClientOriginalName();
            $new_name_image = 'UID_'.$organizacion->id.'_'.$hash_name.'.png';

            // Call the ImageService to consume the external API
            $apiResponse = ImageService::consumeImageCompresorApi($file);

            // Compress and save the image
            if ($apiResponse['status'] == 200) {
                $rutaGuardada = '/public/images/'.$new_name_image;
                //file_put_contents(storage_path('app/public/'.$rutaGuardada), $apiResponse['body']);

                Storage::put($rutaGuardada, $apiResponse['body']);

                $organizacion->logotipo = $new_name_image;
                $organizacion->save();
            } else {
                $mensajeError = 'Error al recibir la imagen de la API externa: '.$apiResponse['body'];

                return Redirect::back()->with('error', $mensajeError);
            }
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
