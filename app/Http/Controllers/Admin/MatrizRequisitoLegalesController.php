<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Team;
use App\Models\Empleado;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MatrizRequisitoLegale;
use App\Models\EvidenciaMatrizRequisitoLegale;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreMatrizRequisitoLegaleRequest;
use App\Http\Requests\UpdateMatrizRequisitoLegaleRequest;
use App\Http\Requests\MassDestroyMatrizRequisitoLegaleRequest;

class MatrizRequisitoLegalesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('matriz_requisito_legale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($query = MatrizRequisitoLegale::with(['team','evidencias_matriz','empleado'])->get());
        if ($request->ajax()) {
            $query = MatrizRequisitoLegale::with(['team','evidencias_matriz','empleado'])->select(sprintf('%s.*', (new MatrizRequisitoLegale)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'matriz_requisito_legale_show';
                $editGate      = 'matriz_requisito_legale_edit';
                $deleteGate    = 'matriz_requisito_legale_delete';
                $crudRoutePart = 'matriz-requisito-legales';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? $row->tipo : "";
            });
            $table->editColumn('nombrerequisito', function ($row) {
                return $row->nombrerequisito ? $row->nombrerequisito : "";
            });
            $table->editColumn('formacumple', function ($row) {
                return $row->formacumple ? $row->formacumple : "";
            });
            $table->editColumn('requisitoacumplir', function ($row) {
                return $row->requisitoacumplir ? $row->requisitoacumplir : "";
            });
            $table->editColumn('alcance', function ($row) {
                return $row->alcance ? $row->alcance : "";
            });
            $table->editColumn('medio', function ($row) {
                return $row->medio ? $row->medio : "";
            });
            $table->editColumn('fechaexpedicion', function ($row) {
                return $row->fechaexpedicion ? $row->fechaexpedicion : "";
            });
            $table->editColumn('fechavigor', function ($row) {
                return $row->fechavigor ? $row->fechavigor : "";
            });
            $table->editColumn('periodicidad_cumplimiento', function ($row) {
                return $row->periodicidad_cumplimiento ? $row->periodicidad_cumplimiento : "";
            });
            $table->editColumn('cumplerequisito', function ($row) {
                return $row->cumplerequisito ? MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT[$row->cumplerequisito] : '';
            });
            $table->editColumn('metodo', function ($row) {
                return $row->metodo ? $row->metodo : "";
            });
            $table->editColumn('descripcion_cumplimiento', function ($row) {
                return $row->descripcion_cumplimiento ? $row->descripcion_cumplimiento : "";
            });
            $table->editColumn('evidencia', function ($row) {
                return $row->evidencias_matriz ? $row->evidencias_matriz : "";
            });

            $table->editColumn('reviso', function ($row) {
                return $row->empleado ? $row->empleado->name : "";
            });

            $table->editColumn('puesto', function ($row) {
                return $row->empleado ? $row->empleado->puesto : "";
            });

            $table->editColumn('area', function ($row) {
                return $row->empleado ? $row->empleado->area->area : "";
            });

            $table->editColumn('comentarios', function ($row) {
                return $row->comentarios ? $row->comentarios : "";
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        $empleados = Empleado::get();

        return view('admin.matrizRequisitoLegales.index', compact('teams','empleados'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_requisito_legale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::get();

        return view('admin.matrizRequisitoLegales.create',compact('empleados'));
    }

    public function store(StoreMatrizRequisitoLegaleRequest $request)
    {
        $matrizRequisitoLegale = MatrizRequisitoLegale::create($request->all());

        
       
        // $image=null;

        // if($request->file('evidencia') !=null or !empty($request->file('evidencia'))){ 

        //     $extension = pathinfo($request->file('evidencia')->getClientOriginalName(), PATHINFO_EXTENSION);
        //     $name_image = basename(pathinfo($request->file('evidencia')->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);
        //     $new_name_image = 'Evidencia_' . $matrizRequisitoLegale->id . '_' . $name_image . '.' . $extension;
        //     $route = storage_path() . 'public/matriz_evidencias' . $new_name_image;
        //     $image = $new_name_image;
        //     if($extension == 'JPG' || $extension == 'PNG' || $extension == 'GIF'){
        //     //Usamos image_intervention para disminuir el peso de la imagen
        //     $img_intervention = Image::make($request->file('evidencia'));
        //     $img_intervention->resize(256, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save($route);
        // }

        // // $file = $request->file('evidencia');   
        // // // Save the file
        // // $path = $file->storeAs('public/matriz_requisitos', $new_name_image);
        // // dd($path);
        
        // $paths = [];
        //     $files = $request->file('evidencia');
        //     // dd($files);
        //     foreach ($files as $file)
        //     {
        //         // Generate a file name with extension
        //         // Save the file
        //         $paths[] = $file->storeAs('public/matriz_evidencias', $new_name_image);
        //     }
          

        // }



        $files = $request->file('files');
        
        // $new_files = 'Evidencia_' . $matrizRequisitoLegale->id . '_' . ;


        foreach($files as $file){
            if (Storage::putFileAs('public/matriz_evidencias',$file, $file->getClientOriginalName())){
      
             EvidenciaMatrizRequisitoLegale::create([
            'evidencia'=> $file->getClientOriginalName(),
            'id_matriz_requisito' =>$matrizRequisitoLegale->id,
            ]); 
            }
        }
        //  dd($files);
      

        // EvidenciaMatrizRequisitoLegale::create([
        //     'nombrerequisito' => $request->nombrerequisito,
        //     'fechaexpedicion'=> $request->fechaexpedicion,
        //     'fechavigor'=> $request->fechavigor,
        //     'requisitoacumplir'=> $request->requisitoacumplir,
        //     'cumplerequisito'=> $request->cumplerequisito,
        //     'formacumple'=> $request->formacumple,
        //     'periodicidad_cumplimiento'=> $request->periodicidad_cumplimiento,
        //     'fechaverificacion'=> $request->fechaverificacion,
        //     'medio'=> $request->medio,
        //     'tipo'=> $request->tipo,
        //     'descripcion_cumplimiento'=> $request->descripcion_cumplimiento,
        //     'id_reviso'=> $request->id_reviso,
        //     'evidencia'=> $name_image,
        //     'id_matriz_requisito' =>$matrizRequisitoLegale->id,
            
            
        // ]); 


        return redirect()->route('admin.matriz-requisito-legales.index')->with("success", 'Guardado con éxito');
    }

    public function edit(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::get();

        $matrizRequisitoLegale->load('team');


        return view('admin.matrizRequisitoLegales.edit', compact('matrizRequisitoLegale','empleados'));
    }

    public function update(UpdateMatrizRequisitoLegaleRequest $request, MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        

        $matrizRequisitoLegale->update([

            'nombrerequisito' => $request->nombrerequisito,
            'fechaexpedicion'=> $request->fechaexpedicion,
            'fechavigor'=> $request->fechavigor,
            'requisitoacumplir'=> $request->requisitoacumplir,
            'cumplerequisito'=> $request->cumplerequisito,
            'formacumple'=> $request->formacumple,
            'periodicidad_cumplimiento'=> $request->periodicidad_cumplimiento,
            'fechaverificacion'=> $request->fechaverificacion,
            'medio'=> $request->medio,
            'tipo'=> $request->tipo,
            'descripcion_cumplimiento'=> $request->descripcion_cumplimiento,
            'evidencia'=> $request->evidencia,
            'id_reviso'=> $request->id_reviso,
        ]);

        dd($matrizRequisitoLegale, $request);

        $image=null;

        if($request->file('evidencia') !=null or !empty($request->file('evidencia'))){ 

            $extension = pathinfo($request->file('evidencia')->getClientOriginalName(), PATHINFO_EXTENSION);
            $name_image = basename(pathinfo($request->file('evidencia')->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);
            $new_name_image = 'Evidencia_' . $matriz_requisito->id . '_' . $name_image . '.' . $extension;
            $route = storage_path() . '/app/public/matriz_evidencias/' . $new_name_image;
            $image = $new_name_image;
            //Usamos image_intervention para disminuir el peso de la imagen
            $img_intervention = Image::make($request->file('evidencia'));
            $img_intervention->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($route);
        }


        EvidenciaMatrizRequisitoLegale::update([
            'evidencia'=> $name_image,
            'id_matriz_requisito' =>$matrizRequisitoLegale->id,
            
            
        ]); 

        

        return redirect()->route('admin.matriz-requisito-legales.index')->with("success", 'Editado con éxito');
    }

    public function show(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->load('team');

        return view('admin.matrizRequisitoLegales.show', compact('matrizRequisitoLegale'));
    }

    public function destroy(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->delete();

        return back();
    }

    public function massDestroy(MassDestroyMatrizRequisitoLegaleRequest $request)
    {
        MatrizRequisitoLegale::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
