<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Price;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::all();

        return view('admin.prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:prices',
            'value' => 'required|numeric',
        ]);
        $price = Price::create($request->all());

        Alert::toast('El precio se creó con éxito', 'success');

        return redirect()->route('admin.prices.index', $price);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Price $price
     * @return \Illuminate\Http\Response
     */
    public function edit($id_price)
    {
        $price = Price::where('id', $id_price)->first();
        return view('admin.prices.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  Price $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_price)
    {
        $price = Price::where('id', $id_price)->first();
        $request->validate([
            'name' => 'required|unique:prices,name,'.$price->id,
            'value' => 'required|numeric',
        ]);

        $price->update($request->all());

        Alert::toast('El precio se actualizó con éxito', 'success');

        return redirect()->route('admin.prices.index', $price);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Price $price
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_price)
    {
        $price = Price::where('id', $id_price)->first();

        $price->delete();

        Alert::toast('El precio se eliminó con éxito', 'success');

        return redirect()->route('admin.prices.index');
    }
}
