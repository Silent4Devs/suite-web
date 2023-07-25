<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyComunicacionSgiRequest;
use App\Http\Requests\UpdateComunicacionSgiRequest;
use App\Models\ComunicacionSgi;
use App\Models\DocumentoComunicacionSgis;
use App\Models\Empleado;
use App\Models\ImagenesComunicacionSgis;
use App\Models\RH\GruposEvaluado;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComunicacionSgiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('comunicados_generales_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ComunicacionSgi::with(['team', 'documentos_comunicacion', 'imagenes_comunicacion'])->select(sprintf('%s.*', (new ComunicacionSgi)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'comunicados_generales_ver';
                $editGate = 'comunicados_generales_editar';
                $deleteGate = 'comunicados_generales_eliminar';
                $crudRoutePart = 'comunicacion-sgis';

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
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->editColumn('archivo', function ($row) {
                return $row->documentos_comunicacion ? $row->documentos_comunicacion : [];
            });

            $table->rawColumns(['actions', 'placeholder', 'archivo']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.comunicacionSgis.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('comunicados_generales_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getAll();
        $documentos = DocumentoComunicacionSgis::get();
        $imagenes = ImagenesComunicacionSgis::get();

        return view('admin.comunicacionSgis.create', compact('empleados', 'documentos', 'imagenes'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('comunicados_generales_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'publicar_en' => 'required',
            'link' => 'nullable|url',
            'fecha_programable' => 'required|date',
            'fecha_programable_fin' => 'nullable|date',
        ]);
        if ($request->by_area) {
            $opts = $request->by_area;
        } else {
            $opts = $request->by_manual;
        }

        $publicoObjetivo = $this->obtenerPublicoObjetivo($request->evaluados_objetivo, $opts);

        $comunicacionSgi = ComunicacionSgi::create($request->all());

        $image = null;
        if ($request->file('imagen') != null or !empty($request->file('imagen'))) {
            $extension = pathinfo($request->file('imagen')->getClientOriginalName(), PATHINFO_EXTENSION);
            $name_image = basename(pathinfo($request->file('imagen')->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);
            $new_name_image = 'UID_' . $comunicacionSgi->id . '_' . $name_image . '.' . $extension;
            $route = storage_path() . '/app/public/imagen_comunicado_SGI/' . $new_name_image;
            $image = $new_name_image;
            if ($extension == 'mp4' || $extension == 'mov' || $extension == 'webm' || $extension == 'wmv' || $extension == 'avi') {
                $request->file('imagen')->storeAs('public/imagen_comunicado_SGI/', $new_name_image);
                $tipo_archivo = 'video';
            } else {
                //Usamos image_intervention para disminuir el peso de la imagen
                $img_intervention = Image::make($request->file('imagen'));
                $img_intervention->resize(720, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($route);
                $tipo_archivo = 'imagen';
            }
        }

        /*  $comunicacionSgi->update([
        'imagen'=>$image
        ]);
*/
        ImagenesComunicacionSgis::create([
            'imagen' => $image,
            'comunicacion_id' => $comunicacionSgi->id,
            'tipo' => $tipo_archivo,
        ]);

        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                if (Storage::putFileAs('public/documento_comunicado_SGI', $file, $file->getClientOriginalName())) {
                    DocumentoComunicacionSgis::create([
                        'documento' => $file->getClientOriginalName(),
                        'comunicacion_id' => $comunicacionSgi->id,
                    ]);
                }
            }
        }
        $comunicacionSgi->empleados()->sync($publicoObjetivo);

        if ($request->input('archivo', false)) {
            $comunicacionSgi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $comunicacionSgi->id]);
        }

        return redirect()->route('admin.comunicacion-sgis.index')->with('success', 'Guardado con éxito');
    }

    public function obtenerPublicoObjetivo($evaluados_objetivo, $opts)
    {
        if ($evaluados_objetivo != null) {
            if ($evaluados_objetivo == 'all') {
                $evaluados = Empleado::alta()->pluck('id')->toArray();
            } elseif ($evaluados_objetivo == 'area') {
                $evaluados_area = intval($opts);
                $evaluados = Empleado::alta()->where('area_id', $evaluados_area)->pluck('id')->toArray();
            } elseif ($evaluados_objetivo == 'manual') {
                $evaluados = $opts;
            } else {
                $evaluados = GruposEvaluado::find(intval($evaluados_objetivo))->empleados->pluck('id')->toArray();
            }

            return $evaluados;
        }

        return [];
    }

    public function edit(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicados_generales_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getaltaAll();
        $documentos = DocumentoComunicacionSgis::get();
        $imagenes = ImagenesComunicacionSgis::get();

        return view('admin.comunicacionSgis.edit', compact('comunicacionSgi', 'documentos', 'imagenes', 'empleados'));
    }

    public function update(UpdateComunicacionSgiRequest $request, ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicados_generales_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'publicar_en' => 'required',
            'link' => 'nullable|url',
            'fecha_programable' => 'required|date',
            'fecha_programable_fin' => 'nullable|date',
        ]);
        if ($request->by_area) {
            $opts = $request->by_area;
        } else {
            $opts = $request->by_manual;
        }
        $publicoObjetivo = $this->obtenerPublicoObjetivo($request->evaluados_objetivo, $opts);
        $comunicacionSgi->update($request->all());
        // $image = $comunicacionSgi->imagen;
        if ($request->file('imagen') != null or !empty($request->file('imagen'))) {
            $extension = pathinfo($request->file('imagen')->getClientOriginalName(), PATHINFO_EXTENSION);
            $name_image = basename(pathinfo($request->file('imagen')->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);
            $new_name_image = 'UID_' . $comunicacionSgi->id . '_' . $name_image . '.' . $extension;
            $route = storage_path() . '/app/public/imagen_comunicado_SGI/' . $new_name_image;
            $image = $new_name_image;
            if ($extension == 'mp4' || $extension == 'mov' || $extension == 'webm' || $extension == 'wmv' || $extension == 'avi') {
                $request->file('imagen')->storeAs('public/imagen_comunicado_SGI/', $new_name_image);
                $tipo_archivo = 'video';
            } else {
                //Usamos image_intervention para disminuir el peso de la imagen
                $img_intervention = Image::make($request->file('imagen'));
                $img_intervention->resize(256, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($route);
                $tipo_archivo = 'imagen';
            }
            $imagen_sgsi = $comunicacionSgi->imagenes_comunicacion->first();
            if ($imagen_sgsi) {
                $imagen_sgsi->update([
                    'imagen' => $image,
                    'comunicacion_id' => $comunicacionSgi->id,
                    'tipo' => $tipo_archivo,
                ]);
            } else {
                ImagenesComunicacionSgis::create([
                    'imagen' => $image,
                    'comunicacion_id' => $comunicacionSgi->id,
                    'tipo' => $tipo_archivo,
                ]);
            }
        }

        /*  $comunicacionSgi->update([
        'imagen'=>$image
        ]);
*/

        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                if (Storage::putFileAs('public/documento_comunicado_SGI', $file, $file->getClientOriginalName())) {
                    DocumentoComunicacionSgis::create([
                        'documento' => $file->getClientOriginalName(),
                        'comunicacion_id' => $comunicacionSgi->id,
                    ]);
                }
            }
        }
        $comunicacionSgi->empleados()->sync($publicoObjetivo);

        if ($request->input('archivo', false)) {
            if (!$comunicacionSgi->archivo || $request->input('archivo') !== $comunicacionSgi->archivo->file_name) {
                if ($comunicacionSgi->archivo) {
                    $comunicacionSgi->archivo->delete();
                }

                $comunicacionSgi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($comunicacionSgi->archivo) {
            $comunicacionSgi->archivo->delete();
        }

        return redirect()->route('admin.comunicacion-sgis.index')->with('success', 'Editado con éxito');
    }

    public function show(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicados_generales_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgi->load('team', 'documentos_comunicacion', 'imagenes_comunicacion');

        return view('admin.comunicacionSgis.show', compact('comunicacionSgi'));
    }

    public function destroy(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicados_generales_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyComunicacionSgiRequest $request)
    {
        ComunicacionSgi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('comunicados_generales_agregar') && Gate::denies('comunicacion_sgi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new ComunicacionSgi();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
