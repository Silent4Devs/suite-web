<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGlosarioRequest;
use App\Models\Glosario;
use Illuminate\Http\Request;

class GlosarioController extends Controller
{
    public function index()
    {
        $glosarios = Glosario::get();

        return view('admin.glosarios.index', compact('glosarios'));
    }

    public function create()
    {
        return view('admin.glosarios.create');
    }

    public function store(StoreGlosarioRequest $request)
    {
        $glosario = Glosario::create($request->all());

        return redirect()->route('admin.glosarios.index');
    }

    public function edit($glosario)
    {
        $glosario = Glosario::find($glosario);

        return view('admin.glosarios.edit', compact('glosario'));
    }

    public function update(Request $request, Glosario $glosario)
    {
        $glosario->update($request->all());

        return redirect()->route('admin.glosarios.index');
    }

    public function show(Glosario $glosario)
    {
        return view('admin.glosarios.show', compact('glosario'));
    }

    public function destroy($id)
    {
        $glosario = Glosario::find($id);
        $glosario->delete();
        $glosarios = Glosario::get();

        return view('admin.glosarios.index', compact('glosarios'));
    }

    public function render(Request $request)
    {
        $glosarios = Glosario::get();

        return view('admin.glosarios.render', compact('glosarios'));
    }
}
