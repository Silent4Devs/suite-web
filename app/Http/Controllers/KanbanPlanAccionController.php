<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KanbanPlanAccionController extends Controller
{
    public function index()
    {
        return view('admin.kanban-pa.index');
    }
}
