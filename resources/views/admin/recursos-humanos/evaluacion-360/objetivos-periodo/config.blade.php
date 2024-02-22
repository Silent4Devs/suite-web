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
                            <div class="form-group anima-focus" style="width: 85%;">
                                <input type="text" class="form-control anima-focus" placeholder="">
                                <label for="">Categoría</label>
                            </div>
                            <div class="btn-delete-cat">
                                <i class="material-symbols-outlined" title="Eliminar" onclick="deleteItem('item-config-cat')">delete</i>
                            </div>
                        </div>
                        <div class="form-group anima-focus" style="width: 85%;">
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
            <div class="card card-body">
                <div class="info-first-config">
                    <h4 class="title-config">Escalas de medición</h4>
                    <p>Define los Valores y Escalas con los que se medirán los objetivos.</p>
                    <hr class="my-4">
                </div>

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
                                <i class="material-symbols-outlined" title="Eliminar" onclick="deleteItem('item-config-escala')">delete</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mt-4" style="color: #006DDB; gap: 10px; cursor: pointer;" onclick="addItem('item-config-escala', 'caja-items-config-escalas')">
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
                <div class="row">
                    <div class="col-2">
                        <strong>Jefes inmediatos</strong>
                        <div class="mt-2">
                            <input type="checkbox">
                        </div>
                    </div>
                    <div class="col-10">
                        Al habilitar esta opción, los jefes de cada área podrán realizar la carga de los objetivos de sus subordinados.
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <strong>Colaboradores</strong>
                        <div class="mt-2">
                            <input type="checkbox">
                        </div>
                    </div>
                    <div class="col-10">
                        Al habilitar esta opción, todos los colaboradores de la organización podrán cargar sus objetivos. (Estos se enviaran a su aprobación al jefe inmediato)
                        <div class="d-flex align-items-center mt-2" style="gap: 8px;">
                            <label for="" class="mb-0">Objetivos</label>
                            <input type="checkbox">

                            <label for=""  class="mb-0 ml-4">Escalas</label>
                            <input type="checkbox">
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
                </div>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="inicioCarga">Inicio de carga de objetivos</label>
                        <input id="inicioCarga" type="date" class="form-control">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="finCarga">Fin de carga objetivos</label>
                        <input id="finCarga" type="date" class="form-control">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="inicioCarga">Habilitar</label>
                        <input id="habilitar" type="checkbox" class="form-control">
                    </div>
                    <div class="col-md-3 form-group">
                        <br>
                        <button class="btn btn-success">
                            Notificar carga de objetivos
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-100 d-flex flex-wrap-wrap mb-4" style="gap: 15px;">
                <div class="item-cfg-num-emp" style="background-color: #5172BF;">
                    <span>Total de colaboradores</span>
                    <span>{100}</span>
                </div>
                <div class="item-cfg-num-emp" style="background-color: #78BB50;">
                    <span>Colaboradores con objetivos asignados</span>
                    <span>{100}</span>
                </div>
                <div class="item-cfg-num-emp" style="background-color: #E89F32;">
                    <span>Colaboradores pendientes de asignar objetivos</span>
                    <span>{100}</span>
                </div>
                <div class="item-cfg-num-emp" style="background-color: #E86A32;">
                    <span>Colaboradores con objetivos por aprobar</span>
                    <span>{100}</span>
                </div>
            </div>
            <div class="card card-body">
                <div class="info-first-config">
                    <h4 class="title-config">Colaboradores y Objetivos</h4>
                    <p>
                        Carga, importa o exporta los objetivos de tus colaboradores
                    </p>
                    <hr class="my-4">
                </div>
                <div class="row">
                    <div class="col-md-3 form-group anima-focus">
                        <select id="area" class="form-control">
                            <option selected value="" disabled></option>
                        </select>
                        <label for="area">Área</label>
                    </div>
                    <div class="col-md-3 form-group anima-focus">
                        <select id="area" class="form-control">
                            <option selected value="" disabled></option>
                        </select>
                        <label for="area">Puesto</label>
                    </div>
                    <div class="col-md-3 form-group anima-focus">
                        <select id="area" class="form-control">
                            <option selected value="" disabled></option>
                        </select>
                        <label for="area">Perfil</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 form-group anima-focus">
                        <input id="buscar" type="search" class="form-control" placeholder="" style="border: none; border-bottom: 1px solid; border-radius: 0px !important;">
                        <label for="buscar"><i class="material-symbols-outlined" style="transform: translateY(50%);">search</i> Buscar</label>
                    </div>
                </div>
            </div>
            <div class="card card-body">
                <div class="datatable-fix">
                    <table id="datatable-empleados-config-evaluaciones" class="table table-bordered w-100 datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No. Empleado</th>
                                <th>Nombre del Colaborador</th>
                                <th>Puesto</th>
                                <th>Área</th>
                                <th>Perfil</th>
                                <th>Objetivos Asignados</th>
                                <th>Carga de Objetivos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{No. Empleado}</td>
                                <td>{Nombre del Colaborador}</td>
                                <td>{Puesto}</td>
                                <td>{Área}</td>
                                <td>{Perfil}</td>
                                <td>{Objetivos Asignados}</td>
                                <td>{Carga de Objetivos}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
@parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }

            ];


            let dtOverrideGlobals = {
                buttons: dtButtons,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('#datatable-empleados-config-evaluaciones').DataTable(dtOverrideGlobals);
        });
    </script>

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
