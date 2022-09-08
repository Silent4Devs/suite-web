<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitantes\VisitanteQuote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitanteQuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (VisitanteQuote::count() > 0) {
            $quote = VisitanteQuote::first();
        } else {
            $quote = new VisitanteQuote();
        }
        return view('admin.visitantes.quotes.index', compact('quote'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quote' => 'required',
        ]);

        if (VisitanteQuote::count() > 0) {
            $quote = VisitanteQuote::first();
            $quote->update([
                'quote' => $request->quote,
            ]);
        } else {
            $quote = VisitanteQuote::create([
                'quote' => $request->quote,
            ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'Aviso de privacidad actualizado correctamente',
            'updated_at' => Carbon::parse($quote->updated_at)->format('d-m-Y H:i:s'),
            'quote' => $quote,
        ]);
    }
}
