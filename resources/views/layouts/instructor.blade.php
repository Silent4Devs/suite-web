{{-- <nav>
    <div class="nav nav-tabs" id="instructor" role="tablist">
        <a class="nav-link active" id="nav-infocurso-tab" data-type="informacion" data-toggle="tab" href="{{ route('admin.courses.edit', $course) }}"
            role="tab" aria-controls="nav-contarea" aria-selected="true">
            Información del curso
        </a>
        <a class="nav-link" id="nav-leccion-curso-tab" data-type="liderazgo" data-toggle="tab" href="{{ route('admin.courses.index') }}" role="tab" aria-selected="false">
        Lecciones del curso
        </a>
        <a class="nav-link" href="{{ route('admin.courses.curriculum',$course) }}">Lecciones curso</a>
    </div>
</nav> --}}

<style>
        .registro {
            background-color: #F8FAFF;
            border: 1px solid #D8D8D8;
            margin-bottom: 10px;
        }
        .advance {
            background-color: #345183;
            color:#FFFFFF;
        }

        .advance:hover{
            color:#FFFFFF;
        }

        .cancel{
            background: #FFFFFF;
            color: #006DDB;
            border: 1px solid #006DDB;
        }

        .cancel:hover{
            color:#006DDB;
        }

        /* Texto de cada meta  */
    </style>

<nav>
    <div class="nav nav-tabs" id="curso" role="tablist">
        <a class="nav-link" id="nav-info-curso-tab" data-toggle="tab" href="#nav-info-curso"
            role="tab" aria-controls="nav-info-curso" aria-selected="false">
            Información del curso
        </a>

        <a class="nav-link active" id="nav-leccion-curso-tab" data-toggle="tab" href="#nav-leccion-curso" role="tab" aria-controls="nav-leccion-curso" aria-selected="true">
            Lecciones curso
        </a>
        <a class="nav-link" id="nav-meta-curso-tab" data-toggle="tab" href="#nav-meta-curso" role="tab"
            aria-controls="nav-meta-curso" aria-selected="false">
            Meta del curso
        </a>
        <a class="nav-link" id="nav-estudiantes-curso-tab" data-toggle="tab" href="#nav-estudiantes-curso" role="tab"
            aria-controls="nav-estudiantes-curso" aria-selected="false">
            Estudiantes
        </a>
        <a class="nav-link" id="nav-evaluaciones-curso-tab" data-toggle="tab" href="#nav-evaluaciones-curso" role="tab"
            aria-controls="nav-evaluaciones-curso" aria-selected="false">
            Evaluaciones
        </a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane mb-4 fade" id="nav-info-curso" role="tabpanel" aria-labelledby="nav-contarea-tab">
        <h4 >Información del curso</h1>
        <hr class="mt-2 mb-6">
        <div class="card" style="background-color: #fff">
            <div class="card-body">
                @livewire('escuela.instructor.publicar-course', ['course' => $course])

                {!! Form::model($course, ['route' => ['admin.courses.update', $course], 'method' => 'put', 'files' => true, 'enctype' =>
                'multipart/form-data']) !!}
                @include('admin.escuela.instructor.courses.partials.form')
                <div class="flex justify-end">
                    {!! Form::submit('Actualizar información', ['class' => 'inline-flex items-center px-4 py-2 m-4 text-xs font-semibold
                    tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700
                    active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25'])
                    !!}
                </div>
                {!! Form::close() !!}
                @section('scripts')
                    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
                    <script>
                        //Slug automático
                                document.getElementById("title").addEventListener('keyup', slugChange);

                                function slugChange() {

                                    title = document.getElementById("title").value;
                                    document.getElementById("slug").value = slug(title);

                                }

                                function slug(str) {
                                    var $slug = '';
                                    var trimmed = str.trim(str);
                                    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                                    replace(/-+/g, '-').
                                    replace(/^-|-$/g, '');
                                    return $slug.toLowerCase();
                                }


                                //CKEDITOR

                                ClassicEditor
                                    .create(document.querySelector('#description'), {
                                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'blockQuote'],
                                        heading: {
                                            options: [{
                                                    model: 'paragraph',
                                                    title: 'Paragraph',
                                                    class: 'ck-heading_paragraph'
                                                },
                                                {
                                                    model: 'heading1',
                                                    view: 'h1',
                                                    title: 'Heading 1',
                                                    class: 'ck-heading_heading1'
                                                },
                                                {
                                                    model: 'heading2',
                                                    view: 'h2',
                                                    title: 'Heading 2',
                                                    class: 'ck-heading_heading2'
                                                }
                                            ]
                                        }
                                    })
                                    .catch(error => {
                                        console.log(error);
                                    });

                                //Cambiar imagen
                                document.getElementById("file").addEventListener('change', cambiarImagen);

                                function cambiarImagen(event) {
                                    var file = event.target.files[0];

                                    var reader = new FileReader();
                                    reader.onload = (event) => {
                                        document.getElementById("picture").setAttribute('src', event.target.result);
                                    };

                                    reader.readAsDataURL(file);
                                }
                    </script>
                @endsection
            </div>
        </div>
    </div>
    <div class="tab-pane mb-4 fade show active" id="nav-leccion-curso" role="tabpanel" aria-labelledby="nav-contorg-tab">
        @livewire('escuela.instructor.courses-curriculum',['course'=>$course])
        <div class="d-flex justify-content-end">
            <button class="btn advance" onclick="cambiarPestana('meta-curso-tab')">GUARDAR Y CONTINUAR</button>
        </div>

    </div>
    <div class="tab-pane mb-4 fade" id="nav-meta-curso" role="tabpanel" aria-labelledby="nav-contorg-tab">
        <div>
            @livewire('escuela.instructor.course-goals',['course'=>$course], key('course-goals'.$course->id))
        </div>

        <div>
            @livewire('escuela.instructor.course-requirements',['course'=>$course], key('course-requirements'.$course->id))
        </div>

        <div>
            @livewire('escuela.instructor.course-audiences',['course'=>$course], key('course-audiences'.$course->id))
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn  advance" onclick="cambiarPestana('estudiantes-curso-tab')">GUARDAR Y CONTINUAR</button>
        </div>
    </div>
    <div class="tab-pane mb-4 fade" id="nav-estudiantes-curso" role="tabpanel" aria-labelledby="nav-contorg-tab">
        @livewire('escuela.instructor.courses-students',['course'=>$course])
        <div class="d-flex justify-content-end">
            <button class="btn  advance" onclick="cambiarPestana('evaluaciones-curso-tab')">GUARDAR Y CONTINUAR</button>
        </div>
    </div>
    <div class="tab-pane mb-4 fade" id="nav-evaluaciones-curso" role="tabpanel" aria-labelledby="nav-contorg-tab">
        @livewire("escuela.instructor.evaluaciones-instructor",['course'=>$course])
        <div class="d-flex justify-content-end">
            <a class="btn advance" href="{{ route('admin.courses.index') }}" role="button">GENERAR CURSO Y GUARDAR</a>
        </div>
    </div>
    <script>
        function cambiarPestana(tab) {
            $('#nav-' + tab).tab('show');
        }
    </script>


</div>
