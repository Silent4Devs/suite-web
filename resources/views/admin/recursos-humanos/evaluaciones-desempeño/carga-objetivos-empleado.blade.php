@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluaciones.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Carga de Objetivos: [Víctor Hugo Rodriguez Albarrán] </h5>

    <div class="card card-body" style="color: #464646;">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center" style="gap: 30px;">
                <div class="img-person" style="width: 80px; height: 80px;">
                    <img src="" alt="">
                </div>
                <span>Víctor Hugo Rodriguez Albarrán</span>
                <hr class="line-vertical mx-2">
                <di class="d-flex flex-column">
                    <span> Director Sr. Innovación y Nuevos Productos </span>
                    <span class="mt-3"> Dirección General</span>
                </di>
            </div>
            <img src="https://picsum.photos/200/300" alt="" style="height: 90px;">
        </div>
    </div>

    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Nuevo Objetivo</h4>
            <p>Define los Valores y Escalas con los que se medirán los objetivos.</p>
            <hr class="my-4">
        </div>
        <div class="row">
            <div class="col-12 form-group anima-focus">
                <input id="objetivo-estrategico" type="text" class="form-control" placeholder="">
                <label for="objetivo-estrategico">Objetivo Estratégico</label>
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group anima-focus">
                <textarea name="" id="descripcion" cols="30" rows="10" placeholder="" class="form-control"></textarea>
                <label for="descripcion">Descripción</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group anima-focus">
                <input id="categoria" type="text" class="form-control" placeholder="">
                <label for="categoria">Categoría</label>
            </div>
            <div class="col-md-3 form-group anima-focus">
                <input id="KPI" type="text" class="form-control" placeholder="">
                <label for="KPI">KPI</label>
            </div>
            <div class="col-md-6">
                <div class="d-flex" style="gap: 10px;">
                    <div class="form-group anima-focus w-100">
                        <input id="unidad-medida" type="text" class="form-control" placeholder="">
                        <label for="unidad-medida">Unidad de medida</label>
                    </div>
                    <button class="btn btn-primary" style="height: 45px;">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button class="btn btn-primary" style="height: 45px;">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="p-3 rounded-lg" style="color: #818181; background-color: #FFFEE5;">
                    <i>
                        *Esta sección estará activa hasta que establezcas los periodos de la evaluación en la
                        <a href="" style="color: #006DDB; text-decoration: underline;">
                            Configuración de la Evaluación.
                        </a>
                        (Asigna un periodo para hacer estos ajustes en la calibración de objetivos)
                    </i>
                </div>
            </div>
        </div>

        <div class="mt-4" style="width: 300px;">
            <div class="form-group anima-focus">
                <div class="form-control" style="height: auto !important;">
                    <div class="d-flex flex-column py-3" style="gap: 15px;">
                        @for ($i = 0; $i < 3; $i++)
                            <div>
                                <input type="checkbox" name="" id="">
                                <label for="">Trimestre 1</label>
                            </div>
                        @endfor
                    </div>
                </div>
                <label for="">Periodos</label>
            </div>
        </div>


        <div class="info-first-config mt-5">
            <h4 class="title-config">Escalas del objetivo</h4>
            <p>Define las Escalas con los que se medirá este objetivo.</p>
            <hr class="my-4">
        </div>

        <div class="d-flex align-items-center" style="gap: 20px;">
            <input type="checkbox">
            <span><strong>Variante</strong></span>
            <span>Selecciona esta opción si deseas agregar una o más variantes a tus valores por periodo.</span>
        </div>

        <div class="mt-5">
            <table class="table-escalas-objetivos">
                <thead>
                    <tr>
                        <th>
                            No Satisfactorio
                        </th>
                        <th>
                            Mín. Requerido
                        </th>
                        <th>
                            Satisfactorio
                        </th>
                        <th>
                            Sobresaliente
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-tiems-center" style="gap: 20px;">
                                <div class="form-group anima-focus" style="width: 60px;">
                                    <input type="color" name="" id="" class="form-control">
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Condicional</label>
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Valor</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-tiems-center" style="gap: 20px;">
                                <div class="form-group anima-focus" style="width: 60px;">
                                    <input type="color" name="" id="" class="form-control">
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Condicional</label>
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Valor</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-tiems-center" style="gap: 20px;">
                                <div class="form-group anima-focus" style="width: 60px;">
                                    <input type="color" name="" id="" class="form-control">
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Condicional</label>
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Valor</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-tiems-center" style="gap: 20px;">
                                <div class="form-group anima-focus" style="width: 60px;">
                                    <input type="color" name="" id="" class="form-control">
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Condicional</label>
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Valor</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <button class="btn btn-outline-primary"
                style="background-color: #ECFBFF; color: #006DDB; border-radius: 100px !important;">
                Agregar objetivo a la tabla <i class="fa-solid fa-arrow-down"></i>
            </button>
        </div>

    </div>

    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Escalas del objetivo</h4>
            <hr class="my-4">
        </div>

        <div class="datatable-fix">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Objetivos Estratégicos</th>
                        <th>KPI</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th>Meta</th>
                        <th>Periodo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Categoría</td>
                        <td>Objetivos Estratégicos</td>
                        <td>KPI</td>
                        <td>Descripción</td>
                        <td>Estatus</td>
                        <td>Meta</td>
                        <td>Periodo</td>
                        <td>Opciones</td>
                    </tr>
                </tbody>
            </table>
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
            let table = $('.table').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection
