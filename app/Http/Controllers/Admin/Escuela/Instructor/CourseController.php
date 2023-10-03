<?php

namespace App\Http\Controllers\Admin\Escuela\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\Level;
use App\Models\Escuela\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// use RealRashid\SweetAlert\Facades\Alert;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.escuela.instructor.courses.index');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');
        $prices = Price::pluck('name', 'id');

        return view('admin.escuela.instructor.courses.create', compact('categories', 'levels', 'prices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'slug' => 'required|unique:courses|string|max:255',
                'subtitle' => 'required|string|max:255',
                'description' => 'required',
                'category_id' => 'required',
                'level_id' => 'required',
                // 'price_id' => 'required',
                'file' => 'required',
            ],
            [
                'subtitle.required' => 'El campo subtítulo es obligatorio',
                'slug.required' => 'El campo slug es obligatorio',
                'title.required' => 'El campo título es obligatorio',
                'category_id.required' => 'El campo categoría es obligatorio',
                'description.required' => 'El campo descripción es obligatorio',
                'level_id.required' => 'El campo nivel es obligatorio',
                'file.required' => 'El campo imagen es obligatorio',
            ]
        );

        // dd($request->all());

        $course = Course::create($request->all());

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            // Storage::putFileAs('public/cursos', $image);
            $url = Storage::put('public/cursos', $image);

            $course->image()->create([
                'url' => $url,
            ]);
        }

        // Alert::toast('El curso fue añadido exitosamente', 'success');
        return redirect()->route('admin.courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.escuela.instructor.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        // $this->authorize('dicatated', $course);

        $categories = Category::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');
        $prices = Price::pluck('name', 'id');

        return view('admin.escuela.instructor.courses.edit', compact('course', 'categories', 'levels', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', "unique:courses,slug,$course->id,id", "max:255", "string"],
            'subtitle' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'level_id' => 'required',
            // 'price_id' => 'required',
            'file' => 'image',
        ], [
            'subtitle.required' => 'El campo subtítulo es obligatorio',
            'slug.required' => 'El campo slug es obligatorio',
            'title.required' => 'El campo título es obligatorio',
            'category_id.required' => 'El campo categoría es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'level_id.required' => 'El campo nivel es obligatorio',
            'file.required' => 'El campo imagen es obligatorio',
        ]);

        $course->update($request->all());

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $url = Storage::put('public/cursos', $image);

            if ($course->image) {
                Storage::delete($course->image->url);
                $course->image->update([
                    'url' => $url,
                ]);
            } else {
                $course->image()->create([
                    'url' => $url,
                ]);
            }
        }

        // Alert::toast('El curso fue actualizado exitosamente', 'success');
        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function goals(Course $course)
    {
        return view('admin.escuela.instructor.courses.goals', compact('course'));
    }

    public function status(Course $course)
    {
        $course->status = 2;
        $course->save();

        return back();
    }

    public function quizDetails(Course $course)
    {
        return view('admin.escuela.instructor.evaluationquizdetails', compact('course'));
    }
}
