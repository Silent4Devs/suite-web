<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index(){

        $courses =Course::where('status', 2)->paginate();
        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course){
        return view('admin.courses.show' , compact('course'));
    }

    public function  approved(Course $course){

        if (!$course->lessons || !$course->goals || !$course->requirements || !$course->image){

            return back()->with('info','No se puede publicar un curso que no este completo');
        }

        $course->status = 3;

        return redirect()->route('admin.courses.index');
    }
}
