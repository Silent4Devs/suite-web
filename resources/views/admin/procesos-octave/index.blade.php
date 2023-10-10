@extends('layouts.admin')
@section('content')

<style>

    .btn_cargar{
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
    .btn_cargar:hover{
        color: #fff;
        background:#345183 ;
    }
    .btn_cargar i{
        font-size: 15pt;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .agregar{
        margin-right:15px;
    }

    .table tr td:nth-child(4) {

    text-align: left !important;

    }

    #tabla-procesos tr td:nth-child(3){
        background-color: green;
        position: relative;
        padding: 0;
    }

</style>

    {{-- {{ Breadcrumbs::render('perfil-puesto') }} --}}
    @can('puesto_create')
        <div class="mt-5 card">
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                {{-- <div class="col-lg-12">
                    @include('csvImport.modalperfilpuesto', ['model' => 'Vulnerabilidad', 'route' => 'admin.vulnerabilidads.parseCsvImport'])
                </div> --}}
            </div>

        @endcan

        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong>Proceso</h3>
        </div>


        <div class="card-body">
            <div class="row">
                @include('admin.OCTAVE.menu')
                <div class="datatable-fix mt-3 col-12">
                    <table class="table table-bordered w-100 datatable-Carta" id="tabla-procesos">
                        <thead class="thead-dark">
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Proceso
                                </th>
                                <th>
                                    Nivel Riesgo
                                </th>
                                <th>
                                    Dirección
                                </th>
                                <th>
                                    Servicio
                                </th>
                                <th>
                                    Opciones
                                </th>
                            </tr>
                        </thead>
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
                    title: `Puestos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Puestos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Puestos ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Puestos ${new Date().toLocaleDateString().trim()}`,
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

                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar proceso',
                url: "{{ route('admin.procesos-octave.create',$matriz) }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                let btnExport = {
                text: '<i  class="fas fa-download"></i>',
                titleAttr: 'Descargar plantilla',
                className: "btn btn_cargar" ,
                url:"{{ route('descarga-puesto') }}",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            let btnImport = {
                text: '<i  class="fas fa-file-upload"></i>',
                titleAttr: 'Importar datos',
                className: "btn btn_cargar",
                action: function(e, dt, node, config) {
                    $('#xlsxImportModal').modal('show');
                }
            };

            dtButtons.push(btnAgregar);
            dtButtons.push(btnExport);
            dtButtons.push(btnImport);
            


            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.procesos-octave.index',$matriz) }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'proceso',
                        name: 'proceso'
                    },
                    {
                        data: 'nivel_riesgo',
                        name: 'nivel_riesgo',
                        render: function(data,type,row,meta){
                            data=data==""?0:data
                            let color = "green";
                            let valor="";
                            let texto="white";
                            if(data <=5){
                                color="green";
                                valor="Muy Bajo";
                            }
                            if(data >=6){
                                color="rgb(50, 205, 63";
                                valor="Bajo";
                            }
                            if(data >=21){
                                color="yellow";
                                texto="black";
                                valor="Media";
                            }
                            if(data >=51){
                                color="orange";
                                valor="Alta";
                            }
                            if(data >=81){
                                color="red";
                                valor="Crítica";
                            }

                            return `
                            <div style="position:absolute; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background-color:${color}; color:${texto}">${data} - ${valor}</div>
                            `
                        }
                    },{
                        data: 'direccion',
                        name: 'direccion'
                    },
                    {
                        data: 'servicio',
                        name: 'servicio'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let proceso = data;
                            let matriz = @json($matriz);
                            let html = `
                            <a class="btn" href="/admin/procesos-octave/${matriz}/edit/${proceso}"><i class="fas fa-edit"></i></a>
                            <button class="btn text-danger" onclick='event.preventDefault();Eliminar("/admin/procesos-octave/${proceso}")'><i class="fas fa-trash-alt"></i></button>

                            `

                            return html;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-Carta').DataTable(dtOverrideGlobals);
            window.Eliminar = (url) => {
                console.log(url);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            dataType: "Json",
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        });

                    }
                })

            }
            $('#lista_areas').on('change', function() {
                console.log(this.value);
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    table.columns(1).search("(^" + this.value + "$)", true, false).draw();
                } else {
                    this.style.border = "none";
                    table.columns(1).search(this.value).draw();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {})
    </script>
@endsection
