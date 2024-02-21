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
    <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane mb-4 fade show active" id="nav-config-obj-1" role="tabpanel"
            aria-labelledby="nav-config-obj-1">

            <div class="card card-body">
                <div class="info-first-config">
                    <h4 class="title-config">Categorias</h4>
                    <p>Da de alta los grupos en los que clasificaras los objetivos.</p>
                    <hr class="my-4">
                </div>

                <div class="grid-config-categorias mt-4">

                    <div class="item-config-cat">
                        <div class="d-flex align-items-center" style="gap: 10px;">
                            <div class="form-group anima-focus w-100">
                                <input type="text" class="form-control anima-focus" placeholder="">
                                <label for="">Categoría</label>
                            </div>
                            <div class="btn-delete-cat">
                                <i class="material-symbols-outlined" title="Eliminar"
                                    onclick="deleteItem('item-config-cat')">delete</i>
                            </div>
                        </div>
                        <div class="form-group anima-focus">
                            <textarea name="" id="" class="form-control" placeholder=""></textarea>
                            <label for="">Descripción</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mt-4" style="color: #006DDB; gap: 10px; cursor: pointer;"
                        onclick="addItem('item-config-cat', 'grid-config-categorias')">
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
            <div class="card card-body">
                <div class="info-first-config">
                    <h4 class="title-config">Escalas de medición</h4>
                    <p>Define los Valores y Escalas con los que se medirán los objetivos.</p>
                    <hr class="my-4">
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
                    <div class="caja-items-config-escalas">
                        <div class="item-config-escala">
                            <div class="d-flex align-items-center" style="gap: 10px;">
                                <div class="form-group anima-focus" style="width: 100px;">
                                    <input type="text" class="form-control" placeholder="">
                                    <label for="">Valor*</label>
                                </div>
                                <div class="form-group anima-focus" style="width: 300px;">
                                    <input type="text" class="form-control" placeholder="">
                                    <label for="">Nombre de la escala*</label>
                                </div>
                                <div class="form-group anima-focus" style="width: 100px;">
                                    <input type="color" class="form-control" placeholder="">
                                    <label for="">Color</label>
                                </div>
                                <div class="btn-delete-escala">
                                    <i class="material-symbols-outlined" title="Eliminar"
                                        onclick="deleteItem('item-config-escala')">delete</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mt-4" style="color: #006DDB; gap: 10px; cursor: pointer;"
                            onclick="addItem('item-config-escala', 'caja-items-config-escalas')">
                            <span class="material-symbols-outlined">add_circle</span>
                            Agregar Categoría
                        </div>

                        <button class="btn btn-primary">
                            GUARDAR
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane mb-4 fade" id="nav-config-obj-3" role="tabpanel" aria-labelledby="nav-config-obj-3">
            <div class="card card-body">
                <div class="info-first-config">
                    <h4 class="title-config">Permisos</h4>
                    <p>Define que perfiles podrán cargar objetivos en la plantilla</p>
                    <hr class="my-4">
                </div>

                <div class="row">
                    <div class="col-2">
                        <strong>Administradores</strong>
                        <div class="mt-2">
                            <input type="checkbox">
                        </div>
                    </div>
                    <div class="col-10">
                        Los administradores definidos en la lista de distribución podrán realizar la carga de objetivos.
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <strong>Jefes inmediatos</strong>
                        <div class="mt-2">
                            <input type="checkbox">
                        </div>
                    </div>
                    <div class="col-10">
                        Al habilitar esta opción, los jefes de cada área podrán realizar la carga de los objetivos de
                        sus subordinados.
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <strong>Colaboradores</strong>
                        <div class="mt-2">
                            <input type="checkbox">
                        </div>
                    </div>
                    <div class="col-10">
                        Al habilitar esta opción, todos los colaboradores de la organización podrán cargar sus
                        objetivos. (Estos se enviaran a su aprobación al jefe inmediato)
                        <div class="d-flex align-items-center mt-2" style="gap: 10px;">
                            <input type="checkbox">
                            <label for="" class="mb-0">Objetivos</label>

                            <input type="checkbox" class="ml-5">
                            <label for="" class="mb-0">Escalas</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane mb-4 fade" id="nav-config-obj-4" role="tabpanel" aria-labelledby="nav-config-obj-4">

            <div class="card card-body">
                <div class="info-first-config">
                    <h4 class="title-config">Habilitar periodo de carga de objetivos</h4>
                    <hr class="my-4">
                    <div class="row caja-habilitar-periodo">
                        <div class="col-md-3 form-group">
                            <label for="">
                                Inicio de carga de objetivos
                            </label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">
                                Fin de carga objetivos
                            </label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">
                                Habilitar
                            </label>
                            <input type="checkbox" class="form-check">
                        </div>
                        <div class="col-md-3 d-flex align-items-end form-group">
                            <button class="btn btn-primary">Notificar carga de objetivos</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <small><i>*Este periodo no aplica para el administrador del módulo, quien podrá ajustar los
                                    objetivos en cualquier momento.</i></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-conntent-between" style="gap: 20px;">
                <div class="item-color-empleados-number" style="background-color: #5172BF;">
                    <span>
                        Total de colaboradores
                    </span>
                    <span>
                        100
                    </span>
                </div>
                <div class="item-color-empleados-number" style="background-color: #78BB50;">
                    <span>
                        Colaboradores con objetivos asignados
                    </span>
                    <span>
                        75
                    </span>
                </div>
                <div class="item-color-empleados-number" style="background-color: #E89F32;">
                    <span>
                        Colaboradores pendientes de asignar objetivos
                    </span>
                    <span>
                        100
                    </span>
                </div>
                <div class="item-color-empleados-number" style="background-color: #E86A32;">
                    <span>
                        Colaboradores con objetivos por aprobar
                    </span>
                    <span>
                        100
                    </span>
                </div>
            </div>
            <div class="card card-body">
                <div class="info-first-config">
                    <h4 class="title-config">Colaboradores y Objetivos</h4>
                    <p>Carga, importa o exporta los objetivos de tus colaboradores</p>
                    <hr class="my-4">
                </div>
                <div class="row">
                    <div class="col-md-3 form-group anima-focus">
                        <input type="text" class="form-control">
                        <label for="">Área</label>
                    </div>
                    <div class="col-md-3 form-group anima-focus">
                        <input type="text" class="form-control">
                        <label for="">Puesto</label>
                    </div>
                    <div class="col-md-3 form-group anima-focus">
                        <input type="text" class="form-control">
                        <label for="">Perfil</label>
                    </div>
                </div>
            </div>
            <div class="card card-body">
                <table></table>
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
