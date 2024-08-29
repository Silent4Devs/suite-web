<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySedeRequest;
use App\Http\Requests\StoreSedeRequest;
use App\Models\Organizacion;
use App\Models\Sede;
use App\Models\Team;
use App\Services\ImageService;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SedeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sedes_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //dd( Sede::with(['organizacion', 'team'])->get());
        if ($request->ajax()) {
            $query = Sede::with(['organizacion', 'team'])->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sedes_ver';
                $editGate = 'sedes_editar';
                $deleteGate = 'sedes_eliminar';
                $crudRoutePart = 'sedes';

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
            $table->editColumn('sede', function ($row) {
                return $row->sede ? $row->sede : '';
            });
            $table->editColumn('foto_sedes', function ($row) {
                return $row->foto_sedes ? $row->foto_sedes : '';
            });
            $table->editColumn('direccion', function ($row) {
                return $row->direccion ? $row->direccion : '';
            });
            $table->editColumn('ubicacion', function ($row) {
                //return "'lat' => ".$row->latitude. ",'long' => ".$row->longitud ? "'lat' => ".$row->latitude. ",'long' =>".$row->longitud : "";
                return $row->id ? $row->id : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->addColumn('organizacion_empresa', function ($row) {
                return $row->organizacion ? $row->organizacion->empresa : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'organizacion']);

            return $table->make(true);
        }

        $organizacions = Organizacion::getAll();
        //$org = $organizacions->organizacion;
        //dd($organizacions->organizacion, $organizacions);
        $teams = Team::get();
        $numero_sedes = Sede::getAll()->count();

        //$sede_inicio = !is_null($sedes) ? url('images/' . DB::table('organizacions')->select('logotipo')->first()->logotipo) : url('img/Silent4Business-Logo-Color.png');

        return view('admin.sedes.index', compact('organizacions', 'teams', 'numero_sedes'));
    }

    public function create()
    {
        abort_if(Gate::denies('sedes_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::getAll()->pluck('empresa', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sedes.create', compact('organizacions'));
    }

    public function store(StoreSedeRequest $request)
    {
        abort_if(Gate::denies('sedes_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $client = new \GuzzleHttp\Client();
        $geocoder = new \Spatie\Geocoder\Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));
        $result = $geocoder->getCoordinatesForAddress($request->direccion);
        $request['latitude'] = $result['lat'];
        $request['longitud'] = $result['lng'];

        if (strlen($request->input('sede')) > 255 || strlen($request->input('descripcion')) > 255 || strlen($request->input('direccion')) > 255) {
            $mensajeError = 'Intentelo de nuevo, Ingrese  todos los campos';

            return Redirect::back()->with('mensajeError', $mensajeError);
        }

        $sede = Sede::create($request->all());

        if ($request->hasFile('foto_sedes')) {
            $file = $request->file('foto_sedes');
            $extension = $file->getClientOriginalExtension();
            $name_image = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $new_name_image = 'UID_'.$sede->id.'_'.$name_image.'.png';

            // Call the ImageService to consume the external API
            $apiResponse = ImageService::consumeImageCompresorApi($file);

            // Verificar si la solicitud fue exitosa
            if ($apiResponse['status'] == 200) {
                $rutaGuardada = '/sedes/imagenes/'.$new_name_image;
                file_put_contents(storage_path('app/public/'.$rutaGuardada), $apiResponse['body']);

                $sede->update([
                    'foto_sedes' => $new_name_image,
                ]);

                return redirect()->route('admin.sedes.index')->with('success', 'Guardado con éxito');

            } else {
                $mensajeError = 'Error al recibir la imagen de la API externa: '.$apiResponse['body'];

                return Redirect::back()->with('mensajeError', $mensajeError);
            }
        } else {
            $mensajeError = 'Intentelo de nuevo, Ingrese  el campo foto';

            return Redirect::back()->with('mensajeError', $mensajeError);
        }

        $sede->update([
            'foto_sedes' => $new_name_image,
        ]);

        return redirect()->route('admin.sedes.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Sede $sede)
    {
        abort_if(Gate::denies('sedes_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::getAll()->pluck('empresa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sede->load('organizacion', 'team');

        return view('admin.sedes.edit', compact('organizacions', 'sede'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('sedes_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sede = Sede::getbyId($id);
        $image = $sede->foto_sedes;

        if (strlen($request->input('sede')) > 255 || strlen($request->input('descripcion')) > 255 || strlen($request->input('direccion')) > 255) {
            $mensajeError = 'Intentelo de nuevo, Ingrese  todos los campos con caracteres menores a 255';

            return Redirect::back()->with('mensajeError', $mensajeError);
        }

        if ($request->hasFile('foto_sedes')) {
            // Check and delete the existing image if it exists
            $existingImagePath = 'sedes/imagenes/'.$sede->foto_sedes;

            if ($sede->foto_sedes && Storage::disk('public')->exists($existingImagePath)) {
                Storage::disk('public')->delete($existingImagePath);
            }

            // Process the new image
            $file = $request->file('foto_sedes');
            $extension = $file->getClientOriginalExtension();
            $name_image = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $new_name_image = 'UID_'.$sede->id.'_'.$name_image.'.png';

            // Call the ImageService to consume the external API
            $apiResponse = ImageService::consumeImageCompresorApi($file);

            // Verificar si la solicitud fue exitosa
            if ($apiResponse['status'] == 200) {
                $rutaGuardada = '/sedes/imagenes/'.$new_name_image;
                file_put_contents(storage_path('app/public/'.$rutaGuardada), $apiResponse['body']);

                $sede->update([
                    'sede' => $request->sede,
                    'foto_sedes' => $request->foto_sede,
                    'direccion' => $request->direccion,
                    'descripcion' => $request->descripcion,
                    'foto_sedes' => $new_name_image,
                ]);

                return redirect()->route('admin.sedes.index')->with('success', 'Editado con éxito');
            } else {
                $mensajeError = 'Error al recibir la imagen de la API externa: '.$apiResponse['body'];

                return Redirect::back()->with('mensajeError', $mensajeError);
            }

        } else {

            $mensajeError = 'Intentelo de nuevo, Ingrese  todos los campos';

            return Redirect::back()->with('mensajeError', $mensajeError);
        }

        $sede->update([

            'sede' => $request->sede,
            'foto_sedes' => $request->foto_sede,
            'direccion' => $request->direccion,
            'descripcion' => $request->descripcion,
            'foto_sedes' => $new_name_image,
        ]);

        return redirect()->route('admin.sedes.index')->with('success', 'Editado con éxito');
    }

    public function show(Sede $sede)
    {
        abort_if(Gate::denies('sedes_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sede->load('organizacion', 'team');

        return view('admin.sedes.show', compact('sede'));
    }

    public function destroy(Sede $sede)
    {
        abort_if(Gate::denies('sedes_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sede->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroySedeRequest $request)
    {
        Sede::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function obtenerListaSedes(Sede $sedes)
    {
        abort_if(Gate::denies('sedes_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //$sede = Sede::getAll();
        $sede = Sede::fastPaginate();
        $organizacions = Organizacion::getAll();
        $teams = Team::get();
        $numero_sedes = Sede::getAll()->count();

        return view('admin.sedes.sedes-organizacion', compact('sede', 'organizacions', 'teams', 'numero_sedes'));
    }

    public function ubicacion($request)
    {
        try {
            abort_if(Gate::denies('sedes_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $sede = Sede::find($request);

            if (! $sede) {
                abort(404);
            }

            return view('admin.sedes.ubicacion', compact('sede'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function ubicacionorg($request)
    {
        try {
            abort_if(Gate::denies('sedes_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $sede = Sede::find($request);

            if (! $sede) {
                abort(404);
            }

            //dd($sede);
            return view('admin.sedes.ubicacion', compact('sede'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}
