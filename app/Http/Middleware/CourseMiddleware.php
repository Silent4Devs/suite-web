<?php

namespace App\Http\Middleware;

use App\Models\Escuela\CourseUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = User::getCurrentUser();
        $courseId = intval($request->route('course'));

        $course = CourseUser::where('course_id', $courseId)->where('user_id', $usuario->id)->first();
        if ($course) {
            return $next($request);
        }

        return redirect()->route('admin.mis-cursos');

    }
}
