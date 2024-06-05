<div class="container-fluid">
    <h3 class="title-main-cursos" style="margin-top: 40px;">Catálogo de cursos</h3>
    <div class="caja-selects-catalogo">
        <form wire:submit.prevent="resetFilters" id="todo">
            <select name="todo" id="todoSelect">
                <option value="">Todos los cursos</option>
            </select>
            <button type="submit" id="guardarButtonT" style="display: none"></button>
        </form>

        <form wire:submit.prevent="categoryFilter" id="formularioC">
            <select name="category" wire:model.lazy="selectioncategory" id="categorySelect">
                <option value="0" selected="true">Categorias</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" type="submit">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" id="guardarButtonC" style="display: none"></button>
        </form>

        <form wire:submit.prevent="levelFilter" id="formularioL">
            <select name="level" id="levelSelect" wire:model.lazy="selectionlevel">
                <option value="0">Niveles</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
            <button type="submit" id="guardarButtonL" style="display: none"></button>
        </form>
    </div>
    <div class="caja-cards-mis-cursos">
        @foreach ($courses as $c)
            @if ($c->status != '4')
                @php
                    $instructor = $c->instructor;
                @endphp

                <div class="card card-body mi-curso" style="height: auto">
                    {{-- <div class="caja-img-mi-curso" > --}}
                    <img src="{{ asset($c->image->url) }}" alt="" class="img-card"
                        style="min-height: 225px; border-radius: 12px 12px 0px 0px;">
                    {{-- </div> --}}
                    <div class="caja-info-card-mc">

                        <p style="font-size: 18px; color:#000000">{{ $c->title }}</p>
                        <p>Creado:</p>
                        <div class="d-flex align-items-center gap-1">
                            <div class="img-person">
                                <img src="{{ asset('storage/empleados/imagenes/' . isset($c->teacher->empleado) ? $c->teacher->empleado->avatar : '') }}"
                                    alt="{{ $c->teacher->name }}">
                            </div>
                            {{ $c->teacher->name }}
                        </div>
                        @if ($instructor)
                            <p>Instructor: </p>
                            <div class="d-flex align-items-center gap-1">
                                <div class="img-person">
                                    <img src="{{ asset('storage/empleados/imagenes/' . isset($instructor->empleado) ? $instructor->empleado->foto : '') }}"
                                        alt="{{ $instructor->name }}">
                                </div>
                                {{ $instructor->name }}
                            </div>
                        @else
                            <p style="margin-top: 0px;">Instructor no asignado</p>
                        @endif
                        <div class="mt-3 d-flex justify-content-between">
                            <div style="color: #FFC400; font-size: 15px;">
                                <div>
                                    <ul class="d-flex px-2" style="list-style: none; padding-left: 0px !important;">
                                        <li class="mr-1">
                                            <i class="fas fa-star"
                                                style="color: {{ $c->rating >= 1 ? '#FFC400' : 'gray' }}; font-size: 15px;">
                                            </i>
                                        </li>
                                        <li class="mr-1">
                                            <i class="fas fa-star"
                                                style="color: {{ $c->rating >= 2 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                        </li>
                                        <li class="mr-1">
                                            <i class="fas fa-star"
                                                style="color: {{ $c->rating >= 3 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                        </li>
                                        <li class="mr-1">
                                            <i class="fas fa-star"
                                                style="color: {{ $c->rating >= 4 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                        </li>
                                        <li class="mr-1">
                                            <i class="fas fa-star"
                                                style="color: {{ $c->rating >= 5 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <i class="fa-solid fa-users" style="font-size: 12px;"></i>
                                {{ $c->students_count }}
                            </div>
                        </div>
                        <button type="button" class="btn btn-mi-course" data-toggle="modal"
                            data-target="#course-{{ $c->id }}" style="margin-bottom: 20px;">
                            Más información
                        </button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="course-{{ $c->id }}" tabindex="-1"
                    aria-labelledby="{{ $c->id }}ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="border: none">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    {{-- <span aria-hidden="true">&times;</span> --}}
                                    <span class="material-symbols-outlined" style="font-size: 22px;">
                                        close
                                    </span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding-left: 41px; padding-right: 41px;">
                                <div>
                                    @if ($c && $c->lesson_introduction)
                                        <div>
                                            {!! $c->lesson_introduction !!}
                                        </div>
                                    @else
                                        <p>Sin lección previa</p>
                                    @endif
                                </div>
                                <h5 class="title-modal">
                                    <strong>
                                        {{ $c->title }}
                                    </strong>
                                </h5>
                                @if ($instructor)
                                    <p class="instructor-modal">Un curso de {{ $instructor->name }} </p>
                                @else
                                    <p class="instructor-modal">Instructor no asignado</p>
                                @endif
                                <p class="aprendizaje-modal">
                                    <strong>
                                        Lo que aprenderas
                                    </strong>
                                </p>
                                @if ($c->goals->isNotEmpty())
                                    <ul style="list-style: none;">
                                        @foreach ($c->goals as $goal)
                                            <li class="mr-2 subtitle-aprendizaje"><i
                                                    class="mr-3 text-gray-600 fas fa-check"></i>{{ $goal->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="subtitle-aprendizaje">
                                        Metas no asignadas
                                    </p>
                                @endif



                                <a href="{{ route('admin.courses.show', $c) }}"
                                    style="display: inline-block; vertical-align: middle; color:#006DDB; margin-bottom:81px; margin-top:21px;">Más
                                    información
                                    <span class="material-symbols-outlined" style="vertical-align: middle;">
                                        more_horiz
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

@section('scripts')
    <script>
        $("#categorySelect").on("change", function(event) {
            document.getElementById('guardarButtonC').click();
        });
    </script>
    <script>
        $("#levelSelect").on("change", function(event) {
            document.getElementById('guardarButtonL').click();
        });
    </script>
    <script>
        $("#todoSelect").on("click", function(event) {
            document.getElementById('guardarButtonT').click();
        });
    </script>
@endsection
