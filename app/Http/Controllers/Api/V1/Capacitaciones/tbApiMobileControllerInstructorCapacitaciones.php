<?php

namespace app\Http\Controllers\Api\V1\Capacitaciones;

use App\Http\Controllers\Controller;
use App\Models\ComunicacionSgi;
use App\Models\Empleado;
use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\CourseUser;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Instructor\Answer;
use App\Models\Escuela\Instructor\Question;
use App\Models\Escuela\Instructor\UserAnswer;
use App\Models\Escuela\Level;
use App\Models\Escuela\UserEvaluation;
use App\Models\Escuela\UsuariosCursos;
use App\Models\FelicitarCumpleaños;
use App\Models\Organizacione;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Escuela\Price;
use Illuminate\Support\Facades\Storage;


class tbApiMobileControllerInstructorCapacitaciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function encodeSpecialCharacters($url)
    {
        // Handle spaces
        // $url = str_replace(' ', '%20', $url);
        // Encode other special characters, excluding /, \, and :
        $url = preg_replace_callback(
            '/[^A-Za-z0-9_\-\.~\/\\\:]/',
            function ($matches) {
                return rawurlencode($matches[0]);
            },
            $url,
        );

        return $url;
    }

    public function tbFunctionIndexCurso()
    {
        $courses = Course::select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
        ->where('user_id', User::getCurrentUser()->id)
        ->latest('id')
        ->get()
        ->toArray();

        return response()->json([
            'courses' => $courses,
        ]);
    }

    public function tbFunctionCreateCurso()
    {
        $categories = Category::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');

        $usuarios = User::with('empleado')
            ->get()
            ->filter(fn($usuario) => $usuario->empleado && $usuario->empleado->estatus === 'alta')
            ->map(fn($usuario) => [
                'id' => $usuario->id,
                'name' => $usuario->name
            ])
            ->values(); // Para reindexar los índices del array

        return response()->json([
            'categorias' => $categories,
            'niveles' => $levels,
            'usuarios' => $usuarios,
        ]);
    }

    public function tbFunctionStoreCurso(Request $request)
    {
        $user = User::getCurrentUser();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:courses|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'level_id' => 'required',
            'empleado_id' => 'required',
            'file' => 'required',
        ], [
            'subtitle.required' => 'El campo subtitulo es obligatorio',
            'slug.required' => 'El campo slug es obligatorio',
            'title.required' => 'El campo titulo es obligatorio',
            'category_id.required' => 'El campo categoría es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'level_id.required' => 'El campo nivel es obligatorio',
            'empleado_id.required' => 'El campo instructor es obligatorio',
            // 'file.required' => 'El campo imagen es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $course = Course::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'level_id' => $request->level_id,
            'user_id' => $user->id,
            'empleado_id' => $request->empleado_id,
        ]);

        // if ($request->hasFile('file')) {
        //     $image = $request->file('file');
        //     Storage::put('public/cursos', $image);
        //     $url = '/storage/cursos/'.$image->hashName();
        //     $course->image()->create([
        //         'url' => $url,
        //     ]);
        // }

        // Si la validación pasa, continuar con la lógica normal
        return response()->json([
            'status' => 'success',
            'message' => 'Curso creado exitosamente'
        ]);
    }

    public function tbFunctionEditCurso($id_course)
    {
        $course = Course::where('id', $id_course)
        ->select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
        ->first(); // Obtener un solo registro

        $courseArray = $course ? $course->toArray() : []; // Convertir a array o devolver vacío si no existe

        $categories = Category::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');

        $usuarios = User::with('empleado')
            ->get()
            ->filter(fn($usuario) => $usuario->empleado && $usuario->empleado->estatus === 'alta')
            ->map(fn($usuario) => [
                'id' => $usuario->id,
                'name' => $usuario->name
            ])
            ->values(); // Para reindexar los índices del array

        return response()->json([
            'courseArray' => $courseArray,
            'categorias' => $categories,
            'niveles' => $levels,
            'usuarios' => $usuarios,
        ]);
    }

    public function tbFunctionUpdateCurso(Request $request, $id_course)
    {
        $course = Course::where('id', $id_course)->first();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => ['required', "unique:courses,slug,$course->id,id", 'max:255', 'string'],
            'subtitle' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'level_id' => 'required',
            'empleado_id' => 'required',
            'file' => 'required',
            'status' => 'required',
        ], [
            'subtitle.required' => 'El campo subtitulo es obligatorio',
            'slug.required' => 'El campo slug es obligatorio',
            'title.required' => 'El campo titulo es obligatorio',
            'category_id.required' => 'El campo categoría es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'level_id.required' => 'El campo nivel es obligatorio',
            'empleado_id.required' => 'El campo instructor es obligatorio',
            // 'file.required' => 'El campo imagen es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $course->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'level_id' => $request->level_id,
            'empleado_id' => $request->empleado_id,
        ]);

        // if ($request->hasFile('file')) {
        //     $image = $request->file('file');
        //     Storage::put('public/cursos', $image);
        //     $url = '/storage/cursos/'.$image->hashName();
        //     $course->image()->create([
        //         'url' => $url,
        //     ]);
        // }

        // Si la validación pasa, continuar con la lógica normal
        return response()->json([
            'status' => 'success',
            'message' => 'Curso modificado exitosamente'
        ]);
    }

    public function tbFunctionShowCurso($id_course)
    {
        $course = Course::where('id', $id_course)
        ->select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
        ->first(); // Obtener un solo registro

        $courseArray = $course ? $course->toArray() : []; // Convertir a array o devolver vacío si no existe

        return response()->json([
            'courseArray' => $courseArray,
        ]);
    }

    public function tbFunctionDeleteCurso($id_course)
    {
        $course = Course::where('id', $id_course)
        ->first(); // Obtener un solo registro

        $course->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Curso modificado exitosamente'
        ]);
    }

    public function tbFunctionIndexGoals($id_course)
    {
        $course = Course::where('id', $id_course)
        ->select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
        ->first(); // Obtener un solo registro

        $courseArray = $course ? $course->toArray() : []; // Convertir a array o devolver vacío si no existe

        foreach ($course->goals as $keyCourse => $goal) {
            # code...

        }

        dd();
    }

    public function tbFunctionSeccionesCurso($id_course)
    {
        $course = Course::where('id', $id_course)
        ->select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
        ->first(); // Obtener un solo registro

        $courseArray = $course ? $course->toArray() : []; // Convertir a array o devolver vacío si no existe


    }
}
