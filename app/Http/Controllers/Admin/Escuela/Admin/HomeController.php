<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\Level;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $cursoscategorias = array_unique(Course::pluck('category_id')->toArray());
        $categorias = Category::select('id', 'name')->find($cursoscategorias);
        $categoriasLabel = [];
        foreach ($categorias as $categoria) {
            $cantidadCategorias = Course::where('category_id', $categoria->id)->count();
            array_push($categoriasLabel, [
                'name' => $categoria->name,
                'cantidad' => $cantidadCategorias,
            ]);
        }

        $cursosStatusBorrador = Course::select('id', 'status')->where('status', 1)->count();
        $cursosStatusPublicado = Course::select('id', 'status')->where('status', 3)->count();


        $cursosniveles = array_unique(Course::pluck('level_id')->toArray());
        $niveles = Level::select('id', 'name')->find($cursosniveles);
        $nivelesLabel = [];
        foreach ($niveles as $nivel) {
            $cantidadNiveles = Course::where('level_id', $nivel->id)->count();
            array_push($nivelesLabel, [
                'name' => $nivel->name,
                'cantidad' => $cantidadNiveles,
            ]);
        }

        return view('admin.Escuela.Admin.index', compact('cursoscategorias', 'categorias', 'categoriasLabel', 'cursosStatusBorrador', 'cursosStatusPublicado', 'nivelesLabel'));
    }
}
