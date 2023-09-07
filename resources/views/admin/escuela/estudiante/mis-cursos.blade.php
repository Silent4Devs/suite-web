@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('centro-atencion') }} --}}

    {{-- <h5 class="titulo_general_funcion">Centro de Atención</h5> --}}

    <style>
        .caja-blue-curso {
            background-color: #3086AF;
            color: #fff;
            padding: 50px;
            box-sizing: border-box;
        }

        .caja-cards-mis-cursos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .caja-info-card-mc {
            padding: 0px 15px;
        }

        .card.mi-curso {
            max-width: 325px;
            padding: 0px;
            padding-bottom: 15px;
            border-radius: 8px;
        }

        .card.mi-curso img {
            width: 100%;
        }

        .card.mi-curso p {
            margin: 0px;
            margin-top: 15px;
        }

        .caja-img-mi-curso {
            width: 100%;
            height: 150px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .curso-progreso-barra {
            height: 10px;
            border-radius: 100px;
            background-color: #E2E2E2;
            margin-top: 6px;
            position: relative;
        }

        .indicador-progreso-barra {
            position: absolute;
            background-color: #006DDB;
            border-radius: 100px;
            height: 100%;
        }

        .mis-c-catalogo-cursos {}

        .caja-selects-catalogo {
            margin-top: 30px;
        }

        .caja-selects-catalogo select {
            background-color: #fff;
            color: #6A6A6A;
            border-radius: 6px;
            padding: 10px 20px;
            margin-right: 20px;
            border: 1px solid #e9e9e9;
        }

        .caja-selects-catalogo form {
            display: inline;
        }

        .mi-c-catalogo-card {
            width: 320px;
        }

        .title-main-cursos {
            font-size: 18px;
            color: #345183;
        }

        .btn-mas-info-c {
            background-color: #1E94A8;
            color: #fff;
            font-size: 12px;
            padding: 10px 25px;
        }
    </style>

    <div class="caja-blue-curso">
        <h2 style="font-size: 24px;">Bienvenido al Centro de Capacitación</h2>
        <p style="font-size: 17px;">
            Aprender te mantiene a la vanguardia. Consigue las habilidades más <br>
            demandadas para potenciar tu crecimiento.
        </p>
    </div>

    <div class="card card-body caja-mis-cursos">
        <h3 class="title-main-cursos">Mis Cursos</h3>

        <div class="caja-cards-mis-cursos">

            @foreach ($cursos_usuario as $cu)
            <div class="card card-body mi-curso">
                        <a href="{{ route('admin.curso-estudiante', $cu->cursos->id) }}">
                            <div class="caja-img-mi-curso">
                                <img src="{{ Storage::url($cu->cursos->image->url) }}" alt="">
                            </div>
                        </a>
                        {{-- <div class="caja-info-card-mc">
                            <p><strong>{{ $cu->cursos->title }}</strong></p>
                            <p style="margin-top: 13px;">32% Avance general</p>
                            <div class="curso-progreso-barra">
                                <div class="indicador-progreso-barra" style="width: 32%;"></div>
                            </div>
                        </div> --}}
                    </div>
            @endforeach

        </div>
    </div>

    @livewire('escuela.course-index')
    {{-- <div class="mis-c-catalogo-cursos">
        <h3 class="title-main-cursos" style="margin-top: 40px;">Catálogo de cursos</h3>
        <div class="caja-selects-catalogo">
            <select name="" id="">
                <option value="null">Todos los cursos</option>
            </select>

            <select name="category" id="categorySelect">
                <option value="null">Categorias</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit">Enviar</button>

            <select name="level" id="levelSelect">
                <option value="null">Niveles</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="caja-cards-mis-cursos">
            @foreach ($cursos as $c)
                <div class="card card-body mi-curso">
                    <div class="caja-img-mi-curso" style="margin-top: 15px;">
                        <img src="{{ asset('img/gap_Ana.jpg') }}" alt="">
                    </div>
                    <div class="caja-info-card-mc">
                        <p style="font-size: 18px;"><strong>{{ $c->title }}</strong></p>
                        <p style="margin-top: 0px;">Profesor: {{ $c->teacher->name }} </p>
                        <div class="mt-3 d-flex justify-content-between">
                            <div style="color: #E3A008; font-size: 18px;">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div>
                                <i class="fa-solid fa-users"></i>
                                (12)
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <a href="" class="btn btn-mas-info-c">MÁS INFORMACIÓN</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div> --}}
@endsection

@section('scripts')
@endsection
