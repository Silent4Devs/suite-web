@extends('layouts.admin')
<link rel="stylesheet" href="css/requisiciones_pdf.css">
<style>
    .modal-lg {
    max-width: 80%; /* Puedes ajustar el porcentaje según tus necesidades */
    }
    .td-blue-header{
        height: 50%;
        background: #EEFCFF 0% 0% no-repeat padding-box;
        opacity: 1;
    }
    .info-header{
        font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) 15px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        text-align: left;
        font: normal normal normal 15px/20px Roboto;
        letter-spacing: 0px;
        color: #3D3D3D;
        opacity: 1;
    }
    .btnimprimir{
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        opacity: 1;
        color: var(--unnamed-color-057be2);
    }

    .boton-transparente {
    background-color: transparent;
    border: none; /* Elimina el borde del botón si lo deseas */
    }

    .icon {
    opacity: 0.7; /* Ajusta la opacidad de la imagen según tus necesidades */
    }
</style>
@section('content')

    {{ Breadcrumbs::render('admin.politica-sgsis.index') }}

        @can('politica_sistema_gestion_agregar')
        <div class="text-right">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.politica-sgsis.create') }}" type="button" class="btn btn-primary">Registrar Politica</a>
                </div>
        </div>
        @endcan
        <h3 class="col-12 titulo_general_funcion">Política del Sistema de Gestión</h3>
                @include('partials.flashMessages')
                <div class="datatable-fix datatable-rds">
                    <div class="d-flex justify-content-end">
                        <form method="POST" action="{{ route('admin.politica-sgsis.pdf') }}">
                            @csrf
                            <button class="boton-transparente">
                                <img src="{{asset('imprimir.svg')}}" alt="Importar" class="icon">
                            </button>
                        </form>
                    </div>
                    <h3 class="title-table-rds"> Politicas</h3>
                    <table class="datatable datatable-Comiteseguridad" id="datatable-PoliticaSgsi">
                        <thead class="head-light">
                            <tr>
                                <th style="min-width: 180px; max-width:180px;">
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
@endsection
@section('scripts')
    @parent
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
                columns: [
                    {
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

                            // Asigna colores y sombras según el valor de 'estatus'
                            switch (data) {
                                case 'aprobado':
                                    color = 'green';
                                    boxShadow = '12px 12px 20px rgba(0, 128, 0, 0.5)';
                                    backgroundColor = 'rgba(0, 128, 0, 0.1)';
                                    break;
                                case 'rechazado':
                                    color = 'red';
                                    boxShadow = '12px 12px 20px rgba(128, 0, 0, 0.5)';
                                    backgroundColor = 'rgba(128, 0, 0, 0.1)';
                                    break;
                                case 'pendiente':
                                    color = 'orange';
                                    boxShadow = '12px 12px 20px rgba(255, 165, 0, 0.5)';
                                    backgroundColor = 'rgba(255, 165, 0, 0.1)';
                                    break;
                                default:
                                    color = 'black';
                                    boxShadow = '12px 12px 20px rgba(0, 0, 0, 0.5)';
                                    backgroundColor = 'rgba(0, 0, 0, 0.1)';
                            }

                            const style = `
                                font: normal normal normal 10px/20px Roboto;
                                color: ${color};
                                box-shadow: ${boxShadow};
                                border-radius: 12px;
                                background-color: ${backgroundColor};
                            `;

                            return `<center><span style="${style}">${data}</span></center>`;
                        }
                    },
                    {
                        data: 'mostrar',
                        name: 'mostrar',
                        render: function(data, type, row) {
                            // Solo muestra el checkbox si el estatus es 'aprobado'
                            if (row.estatus === 'aprobado') {
                                return `<input type="checkbox" class="redireccionar-checkbox" value="${row.id}" />`;
                            } else {
                                return ''; // Si no es 'aprobado', no muestra nada
                            }
                        }
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
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
        });
    </script>
@endsection
