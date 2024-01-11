@extends('layouts.admin')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">
    <style>
        @media print {
            .print-none {
                display: none !important;
            }
        }

        .boton-cancelar {
            background-color: white;
            border-color: #057BE2;
            font: 14px Roboto;
            color: #057BE2;
            border-radius: 4px;
            width: 148px;
            height: 48px;
            align-content: center;
        }

        .btn-outline-success {
            background: #788bac !important;
            color: white;
            border: none;
        }

        .btn-outline-success:focus {
            border-color: #345183 !important;
            box-shadow: none;
        }

        .btn-outline-success:active {
            box-shadow: none !important;
        }

        .btn-outline-success:hover {
            background: #788bac;
            color: white;

        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

        .table tr td:nth-child(2) {
            text-align: justify !important;
        }

        .table tr th:nth-child(3) {
            text-align: center !important;
            min-width: 200px !important;
        }

        .table tr td:nth-child(4) {
            text-align: center !important;
        }

        .table tr th:nth-child(4) {
            width: 120px !important;
            max-width: 120px !important;
            min-width: 120px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(2) {
            width: 400px !important;
            max-width: 500px !important;
            min-width: 100px !important;
            text-align: center !important;
        }


        .table tr td:nth-child(5) {
            max-width: 200px !important;
            min-width: 200px !important;
            width: 200px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(5) {
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(6) {
            max-width: 200px !important;
            min-width: 200px !important;
            width: 200px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(6) {
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(7) {
            max-width: 200px !important;
            min-width: 200px !important;
            width: 200px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(7) {
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(8) {
            max-width: 80px !important;
            min-width: 80px !important;
            width: 80px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(8) {
            width: 80px !important;
            max-width: 80px !important;
            min-width: 80px !important;
            text-align: center !important;
        }

        .agregar {
            margin-right: 15px;
        }

        .radius {
            border-radius: 16px;
        }

        .titulo-card {

            text-align: left;
            font: 20px Roboto;
            color: #606060;
        }

        .dt-buttons.btn-group {
            display: none !important;
        }

        .modal-dialog {
            max-width: var(--bs-modal-width);
            margin-right: 0px;
            margin-left: 180px;
            margin-top: 180px;
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            color: var(--bs-modal-color);
            pointer-events: auto;
            background-color: var(--bs-modal-bg);
            background-clip: padding-box;
            border: var(--bs-modal-border-width) solid var(--bs-modal-border-color);
            border-radius: 16px;
            outline: 0;
            margin-top: 0px;
            margin-bottom: 100px;
        }

        .boton-sin-borde {
            border: none;
            outline: none;
            /* Esto elimina el contorno al hacer clic */
        }

        .boton-transparente {
            background-color: transparent;
            border: none;
            /* Elimina el borde del botón si lo deseas */
        }

        .boton-transparentev2 {
            top: 214px;
            width: 135px;
            height: 40px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            border: 1px solid var(--unnamed-color-057be2);
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #057BE2;
            opacity: 1;
        }

        .icon {
            opacity: 0.7;
            /* Ajusta la opacidad de la imagen según tus necesidades */
        }

        .textopdf {
            font: var(--unnamed-font-style-normal) normal medium var(--unnamed-font-size-20)/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-306ba9);
            text-align: left;
            font: normal normal medium 20px/20px Roboto;
            letter-spacing: 0px;
            color: #306BA9;
            opacity: 1;
            position: relative;
            left: 1rem;
        }

        .modal {
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) var(--unnamed-font-size-14)/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-606060);
            text-align: left;
            font: normal normal normal 14px/20px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }
    </style>

    {{ Breadcrumbs::render('admin.politica-sgsis.index') }}


    <h5 class="col-12 titulo_general_funcion">Política del Sistema de Gestión </h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <h4> ¿Qué es? Política del Sistema de Gestión</h4>
                <p>
                    Es una declaración oficial de la dirección de una organización que establece sus intenciones y compromisos con respecto al sistema de gestión implementado en la organización.
                </p>
                <p>
                    La Política del Sistema de Gestión sirve como un documento fundamental para alinear a toda la organización en torno a los objetivos y compromisos relacionados con la calidad, el medio ambiente u otros ámbitos específicos.
                </p>
            </div>
        </div>
    </div>

    @can('politica_sistema_gestion_agregar')
        <div class="text-right">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.politica-sgsis.create') }}" type="button" class="btn btn-primary">Registrar Política</a>
            </div>
        </div>
    @endcan

    <div class="row d-flex align-items-center">
        <h5 class="col-12 titulo_general_funcion">Política del Sistema de Gestión</h5>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"
                style="margin:50px 0px 50px 1230px; background:none;"><i class="fa-solid fa-x fa-2xl"
                    style="color: #ffffff;"></i>
            </button>
            <div class="modal-dialog" style="margin-top: 0px;">
                <div class="modal-content" style="width:1000px;">
                    <div class="modal-body" style="border-radius: 0px;">
                        <div class="print-none">
                        </div>
                        <div class="card col-sm-12 col-md-10"
                            style="border-radius: 0px; box-shadow: none; border-color:white; width:800px;">
                            <div class="card-body" style="">
                                <div class="print-none" style="text-align:right;">
                                    <form method="POST" style="position: relative; left: 10rem; "
                                        action="{{ route('admin.politica-sgsis.pdf') }}">
                                        @csrf
                                        <button class="boton-transparentev2" type="submit" style="color: #306BA9;">
                                            IMPRIMIR <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
                                        </button>
                                    </form>
                                </div>
                                <div class="card mt-5" style="width:900px;box-shadow:4px;">
                                    <div class="row col-12 ml-0"
                                        style="border-radius;
                                        padding-left: 0px;padding-right: 0px;">
                                        @if ($logo_actual != null)
                                            <div class="col-3" style="border-left: 25px solid #2395AA">
                                                <img src=" {{ $logo_actual }}" class="mt-2 img-fluid"
                                                    style=" width:60%; position: relative; left: 1rem; top: 1.5rem;">
                                            </div>
                                        @else
                                            <div class="col-3" style="border-left: 25px solid #2395AA">
                                                <img src="{{ asset('img/tabantaj_fondo_blanco.PNG') }}"
                                                    class="mt-2 img-fluid"
                                                    style=" width:60%; position: relative; left: 1rem; top: 1.5rem;">
                                            </div>
                                        @endif
                                        <div class="col-5 p-2 mt-3">
                                            <br>
                                            <span class=""
                                                style="color:black; position: relative; top: -1.5rem; right: 3rem;">
                                                {{ $empresa_actual }} <br>
                                                RFC: {{ $rfc }} <br>
                                                {{ $direccion }} <br>
                                            </span>

                                        </div>
                                        <div class="col-4 pt-6 pl-6" style="background:#EEFCFF;">
                                            <br>
                                            <br>
                                            <br>
                                            <span class="textopdf"> <strong> Reporte Política del Sistema de
                                                    Gestión</strong></span>
                                        </div>
                                        <br>
                                        <div class="col-12 " style="background:#EEFCFF; border-right: 25px solid #2395AA;">
                                            <div style="position: relative; right: 1rem;  margin: 5%"><br>
                                                <h6 style="color:#306BA9;">Nombre de la política</h6>
                                                <p>Política del Sistema de Gestión</p>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($politicaSgsis as $politica)
                                        <div style="margin: 4%">
                                            <h5 style="color:#306BA9;">{{ $politica->nombre_politica }}</h5>
                                            <p>Fecha de publicación: {{ $politica->fecha_publicacion }} &nbsp;&nbsp;&nbsp;
                                                Fecha de revision: {{ $politica->fecha_revision }}</p>
                                            <br>
                                            <small style="text-align: justify;">{!! $politica->politicasgsi !!}</small>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <div class="d-flex justify-content-end">

            <button class="boton-transparente boton-sin-borde" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
            </button>
        </div>
        <h3 class="title-table-rds"> Politicas</h3>
        <table class="datatable datatable-Comiteseguridad" id="datatable-PoliticaSgsi">
            <thead class="head-light">
                <tr>
                    <th style="min-width: 400px; max-width:400px;">
                        Nombre
                    </th>
                    <th style="min-width: 400px; max-width:400px;">
                        Políticas
                    </th>
                    <th style="min-width: 80px; max-width:80px;">
                        Estatus
                    </th>
                    <th style="min-width: 80px; max-width:80px;">
                        Mostrar
                    </th>
                    <th>Opciones</th>
                </tr>
            </thead>
        </table>
    </div>


    @if ($listavacia == 'vacia')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    // title: 'No es posible acceder a esta vista.',
                    imageUrl: `{{ asset('img/errors/cara-roja-triste.svg') }}`, // Replace with the path to your image
                    imageWidth: 100, // Set the width of the image as needed
                    imageHeight: 100,
                    html: `<h4 style="color:red;">No se ha agregado ningún colaborador a la lista</h4>
                <br><p>No se ha agregado un responsable al flujo de aprobación de esta vista.</p><br>
                <p>Es necesario acercarse con el administrador para solicitar que se agregue  un responsable, de lo contrario no podra registrar información en este módulo.</p>`,
                    // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another view after user clicks OK
                        window.location.href =
                            '{{ route('admin.iso27001.guia') }}';
                    }
                });
            });
        </script>
    @elseif ($listavacia == 'baja')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    // title: 'No es posible acceder a esta vista.',
                    imageUrl: `{{ asset('img/errors/cara-roja-triste.svg') }}`, // Replace with the path to your image
                    imageWidth: 100, // Set the width of the image as needed
                    imageHeight: 100,
                    html: `<h4 style="color:red;">Colaborador dado de baja</h4>
                <br><p>El colaborador responsable de este formulario ta no se encuentra dado de alta en el sistema.</p><br>
                <p>Es necesario acercarse con el administrador para solicitar que se agregue un nuevo responsable, de lo contrario no podra registrar información en este módulo.</p>`,
                    // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another view after user clicks OK
                        window.location.href =
                            '{{ route('admin.iso27001.guia') }}';
                    }
                });
            });
        </script>
    @endif
@endsection
@section('scripts')
    @parent
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'print',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                        <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                            <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">POLÍTICA DEL SISTEMA DE GESTIÓN</strong>
                                </div>
                                <div class="col-3 p-2">
                                    Fecha: ${jsDate}
                                </div>
                            </div>
                        `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
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
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.politica-sgsis.index') }}",
                columns: [{
                        data: 'nombre_politica',
                        name: 'nombre_politica',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'politicasgsi',
                        name: 'politicasgsi',
                        render: function(data, type, row) {
                            return `<div style="text-align: justify;">${data}</div>`;
                        }
                    },
                    {
    data: 'estatus',
    name: 'estatus',
    render: function(data, type, row) {
        let color = '';
        let boxShadow = '';
        let backgroundColor = '';
        let statusText = data;  // Por defecto, utiliza el valor existente.

        if (!data || data.trim() === '') {
            // Si el estatus está vacío, muestra un estatus específico.
            statusText = 'Generar';
            color = '#0000FF';  // Color gris para un estatus vacío.
            backgroundColor = 'rgba(0, 0, 255, 0.1)';
        } else {
            // Aplica estilos según el valor del estatus.
            switch (data) {
                case 'Aprobado':
                    color = '#008F27'; // Verde
                    backgroundColor = 'rgba(0, 128, 0, 0.1)';
                    break;
                case 'Rechazado':
                    color = '#dd0483'; // Rojo
                    backgroundColor = 'rgba(255, 0, 0, 0.1)';
                    break;
                case 'Pendiente':
                    color = '#DD8E04'; // Naranja
                    backgroundColor = 'rgba(255, 165, 0, 0.1)';
                    break;
                default:
                    color = '#464646'; // Negro
                    backgroundColor = 'rgba(255, 165, 0, 0.1)';
            }
        }

        const style = `
            background: #E9FFE8 0% 0% no-repeat padding-box;
            border-radius: 7px;
            opacity: 1;
            color: ${color};
            box-shadow: ${boxShadow};
            background-color: ${backgroundColor};
        `;

        return `<center><span style="${style}">${statusText}</span></center>`;
    }
},

                    {
                        data: 'mostrar',
                        name: 'mostrar',
                        render: function(data, type, row) {
                            // Solo muestra el checkbox si el estatus es 'aprobado'
                            if (row.estatus === 'Aprobado') {
                                return `<input type="checkbox" class="redireccionar-checkbox" value="${row.id}" />`;
                            } else {
                                return ''; // Si no es 'aprobado', no muestra nada
                            }
                        }
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}',
                        // render: function(data, type, full, meta) {
                        //     return data + '<button class="tu-clase-de-boton" style="border: none; position:relative; left:1.8rem; top:-1.2rem;"><i class="fas fa-arrow-down fa-sm" style="border: none;"></i></button>';
                        // }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };


            $('#datatable-PoliticaSgsi').on('click', '.redireccionar-checkbox', function() {
                // Obtiene el valor de la casilla de verificación
                var valorCheckbox = $(this).val();

                // Redirecciona a la otra vista usando Laravel
                window.location.href = '/admin/politica-sgsis/visualizacion/';
            });

            let table = $('#datatable-PoliticaSgsi').DataTable(dtOverrideGlobals);


            // $('#datatable-PoliticaSgsi').on('click', '.tu-clase-de-boton', function () {
            //     // Muestra las nuevas columnas
            //     table.column('fecha_entrada:name').visible(true);
            //     table.column('fecha_publicacion:name').visible(true);

            //     // Vuelve a dibujar la tabla para reflejar los cambios
            //     table.draw();
            // });

        });
    </script>
@endsection
