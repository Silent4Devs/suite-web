<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class AdquirirtreintaunmilController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('adquirirtreintaunmil_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adquirirtreintaunmils.index');
    }
}
