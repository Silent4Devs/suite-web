<?php

namespace App\Http\Controllers\Admin\Escuela\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Course;

class CourseCurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.escuela.instructor.courses.curriculum', compact('course'));
    }
}
