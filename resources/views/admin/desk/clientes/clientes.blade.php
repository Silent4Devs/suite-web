<div class="cards-status-centro-atencion">
    <div class="card-status-centro" style="background-color: #4A98FF !important;">
        <i class="material-symbols-outlined">warning</i>
        <div class="info">
            <span>Quejas</span><br>
            <strong>{{ $total_quejasClientes }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #FF8F55 !important;">
        <i class="material-symbols-outlined">flag</i>
        <div class="info">
            <span>Sin atender</span><br>
            <strong>{{ $nuevos_quejasClientes }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #78BB50 !important;">
        <i class="material-symbols-outlined">check_circle</i>
        <div class="info">
            <span>En curso</span><br>
            <strong>{{ $en_curso_quejasClientes }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #BE74FF !important;">
        <i class="material-symbols-outlined">pause</i>
        <div class="info">
            <span>En espera</span><br>
            <strong>{{ $en_espera_quejasClientes }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #7A7A7A !important;">
        <i class="material-symbols-outlined">cancel_presentation</i>
        <div class="info">
            <span>Cerrados</span><br>
            <strong>{{ $cerrados_quejasClientes }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #FE5661 !important;">
        <i class="material-symbols-outlined">block</i>
        <div class="info">
            <span>Cancelados</span><br>
            <strong>{{ $cancelados_quejasClientes }}</strong>
        </div>
    </div>
</div>

<div class="card card-body box-sentimientos mt-4">
    <div class="card-sentimiento">
        <div>
            <span>No prioritario</span><br>
            <strong>{{$clientes_sentiment_1}}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji1.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Bajo</span><br>
            <strong>{{$clientes_sentiment_2}}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji2.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Medio</span><br>
            <strong>{{$clientes_sentiment_3}}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji3.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Alto</span><br>
            <strong>{{$clientes_sentiment_4}}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji4.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Urgente</span><br>
            <strong>{{$clientes_sentiment_5}}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji5.png') }}" alt="Emoji">
    </div>
</div>
<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_quejasClientes }}</div>
            <div class="textoCentroCard">Quejas Clientes</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_quejasClientes }}</div>
            <div class="textoCentroCard">Sin atender</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_quejasClientes }}</div>
            <div class="textoCentroCard">En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_quejasClientes }}</div>
            <div class="textoCentroCard">En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_quejasClientes }}</div>
            <div class="textoCentroCard">Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_quejasClientes }}</div>
            <div class="textoCentroCard">No procedentes</div>
        </div>
    </div>
</div>

<div class=" mb-3 text-right">
    @can('centro_atencion_quejas_clientes_agregar')
        <a class="btn btn-primary" href="{{ asset('admin/desk/quejas-clientes') }}">Crear reporte</a>
    @endcan

    @can('centro_atencion_quejas_cliente_dashboard')
        <a class="btn btn-primary" href="{{ asset('admin/desk/quejas-clientes/dashboard') }}">Dashboard</a>
    @endcan
</div>

@include('partials.flashMessages')
<div class="datatable-fix datatable-rds">
    <table class="datatable tabla_quejasclientes" id="tabla-procesos"
        style="border-collapse: separate; border-spacing: 0; border-radius: 10px;">
        <thead>
            <tr>
                <th style="min-width:60px;">Folio</th>
                <th style="min-width:200px;">Nombre del Cliente</th>
                <th style="min-width:200px;">Puesto</th>
                <th style="min-width:200px;">Teléfono</th>
                <th style="min-width:200px;">Correo</th>
                <th style="min-width:200px;">Título de la Queja</th>
                <th style="text-align:left !important;min-width:150px;">Fecha de Registro</th>
                <th style="min-width:150px;">Fecha de Cierre</th>
                <th style="min-width:200px;">Proceso</th>
                <th style="min-width:200px;">Ubicación</th>
                <th style="min-width:200px;">Otros</th>
                <th style="min-width:500px;">Descripción</th>
                <th style="min-width:80px;">Estatus</th>
                <th>Prioridad</th>
                <th style="min-width:150px;">Acción Correctiva</th>
                <th>Opciones</th>
            </tr>
        </thead>
    </table>
</div>


@foreach ($quejasClientes as $item)
    @php
        $sentimentLevel = $item->sentimiento['analisis_de_sentimientos'][0]['compound'];
    @endphp
    <div class="modal fade" id="sentimiento-modal-clientes-{{ $item->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="mb-2">
                                <strong>Ticket:</strong>
                                <span>{{ $item->folio }}</span>
                            </div>
                            <div class="mb-2">
                                <strong>Palabras clave:</strong>
                                <span>
                                    @foreach ($item->sentimiento['palabras_clave'][0] as $palabra)
                                        {{ $palabra }},
                                    @endforeach
                                </span>
                            </div>
                            <div class="mb-2">
                                <strong>Categoría de la queja:</strong>

                                @if ($item->sentimiento['sentimientos_textblob'][0]['polarity'] >= 0.6)
                                    Polarizada,
                                @else
                                    Equilibrada,
                                @endif
                                @if ($item->sentimiento['sentimientos_textblob'][0]['subjectivity'] >= 0.6)
                                    subjetiva
                                @else
                                    objetiva
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-body">
                                <div class="d-flex gap-3 align-items-center">

                                    @if ($sentimentLevel >= -1 && $sentimentLevel < -0.4)
                                        <img src="{{ asset('img/centroAtencion/emoji1.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif
                                    @if ($sentimentLevel >= -0.4 && $sentimentLevel < -0.8)
                                        <img src="{{ asset('img/centroAtencion/emoji2.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif
                                    @if ($sentimentLevel >= -0.8 && $sentimentLevel < 0.2)
                                        <img src="{{ asset('img/centroAtencion/emoji3.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif
                                    @if ($sentimentLevel >= 0.2 && $sentimentLevel < 0.6)
                                        <img src="{{ asset('img/centroAtencion/emoji4.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif
                                    @if ($sentimentLevel >= 0.6 && $sentimentLevel <= 1)
                                        <img src="{{ asset('img/centroAtencion/emoji5.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif

                                    <div>
                                        <strong style="font-size: 16px;">{{ $item->titulo }}</strong><br>
                                        <span>Prioridad de atención:</span>

                                        @if ($sentimentLevel >= -1 && $sentimentLevel < -0.4)
                                            <span class="span-sentiment-1">1</span>
                                        @endif
                                        @if ($sentimentLevel >= -0.4 && $sentimentLevel < -0.8)
                                            <span class="span-sentiment-2">2</span>
                                        @endif
                                        @if ($sentimentLevel >= -0.8 && $sentimentLevel < 0.2)
                                            <span class="span-sentiment-3">3</span>
                                        @endif
                                        @if ($sentimentLevel >= 0.2 && $sentimentLevel < 0.6)
                                            <span class="span-sentiment-4">4</span>
                                        @endif
                                        @if ($sentimentLevel >= 0.6 && $sentimentLevel <= 1)
                                            <span class="span-sentiment-5">5</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div>
                        <h5>Frases nominales</h5>
                        <ul class="mt-3">
                            @foreach ($item->sentimiento['frases_nominales_spacy'][0] as $frase)
                                <li>
                                    {{ $frase }}
                                </li>
                            @endforeach
                        </ul>

                        <h5 class="mt-5">Resumen</h5>
                        @if ($item->sentimiento['sentimientos_textblob'][0]['polarity'] >= 0.6)
                            <p class="mt-3">
                                El mensaje tiene un tono cargado de crítica, frustración o resentimiento. Esto puede
                                reflejar un nivel significativo de malestar acumulado y una percepción de que sus
                                necesidades o preocupaciones han sido ignoradas. La polaridad negativa suele ir
                                acompañada de emociones intensas como enojo, estrés o decepción, y podría indicar un
                                riesgo de escalamiento del conflicto si no se gestiona adecuadamente. Las acciones
                                recomendadas son:
                            </p>
                            <ul>
                                <li>Responder con empatía y profesionalismo.</li>
                                <li>Abordar la causa del malestar rápidamente</li>
                                <li>Priorizar la resolución del conflicto para reducir tensiones y restaurar la
                                    confianza.</li>
                            </ul>
                        @else
                            <p class="mt-3">
                                El mensaje carece de carga emocional evidente, enfocándose únicamente en los hechos.
                                Esta neutralidad puede interpretarse de dos maneras. Por un lado, puede ser un intento
                                del empleado de mantener objetividad y profesionalismo. Por otro lado, también podría
                                ser una señal de desconexión emocional, lo que implica que el colaborador ya no se
                                siente comprometido con el entorno o no tiene expectativas de que sus quejas generen un
                                cambio significativo. Las acciones recomendadas son:
                            </p>
                            <ul>
                                <li>Asegurar que el colaborador se sienta escuchado y comprendido</li>
                                <li>Indagar si la neutralidad refleja una preferencia personal por mantener objetividad
                                    o si hay señales de apatía y desconexión emocional.</li>
                                <li>Promover espacios de diálogo abierto para restablecer el compromiso del colaborador
                                    con la organización.</li>
                            </ul>
                        @endif

                        @if ($item->sentimiento['sentimientos_textblob'][0]['subjectivity'] >= 0.6)
                            <p class="mt-3">
                                Refleja las percepciones, emociones y opiniones personales del colaborador. En lugar de
                                centrarse únicamente en hechos, esta queja expresa cómo la situación es vivida y
                                experimentada por la persona, lo que puede incluir interpretaciones, suposiciones o
                                juicios.
                            </p>
                        @else
                            <p class="mt-3">
                                Se enfoca hechos concretos y verificables sin involucrar juicios personales o emociones.
                                El colaborador describe la situación tal como ocurrió, con información específica que
                                puede ser corroborada por datos, procedimientos o testimonios.
                            </p>
                        @endif

                        <h5 class="mt-5">Interpretación de Sentimientos</h5>
                        @if ($sentimentLevel >= -1 && $sentimentLevel < -0.4)
                            <p class="mt-3">
                                El colaborador expresa satisfacción a pesar de la situación que describe. Su sugerencia
                                o queja tiene un tono positivo y constructivo, mostrando confianza en la capacidad de la
                                organización para mejorar.
                            </p>
                            <p class="mt-3">
                                <strong>Reacción ideal:</strong>
                                Agradecer y motivar la participación, reforzando su actitud colaborativa.
                            </p>
                        @endif
                        @if ($sentimentLevel >= -0.4 && $sentimentLevel < -0.8)
                            <p class="mt-3">
                                La queja refleja una incomodidad ligera; el colaborador muestra cierta preocupación o
                                frustración, pero mantiene un tono respetuoso. No hay señales de enojo profundo, y aún
                                prevalece la intención de encontrar soluciones.
                            </p>
                            <p class="mt-3">
                                <strong>Reacción ideal:</strong>
                                Escuchar activamente y ofrecer alternativas rápidas para evitar que el malestar crezca.
                            </p>
                        @endif
                        @if ($sentimentLevel >= -0.8 && $sentimentLevel < 0.2)
                            <p class="mt-3">
                                La queja muestra frustración leve. El tono es crítico y puede incluir comentarios sobre
                                la insatisfacción con la situación o gestión del problema. En esta fase, la persona
                                siente que algo ha salido mal y requiere atención inmediata.
                            </p>
                            <p class="mt-3">
                                <strong>Reacción ideal:</strong>
                                Responder con empatía y compromiso, proponiendo soluciones concretas rápidamente para
                                evitar escalamiento.
                            </p>
                        @endif
                        @if ($sentimentLevel >= 0.2 && $sentimentLevel < 0.6)
                            <p class="mt-3">
                                El colaborador expresa un alto grado de disgusto o enojo, acompañado de comentarios más
                                duros o críticas dirigidas hacia procedimientos, personas o decisiones. Aunque la
                                comunicación aún es manejable, el riesgo de que la queja evolucione a conflicto es alto.
                            </p>
                            <p class="mt-3">
                                <strong>Reacción ideal:</strong>
                                Priorizar la respuesta, ofreciendo disculpas si corresponde, y demostrar disposición
                                inmediata para corregir la situación.
                            </p>
                        @endif
                        @if ($sentimentLevel >= 0.6 && $sentimentLevel <= 1)
                            <p class="mt-3">
                                El tono de la queja es intenso, directo e incluso agresivo. Refleja que el colaborador
                                ha perdido la paciencia y siente que sus necesidades no fueron atendidas de manera
                                oportuna o justa. En este punto, el malestar es profundo y la percepción de la
                                organización está seriamente dañada.
                            </p>
                            <p class="mt-3">
                                <strong>Reacción ideal:</strong>
                                Responder con calma y empatía, buscar resolver la situación de manera urgente, e
                                involucrar a líderes si es necesario para reconstruir la confianza.
                            </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {

            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Quejas de Clientes ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Quejas de Clientes ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    // set custom header when print
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                            <div class="row">
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">CENTRO DE ATENCIÓN: QUEJAS CLIENTES</strong>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
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
                },
                {

                    text: '<i class="fas fa-archive" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Archivo',
                    action: function(e, dt, node, config) {
                        window.location.href = '/admin/desk/quejas-cliente-archivo';
                    }
                }

            ];
            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar empleado',
            //     url: "{{ asset('admin/inicioUsuario/reportes/seguridad') }}",
            //     className: "btn-xs btn-outline-success rounded ml-2 pr-3",
            //     action: function(e, dt, node, config) {
            //     let {
            //     url
            //     } = config;
            //     window.location.href = url;
            //     }
            // };
            //     dtButtons.push(btnAgregar)
            if (!$.fn.dataTable.isDataTable('.tabla_quejasclientes')) {
                window.tabla_quejasclientes_desk = $(".tabla_quejasclientes").DataTable({
                    ajax: "{{ route('admin.desk.quejasClientes-index') }}",
                    buttons: dtButtons,
                    columnDefs: [{
                        targets: [4, 5, 6, 10, 11, 12, 13],
                        visible: false,
                    }],
                    columns: [
                        // {data: 'id'},
                        {
                            data: 'folio',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'nombre',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }

                        },
                        {
                            data: 'puesto',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'telefono',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'correo',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'titulo',
                            render: function(data, type, row, meta) {
                                return `<div style="text-align: left">${data}</div>`
                            }
                        },
                        {
                            data: 'fecha_reporte',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'fecha_de_cierre',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'proceso_quejado',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'ubicacion',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'otro_quejado',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'descripcion',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'estatus',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'prioridad',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'desea_levantar_ac',
                            render: function(data, type, row, meta) {
                                data = data == "" ? 0 : data
                                let valor = "";
                                if (data == true) {
                                    valor = "Solicitada";
                                }
                                if (data == false) {
                                    valor = "No aplica";
                                }

                                return `
                                <div>${valor}</div>
                            `
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html =
                                    `
                			<div class="botones_tabla">
                				<a href="/admin/desk/${data}/quejas-clientes-edit/"><i class="fas fa-edit" title="Análisis de la queja"></i></a>
                                <a onclick='EliminarQuejaCliente("/admin/desk/${data}/quejas-clientes-delete"); return false;'><i style="color:#000" class="ml-2 fas fa-trash"  data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>

                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#sentimiento-modal-clientes-${data}">
                                    <i class="fa-regular fa-face-smile"></i>
                                </button>
                                `;

                                if ((row.estatus == 'Cerrado') || (row.estatus ==
                                        'No procedente')) {

                                    html += `<button onclick='ArchivarQuejaCliente("/admin/desk/${data}/archivarQuejasClientes"); return false;' style="margin-top:-10px">
				       						<i class="fas fa-archive" ></i></a>
				       					</button>
				       					</div>`;
                                }
                                return html;
                            }
                        },
                    ],
                    createdRow: (row, data, dataIndex, cells) => {
                        let color = "green";
                        let texto = "white";
                        if (data.prioridad == 'Alta') {
                            color = "#FF417B";
                            texto = "white";
                        }
                        if (data.prioridad == 'Media') {
                            color = "#FFCB63";
                            texto = "white";
                        }
                        if (data.prioridad == 'Baja') {
                            color = "#6DC866";
                            texto = "white";
                        }

                        let fondo = "green";
                        let letras = "white";
                        if (data.estatus == 'Sin atender') {
                            fondo = "#FFCB63";
                            letras = "white";
                        }
                        if (data.estatus == 'En curso') {
                            fondo = "#AC84FF";
                            letras = "white";
                        }
                        if (data.estatus == 'En espera') {
                            fondo = "#6863FF";
                            letras = "white";
                        }
                        if (data.estatus == 'Cerrado') {
                            fondo = "#6DC866";
                            letras = "white";
                        }
                        if (data.estatus == 'No procedente') {
                            fondo = "#FF417B";
                            letras = "white";
                        }
                        if (data.estatus != null) {
                            $(cells[14]).css('background-color', fondo)
                            $(cells[14]).css('color', letras)
                        }
                        if (data.prioridad != null) {
                            $(cells[15]).css('background-color', color)
                            $(cells[15]).css('color', texto)

                        }
                    },

                    order: [
                        [0, 'desc']
                    ]
                });
            }

            window.ArchivarQuejaCliente = function(url) {
                Swal.fire({
                    title: '¿Archivar queja clientes?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Archivar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({

                            type: "post",

                            url: url,

                            data: {
                                _token: '{{ csrf_token() }}'
                            },

                            dataType: "json",

                            success: function(response) {

                                if (response.success) {
                                    tabla_quejasclientes_desk.ajax.reload();
                                    Swal.fire(
                                        'Queja Archivada',
                                        '',
                                        'success'
                                    )
                                }

                            }

                        });

                    }
                })
            }

            window.EliminarQuejaCliente = function(url) {
                Swal.fire({
                    title: '¿Eliminar queja cliente?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({

                            type: "DELETE",

                            url: url,

                            data: {
                                _token: '{{ csrf_token() }}'
                            },

                            dataType: "json",

                            success: function(response) {

                                tabla_quejasclientes_desk.ajax.reload();
                                Swal.fire(
                                    'Queja Eliminada',
                                    '',
                                    'success'
                                )


                            }

                        });

                    }
                })
            }

            let botones_archivar = document.querySelectorAll('.archivar');
            botones_archivar.forEach(boton => {
                boton.addEventListener('click', function(e) {
                    e.preventDefault();
                    let incidente_id = this.getAttribute('data-id');
                    // console.log(incidente_id);
                    let url = `/admin/desk/${incidente_id}/archivarQuejasClientes`;
                });
            });

        });
    </script>
@endsection
