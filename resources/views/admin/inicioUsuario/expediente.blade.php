@extends('layouts.admin')
@section('content')

    <style type="text/css">
        .img_empleado_expediente {
            clip-path: circle(70px at 50% 50%);
            width: 140px !important;
            height: 140px !important;
            min-width: 140px !important;
            max-width: 140px !important;

            max-height: 140px !important;
            min-height: 140px !important;
        }

        #tabla_docs font{
            color:#fff; padding:5px; border-radius: 4px;
        }
        #tabla_docs .opcional{
            background-color:#25B82B;
            text-transform: capitalize;
        }
        #tabla_docs .obligatorio{
            background-color:#DD3939;
            text-transform: capitalize;
        }
        #tabla_docs .aplica{
            background-color:#FA8E1C;
        }
        #tabla_docs .aplica::before{
            content: "Solo si ";
        }

    </style>

    {{ Breadcrumbs::render('mi-expediente') }}
    <h5 class="col-12 titulo_general_funcion">Mi Expediente</h5>

    <div class="card-body card">
        <div class="row">

            <div class="col-12 d-flex" style="justify-content:space-between;">
                <div class="d-flex align-items-center">
                    <img class="img_empleado_expediente" src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado ? $empleado->avatar : 'user.png' }}">

                    <div class="ml-4">
                        <h5>{{ $empleado->name }}</h5>
                        <span>{{ $empleado->puesto }}</span><br>
                        <span>{{ $empleado->area ? $empleado->area->area : '' }}</span>
                    </div>
                </div>

                @php
                    use App\Models\Organizacion;
                    use App\Models\EvidenciasDocumentosEmpleados;

                    $organizacion = Organizacion::getLogo();
                    if (!is_null($organizacion)) {
                        $logotipo = $organizacion->logotipo;
                    } else {
                        $logotipo = 'logotipo-tabantaj.png';
                    }
                @endphp

                <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 130px;">
            </div>

            <div class="col-12 my-4">
                <hr>
            </div>

            <div class="datatable-fix col-12">
                <table class="table table-bordered w-100 datatable datatable-Perfiles" id="tabla_docs">
                    <thead class="thead-dark">
                        <tr>
                            <th style="max-width:120px;">Tipo</th>
                            <th>Documento</th>
                            <th style="max-width:160px; text-align: center;">ID</th>
                            <th style="max-width:350px; text-align: center;">Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista_docs as $doc)
                            <tr>
                                <td><font class="{{ $doc->tipo }}">{{ $doc->tipo }}</font></td>
                                <td>{{ $doc->documento }}</td>
                                <td>
                                    <input id="" data-id="{{ $doc->id }}" data-empleado="{{ auth()->user()->empleado->id }}" name="numero" class="form-control" value="{{ $doc->empleado ? $doc->empleado->numero : null }}">
                                </td>
                                <td style=" display: flex;justify-content: center; position: relative;">
                                    @if($doc->ruta_documento)
                                        <a target="_blank" href="{{ $doc->ruta_documento }}" style="text-align:center; display:inline-block;">
                                            <img src="{{ asset('img/pdf-file.png') }}" style="width:50px;"><br>
                                            {{ $doc->nombre_doc}}
                                        </a>
                                        <label for="documento{{ $doc->id }}" class="text-center" style="position:absolute; right: 20px; top:20px;">
                                            <i class="fa-solid fa-arrows-rotate btn" title="Actualizar Documento"></i>
                                        </label>
                                        <input type="file" class="form-control d-none" id="documento{{ $doc->id }}" data-id="{{ $doc->id }}" data-empleado="{{ auth()->user()->empleado->id }}" name="file"/>
                                     @else
                                        <div class="text-center">
                                            <label for="documento{{ $doc->id }}" class="text-center">
                                                <img src="{{ asset('img/upload-pdf.png') }}" style="width:40px" />
                                                <p class="m-0 text-muted" style="font-size:10px">Subir Documento</p>
                                            </label>
                                        </div>
                                        <input type="file" class="form-control d-none" id="documento{{ $doc->id }}" data-id="{{ $doc->id }}" data-empleado="{{ auth()->user()->empleado->id }}" name="file"/>
                                        <p class="m-0">
                                            <span class="errors documento_error text-danger"></span>
                                        </p>
                                    @endif



                                </td>
                                {{-- <td>
                                    @if( $doc->archivado == false)
                                        <font style="background-color:green;">Actual</font>
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
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
            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar',
            //     url: "#",
            //     className: 'btn-xs btn-outline-success rounded ml-2 pr-3',
            //     action: function(e, dt, node, config) {
            //     let {
            //     url
            //     } = config;
            //     window.location.href = url;
            //     }
            // };

            // dtButtons.push(btnAgregar);

            let dtOverrideGlobals = {
                buttons: dtButtons,
                order:[
                            [0,'desc']
                        ],
                pageLength: 20,
            };
            let table = $('#tabla_docs').DataTable(dtOverrideGlobals);

            document.getElementById('tabla_docs').addEventListener('keyup', async function(e){
                if (e.target.tagName == 'INPUT') {
                    try{
                        let formData = new FormData();
                        formData.append('name', e.target.getAttribute('name'));
                        formData.append('value', e.target.value);
                        formData.append('documentoId', e.target.getAttribute('data-id'));
                        formData.append('empleadoId', e.target.getAttribute('data-empleado'));
                        const url = '{{ route("admin.inicio-Usuario.expediente-update") }}';
                        formData.forEach(item=>console.log(item));
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })

                        const data = await response.json()
                        console.log(data);
                    } catch(error){
                        toastr.error(error);
                    }
                }
            });

            // file
            document.getElementById('tabla_docs').addEventListener('change', async function(e){
                if (e.target.tagName == 'INPUT') {
                    try{
                        console.log(e.target.files);
                        let formData = new FormData();
                        formData.append('name', e.target.getAttribute('name'));
                        if (e.target.getAttribute('name') == 'file') {
                            formData.append('value', e.target.files[0]);
                        }else{
                            formData.append('value', e.target.value);
                        }
                        formData.append('documentoId', e.target.getAttribute('data-id'));
                        formData.append('empleadoId', e.target.getAttribute('data-empleado'));
                        const url = '{{ route("admin.inicio-Usuario.expediente-update") }}';
                        formData.forEach(item=>console.log(item));
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })

                        const data = await response.json()
                        console.log(data);
                        if (data.status == 201) {
                            toastr.success(data.message);
                            setTimeout(()=>{
                                window.location.reload();
                            },800);
                        }
                    } catch(error){
                        toastr.error(error);
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '#nombre_documento', function(event) {
            let op_select = $('#nombre_documento option:selected').attr('data-activar');
            console.log(op_select);
            if (op_select == 'si') {
                $('#group_numero_activo').addClass('d-block');
                $('#group_numero_activo').removeClass('d-none');
            }
            if (op_select == 'no'){
                $('#group_numero_activo').addClass('d-none');
                $('#group_numero_activo').removeClass('d-block');
            }

            let tipo_doc = $('#nombre_documento option:selected').attr('data-tipo');

            document.querySelector('#tipo_doc').innerHTML = tipo_doc;
            $('#tipo_doc').removeClass('opcional');
            $('#tipo_doc').removeClass('obligatorio');
            $('#tipo_doc').removeClass('aplica');
            $('#tipo_doc').addClass(tipo_doc);
        });
    </script>
@endsection
