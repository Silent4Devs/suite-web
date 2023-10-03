<?php

namespace App\Http\Livewire\Escuela\Instructor;

use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EvaluacionesInstructor extends Component
{
    use LivewireAlert;

    public $course;
    public $sections;
    public $name;
    public $description;
    public $is_active = 1;
    public $linkedTo = 1;
    public $idLinkedTo;
    public $section_id = '';
    public $editar = false;
    public $evaluacion_id;
    public $showlessons = true;
    public $course_id;

    // protected function rules(){

    //     if($this->linkedTo ==2)
    //     {
    //         return[
    //             'name' => 'required',
    //             'description' => 'nullable',
    //             'linkedTo' => 'required',
    //             'is_active' => 'required',
    //             'section_id'=>'required',
    //             ];
    //     }else{
    //         return[
    //             'name' => 'required',
    //             'description' => 'nullable',
    //             'linkedTo' => 'required',
    //             'is_active' => 'required',
    //             'course_id'=>'required'
    //             ];
    //     }

    // }

    protected $rules = [
        'section_id' => 'required',
        'name' => 'required | max:255',
    ];


    protected $messages=[
        'name.required'=>"El campo nombre es obligatorio",
        'section_id.required'=>"El campo sección del curso es obligatorio",
        'name.max'=> "El campo nombre no debe de ser mayor a 255 caracteres",
    ];

    protected $listeners = ['editarEvaluacion'=>'editar', 'evaluationDestroy'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->course_id = $course->id;
        $this->sections = Section::where('course_id', $course->id)->get();
    }

    public function save()
    {
        $this->validate();
        // dd($this->is_active);
        Evaluation::create([
        'name' => $this->name,
        'description' => $this->description,
        'linkedTo' => $this->linkedTo,
        'is_active' => $this->is_active,
        'course_id'=>$this->course_id,
        'section_id'=>$this->section_id,
    ]);
        $this->emit('evaluationStore');
        $this->render_alerta('success', 'El registro se ha agregado exitosamente');
        $this->default();
    }

    public function editar($evaluacion)
    {
        $this->name = $evaluacion['name'];
        $this->description = $evaluacion['description'];
        $this->linkedTo = $evaluacion['linkedTo'];
        if ($evaluacion['linkedTo'] == '2') {
            $this->showlessons = true;
        } else {
            $this->showlessons = false;
        }
        $this->is_active = $evaluacion['is_active'];
        $this->section_id = $evaluacion['section_id'];
        $this->evaluacion_id = $evaluacion['id'];
        $this->editar = true;
    }

    public function update()
    {
        $this->validate();
        $evaluacion = Evaluation::find($this->evaluacion_id);
        $evaluacion->update([
            'name' => $this->name,
            'description' => $this->description,
            'linkedTo' => $this->linkedTo,
            'is_active' => $this->is_active,
            'section_id'=>$this->section_id,
        ]);
        $this->emit('evaluationStore');
        $this->render_alerta('success', 'Actualizado con éxito');
        $this->default();
    }

    public function render_alerta($type, $message)
    {
        $this->alert($type, $message, [
            'position' => 'top-end',
            'timer' => '4000',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.escuela.instructor.evaluaciones-instructor')->with('course', $this->course);
    }

    public function default()
    {
        $this->name = null;
        $this->description = null;
        $this->linkedTo = 1;
        $this->is_active = true;
        $this->section_id = '';
        $this->editar = false;
        $this->showlessons = false;
    }

    public function evaluationDestroy()
    {
        $this->default();
    }
}
