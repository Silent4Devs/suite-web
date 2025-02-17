<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 2)->orderByDesc('id')->cursorPaginate();

        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function approved($id_course)
    {
        $course = Course::where('id', $id_course)->first();
        if (! $course->lessons || ! $course->goals || ! $course->requirements || ! $course->image) {
            return back()->with('info', 'No se puede publicar un curso que no este completo');
        }

        $course->status = 3;

        return redirect()->route('admin.courses.index');
    }
}
