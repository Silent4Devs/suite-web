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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrganizacionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('organizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::first();




        if (empty($organizacions)) {
            $count = Organizacion::get()->count();
            $empty = false;

            return view('admin.organizacions.index')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty);
        } else {
            $empty = true;
            $count = Organizacion::get()->count();
            $logotipo=$organizacions->logotipo;
            // dd($organizacions);
            return view('admin.organizacions.index')->with('organizacion', $organizacions)->with('count', $count)->with('empty', $empty)->with('logotipo', $logotipo);
        }
    }

    public function create()
    {
        $count = Organizacion::get()->count();
        if ($count == 0) {
            abort_if(Gate::denies('organizacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            return view('admin.organizacions.create');
        } else {
            Flash::warning("<h5 align='center'>Ya existe un registro en la base de datos</h5>");

            return redirect()->route('admin.organizacions.index');
        }
    }

    public function store(StoreOrganizacionRequest $request)
    {
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
        ]);

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
            $ruta=public_path("storage/images");
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

        return view('admin.organizacions.edit', compact('organizacion'));
    }

    public function update(UpdateOrganizacionRequest $request, Organizacion $organizacion)
    {
        abort_if(Gate::denies('organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion->update($request->all());

        if ($request->hasFile('logotipo')) {
            $this->validate($request, [
                'logotipo' => 'mimetypes:image/jpeg,image/bmp,image/png',
            ]);
        }
        $file = $request->file('logotipo');
        if ($file != null) {
            Storage::makeDirectory("public/images");
            $ruta=public_path("storage/images");
            $nombre = $file->getClientOriginalName();
            $file->move($ruta, $file->getClientOriginalName());
            $organizacions = Organizacion::find(request()->org_id);
            $organizacions->logotipo = $nombre;
            $organizacions->save();
        }

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
}
