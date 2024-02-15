@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluaciones.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}
    <div style="display:flex; justify-content:space-between;">
        <h5 class="titulo_general_funcion">Configuración de Evaluaciones </h5>
    </div>

    <div class="purple-info-first">
        <img src="{{ asset('img/config-eval-purple.png') }}" alt="">
        <div class="info-purple">
            <h3>Configura tu evaluación</h3>
            <p>
                En esta sección puedes asignar los objetivos que le correspondan a cada colaborador de la organización. <br>
                Consulte los Objetivos Estratégicos con el líder de cada Colaborador
            </p>
        </div>
    </div>

    <nav class="mt-5">
        <div class="nav nav-tabs" role="tablist" style="margin-bottom: 0px !important;">
            <a class="nav-link active" id="" data-type="empleados" data-toggle="tab" href="#nav-config-obj-1"
                role="tab" aria-controls="nav-empleados" aria-selected="true">
                Definir Categorías
            </a>
            <a class="nav-link" id="" data-type="calendario-comunicacion" data-toggle="tab"
                href="#nav-config-obj-2" role="tab" aria-controls="nav-config-obj-2" aria-selected="false">
                Definir Escalas
            </a>
            <a class="nav-link" id="" data-type="ev360" data-toggle="tab" href="#nav-config-obj-3" role="tab"
                aria-controls="nav-ev360" aria-selected="false">
                Definir Permisos
            </a>
            <a class="nav-link" id="" data-type="ev360" data-toggle="tab" href="#nav-config-obj-4" role="tab"
                aria-controls="nav-ev360" aria-selected="false">
                Cargar objetivos
            </a>
        </div>
    </nav>
    <div class="card">
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane mb-4 fade show active" id="nav-config-obj-1" role="tabpanel"
                    aria-labelledby="nav-config-obj-1">

                    <div class="">
                        <div class="info-first-config">
                            <h4 class="title-config">Categorias</h4>
                            <p>Da de alta los grupos en los que clasificaras los objetivos.</p>
                        </div>

                        <div class="grid-config-categorias mt-4">

                            <div class="item-config-cat">
                                <div class="d-flex align-items-center" style="gap: 10px;">
                                    <div class="form-group anima-focus w-100">
                                        <input type="text" class="form-control anima-focus" placeholder="">
                                        <label for="">Categoría</label>
                                    </div>
                                    <div class="btn-delete-cat">
                                        <i class="material-symbols-outlined" title="Eliminar" onclick="deleteItem('item-config-cat')">delete</i>
                                    </div>
                                </div>
                                <div class="form-group anima-focus">
                                    <textarea name="" id="" class="form-control" placeholder=""></textarea>
                                    <label for="">Descripción</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center mt-4" style="color: #006DDB; gap: 10px; cursor: pointer;" onclick="addItem('item-config-cat', 'grid-config-categorias')">
                                <span class="material-symbols-outlined">add_circle</span>
                                Agregar Categoría
                            </div>

                            <button class="btn btn-primary">
                                GUARDAR
                            </button>
                        </div>
                    </div>

                </div>

                <div class="tab-pane mb-4 fade" id="nav-config-obj-2" role="tabpanel" aria-labelledby="nav-config-obj-2">
                    <div class="info-first-config">
                        <h4 class="title-config">Escalas de medición</h4>
                        <p>Define los Valores y Escalas con los que se medirán los objetivos.</p>
                    </div>

                    <div class="">
                        <p>
                            Rango <br>
                            Especifica el valor mínimo y máximo que tendrá la escala de medición
                        </p>
                        <div class="d-flex" style="gap: 10px;">
                            <div class="form-group anima-focus" style="width: 100px;">
                                <input type="text" class="form-control" placeholder="">
                                <label for="">Mínimo*</label>
                            </div>
                            <div class="form-group anima-focus" style="width: 100px;">
                                <input type="text" class="form-control" placeholder="">
                                <label for="">Máximo*</label>
                            </div>
                        </div>

                        <p class="mt-4">
                            Escalas <br>
                            Define las escalas de medición y asigna su Valor y Nombre
                        </p>
                        <div class="d-flex" style="gap: 10px;">
                            <div class="form-group anima-focus" style="width: 100px;">
                                <input type="text" class="form-control" placeholder="">
                                <label for="">Valor*</label>
                            </div>
                            <div class="form-group anima-focus" style="width: 300px;">
                                <input type="text" class="form-control" placeholder="">
                                <label for="">Nombre de la escala*</label>
                            </div>
                            <div class="form-group anima-focus" style="width: 100px;">
                                <input type="text" class="form-control" placeholder="">
                                <label for="">Color</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center mt-4" style="color: #006DDB; gap: 10px; cursor: pointer;" onclick="addCategoria()">
                                <span class="material-symbols-outlined">add_circle</span>
                                Agregar Categoría
                            </div>

                            <button class="btn btn-primary">
                                GUARDAR
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tab-pane mb-4 fade" id="nav-config-obj-3" role="tabpanel" aria-labelledby="nav-config-obj-3">
                    <div class="info-first-config">
                        <h4 class="title-config">Categorias</h4>
                        <p>Da de alta los grupos en los que clasificaras los objetivos.</p>
                    </div>
                </div>

                <div class="tab-pane mb-4 fade" id="nav-config-obj-4" role="tabpanel" aria-labelledby="nav-config-obj-4">
                    <div class="info-first-config">
                        <h4 class="title-config">Categorias</h4>
                        <p>Da de alta los grupos en los que clasificaras los objetivos.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function addItem(classItem, classContent) {
            let item = document.querySelector('.' + classItem);
            let newItem = document.createElement('div');

            newItem.classList.add(classItem);
            newItem.innerHTML += item.innerHTML;

            document.querySelector('.' + classContent).appendChild(newItem);
        }
        function deleteItem(classItem) {
            document.querySelector('.' + classItem + ':hover').remove();
        }
    </script>
@endsection
