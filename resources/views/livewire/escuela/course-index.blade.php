<div class="mis-c-catalogo-cursos">
    <h3 class="title-main-cursos" style="margin-top: 40px;">Catálogo de cursos</h3>
    <div class="caja-selects-catalogo">
        <form wire:submit.prevent="resetFilters" id="todo">
            <select name="todo" id="todoSelect">
                <option value="">Todos los cursos</option>
            </select>
            <button type="submit" id="guardarButtonT" style="display: none"></button>
        </form>

        <form wire:submit.prevent="categoryFilter" id="formularioC">
            <select name="category" wire:model="selectioncategory" id="categorySelect">
                <option value="0" selected="true">Categorias</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" type="submit">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" id="guardarButtonC" style="display: none"></button>
        </form>

        <form wire:submit.prevent="levelFilter" id="formularioL">
            <select name="level" id="levelSelect" wire:model="selectionlevel">
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
            <div class="card card-body mi-curso">
                <div class="caja-img-mi-curso" style="margin-top: 15px;">
                    <img src="{{ Storage::url($c->image->url) }}" alt="">
                </div>
                <div class="caja-info-card-mc">
                    <p style="font-size: 18px;"><strong>{{ $c->title }}</strong></p>
                    <p style="margin-top: 0px;">Profesor: {{ $c->teacher->name }} </p>
                    <div class="mt-3 d-flex justify-content-between">
                        <div style="color: #E3A008; font-size: 18px;">

                            @for ($i = 1; $i <= $c->getRatingAttribute(); $i++)
                            <i class="fa-solid fa-star"></i>
                            @endfor

                            {{-- <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i> --}}
                        </div>
                        <div>
                            <i class="fa-solid fa-users"></i>
                            {{$c->students_count}}
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <a href="" class="btn btn-mas-info-c">MÁS INFORMACIÓN</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@section('scripts')
    <script>
        $("#categorySelect").on("change", function (event) {
            document.getElementById('guardarButtonC').click();
        });
    </script>
    <script>
        $("#levelSelect").on("change", function (event) {
            document.getElementById('guardarButtonL').click();
        });
    </script>
    <script>
        $("#todoSelect").on("click", function (event) {
            document.getElementById('guardarButtonT').click();
        });
    </script>

@endsection

