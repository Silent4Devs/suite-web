<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Level;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Level::getAll();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'capacitaciones_ver';
                $editGate = 'capacitaciones_editar';
                $deleteGate = 'capacitaciones_eliminar';
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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $levels = Level::getAll();

        return view('admin.escuela.admin.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.escuela.admin.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:levels',
        ]);

        $level = Level::create($request->all());

        //Alert::toast('El nivel se creó con éxito', 'success');
        return redirect()->route('admin.levels.index', $level);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        return view('admin.escuela.admin.levels.show', compact('level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Level $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        return view('admin.escuela.admin.levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  Level $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        $request->validate([
            'name' => 'required|unique:levels,name,'.$level->id,
        ]);

        $level->update($request->all());

        //Alert::toast('El nivel se actualizó con éxito', 'success');
        return redirect()->route('admin.levels.index', $level);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::find($id)->delete();

        //Alert::toast('El nivel se eliminó con éxito', 'success');
        return redirect()->route('admin.levels.index');
    }
}
