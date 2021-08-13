@extends('layouts.admin')
@section('content')


<style>

.img-size{
/* 	padding: 0;
	margin: 0; */
	height: 450px;
	width: 700px;
	background-size: cover;
	overflow: hidden;
}
.modal-content {
   width: 700px;
  border:none;
}
.modal-body {
   padding: 0;
}

.carousel-control-prev-icon {
	background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
	width: 30px;
	height: 48px;
}
.carousel-control-next-icon {
	background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
	width: 30px;
	height: 48px;
}

.carousel-control-next {
    top: 100px;
    height: 10px;
}

.carousel-control-prev {
    height: 40px;
    top: 80px;
}

</style>

    {{ Breadcrumbs::render('admin.matriz-requisito-legales.index') }}
    
    @can('matriz_requisito_legale_create')

        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Matriz de Requisitos Legales</strong></h3>
            </div>

            {{-- <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin.matriz-requisito-legales.create') }}">
                        Agregar <strong>+</strong>
                    </a>
                </div>
            </div> --}}
        @endcan
        
       
 
 @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table datatable-MatrizRequisitoLegale">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th>

                        </th> --}}
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.id') }}
                        </th>
                        <th>
                            Tipo&nbsp;de&nbsp;requisito
                        </th>
                        <th>
                            Fundamento
                        </th>
                        <th>
                            Apartado
                        </th>
                        <th>
                            Requisito(s)&nbsp;a&nbsp;cumplir
                        </th>
                        <th>
                            Alcance&nbsp;y&nbsp;grado&nbsp;de&nbsp;aplicabilidad
                        </th>
                        <th>
                            Medio&nbsp;de&nbsp;publicación
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;publicación
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;entrada&nbsp;en&nbsp;vigor
                        </th>
                        <th>
                            Periodicidad&nbsp;de&nbsp;cumplimiento
                        </th>
                        <th>
                            ¿En&nbsp;cumplimiento?
                        </th>
                        <th>
                            Descripción&nbsp;del&nbsp;cumplimiento/incumplimiento
                        </th>
                        <th>
                            Método&nbsp;utilizado&nbsp;de&nbsp;verificación    
                        </th>                    </th>
                        <th>
                            Evidencia
                        </th>
                        <th>
                            Revisó
                        </th>
                        <th>
                           Puesto
                        </th>
                        <th>
                           Área
                        </th>
                        <th>
                            Comentarios
                         </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                    {{-- <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach (App\Models\MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr> --}}
                </thead>
            </table>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        doc.styles.tableHeader.fontSize = 8.5;
                        doc.defaultStyle.fontSize = 8.5; //<-- set fontsize to 16 instead of 10 
                    }
                },
                {
                    extend: 'print',
                    title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
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
            @can('matriz_requisito_legale_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.matriz-requisito-legales.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
                });
            
                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')
            
                return
                }
            
                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                //dtButtons.push(deleteButton)
            @endcan
            @can('matriz_requisito_legale_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nueva matríz de requisitos legales',
                url: "{{ route('admin.matriz-requisito-legales.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.matriz-requisito-legales.index') }}",
                columnDefs:[{targets:[5,12,11,17],visible:false}],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tipo',
                        name: 'tipo'
                    },
                    {
                        data: 'nombrerequisito',
                        name: 'nombrerequisito'
                    },
                    {
                        data: 'formacumple',
                        name: 'formacumple'
                    },
                    {
                        data: 'requisitoacumplir',
                        name: 'requisitoacumplir'
                    },
                    {
                        data: 'alcance',
                        name: 'alcance'
                    },
                    {
                        data: 'medio',
                        name: 'medio'
                    },
                    {
                        data: 'fechaexpedicion',
                        name: 'fechaexpedicion'
                    },
                    {
                        data: 'fechavigor',
                        name: 'fechavigor'
                    },
                    {
                        data: 'periodicidad_cumplimiento',
                        name: 'periodicidad_cumplimiento'
                    },
                    {
                        data: 'cumplerequisito',
                        name: 'cumplerequisito'
                    },
                    {
                        data: 'metodo',
                        name: 'metodo'
                    },
                    {
                        data: 'descripcion_cumplimiento',
                        name: 'descripcion_cumplimiento'
                    },
                    {
                        data: 'evidencia',
                        name: 'evidencia',
                        render:function(data,type,row,meta){
                            console.log(JSON.parse(data))
                             let archivo="";
                             let archivos=JSON.parse(data)
                               archivo=` <div class="container">
                                    
                                    <div class="row mb-4">
                                    <div class="col text-center">
                                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#largeModal${row.id}"><i class="fas fa-file mr-2 text-white" style="font-size:13pt"></i>Visualizar evidencias</a>
                                    </div>
                                    </div>
                                
                                    <!-- modal -->
                                    <div class="modal fade" id="largeModal${row.id}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <!-- carousel -->
                                            <div
                                                id='carouselExampleIndicators${row.id}'
                                                class='carousel slide'
                                                data-ride='carousel'
                                                >
                                            <ol class='carousel-indicators'>
                                                <li
                                                    data-target='#carouselExampleIndicators${row.id}'
                                                    data-slide-to='0'
                                                    class='active'
                                                    ></li>
                                                <li
                                                    data-target='#carouselExampleIndicators${row.id}'
                                                    data-slide-to='1'
                                                    ></li>
                                                <li
                                                    data-target='#carouselExampleIndicators${row.id}'
                                                    data-slide-to='2'
                                                    ></li>
                                            </ol>
                                            <div class='carousel-inner'>
                                                    ${archivos.map((archivo,idx)=>{
                                                        return `
                                                    <div class='carousel-item ${idx==0?"active":""}'>
                                                        <iframe seamless class='img-size' src='{{asset("storage/matriz_evidencias")}}/${archivo.evidencia}'></iframe>
                                                    </div>`
                                                    })}
                                                
                                            </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <a
                                                class='carousel-control-prev'
                                                href='#carouselExampleIndicators${row.id}'
                                                role='button'
                                                data-slide='prev'
                                                >
                                                <span class='carousel-control-prev-icon'
                                                    aria-hidden='true'
                                                    ></span>
                                                <span class='sr-only'>Previous</span>
                                            </a>
                                            <a
                                                class='carousel-control-next'
                                                href='#carouselExampleIndicators${row.id}'
                                                role='button'
                                                data-slide='next'
                                                >
                                                <span
                                                    class='carousel-control-next-icon'
                                                    aria-hidden='true'
                                                    ></span>
                                                <span class='sr-only'>Next</span>
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>`
                            return archivo;
                        }
                    },
                    {
                        data: 'reviso',
                        name: 'reviso'
                    },
                    {
                        data: 'puesto',
                        name: 'puesto'
                    },
                    {
                        data: 'area',
                        name: 'area'
                    },
                    {
                        data: 'comentarios',
                        name: 'comentarios'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
            };
            let table = $('.datatable-MatrizRequisitoLegale').DataTable(dtOverrideGlobals);
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });
            // $('.datatable thead').on('input', '.search', function() {
            //     let strict = $(this).attr('strict') || false
            //     let value = strict && this.value ? "^" + this.value + "$" : this.value
            //     table
            //         .column($(this).parent().index())
            //         .search(value, strict)
            //         .draw()
            // });
        });

    </script>
@endsection
