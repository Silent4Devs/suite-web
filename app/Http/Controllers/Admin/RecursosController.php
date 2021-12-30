<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRecursoRequest;
use App\Models\CategoriaCapacitacion;
use App\Models\Recurso;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RecursosController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('recurso_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Recurso::with(['empleados', 'team', 'categoria_capacitacion'])->select(sprintf('%s.*', (new Recurso)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'recurso_show';
                $editGate = 'recurso_edit';
                $deleteGate = 'recurso_delete';
                $crudRoutePart = 'recursos';

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
            $table->editColumn('cursoscapacitaciones', function ($row) {
                return $row->cursoscapacitaciones ? $row->cursoscapacitaciones : '';
            });

            $table->editColumn('participantes', function ($row) {
                return $row->empleados ? $row->empleados : '';
            });
            $table->editColumn('instructor', function ($row) {
                return $row->instructor ? $row->instructor : '';
            });
            $table->editColumn('certificado', function ($row) {
                if (!$row->certificado) {
                    return '';
                }

                $links = [];

                foreach ($row->certificado as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'participantes', 'certificado']);

            return $table->make(true);
        }

        $users = User::get();
        $teams = Team::get();

        return view('admin.recursos.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('recurso_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $participantes = User::all()->pluck('name', 'id');
        $categorias = CategoriaCapacitacion::get();
        $recurso = new Recurso;

        return view('admin.recursos.create', compact('recurso', 'categorias'));
    }

    public function store(Request $request)
    {
        $this->validateForm($request);
        $request->validate([
            'fecha_limite' => 'date|required|before_or_equal:fecha_curso',
        ]);

        $duracion = Carbon::parse($request->fecha_curso)->diffInHours(Carbon::parse($request->fecha_fin));

        $recurso = Recurso::create([
            'cursoscapacitaciones' => $request->cursoscapacitaciones,
            'tipo' => $request->tipo,
            'categoria_capacitacion_id' => $request->categoria_capacitacion_id,
            'fecha_curso' => $request->fecha_curso,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $duracion,
            'instructor' => $request->instructor,
            'descripcion' => $request->descripcion,
            'modalidad' => $request->modalidad,
            'ubicacion' => $request->ubicacion,
            'fecha_limite' => $request->fecha_limite,
        ]);
        if ($request->tipo_request == 'ajax') {
            return response()->json(['status' => 'success', 'message' => 'Recurso creado']);
        }

        return redirect()->route('admin.recursos.index')->with('success', 'Guardado con éxito');
    }

    public function validateForm(Request $request)
    {
        if ($request->tipo_validacion == 'general') {
            $this->validateRequest($request);

            return response()->json(['isValid' => true]);
        } else {
            $this->validateRequest($request);
        }
    }

    public function validateRequest($request)
    {
        $request->validate([
            'tipo' => 'required',
            'fecha_curso' => 'date|required',
            'fecha_fin' => 'date|required|after:fecha_curso',
            'instructor' => 'string|required',
            'cursoscapacitaciones'  => 'string|required',
            'modalidad'  => 'string|required',
            'ubicacion' => 'string|required',
            'categoria_capacitacion_id'  => 'string|required',
            'modalidad' => 'string|required',
        ]);
    }

    public function edit(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categorias = CategoriaCapacitacion::get();

        return view('admin.recursos.edit', compact('recurso', 'categorias'));
    }

    public function update(Request $request, Recurso $recurso)
    {
        $this->validateForm($request);
        $request->validate([
            'fecha_limite' => 'date|required|before_or_equal:fecha_curso',
        ]);
        $duracion = Carbon::parse($request->fecha_curso)->diffInHours(Carbon::parse($request->fecha_fin));

        $recurso->update([
            'cursoscapacitaciones' => $request->cursoscapacitaciones,
            'tipo' => $request->tipo,
            'categoria_capacitacion_id' => $request->categoria_capacitacion_id,
            'fecha_curso' => $request->fecha_curso,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $duracion,
            'instructor' => $request->instructor,
            'descripcion' => $request->descripcion,
            'modalidad' => $request->modalidad,
            'ubicacion' => $request->ubicacion,
            'fecha_limite' => $request->fecha_limite,
        ]);
        if ($request->tipo_request == 'ajax') {
            return response()->json(['status' => 'success', 'message' => 'Recurso creado']);
        }

        return redirect()->route('admin.recursos.index')->with('success', 'Actualizado con éxito');
        // if ($recurso->cursoscapacitaciones != $request->cursoscapacitaciones) {
        //     if (Storage::exists('public/capacitaciones/certificados/' . $recurso->cursoscapacitaciones)) {
        //         Storage::move('public/capacitaciones/certificados/' . $recurso->cursoscapacitaciones, 'public/capacitaciones/certificados/' . $request->cursoscapacitaciones); //rename folder
        //     }
        // }
    }

    public function show(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurso->load('participantes', 'team');

        return view('admin.recursos.show', compact('recurso'));
    }

    public function destroy(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurso->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyRecursoRequest $request)
    {
        Recurso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('recurso_create') && Gate::denies('recurso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Recurso();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function suscribir(Request $request)
    {
        if ($request->id_recurso != null && $request->id_empleado != null) {
            $recurso = Recurso::find(intval($request->id_recurso));
            // dd($recurso->empleados);
            $exists = $recurso->empleados()->where('empleado_id', intval($request->id_empleado))->exists();
            if (!$exists) {
                $recurso->empleados()->attach($request->id_empleado);

                return response()->json(['success' => true]);
            } else {
                return response()->json(['exists' => true]);
            }
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function participantes($recurso)
    {
        $int_recurso = intval($recurso);
        $recurso_data = Recurso::find($int_recurso);

        return datatables()->of($recurso_data->empleados)->toJson();
    }

    public function getParticipantes($recurso)
    {
        $int_recurso = intval($recurso);
        $recurso_data = Recurso::with('categoria_capacitacion')->find($int_recurso);
        $recurso_info = ['recurso' => $recurso_data, 'empleados' => $recurso_data->empleados];

        return $recurso_info;
    }

    public function calificarParticipante(Request $request)
    {
        if ($request->id_empleado != null) {
            $int_empleado = intval($request->id_empleado);
            $int_recurso = intval($request->id_recurso);
            $calificacion = intval($request->calificacion);
            // $certificado = $request->file('certificado');
            $recurso = Recurso::find($int_recurso);

            $image = null;
            $nombre_empleado = null;
            foreach ($recurso->empleados as $empleado) {
                if ($empleado->pivot->empleado_id == $int_empleado) {
                    $image = $empleado->pivot->certificado;
                    $nombre_empleado = $empleado->name;
                    break;
                }
            }

            if (!Storage::exists('public/capacitaciones/certificados')) {
                Storage::makeDirectory('public/capacitaciones/certificados');
            }

            if ($request->file('certificado') != null or !empty($request->file('certificado'))) {
                if (!Storage::exists('public/capacitaciones/certificados/' . $recurso->cursoscapacitaciones)) {
                    Storage::makeDirectory('public/capacitaciones/certificados/' . $recurso->cursoscapacitaciones);
                }

                $isExists = Storage::disk('public')->exists('capacitaciones/certificados/' . $recurso->cursoscapacitaciones . '/' . $image);
                if ($isExists) {
                    if ($image != null) {
                        unlink(storage_path('/app/public/capacitaciones/certificados/' . $recurso->cursoscapacitaciones . '/' . $image));
                    }
                }
                $extension = pathinfo($request->file('certificado')->getClientOriginalName(), PATHINFO_EXTENSION);
                $name_image = basename(pathinfo($request->file('certificado')->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);
                $new_name_image = 'CERTIFICADO_' . $nombre_empleado . '_' . $recurso->cursoscapacitaciones . '.' . $extension;
                $route = storage_path() . '/app/public/capacitaciones/certificados/' . $recurso->cursoscapacitaciones . '/' . $new_name_image;
                $image = $new_name_image;
                //Usamos image_intervention para disminuir el peso de la imagen
                $img_intervention = Image::make($request->file('certificado'));
                $img_intervention->resize(256, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($route);
            }

            $recurso->empleados()->syncWithoutDetaching([$int_empleado => ['calificacion' => $calificacion, 'certificado' => $image]]);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['no_selected' => true]);
        }
    }

    public function eliminarParticipante(Request $request)
    {
        $int_recurso = intval($request->id_recurso);
        $int_empleado = intval($request->id_empleado);
        $recurso = Recurso::find($int_recurso);
        $recurso->empleados()->detach($int_empleado);
        if ($recurso) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }
}
