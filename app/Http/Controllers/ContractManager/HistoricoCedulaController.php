<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Models\ContractManager\HistoricoCedulaCumplimiento;

class HistoricoCedulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cedula_id)
    {
        $items_historico = HistoricoCedulaCumplimiento::where('id_cedula', '=', $cedula_id)->orderByDesc('id')->cursorPaginate(15);

        return view('livewire.cedula-cumplimiento.historico-component', compact('items_historico'));
    }
}
