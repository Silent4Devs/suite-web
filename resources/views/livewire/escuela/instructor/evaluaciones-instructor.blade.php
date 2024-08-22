<div>
    {{-- <x-loading-indicator wire:loading /> --}}

    <h4 id="parte-inicio">Evaluaciones del curso</h4>
    <hr class="mt-2 mb-6 bg-primary">

    <div class="card shadow-none">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div>
                    <div class="form-group anima-focus">
                        <select wire:model="section_id" id="section_id" name="section[is_active]"
                            value="{{ old('section.is_active') }}" class="form-control">
                            <option value="" selected disabled>Seleccionar una o más secciones
                            </option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        <label for="section[is_active]" >Sección a evaluar</label>
                        @error('section_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <div class="form-group anima-focus " style="margin: 3rem 0px;">
                    @error('section.name')
                        <span class="content-end float-right text-xs text-red-700">{{ $message }}</span>
                    @enderror
                    <input class="form-control" type="text" value="" id="title" wire:model="name" placeholder="">
                    <label for="name">Nombre*</label>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                </div>

                <div class="form-group anima-focus ">
                    {{-- {!! Form::label('description', 'Descripción:', ['class' => 'text-primary mt-4']) !!} --}}
                    <textarea class="mb-2 form-control" type="text" value="" id="title" wire:model="description"
                    placeholder=""></textarea>
                    <label for="description">Descripción:</label>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>



                <div class="d-flex justify-content-end" style="margin-top:30px">
                    @if (!$editar)
                        <button type="submit" class="btn advance mb-3 ml-4" wire:click.prevent="save">
                            {{ __('CREAR EVALUACIÓN') }}
                        </button>
                    @else
                        <button type="submit" class="btn btn-outline-primary mt-4 mb-4 ml-4"
                            wire:click.prevent="update">
                            {{ __('ACTUALIZAR EVALUACIÓN') }}
                        </button>
                    @endif

                </div>

            </form>
        </div>
    </div>

    <div>
        @livewire('escuela.instructor.evaluations-table', ['course' => $course])
    </div>
    @section('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    @endsection
        <script>
            document.addEventListener("click", function(e) {
                let btn = event.target;
                if (btn.classList.contains('btn-top')) {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }

            });
        </script>

</div>


{{-- <x-slot name="js">

    <script>
        window.initSelect2 = () => {
            $('.select2').select2();
        }
        initSelect2();

        Livewire.on('select2', () => {

            initSelect2();

        });
        let CKEDITOR = null;

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
            .then(editor => {
                CKEDITOR = editor;
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData(), true);
                })
            })
            .catch(error => {
                console.log(error);
            });



        $('#section_id').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('section_id', data.id, false);
        });
        Livewire.on('evaluationStore', () => {
            CKEDITOR.setData('');
            console.log('crear')
        })

        Livewire.on('editarEvaluacion', (evaluacion) => {
            console.log(evaluacion);
            if (evaluacion.description) {
                CKEDITOR.setData(evaluacion.description);
            }
        })
    </script>


</x-slot> --}}
