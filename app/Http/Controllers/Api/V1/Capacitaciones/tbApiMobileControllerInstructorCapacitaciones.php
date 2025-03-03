<?php

namespace app\Http\Controllers\Api\V1\Capacitaciones;

use App\Http\Controllers\Controller;
use App\Models\ComunicacionSgi;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Escuela\Audience;
use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\CourseUser;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Goal;
use App\Models\Escuela\Instructor\Answer;
use App\Models\Escuela\Instructor\Question;
use App\Models\Escuela\Instructor\UserAnswer;
use App\Models\Escuela\Level;
use App\Models\Escuela\Requirement;
use App\Models\Escuela\Section;
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
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Escuela\Price;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Escuela\Lesson;

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
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses')->where(function ($query) {
                    return $query->whereNull('deleted_at'); // Solo considera los cursos no eliminados
                })
            ],
            'subtitle' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'level_id' => 'required',
            'empleado_id' => 'required',
            // 'file' => 'required',
        ], [
            'subtitle.required' => 'El campo subtitulo es obligatorio',
            'slug.required' => 'El campo slug es obligatorio',
            'slug.unique' => 'Este slug ya está en uso', // Mensaje personalizado para la unicidad
            'title.required' => 'El campo titulo es obligatorio',
            'category_id.required' => 'El campo categoría es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'level_id.required' => 'El campo nivel es obligatorio',
            'empleado_id.required' => 'El campo instructor es obligatorio',
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
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses')->ignore($course->id)->where(function ($query) {
                    return $query->whereNull('deleted_at'); // Ignora registros eliminados
                }),
            ],
            'subtitle' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'level_id' => 'required',
            'empleado_id' => 'required',
            // 'file' => 'required',
            'status' => 'required',
        ], [
            'subtitle.required' => 'El campo subtítulo es obligatorio',
            'slug.required' => 'El campo slug es obligatorio',
            'slug.unique' => 'Este slug ya está en uso', // Mensaje personalizado
            'title.required' => 'El campo título es obligatorio',
            'category_id.required' => 'El campo categoría es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'level_id.required' => 'El campo nivel es obligatorio',
            'empleado_id.required' => 'El campo instructor es obligatorio',
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
            'message' => 'Curso eliminado exitosamente'
        ]);
    }

    public function tbFunctionIndexGoals($id_course)
    {
        $course = Course::where('id', $id_course)
        ->select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
        ->first(); // Obtener un solo registro

        // $courseArray = $course ? $course->toArray() : []; // Convertir a array o devolver vacío si no existe
        $course_goals = [];

        foreach ($course->goals as $keyCourse => $goal) {
            # code...
            $course_goals[] =
            [
                'id' => $goal->id,
                'name' => $goal->name,
                'id_course' => $course->id
            ];
        }

        return response()->json([
            'course_goals' => $course_goals
        ]);
    }

    public function tbFunctionStoreGoals(Request $request, $id_course)
    {
        $course = Course::where('id', $id_course)->first(); // Obtener un solo registro

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El campo meta es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $course->goals()->create([
            'name' => $request->name,
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Meta agregada exitosamente'
        ]);
    }

    public function tbFunctionEditGoals($id_goal)
    {
        $goal = Goal::where('id', $id_goal)
        ->select('id', 'name', 'course_id')
        ->first(); // Obtener un solo registro

        $goalArray = $goal ? $goal->toArray() : []; // Convertir a array o devolver vacío si no existe

        return response()->json([
            'goal' => $goalArray
        ]);
    }

    public function tbFunctionUpdateGoals(Request $request, $id_goal)
    {
        $goal = Goal::where('id', $id_goal)->first(); // Obtener un solo registro

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El campo meta es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $goal->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Meta modificada exitosamente'
        ]);
    }

    public function tbFunctionDeleteGoals($id_goal)
    {
        $goal = Goal::where('id', $id_goal)->first(); // Obtener un solo registro

        $goal->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Meta eliminada exitosamente'
        ]);
    }

    public function tbFunctionIndexRequirements($id_course)
    {
        $course = Course::where('id', $id_course)
        ->select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
        ->first(); // Obtener un solo registro

        $course_requirements = [];

        foreach ($course->requirements as $keyCourse => $requirement) {
            # code...
            $course_requirements[] =
            [
                'id' => $requirement->id,
                'name' => $requirement->name,
                'id_course' => $course->id
            ];
        }

        return response()->json([
            'course_requirements' => $course_requirements
        ]);
    }

    public function tbFunctionStoreRequirements(Request $request, $id_course)
    {
        $course = Course::where('id', $id_course)->first(); // Obtener un solo registro

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El campo requisito es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $course->requirements()->create([
            'name' => $request->name,
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Requirimiento agregada exitosamente'
        ]);
    }

    public function tbFunctionEditRequirements($id_requirement)
    {
        $requirement = Requirement::where('id', $id_requirement)
        ->select('id', 'name', 'course_id')
        ->first(); // Obtener un solo registro

        $requirementArray = $requirement ? $requirement->toArray() : []; // Convertir a array o devolver vacío si no existe

        return response()->json([
            'requirement' => $requirementArray
        ]);
    }

    public function tbFunctionUpdateRequirements(Request $request, $id_requirement)
    {
        $requirement = Requirement::where('id', $id_requirement)->first(); // Obtener un solo registro

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El campo requisito es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $requirement->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Requirimiento modificado exitosamente'
        ]);
    }

    public function tbFunctionDeleteRequirements($id_requirement)
    {
        $requirement = Requirement::where('id', $id_requirement)->first(); // Obtener un solo registro

        $requirement->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Requirimiento eliminado exitosamente'
        ]);
    }

    public function tbFunctionIndexAudience($id_course)
    {
        $course = Course::where('id', $id_course)
        ->select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
        ->first(); // Obtener un solo registro

        // $courseArray = $course ? $course->toArray() : []; // Convertir a array o devolver vacío si no existe
        $course_audiences = [];

        foreach ($course->audiences as $keyCourse => $audience) {
            # code...
            $course_audiences[] =
            [
                'id' => $audience->id,
                'name' => $audience->name,
                'id_course' => $course->id
            ];
        }

        return response()->json([
            'course_audiences' => $course_audiences
        ]);
    }

    public function tbFunctionStoreAudience(Request $request, $id_course)
    {
        $course = Course::where('id', $id_course)->first(); // Obtener un solo registro

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El campo audiencia es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $course->audiences()->create([
            'name' => $request->name,
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Audiencia agregada exitosamente'
        ]);
    }

    public function tbFunctionEditAudience($id_audience)
    {
        $audience = Audience::where('id', $id_audience)
        ->select('id', 'name', 'course_id')
        ->first(); // Obtener un solo registro

        $audienceArray = $audience ? $audience->toArray() : []; // Convertir a array o devolver vacío si no existe

        return response()->json([
            'audience' => $audienceArray
        ]);
    }

    public function tbFunctionUpdateAudience(Request $request, $id_audience)
    {
        $audience = Audience::where('id', $id_audience)->first(); // Obtener un solo registro

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El campo audiencia es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $audience->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Audiencia modificada exitosamente'
        ]);
    }

    public function tbFunctionDeleteAudience($id_audience)
    {
        $audience = Audience::where('id', $id_audience)->first(); // Obtener un solo registro

        $audience->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Audiencia eliminada exitosamente'
        ]);
    }

    public function tbFunctionIndexEstudiantes($id_course)
    {
        // Obtener información del curso
        $course = Course::select('id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id')
            ->find($id_course);

        if (!$course) {
            return response()->json(['error' => 'Curso no encontrado'], 404);
        }

        // Obtener usuarios inscritos con nombres
        $userInsc = UsuariosCursos::where('course_id', $course->id)
            ->with('usuarios:id,name,empleado_id') // Optimiza la consulta para traer solo los datos necesarios
            ->get()
            ->map(fn($ui) => [
                'id' => $ui->id,
                'id_user' => $ui->user_id,
                'name_user' => $ui->usuarios?->name // Manejo de null safety
            ])->toArray();

        // Obtener todas las áreas
        $areas_array = Area::select('id', 'area')->get()->sortBy('area')->map(fn($area) => [
            'id_area' => $area->id,
            'name_area' => $area->area
        ])->toArray();

        // Obtener usuarios no inscritos
        $usuariosNoInsc = User::whereNotIn('id', UsuariosCursos::where('course_id', $course->id)->pluck('user_id')->toArray())
            ->orderBy('name')
            ->get();

        // Obtener empleados activos
        $empleados = Empleado::select('id', 'name')
            ->where('estatus', 'alta')
            ->get()
            ->keyBy('id'); // Indexamos para búsqueda rápida

        // Filtrar usuarios manualmente según empleados
        $users_manual = $usuariosNoInsc->filter(fn($usuario) => isset($empleados[$usuario->empleado_id]))
            ->map(fn($usni) => [
                'id_user' => $usni->id,
                'name_user' => $usni->name
            ])->values()
            ->toArray();

        return response()->json([
            'data' => [
                'course' => $course,
                'usuarios_incritos' => $userInsc,
                'areas' => $areas_array,
                'users_manual' => $users_manual
            ]
        ]);
    }


    public function tbFunctionStoreEstudiantes(Request $request, $id_course)
    {
        // Obtener el curso
        $course = Course::find($id_course);
        if (!$course) {
            return response()->json(['status' => 'error', 'message' => 'Curso no encontrado'], 404);
        }

        // Obtener IDs de usuarios ya inscritos en el curso
        $usuariosInscritosIds = UsuariosCursos::where('course_id', $course->id)->pluck('user_id')->toArray();

        // Obtener usuarios no inscritos con sus empleados en una sola consulta
        $usuariosNoInsc = User::with('empleado')->whereNotIn('id', $usuariosInscritosIds)->orderBy('name')->get();

        // Si se seleccionan todos los empleados activos
        if ($request->publico === 'todos') {
            $usuariosValidos = $usuariosNoInsc->filter(fn($usuario) => $usuario->empleado?->estatus === 'alta');

            if ($usuariosValidos->isNotEmpty()) {
                UsuariosCursos::insert($usuariosValidos->map(fn($usuario) => [
                    'user_id' => $usuario->id,
                    'course_id' => $course->id,
                ])->toArray());
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Los estudiantes de la organización se han agregado exitosamente'
            ]);
        }

        // Si se seleccionan empleados de un área específica
        if ($request->publico === 'area') {
            $usuariosValidos = $usuariosNoInsc->filter(fn($usuario) =>
                $usuario->empleado?->estatus === 'alta' && $usuario->empleado?->area_id == $request->id_area
            );

            if ($usuariosValidos->isNotEmpty()) {
                UsuariosCursos::insert($usuariosValidos->map(fn($usuario) => [
                    'user_id' => $usuario->id,
                    'course_id' => $course->id,
                ])->toArray());
            }

            $areaNombre = Area::where('id', $request->id_area)->value('area'); // Optimizado con `value()`

            return response()->json([
                'status' => 'success',
                'message' => "Los estudiantes del área $areaNombre se han agregado exitosamente"
            ]);
        }

        // Si se selecciona un usuario manualmente
        if ($request->publico === 'manual' && $request->filled('id_user')) {
            UsuariosCursos::create([
                'user_id' => $request->id_user,
                'course_id' => $course->id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'El estudiante se ha agregado exitosamente'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Parámetros incorrectos'
        ], 400);
    }

    public function tbFunctionDeleteEstudiantes(Request $request)
    {

        $cursoUsuario = UsuariosCursos::where('id', $request->id_student)->first();
        if ($cursoUsuario) {
            $cursoUsuario->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Estudiante retirado exitosamente'
            ]);
        }

    }

    public function tbFunctionMultipleDeleteEstudiantes(Request $request)
    {
        $array_students = $request->input('students');

        foreach ($array_students as $key => $id_student) {

            $cursoUsuario = UsuariosCursos::where('id', $id_student)->first();
            if ($cursoUsuario) {
                $cursoUsuario->delete();
            }

        }

        return response()->json([
            'status' => 'success',
            'message' => 'Todos los estudiantes han sido retirados exitosamente'
        ]);
    }

    public function tbFunctionAllDeleteEstudiantes($id_course)
    {

        $cursoUsuarios = UsuariosCursos::where('course_id', $id_course)->get();
        foreach ($cursoUsuarios as $key => $cursoUsuario) {

            if ($cursoUsuario) {
                $cursoUsuario->delete();
            }

        }

        return response()->json([
            'status' => 'success',
            'message' => 'Todos los estudiantes han sido retirados exitosamente'
        ]);
    }

    public function tbFunctionIndexSeccionesCurso($id_course)
    {
        $course = Course::with(['instructor', 'teacher.empleado', 'user.empleado', 'sections_order.lessons'])
            ->where('id', $id_course)
            ->firstOrFail();

        $data['course'] = [
            'id_course' => $course->id,
            'title' => $course->title,
            'subtitle' => $course->subtitle,
            'description' => $course->description,
            'course_rating' => $course->rating,
            'course_certificate' => $course->certificado,
            'colaboradores_inscritos' => $course->students_count,
            'nombre_instructor' => $course->instructor->name ?? $course->teacher->empleado->name ?? '',
            'imagen_instructor' => optional($course->user->empleado)->avatar_ruta ? $this->encodeSpecialCharacters($course->user->empleado->avatar_ruta) : '',
        ];

        foreach ($course->sections_order as $section) {
            $data['course']['sections'][] = [
                'id_section' => $section->id,
                'name_section' => $section->name,
                'lessons' => $section->lessons->map(function ($lesson) {
                    return [
                        'id_lesson' => $lesson->id,
                        'name_lesson' => $lesson->name,
                        'url_evaluation' => $lesson->url,
                        'lesson_completed' => $lesson->completed,
                    ];
                })->toArray(),
            ];
        }

        return response()->json(['data' => $data], 200);
    }

    public function tbFunctionStoreSeccionesCurso(Request $request, $id_course)
    {
        $course = Course::select(['id', 'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'user_id', 'empleado_id'])
            ->findOrFail($id_course);

        $this->saveSections($request->input('sections', []), $request->input('lessons', []), $id_course);

        return response()->json([
            'status' => 'success',
            'message' => 'Secciones y lecciones creadas exitosamente.'
        ]);
    }

    public function saveSections($sections, $lessons, $cursoID)
    {
        DB::beginTransaction();
        try {
            $sectionIds = []; // Almacena los IDs de las secciones en orden

            foreach ($sections as $section) {
                if (Str::startsWith($section['id_seccion'], 'sec-')) {
                    $sec = Section::create([
                        'name' => $section['name_seccion'],
                        'course_id' => $cursoID
                    ]);
                } else {
                    $sec = Section::findOrFail($section['id_seccion']);
                    $sec->update(['name' => $section['name_seccion']]);
                }

                $sectionIds[] = "seccion-" . $sec->id; // Agrega el ID en el formato correcto

                // Guardar las lecciones dentro de la sección
                $this->saveLessons($sec->id, collect($lessons)->where('section_id', $section['id_seccion'])->all(), $cursoID);
            }

            // Actualizar el campo order_section del curso con los IDs de las secciones
            $orderSection = implode(',', $sectionIds);
            Course::where('id', $cursoID)->update(['order_section' => $orderSection]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }


    public function saveLessons($sectionId, $lessons, $templateId)
    {
        DB::beginTransaction();
        try {
            foreach ($lessons as $lesson) {
                if (Str::startsWith($lesson['id_leccion'], 'lec-')) {
                    // Nueva lección
                    $resource = match ($lesson['formato_lesson']) {
                        'Youtube', 'Vimeo' => Lesson::create([
                            'name' => $lesson['name_lesson'],
                            'platform_id' => $lesson['platform_id'],
                            'url' => "{$lesson['url_lesson']}?rel=0",
                            'section_id' => $sectionId,
                            'description' => $lesson['description'],
                        ]),
                        'Texto' => Lesson::create([
                            'name' => $lesson['name_lesson'],
                            'platform_id' => $lesson['platform_id'],
                            'section_id' => $sectionId,
                            'text_lesson' => $lesson['description'],
                        ]),
                        'Documento' => (!empty($lesson['file']) && $this->isValidDocument($lesson['file']))
                            ? $this->storeDocumentLesson($lesson, $sectionId)
                            : throw new \Exception("Formato de archivo no válido."),
                        default => throw new \Exception("Formato de lección no válido."),
                    };

                    if (!empty($lesson['file'])) {
                        $this->storeResourceFile($lesson['file'], $resource, $sectionId);
                    }
                } else {
                    // Actualizar lección existente
                    $this->updateExistingLesson($lesson['id_leccion'], $lesson, $sectionId);
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    private function storeDocumentLesson($lesson, $sectionId)
    {
        return Lesson::create([
            'name' => $lesson['name_lesson'],
            'platform_id' => $lesson['platform_id'],
            'section_id' => $sectionId,
        ]);
    }

    private function storeResourceFile($file, $resource, $sectionId = null)
    {
        $uuid = Str::uuid();
        $newFileName = "{$uuid}_{$file->getClientOriginalName()}";
        $path = "cursos/section/{$sectionId}/lesson/{$resource->id}";

        $storedPath = $file->storeAs($path, $newFileName);
        $file->storeAs("public/{$path}", $newFileName);

        $resource->resource()->create(['url' => $storedPath]);
    }

    private function updateExistingLesson($id, $lesson, $sectionId)
    {
        $leccionPrevia = Lesson::find($id);

        DB::beginTransaction();
        try {
            switch ($lesson['formato_lesson']) {
                case 'Youtube':
                case 'Vimeo':
                    try {
                        if ($leccionPrevia->platform_format == 'Documento' && isset($leccionPrevia->resource)) {
                            $leccionPrevia->resource->delete();
                        }

                        $leccionPrevia->update([
                            'name' => $lesson['name_lesson'],
                            'platform_id' => $lesson['platform_id'],
                            'url' => "{$lesson['url_lesson']}?rel=0",
                            'description' => $lesson['description'],
                        ]);

                        if (!empty($lesson['file'])) {
                            $this->storeResourceFile($lesson['file'], $leccionPrevia, $sectionId);
                        }
                    } catch (\Throwable $th) {}
                    break;

                case 'Texto':
                    try {
                        if (isset($leccionPrevia->resource)) {
                            $leccionPrevia->resource->delete();
                        }

                        $leccionPrevia->update([
                            'name' => $lesson['name_lesson'],
                            'platform_id' => $lesson['platform_id'],
                            'url' => null,
                            'text_lesson' => $lesson['description'],
                        ]);
                    } catch (\Throwable $th) {}
                    break;

                case 'Documento':
                    try {
                        if ($leccionPrevia->resource) {
                            $leccionPrevia->resource->delete();
                        }

                        $leccionPrevia->update([
                            'name' => $lesson['name_lesson'],
                            'platform_id' => $lesson['platform_id'],
                        ]);

                        if (!empty($lesson['file'])) {
                            $this->storeResourceFile($lesson['file'], $leccionPrevia, $sectionId);
                        }
                    } catch (\Throwable $th) {}
                    break;
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    public function tbFunctionDeleteSeccion($id_section)
    {
        $section = Section::find($id_section);

        $section->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'La seccion ha sido eliminada con exito.'
        ]);
    }

    public function tbFunctionDeleteLesson($id_lesson)
    {
        $lesson = Lesson::find($id_lesson);

        $lesson->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'La leccion ha sido eliminada con exito.'
        ]);
    }

    public function tbFunctionIndexEvaluacion($id_course)
    {
        $evaluations = Evaluation::select('id', 'section_id', 'course_id', 'name', 'description', 'is_active', 'linkedTo', 'details')->where('course_id', $id_course)->get()->toArray();

        return response()->json([
            'evaluations' => $evaluations,
        ]);
    }

    public function tbFunctionCreateEvaluacion($id_course)
    {
        $sections = Section::where('course_id', $id_course)->get();

        return response()->json([
            'sections' => $sections,
        ]);
    }

    public function tbFunctionStoreEvaluacion(Request $request, $id_course)
    {
        Evaluation::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'linkedTo' => 1,
            'is_active' => 1,
            'section_id' => $request['section_id'],
            'course_id' => $id_course,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'El registro se ha agregado exitosamente.',
        ]);
    }

    public function tbFunctionEditarEvaluacion($id_evaluation)
    {
        $evaluation = Evaluation::find($id_evaluation)->toArray();

        return response()->json([
            'evaluation' => $evaluation,
        ]);
    }

    public function tbFunctionUpdateEvaluacion(Request $request, $id_evaluation)
    {
        $evaluation = Evaluation::findOrFail($id_evaluation);

        $evaluation->update([
            'name' => $request->input('name', $evaluation->name),
            'description' => $request->input('description', $evaluation->description),
            'section_id' => $request->input('section_id', $evaluation->section_id),
            'is_active' => $request->input('is_active', $evaluation->is_active),
            'linkedTo' => $request->input('linkedTo', $evaluation->linkedTo),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'La evaluación ha sido actualizada exitosamente.',
        ]);
    }

    public function tbFunctionDestroyEvaluacion($id_evaluation)
    {
        $evaluation = Evaluation::findOrFail($id_evaluation);
        $evaluation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'La evaluación ha sido eliminada exitosamente.',
        ]);
    }

    public function tbFunctionEvaluacionwithQuestions($id_evaluation)
    {
        $evaluation = Evaluation::with('questions.answers')->findOrFail($id_evaluation);

        $json_preguntas_curso = [
            'evaluation' => $this->formatEvaluationData($evaluation),
        ];

        return response()->json(['evaluation' => $json_preguntas_curso], 200);
    }

    private function formatEvaluationData($evaluation)
    {
        $evaluationData = [
            'id_evaluation' => $evaluation->id,
            'name_evaluation' => $evaluation->name,
            'evaluation_blocked' => false,
            'questions' => $this->formatQuestions($evaluation)
        ];

        return $evaluationData;
    }

    private function formatQuestions($evaluation)
    {
        $questionsData = [];
        foreach ($evaluation->questions->shuffle() as $question) {
            $questionsData[] = [
                'id_question' => $question->id,
                'question' => $question->question,
                'is_active' => $question->is_active,
                'answers' => $this->formatAnswers($question->answers),
            ];
        }
        return $questionsData;
    }

    private function formatQuestion($question)
    {
        $questionsData = [];

        $questionsData[] = [
            'id_question' => $question->id,
            'question' => $question->question,
            'is_active' => $question->is_active,
            'answers' => $this->formatAnswers($question->answers),
        ];
        return $questionsData;
    }

    private function formatAnswers($answers, $selectedAnswerId = null, $isCorrect = false)
    {
        $answersData = [];
        foreach ($answers as $answer) {
            $answersData[] = [
                "id_answer" => $answer->id,
                "answer" => $answer->answer,
                "is_correct" => $selectedAnswerId === $answer->id
                    ? (bool) $isCorrect
                    : (bool) $answer->is_correct,
                "selected" => $selectedAnswerId === $answer->id,
            ];
        }
        return $answersData;
    }

    public function tbFunctionStoreQuestion(Request $request, $id_evaluation)
    {
        $question = Question::create([
            'explanation' => $request['explanation'],
            'question' => $request['question'],
            'evaluation_id' => $id_evaluation,
        ]);

        $answers = $request->input('answers', []);

        foreach ($answers as $answer) {
            Answer::create([
                'answer' => $answer['answer'],
                'is_correct' => $answer['is_correct'] == false ? '0' : '1',
                'question_id' => $question->id,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'La pregunta ha sido creada exitosamente.',
        ]);
    }

    public function tbFunctionEditarQuestion($id_question)
    {
        $question = Question::find($id_question);

        $data = $this->formatQuestion($question);

        return response()->json([
            'question' => $data,
        ]);
    }

    public function tbFunctionUpdateQuestion(Request $request, $id_question)
    {
        $question = Question::find($id_question);
        $question->update([
            'explanation' => $request['explanation'],
            'question' => $request['question'],
            'evaluation_id' => $request['id_evaluation'],
        ]);

        $answers = $request->input('answers', []);

        foreach ($answers as $answer) {
            $answerExist = Answer::where('id', $answer['id_answer'])->exists();
            if ($answerExist) {
                Answer::find($answer['id_answer'])->update([
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct'] == false ? '0' : '1',
                    'question_id' => $question->id,
                ]);
            } else {
                Answer::create([
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct'] == false ? '0' : '1',
                    'question_id' => $question->id,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'La pregunta ha sido modificada exitosamente.',
        ]);
    }

    public function tbFunctionDeleteQuestion($id_question)
    {
        $question = Question::find($id_question);

        $question->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'La pregunta ha sido eliminada exitosamente.',
        ]);
    }

    public function tbFunctionDeleteAnswer($id_answer)
    {
        $answer = Answer::find($id_answer);

        $answer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'La respuesta ha sido eliminada.',
        ]);
    }

    public function tbFunctionCertificadoCurso(Request $request, $id_course)
    {
        $course = Course::find($id_course);

        $course->update([
            'certificado' => $request->certificado,
            'firma_instructor' => $request->firma_instructor,
            'firma_habilitar' => $request->firma_habilitar,
        ]);
    }
}
