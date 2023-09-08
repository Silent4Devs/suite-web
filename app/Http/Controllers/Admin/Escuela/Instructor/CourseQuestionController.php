<?php

namespace App\Http\Controllers\Admin\Escuela\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $course=$request->course;
        $evaluation=$request->evaluation;
        return view('admin.escuela.instructor.test',compact('course', 'evaluation'));
    }
}
