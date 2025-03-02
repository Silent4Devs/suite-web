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

        return response()->json(['message' => 'Sections and lessons created successfully'], 200);
    }

    public function saveSections($sections, $lessons, $cursoID)
    {
        DB::beginTransaction();
        try {
            foreach ($sections as $section) {
                $sec = Str::startsWith($section['id_seccion'], 'sec-')
                    ? Section::create(['name' => $section['name_seccion'], 'course_id' => $cursoID])
                    : Section::findOrFail($section['id_seccion'])->update(['name' => $section['name_seccion']]);

                $this->saveLessons($sec->id, collect($lessons)->where('section_id', $section['id_seccion'])->all(), $cursoID);
            }
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
                if (empty($lesson['id'])) {
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
                    $this->updateExistingLesson($lesson['id'], $lesson, $sectionId);
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
        DB::beginTransaction();
        try {
            Lesson::findOrFail($id)->update([
                'title' => $lesson['title'],
                'size' => $lesson['size'],
                'type' => $lesson['type'],
                'position' => $lesson['position'],
                'obligatory' => $lesson['obligatory'],
                'is_numeric' => $lesson['isNumeric'] ?? null,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    // {
    //     /**
    //      * Display a listing of the resource.
    //      */
    //     public function index() {}

    //     /**
    //      * Store a newly created resource in storage.
    //      */
    //     public function store(Request $request)
    //     {

    //         $sections = json_decode($request->input('sections'));
    //         $questions = json_decode($request->input('questions'));
    //         $imagenes = $request->file('image');
    //         $templateId = $sections[0]->template_id;
    //         $sectionId = $sections[0]->id;
    //         if (! empty($imagenes)) {
    //             $this->saveImage($questions, $imagenes);
    //         }

    //         $this->saveSections($sections, $questions);

    //         $this->createQuestionsDefault($templateId, $sectionId);

    //         return json_encode(['data' => 'Sections and questions created successfully'], 200);
    //     }

    //     /**
    //      * Display the specified resource.
    //      */
    //     public function show(int $id)
    //     {
    //         try {
    //             $template = TBTemplateAnalisisRiesgoModel::findOrFail($id);

    //             $sections = TBSectionTemplateAnalisisRiesgoModel::select('id', 'title', 'template_id', 'position')
    //                 ->where('template_id', $template->id)->get();

    //             $questions = [];

    //             foreach ($sections as $section) {
    //                 $data = $section->questions;
    //                 $sectionId = $section->id;

    //                 $filter = $data->reject(function ($registro) {
    //                     if ($registro['type'] === '11' || $registro['type'] === '12' || $registro['type'] === '13' || $registro['type'] === '14') {
    //                         return $registro;
    //                     }
    //                 });

    //                 $newQuestions = $filter->map(function ($itm) use ($sectionId) {
    //                     Arr::forget($itm, 'created_at');
    //                     Arr::forget($itm, 'updated_at');
    //                     Arr::forget($itm, 'pivot');
    //                     Arr::forget($itm, 'deleted_at');
    //                     $itm->columnId = $sectionId;
    //                     $itm->isNumeric = $itm->is_numeric;

    //                     Arr::forget($itm, 'is_numeric');
    //                     $this->getDataQuestion($itm);

    //                     return $itm;
    //                 });

    //                 Arr::forget($section, 'questions');

    //                 foreach ($newQuestions as $newQuestion) {
    //                     array_push($questions, $newQuestion);
    //                 }
    //             }

    //             return json_encode(['data' => ['sections' => $sections, 'questions' => $questions]], 200);
    //         } catch (\Throwable $th) {
    //             throw $th;

    //             return response()->json(['message' => 'No encontrado'], 404);
    //         }
    //     }

    //     /**
    //      * Update the specified resource in storage.
    //      */
    //     public function update(int $id, Request $request)
    //     {
    //         $templateId = $id;
    //         $requestSections = json_decode($request->input('sections'));
    //         $requestQuestions = json_decode($request->input('questions'));
    //         $imagenes = $request->file('image');
    //         if (! empty($imagenes)) {
    //             $this->saveImage($requestQuestions, $imagenes);
    //         }
    //         $dataFilter = $this->filterData($requestSections, $requestQuestions);
    //         $sections = $dataFilter['sections'];
    //         $newSections = $dataFilter['newSections'];
    //         $questions = $dataFilter['questions'];
    //         $newQuestions = $dataFilter['newQuestions'];

    //         $this->saveSections($newSections, $newQuestions);

    //         $this->updateSections($sections);
    //         $this->updateQuestions($questions, $templateId);

    //         return json_encode(['data' => 'Se actualizaron exitosamente las secciones y las preguntas']);
    //     }

    //     /**
    //      * Remove the specified resource from storage.
    //      */
    //     public function destroy(Template_Analisis_Riesgos $template_Analisis_Riesgos)
    //     {
    //         //
    //     }

    //     public function saveSections($sections, $questions)
    //     {
    //         DB::beginTransaction();
    //         try {
    //             foreach ($sections as $section) {
    //                 $sectionId = $section->id;
    //                 $templateId = $section->template_id;
    //                 $questionsFilter = array_filter($questions, function ($item) use ($sectionId) {
    //                     return $item->columnId === $sectionId;
    //                 });

    //                 $sectionCreate = TBSectionTemplateAnalisisRiesgoModel::create([
    //                     'title' => $section->title,
    //                     'template_id' => $templateId,
    //                     'position' => $section->position,
    //                 ]);
    //                 $sectionId = $sectionCreate->id;
    //                 $this->saveQuestions($sectionId, $questionsFilter, $templateId);
    //             }
    //             DB::commit();
    //         } catch (\Throwable $th) {
    //             // throw $th;
    //             DB::rollback();
    //         }
    //     }

    //     public function saveQuestions($sectionId, $questions, $templateId)
    //     {
    //         foreach ($questions as $question) {
    //             $id = $question->id;
    //             $exist = intval($id);
    //             if (! $exist) {
    //                 DB::beginTransaction();
    //                 try {
    //                     $uuid = $this->verifyUuidFormula($question);
    //                     $questionCreate = TBQuestionTemplateAnalisisRiesgoModel::create([
    //                         'title' => $question->title,
    //                         'size' => $question->size,
    //                         'type' => $question->type,
    //                         'position' => $question->position,
    //                         'obligatory' => $question->obligatory,
    //                         'is_numeric' => $question->isNumeric,
    //                         'uuid_formula' => $uuid ? $uuid : null,
    //                     ]);

    //                     TBSectionTemplateAr_QuestionTemplateArModel::create([
    //                         'section_id' => $sectionId,
    //                         'question_id' => $questionCreate->id,
    //                     ]);

    //                     TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
    //                         'template_id' => $templateId,
    //                         'question_id' => $questionCreate->id,
    //                         'is_show' => false,
    //                     ]);

    //                     $this->filterSaveDataQuestion($question, $questionCreate);
    //                     DB::commit();
    //                 } catch (\Throwable $th) {
    //                     DB::rollback();

    //                     continue;
    //                 }
    //             } else {
    //                 $pivot = TBSectionTemplateAr_QuestionTemplateArModel::where('question_id', $id)->first();
    //                 $register = TBQuestionTemplateAnalisisRiesgoModel::where('id', $id)->first();
    //                 DB::beginTransaction();
    //                 try {
    //                     $register->update([
    //                         'title' => $question['title'],
    //                         'size' => $question['size'],
    //                         'type' => $question['type'],
    //                         'position' => $question['position'],
    //                         'obligatory' => $question['obligatory'],
    //                         'is_numeric' => $question->isNumeric,
    //                     ]);
    //                     $pivot->update(
    //                         ['section_id' => $sectionId],
    //                     );
    //                     DB::commit();
    //                 } catch (\Throwable $th) {
    //                     DB::rollback();

    //                     continue;
    //                 }
    //             }
    //         }
    //     }

    //     public function updateSections($sections)
    //     {
    //         foreach ($sections as $section) {
    //             $id = $section->id;
    //             $sectionRegister = TBSectionTemplateAnalisisRiesgoModel::find($id);
    //             DB::beginTransaction();
    //             try {
    //                 $sectionRegister->update([
    //                     'title' => $section->title,
    //                     'position' => $section->position,
    //                 ]);
    //                 DB::commit();
    //             } catch (\Throwable $th) {
    //                 DB::rollback();

    //                 continue;
    //             }
    //         }
    //     }

    //     public function updateQuestions($questions, $templateId)
    //     {
    //         foreach ($questions as $question) {
    //             $id = $question->id;
    //             $exist = intval($id);

    //             if ($exist) {
    //                 $pivot = TBSectionTemplateAr_QuestionTemplateArModel::where('question_id', $id)->first();
    //                 $register = TBQuestionTemplateAnalisisRiesgoModel::where('id', $id)->first();
    //                 DB::beginTransaction();
    //                 try {
    //                     $register->update([
    //                         'title' => $question->title,
    //                         'size' => $question->size,
    //                         'type' => $question->type,
    //                         'position' => $question->position,
    //                         'obligatory' => $question->obligatory,
    //                         'is_numeric' => $question->isNumeric,
    //                     ]);
    //                     $pivot->update(
    //                         ['section_id' => $question->columnId],
    //                     );

    //                     $this->filterUpdateDataQuestion($question, $id);
    //                     DB::commit();
    //                 } catch (\Throwable $th) {
    //                     DB::rollback();

    //                     continue;
    //                 }
    //             } else {

    //                 DB::beginTransaction();
    //                 try {
    //                     $questionCreate = TBQuestionTemplateAnalisisRiesgoModel::create([
    //                         'title' => $question->title,
    //                         'size' => $question->size,
    //                         'type' => $question->type,
    //                         'position' => $question->position,
    //                         'obligatory' => $question->obligatory,
    //                         'is_numeric' => $question->isNumeric,
    //                     ]);

    //                     TBSectionTemplateAr_QuestionTemplateArModel::create([
    //                         'section_id' => $question->columnId,
    //                         'question_id' => $questionCreate->id,
    //                     ]);

    //                     TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
    //                         'template_id' => $templateId,
    //                         'question_id' => $questionCreate->id,
    //                         'is_show' => false,
    //                     ]);

    //                     $this->filterSaveDataQuestion($question, $questionCreate);
    //                     DB::commit();
    //                 } catch (\Throwable $th) {
    //                     // throw $th;
    //                     DB::rollback();

    //                     continue;
    //                 }
    //             }
    //         }
    //     }

    //     public function filterData($requestSections, $requestQuestions)
    //     {
    //         $sections = [];
    //         $questions = [];
    //         $newSections = [];
    //         $newQuestions = [];

    //         foreach ($requestSections as $requestSection) {
    //             $id = intval($requestSection->id);
    //             if ($id) {
    //                 $sections[] = $requestSection;
    //             } else {

    //                 $newSections[] = $requestSection;
    //             }
    //         }

    //         foreach ($requestQuestions as $requestQuestion) {
    //             $id = intval($requestQuestion->id);
    //             $columnId = intval($requestQuestion->columnId);

    //             if ($id && $columnId) {
    //                 $questions[] = $requestQuestion;
    //             } elseif ($columnId) {
    //                 $questions[] = $requestQuestion;
    //             } else {
    //                 $newQuestions[] = $requestQuestion;
    //             }
    //         }

    //         return ['sections' => $sections, 'newSections' => $newSections, 'questions' => $questions, 'newQuestions' => $newQuestions];
    //     }

    //     public function filterSaveDataQuestion($question, $questionCreate)
    //     {
    //         switch ($question->type) {
    //             case '3':
    //                 $this->saveDataQuestionMinMax($question->data, $questionCreate->id);
    //                 break;
    //             case '4':
    //                 $this->saveDataQuestionCatalog($question->data, $questionCreate->id);
    //                 break;
    //             case '5':
    //                 $this->saveMultipleDataQuestion($question->data, $questionCreate->id);
    //                 break;
    //             case '6':
    //                 $this->saveMultipleDataQuestion($question->data, $questionCreate->id);
    //                 break;
    //             case '7':
    //                 $this->saveSelectDataQuestion($question->data, $questionCreate->id);
    //                 break;
    //             case '10':
    //                 $this->saveImageDataQuestion($question->data, $questionCreate->id);
    //                 break;
    //             case '15':
    //                 $this->saveDataQuestionMinMax($question->data, $questionCreate->id);
    //                 break;
    //             default:
    //                 break;
    //         }
    //     }

    //     public function filterUpdateDataQuestion($question, $questionCreate)
    //     {
    //         switch ($question->type) {
    //             case '3':
    //                 $this->updateDataQuestionMinMax($question->data, $questionCreate);
    //                 break;
    //             case '4':
    //                 $this->updateDataQuestionCatalog($question->data);
    //                 break;
    //             case '5':
    //                 $this->updateMultipleDataQuestion($question->data, $questionCreate);
    //                 break;
    //             case '6':
    //                 $this->updateMultipleDataQuestion($question->data, $questionCreate);
    //                 break;
    //             case '7':
    //                 $this->updateSelectDataQuestion($question->data, $questionCreate);
    //                 break;
    //             case '10':
    //                 $this->updateImageDataQuestion($question->data, $questionCreate);
    //                 break;
    //             case '15':
    //                 $this->updateDataQuestionMinMax($question->data, $questionCreate);
    //                 break;
    //             default:
    //                 break;
    //         }
    //     }

    //     public function saveDataQuestionMinMax($dataQuestion, $questionCreateId)
    //     {
    //         DB::beginTransaction();
    //         try {
    //             $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
    //                 'minimum' => intval($dataQuestion->minimo),
    //                 'maximum' => intval($dataQuestion->maximo),
    //             ]);

    //             TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
    //                 'question_id' => $questionCreateId,
    //                 'dataquestion_id' => $dataQuestionCreate->id,
    //             ]);

    //             DB::commit();
    //         } catch (\Throwable $th) {
    //             // throw $th;
    //             DB::rollback();
    //         }
    //     }

    //     public function updateDataQuestionMinMax($dataQuestion)
    //     {

    //         DB::beginTransaction();
    //         $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($dataQuestion->id);

    //         try {
    //             $register->update([
    //                 'minimum' => intval($dataQuestion->minimo),
    //                 'maximum' => intval($dataQuestion->maximo),
    //             ]);

    //             DB::commit();
    //         } catch (\Throwable $th) {
    //             // throw $th;
    //             DB::rollback();
    //         }
    //     }

    //     public function saveDataQuestionCatalog($dataQuestion, $questionCreateId)
    //     {
    //         DB::beginTransaction();
    //         try {
    //             $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
    //                 'title' => ($dataQuestion->title),
    //                 'catalog' => intval($dataQuestion->catalog),
    //             ]);

    //             TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
    //                 'question_id' => $questionCreateId,
    //                 'dataquestion_id' => $dataQuestionCreate->id,
    //             ]);

    //             DB::commit();
    //         } catch (\Throwable $th) {
    //             // throw $th;
    //             DB::rollback();
    //         }
    //     }

    //     public function updateDataQuestionCatalog($dataQuestion)
    //     {

    //         DB::beginTransaction();
    //         $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($dataQuestion->id);

    //         try {
    //             $register->update([
    //                 'title' => $dataQuestion->title,
    //                 'catalog' => intval($dataQuestion->catalog),
    //             ]);

    //             DB::commit();
    //         } catch (\Throwable $th) {
    //             // throw $th;
    //             DB::rollback();
    //         }
    //     }

    //     public function saveMultipleDataQuestion($dataQuestions, $questionCreateId)
    //     {
    //         foreach ($dataQuestions as $dataQuestion) {
    //             DB::beginTransaction();
    //             try {
    //                 $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
    //                     'title' => $dataQuestion->title,
    //                     'name' => $dataQuestion->name,
    //                     'status' => $dataQuestion->status,
    //                     'value' => $dataQuestion->value,
    //                 ]);

    //                 TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
    //                     'question_id' => $questionCreateId,
    //                     'dataquestion_id' => $dataQuestionCreate->id,
    //                 ]);

    //                 DB::commit();
    //             } catch (\Throwable $th) {
    //                 // throw $th;
    //                 DB::rollback();

    //                 continue;
    //             }
    //         }
    //     }

    //     public function updateMultipleDataQuestion($dataQuestions, $questionCreateId)
    //     {
    //         foreach ($dataQuestions as $dataQuestion) {
    //             $id = $dataQuestion->id;
    //             if (is_int($id)) {
    //                 DB::beginTransaction();
    //                 $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($id);
    //                 try {
    //                     $register->update([
    //                         'title' => $dataQuestion->title,
    //                         'name' => $dataQuestion->name,
    //                         'status' => $dataQuestion->status,
    //                         'value' => $dataQuestion->value,
    //                     ]);
    //                     DB::commit();
    //                 } catch (\Throwable $th) {
    //                     // throw $th;
    //                     DB::rollback();

    //                     continue;
    //                 }
    //             } else {
    //                 DB::beginTransaction();
    //                 try {
    //                     $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
    //                         'title' => $dataQuestion->title,
    //                         'name' => $dataQuestion->name,
    //                         'status' => $dataQuestion->status,
    //                     ]);

    //                     TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
    //                         'question_id' => $questionCreateId,
    //                         'dataquestion_id' => $dataQuestionCreate->id,
    //                     ]);

    //                     DB::commit();
    //                 } catch (\Throwable $th) {
    //                     // throw $th;
    //                     DB::rollback();

    //                     continue;
    //                 }
    //             }
    //         }
    //     }

    //     public function saveSelectDataQuestion($dataQuestions, $questionCreateId)
    //     {
    //         // dd($dataQuestions);
    //         foreach ($dataQuestions as $dataQuestion) {
    //             DB::beginTransaction();
    //             try {
    //                 $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
    //                     'title' => $dataQuestion->title,
    //                     'name' => $dataQuestion->name,
    //                     'value' => $dataQuestion->value,
    //                 ]);

    //                 TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
    //                     'question_id' => $questionCreateId,
    //                     'dataquestion_id' => $dataQuestionCreate->id,
    //                 ]);

    //                 DB::commit();
    //             } catch (\Throwable $th) {
    //                 // throw $th;
    //                 // dd($th);
    //                 DB::rollback();

    //                 continue;
    //             }
    //         }
    //     }

    //     public function updateSelectDataQuestion($dataQuestions, $questionCreateId)
    //     {
    //         foreach ($dataQuestions as $dataQuestion) {
    //             $id = $dataQuestion->id;
    //             if (is_int($id)) {
    //                 DB::beginTransaction();
    //                 $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($id);
    //                 try {
    //                     $register->update([
    //                         'title' => $dataQuestion->title,
    //                         'name' => $dataQuestion->name,
    //                         'value' => $dataQuestion->value,

    //                     ]);

    //                     DB::commit();
    //                 } catch (\Throwable $th) {
    //                     // throw $th;
    //                     DB::rollback();

    //                     continue;
    //                 }
    //             } else {
    //                 DB::beginTransaction();
    //                 try {
    //                     $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
    //                         'title' => $dataQuestion->title,
    //                         'name' => $dataQuestion->name,
    //                     ]);

    //                     TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
    //                         'question_id' => $questionCreateId,
    //                         'dataquestion_id' => $dataQuestionCreate->id,
    //                     ]);

    //                     DB::commit();
    //                 } catch (\Throwable $th) {
    //                     // throw $th;
    //                     DB::rollback();

    //                     continue;
    //                 }
    //             }
    //         }
    //     }

    //     public function saveImageDataQuestion($dataQuestions, $questionCreateId)
    //     {

    //         DB::beginTransaction();
    //         try {

    //             $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
    //                 'url' => $dataQuestions->name,
    //             ]);
    //             TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
    //                 'question_id' => $questionCreateId,
    //                 'dataquestion_id' => $dataQuestionCreate->id,
    //             ]);
    //             DB::commit();
    //         } catch (\Throwable $th) {
    //             // throw $th;
    //             DB::rollback();
    //         }

    //         // $extension = pathinfo($dataQuestions->file('file')->getClientOriginalName(), PATHINFO_EXTENSION);
    //         // $new_name_image = 'Template_AR_Question_Image'.$extension;

    //         // $route = storage_path().'/app/public/analisis_riesgo/template/questions/'.$new_name_image;
    //         // $image = $new_name_image;

    //         // // Call the ImageService to consume the external API
    //         // $apiResponse = ImageService::consumeImageCompresorApi($dataQuestions->file('file'));

    //         // // Compress and save the image
    //         // if ($apiResponse['status'] == 200) {
    //         //     file_put_contents($route, $apiResponse['body']);
    //         // }
    //     }

    //     public function updateImageDataQuestion($dataQuestions, $questionId)
    //     {
    //         if (property_exists($dataQuestions, 'name')) {
    //             DB::beginTransaction();
    //             $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($questionId);
    //             try {
    //                 $register->update([
    //                     'url' => $dataQuestions->name,
    //                 ]);

    //                 DB::commit();
    //             } catch (\Throwable $th) {
    //                 // throw $th;
    //                 DB::rollback();
    //             }
    //         }
    //     }

    //     public function getDataQuestion($question)
    //     {
    //         $register = TBQuestionTemplateAnalisisRiesgoModel::findOrFail($question->id);
    //         $data = $register->dataQuestions;
    //         switch ($question->type) {
    //             case '3':
    //                 foreach ($data as $item) {
    //                     Arr::forget($item, 'created_at');
    //                     Arr::forget($item, 'updated_at');
    //                     Arr::forget($item, 'deleted_at');
    //                     Arr::forget($item, 'pivot');
    //                     Arr::forget($item, 'title');
    //                     Arr::forget($item, 'name');
    //                     Arr::forget($item, 'status');

    //                     $item->minimo = $item->minimum;
    //                     $item->maximo = $item->maximum;

    //                     Arr::forget($item, 'minimum');
    //                     Arr::forget($item, 'maximum');
    //                 }
    //                 break;
    //             case '4':
    //                 foreach ($data as $item) {
    //                     Arr::forget($item, 'created_at');
    //                     Arr::forget($item, 'updated_at');
    //                     Arr::forget($item, 'deleted_at');
    //                     Arr::forget($item, 'pivot');
    //                     Arr::forget($item, 'name');
    //                     Arr::forget($item, 'status');
    //                     Arr::forget($item, 'minimum');
    //                     Arr::forget($item, 'maximum');
    //                     Arr::forget($item, 'url');

    //                     // $item->id = $item->catalog;

    //                     // Arr::forget($item, 'catalog');

    //                 }
    //                 break;
    //             case '5':
    //                 foreach ($data as $item) {
    //                     Arr::forget($item, 'created_at');
    //                     Arr::forget($item, 'updated_at');
    //                     Arr::forget($item, 'deleted_at');
    //                     Arr::forget($item, 'pivot');
    //                     Arr::forget($item, 'minimum');
    //                     Arr::forget($item, 'maximum');
    //                 }
    //                 break;
    //             case '6':
    //                 foreach ($data as $item) {
    //                     Arr::forget($item, 'created_at');
    //                     Arr::forget($item, 'updated_at');
    //                     Arr::forget($item, 'deleted_at');
    //                     Arr::forget($item, 'pivot');
    //                     Arr::forget($item, 'minimum');
    //                     Arr::forget($item, 'maximum');
    //                 }
    //                 break;
    //             case '7':
    //                 foreach ($data as $item) {
    //                     Arr::forget($item, 'created_at');
    //                     Arr::forget($item, 'updated_at');
    //                     Arr::forget($item, 'deleted_at');
    //                     Arr::forget($item, 'pivot');
    //                     Arr::forget($item, 'minimum');
    //                     Arr::forget($item, 'maximum');
    //                     Arr::forget($item, 'status');
    //                 }
    //                 break;
    //             case '10':
    //                 foreach ($data as $item) {
    //                     Arr::forget($item, 'created_at');
    //                     Arr::forget($item, 'updated_at');
    //                     Arr::forget($item, 'deleted_at');
    //                     Arr::forget($item, 'pivot');
    //                     Arr::forget($item, 'minimum');
    //                     Arr::forget($item, 'maximum');
    //                     Arr::forget($item, 'title');
    //                     Arr::forget($item, 'name');
    //                     Arr::forget($item, 'status');

    //                     $fileName = $item->url;
    //                     $path = asset('storage/analisis_riesgo/template/questions/'.$fileName);
    //                     $item->url = $path;
    //                 }
    //                 break;
    //             case '15':
    //                 foreach ($data as $item) {
    //                     Arr::forget($item, 'created_at');
    //                     Arr::forget($item, 'updated_at');
    //                     Arr::forget($item, 'deleted_at');
    //                     Arr::forget($item, 'pivot');
    //                     Arr::forget($item, 'title');
    //                     Arr::forget($item, 'name');
    //                     Arr::forget($item, 'status');
    //                     Arr::forget($item, 'catalog');
    //                     Arr::forget($item, 'value');
    //                     Arr::forget($item, 'url');

    //                     $item->minimo = $item->minimum;
    //                     $item->maximo = $item->maximum;

    //                     Arr::forget($item, 'minimum');
    //                     Arr::forget($item, 'maximum');
    //                 }
    //                 break;
    //             default:
    //                 break;
    //         }
    //         $question->data = $data;
    //     }

    //     public function destroySection($id)
    //     {
    //         $section = TBSectionTemplateAnalisisRiesgoModel::find($id);
    //         $section->delete();

    //         return json_encode(['data' => 'Se elimino el registro exitosamente'], 200);
    //     }

    //     public function destroyQuestion($id)
    //     {
    //         $pivot = TBSectionTemplateAr_QuestionTemplateArModel::find($id);
    //         $question = TBQuestionTemplateAnalisisRiesgoModel::find($id);

    //         $question->delete();
    //         $pivot->delete();

    //         return json_encode(['data' => 'Se elimino el registro exitosamente'], 200);
    //     }

    //     public function destroyDataQuestion($id)
    //     {
    //         $pivot = TBQuestionTemplateAr_DataQuestionTemplateArModel::find($id);
    //         $dataQuestion = TBDataQuestionTemplateAnalisisRiesgoModel::find($id);

    //         $dataQuestion->delete();
    //         $pivot->delete();

    //         return json_encode(['data' => 'Se elimino el registro exitosamente'], 200);
    //     }

    //     public function getSettings(int $id)
    //     {
    //         try {
    //             $template = TBTemplateAnalisisRiesgoModel::findOrFail($id);

    //             $sections = TBSectionTemplateAnalisisRiesgoModel::select('id', 'title', 'template_id', 'position')
    //                 ->where('template_id', $template->id)->get();

    //             $formulas = TBFormulaTemplateAnalisisRiesgoModel::where('template_id', $id)->get();

    //             foreach ($formulas as $formula) {
    //                 Arr::forget($formula, 'created_at');
    //                 Arr::forget($formula, 'updated_at');
    //                 Arr::forget($formula, 'deleted_at');
    //                 Arr::forget($formula, 'template_id');
    //             }

    //             $exists = $this->verifyInputsDefault($sections);
    //             $questions = [];

    //             // $optionId = ([
    //             //     'id' => 'q-1',
    //             //     'title' => 'ID',
    //             //     'template' => $template->id,
    //             //     'position' => 0,
    //             //     'type' => '12',
    //             //     'size' => 3,
    //             //     'obligatory' => true,
    //             //     'data' => [],
    //             // ]);

    //             // $optionDescription = ([
    //             //     'id' => 'q-2',
    //             //     'title' => 'Descripcion del riesgo',
    //             //     'template' => $template->id,
    //             //     'position' => 1,
    //             //     'type' => '12',
    //             //     'size' => 3,
    //             //     'obligatory' => true,
    //             //     'data' => [],
    //             // ]);

    //             // $optionOwner = ([
    //             //     'id' => 'q-3',
    //             //     'title' => 'Dueño del riesgo',
    //             //     'template' => $template->id,
    //             //     'position' => 2,
    //             //     'type' => '13',
    //             //     'size' => 3,
    //             //     'obligatory' => true,
    //             //     'data' => [],
    //             // ]);

    //             if ($exists) {
    //                 foreach ($sections as $index => $section) {
    //                     $data = $section->questions;
    //                     $sectionId = $section->id;
    //                     $newQuestions = $data->map(function ($itm) use ($sectionId) {
    //                         // if ($index === 0) {
    //                         //     $itm['type'] === '11' ? $itm['position'] = $itm['position'] + 5 : null;
    //                         //     if ($itm['type'] !== '10' && $itm['type'] !== '11' && $itm['type'] !== '12' && $itm['type'] !== '13' && $itm['type'] !== '14') {
    //                         //         $itm['position'] = $itm['position'] + 5;
    //                         //     }
    //                         // }
    //                         Arr::forget($itm, 'created_at');
    //                         Arr::forget($itm, 'updated_at');
    //                         Arr::forget($itm, 'pivot');
    //                         Arr::forget($itm, 'deleted_at');
    //                         $itm->columnId = $sectionId;

    //                         $itm->isNumeric = $itm->is_numeric;
    //                         Arr::forget($itm, 'is_numeric');

    //                         $this->getDataQuestion($itm);

    //                         return $itm;
    //                     });

    //                     $questions = array_merge($questions, $newQuestions->toArray());

    //                     Arr::forget($section, 'questions');
    //                 }
    //             } else {
    //                 foreach ($sections as $index => $section) {
    //                     $data = $section->questions;
    //                     $sectionId = $section->id;
    //                     if ($index === 0) {
    //                         $optionId['columnId'] = $sectionId;
    //                         $optionDescription['columnId'] = $sectionId;
    //                         $optionOwner['columnId'] = $sectionId;
    //                     }
    //                     $newQuestions = $data->map(function ($itm) use ($sectionId, $index, &$optionId) {
    //                         if ($index === 0) {
    //                             $itm['type'] === '11' ? $itm['position'] = $itm['position'] + 5 : null;
    //                             $itm['type'] !== '11' ? $itm['position'] = $itm['position'] + 6 : null;
    //                         }
    //                         // if($itm['type'] !== "11"){
    //                         //     $position = $itm['position'];
    //                         //     $itm['position'] = $position + 1;
    //                         // }
    //                         Arr::forget($itm, 'created_at');
    //                         Arr::forget($itm, 'updated_at');
    //                         Arr::forget($itm, 'pivot');
    //                         Arr::forget($itm, 'deleted_at');
    //                         $itm->columnId = $sectionId;
    //                         $this->getDataQuestion($itm);

    //                         return $itm;
    //                     });
    //                     $questions = array_merge($questions, $newQuestions->toArray());

    //                     Arr::forget($section, 'questions');
    //                 }
    //                 $questions[] = ($optionId);
    //                 $questions[] = ($optionDescription);
    //                 $questions[] = ($optionOwner);
    //             }

    //             return json_encode(['data' => ['sections' => $sections, 'questions' => $questions]], 200);
    //         } catch (\Throwable $th) {
    //             throw $th;

    //             return response()->json(['message' => 'No encontrado'], 404);
    //         }
    //     }

    //     public function getInfoTemplate(int $id)
    //     {
    //         $register = TBTemplateAnalisisRiesgoModel::find($id);
    //         $template = ([
    //             'id' => $register->id,
    //             'title' => $register->nombre,
    //             'norma' => $register->norma->norma,
    //             'description' => $register->descripcion,
    //         ]);

    //         return json_encode(['data' => ['template' => $template]], 200);
    //     }

    //     public function verifyInputsDefault($sections)
    //     {
    //         $existInputId = false;

    //         foreach ($sections as $index => $section) {
    //             $existInputCreateBy = false;

    //             $questions = $section->questions;

    //             foreach ($questions as $question) {

    //                 if ($question['type'] === '12') {
    //                     $existInputId = true;
    //                 }
    //             }
    //         }

    //         return $existInputId;
    //     }

    //     public function saveImage(&$questions, $imagenes)
    //     {
    //         $today = Carbon::now();
    //         $date = $today->format('d-m-Y');
    //         $filter = array_filter($questions, function ($item) use ($imagenes) {
    //             if ($item->type === '10' && Arr::exists($imagenes, $item->id)) {
    //                 return $item;
    //             }
    //         });

    //         foreach ($filter as $question) {
    //             $key = $question->id;
    //             $imagen = $imagenes[$key];
    //             $name = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
    //             $extension = pathinfo($imagen->getClientOriginalName(), PATHINFO_EXTENSION);
    //             $new_name_image = 'Template_AR_Question_Image_'.$name.'_'.$date.'.'.$extension;

    //             $route = storage_path().'/app/public/analisis_riesgo/template/questions/'.$new_name_image;
    //             $image = $new_name_image;

    //             // Call the ImageService to consume the external API
    //             $apiResponse = ImageService::consumeImageCompresorApi($imagen);

    //             // Compress and save the image
    //             if ($apiResponse['status'] == 200) {
    //                 file_put_contents($route, $apiResponse['body']);
    //                 foreach ($questions as $question) {
    //                     if ($question->id === $key) {
    //                         $question->data->name = $new_name_image;
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     public function getSettingsTable(int $id)
    //     {
    //         $questionsRegisters = TBSettingsTemplateAR_TBQuestionTemplateARModel::select('id', 'question_id', 'is_show')->where('template_id', $id)->orderBy('id', 'asc')->get();
    //         $formulasRegisters = TBSettingsTemplateAR_TBFormulaTemplateARModel::select('id', 'formula_id', 'is_show')->where('template_id', $id)->orderBy('id', 'asc')->get();
    //         foreach ($questionsRegisters as $questionRegister) {
    //             $questionRegister->title = $questionRegister->question->title;
    //             Arr::forget($questionRegister, 'question');
    //         }
    //         foreach ($formulasRegisters as $formulaRegister) {
    //             $formulaRegister->title = $formulaRegister->formula->title;
    //             Arr::forget($formulaRegister, 'formula');
    //         }

    //         return json_encode(['data' => ['questions' => $questionsRegisters, 'formulas' => $formulasRegisters]], 200);
    //     }

    //     public function updateSettingsTable(Request $request)
    //     {
    //         $questions = $request['questions'];
    //         $formulas = $request['formulas'];
    //         foreach ($questions as $question) {
    //             // dd($question['question_id']);
    //             try {
    //                 $questionRegister = TBSettingsTemplateAR_TBQuestionTemplateARModel::where('question_id', $question['question_id'])->first();
    //                 // dd($questionRegister);
    //                 DB::beginTransaction();

    //                 $questionRegister->update([
    //                     'is_show' => $question['is_show'],
    //                 ]);

    //                 DB::commit();
    //             } catch (\Throwable $th) {
    //                 // throw $th;
    //                 DB::rollback();

    //                 continue;
    //             }
    //         }

    //         foreach ($formulas as $formula) {
    //             try {
    //                 $formulaRegister = TBSettingsTemplateAR_TBFormulaTemplateARModel::findOrFail($formula['formula_id']);
    //                 DB::beginTransaction();

    //                 $formulaRegister->update([
    //                     'is_show' => $formula['is_show'],
    //                 ]);

    //                 DB::commit();
    //             } catch (\Throwable $th) {
    //                 // throw $th;
    //                 DB::rollback();

    //                 continue;
    //             }
    //         }

    //         return json_encode(['data' => 'Table Settigns updated successfully']);
    //     }

    //     public function createQuestionsDefault($templateId, $sectionId)
    //     {
    //         $sectionRegister = TBSectionTemplateAnalisisRiesgoModel::where('template_id', $templateId)->first();
    //         // dd($sectionRegister);
    //         $optionId = ([
    //             'title' => 'ID',
    //             'position' => 0,
    //             'type' => '12',
    //             'size' => 3,
    //             'obligatory' => true,
    //             'data' => [],
    //         ]);

    //         $optionDescription = ([
    //             'title' => 'Descripcion del riesgo',
    //             'position' => 1,
    //             'type' => '12',
    //             'size' => 3,
    //             'obligatory' => true,
    //             'data' => [],
    //         ]);

    //         $optionOwner = ([
    //             'title' => 'Dueño del riesgo',
    //             'position' => 2,
    //             'type' => '13',
    //             'size' => 3,
    //             'obligatory' => true,
    //             'data' => [],
    //         ]);

    //         $optionProb = ([
    //             'title' => 'Probabilidad',
    //             'position' => 3,
    //             'type' => '14',
    //             'size' => 3,
    //             'obligatory' => true,
    //             'data' => [],
    //             'uuid_formula' => substr(Str::uuid(), 0, 5),
    //         ]);

    //         $optionImpa = ([
    //             'title' => 'Impacto',
    //             'position' => 4,
    //             'type' => '14',
    //             'size' => 3,
    //             'obligatory' => true,
    //             'data' => [],
    //             'uuid_formula' => substr(Str::uuid(), 0, 5),
    //         ]);

    //         $questionOptionId = TBQuestionTemplateAnalisisRiesgoModel::create($optionId);

    //         TBSectionTemplateAr_QuestionTemplateArModel::create([
    //             'section_id' => $sectionRegister->id,
    //             'question_id' => $questionOptionId->id,
    //         ]);

    //         TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
    //             'template_id' => $templateId,
    //             'question_id' => $questionOptionId->id,
    //             'is_show' => false,
    //         ]);

    //         $questionOptionDescription = TBQuestionTemplateAnalisisRiesgoModel::create($optionDescription);

    //         TBSectionTemplateAr_QuestionTemplateArModel::create([
    //             'section_id' => $sectionRegister->id,
    //             'question_id' => $questionOptionDescription->id,
    //         ]);

    //         TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
    //             'template_id' => $templateId,
    //             'question_id' => $questionOptionDescription->id,
    //             'is_show' => false,
    //         ]);

    //         $questionOptionOwner = TBQuestionTemplateAnalisisRiesgoModel::create($optionOwner);

    //         TBSectionTemplateAr_QuestionTemplateArModel::create([
    //             'section_id' => $sectionRegister->id,
    //             'question_id' => $questionOptionOwner->id,
    //         ]);

    //         TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
    //             'template_id' => $templateId,
    //             'question_id' => $questionOptionOwner->id,
    //             'is_show' => false,
    //         ]);

    //         $questionOptionProb = TBQuestionTemplateAnalisisRiesgoModel::create($optionProb);

    //         TBSectionTemplateAr_QuestionTemplateArModel::create([
    //             'section_id' => $sectionRegister->id,
    //             'question_id' => $questionOptionProb->id,
    //         ]);

    //         TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
    //             'template_id' => $templateId,
    //             'question_id' => $questionOptionProb->id,
    //             'is_show' => false,
    //         ]);

    //         $questionOptionImpa = TBQuestionTemplateAnalisisRiesgoModel::create($optionImpa);

    //         TBSectionTemplateAr_QuestionTemplateArModel::create([
    //             'section_id' => $sectionRegister->id,
    //             'question_id' => $questionOptionImpa->id,
    //         ]);

    //         TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
    //             'template_id' => $templateId,
    //             'question_id' => $questionOptionImpa->id,
    //             'is_show' => false,
    //         ]);
    //     }

}
