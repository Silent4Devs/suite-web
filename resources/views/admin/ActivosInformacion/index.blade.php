@extends('layouts.admin')
@section('content')

    <style>
        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

        .btn_cargar:hover {
            color: #fff;
            background: #345183;
        }

        .btn_cargar i {
            font-size: 15pt;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .agregar {
            margin-right: 15px;
        }

    </style>
    {{-- <h5 class="col-12 titulo_general_funcion">Inventario de Activos de Información</h5> --}}
    <div class="mt-5 card">
        @can('configuracion_activo_create')
            {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Inventario de Activos</strong></h3>
            </div> --}}
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modalactivoinventario', ['model' => 'Vulnerabilidad', 'route' =>
                    'admin.vulnerabilidads.parseCsvImport'])
                </div>
            </div>
        @endcan

        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Activo de Información</h3>
        </div>


        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
              @include('admin.OCTAVE.menu')
            <table class="table table-bordered w-100 datatable-Activo" id="columnaft">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width:75px;">ID</th>
                        <th style="min-width:220px;">Nombre del Activo Información</th>
                        <th style="min-width:100px;">Criticidad del AI </th>
                        <th style="min-width:120px;">Promedio Contenedor(es)</th>
                        <th style="min-width:120px;">Nivel de riesgo AI</th>
                        <th style="min-width:100px;">Nombre VP</th>
                        <th style="min-width:200px;">Dueño AI Nombre del VP</th>
                        <th style="min-width:150px;">Nombre Dirección</th>
                        <th style="min-width:200px;">Custodio AI Nombre Director</th >
                        <th style="min-width:50px;">Formato</th>
                        <th style="min-width:100px;">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $activos as $activo )
                    @php
                        $color="green";
                        $colorRiesgo="green";
                        $texto="white";
                        $textoColor="white";
                        $valor="";
                        $resultado="";
                        if($activo->valor_criticidad <=3){
                            $color="green";
                            $valor="Bajo";
                        }
                        if($activo->valor_criticidad >=5){
                            $color="yellow";
                            $texto="black";
                            $valor="Media";
                        }
                        if($activo->valor_criticidad >=7){
                            $color="orange";
                            $valor="Alta";
                        }
                        if($activo->valor_criticidad >=10){
                            $color="red";
                            $valor="Crítica";
                        }

                        if($activo->riesgo_activo <=5){
                            $colorRiesgo="green";
                            $resultado="Bajo";
                        }
                        if($activo->riesgo_activo >=6){
                            $colorRiesgo="yellow";
                            $textoColor="black";
                            $resultado="Media";
                        }
                        if($activo->riesgo_activo >=11){
                            $colorRiesgo="orange";
                            $resultado="Alta";
                        }
                        if($activo->riesgo_activo >=16){
                            $colorRiesgo="red";
                            $resultado="Crítica";
                        }
                    @endphp

                    <tr>
                        <td><div>{{$activo->identificador}}</div></td>
                        <td><div>{{$activo->activo_informacion}}</div></td>
                        <td style="background-color:{{$color}};color:{{$texto}}">
                            <div>
                                {{$activo->valor_criticidad}} - {{$valor}}

                            </div>
                        </td>
                        <td style="background-color:{{$colorRiesgo}};color:{{$textoColor}}">
                            <div>
                                {{$activo->riesgo_activo}} - {{$valor}}
                            </div>
                        </td>
                        <td><div>{{$activo->nivel_riesgo_ai['riesgo']}} {{$activo->nivel_riesgo_ai['coordenada']}}</div></td>
                        <td><div>{{$activo->vp ? $activo->vp->nombre : 'Sin definir'}}</div></td>
                        <td><div>{{$activo->dueno->name}}</div></td>
                        <td><div>{{$activo->direccion->area}}</div></td>
                        <td><div>{{$activo->custodio->name}}</div></td>
                        <td><div>{{$activo->formato}}</td>
                        <td><div>
                            <form action="{{ route('admin.activosInformacion.destroy', $activo->id) }}" method="POST">
                                <a href="{{ route('admin.activosInformacion.edit',[$activo->id, $matriz] )}}"><i class="fas fa-edit"></i></a>
                                {{-- <a href="{{ route('admin.activosInformacion.show',$activo->id )}}"><i class="fas fa-eye"></i></a> --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash text-danger"></i>
                                    </button>
                            </form>
                        </div></td>
                    </tr>
                    @endforeach
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
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 10;
                        doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
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
            @can('configuracion_activo_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar inventario de activos',
                url: "{{ route('admin.activosInformacion.create',$matriz) }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                // let btnExport = {
                // text: '<i class="fas fa-download"></i>',
                // titleAttr: 'Descargar plantilla',
                // className: "btn btn_cargar" ,
                // url:"{{ route('descarga-activo_inventario') }}",
                // action: function(e, dt, node, config) {
                // let {
                // url
                // } = config;
                // window.location.href = url;
                // }
                // };
                // let btnImport = {
                // text: '<i class="fas fa-file-upload"></i>',
                // titleAttr: 'Importar datos',
                // className: "btn btn_cargar",
                // action: function(e, dt, node, config) {
                // $('#xlsxImportModal').modal('show');
                // }
                // };

                dtButtons.push(btnAgregar);
                // dtButtons.push(btnExport);
                // dtButtons.push(btnImport);
            @endcan
            // @can('configuracion_activo_delete')
            //     let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            //     let deleteButton = {
            //     text: deleteButtonTrans,
            //     url: "{{ route('admin.activos.massDestroy') }}",
            //     className: 'btn-danger',
            //     action: function (e, dt, node, config) {
            //     var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
            //     return entry.id
            //     });

            //     if (ids.length === 0) {
            //     alert('{{ trans('global.datatables.zero_selected') }}')

            //     return
            //     }

            //     if (confirm('{{ trans('global.areYouSure') }}')) {
            //     $.ajax({
            //     headers: {'x-csrf-token': _token},
            //     method: 'POST',
            //     url: config.url,
            //     data: { ids: ids, _method: 'DELETE' }})
            //     .done(function () { location.reload() })
            //     }
            //     }
            //     }
            //     //dtButtons.push(deleteButton)
            // @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,


            };
            let table = $('.datatable-Activo').DataTable(dtOverrideGlobals);
        });
    </script>



@endsection
