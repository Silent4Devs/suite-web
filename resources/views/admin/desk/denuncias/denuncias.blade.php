<h5 class="col-12 titulo_general_funcion">Centro de Atención: <span style="font-weight: lighter;">Denuncias</span></h5>
<div class="cards-status-centro-atencion">
    <div class="card-status-centro" style="background-color: #4A98FF !important;">
        <i class="material-symbols-outlined">warning</i>
        <div class="info">
            <span>Quejas</span><br>
            <strong>{{ $total_denuncias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #FF8F55 !important;">
        <i class="material-symbols-outlined">flag</i>
        <div class="info">
            <span>Sin atender</span><br>
            <strong>{{ $nuevos_denuncias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #78BB50 !important;">
        <i class="material-symbols-outlined">check_circle</i>
        <div class="info">
            <span>En curso</span><br>
            <strong>{{ $en_curso_denuncias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #BE74FF !important;">
        <i class="material-symbols-outlined">pause</i>
        <div class="info">
            <span>En espera</span><br>
            <strong>{{ $en_espera_denuncias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #7A7A7A !important;">
        <i class="material-symbols-outlined">cancel_presentation</i>
        <div class="info">
            <span>Cerrados</span><br>
            <strong>{{ $cerrados_denuncias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #FE5661 !important;">
        <i class="material-symbols-outlined">block</i>
        <div class="info">
            <span>Cancelados</span><br>
            <strong>{{ $cancelados_denuncias }}</strong>
        </div>
    </div>
</div>

{{-- <div class="card card-body box-sentimientos mt-4">
    <div class="card-sentimiento">
        <div>
            <span>No prioritario</span><br>
            <strong>{{ $denuncias_sentiment_1 }}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji1.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Bajo</span><br>
            <strong>{{ $denuncias_sentiment_2 }}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji2.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Medio</span><br>
            <strong>{{ $denuncias_sentiment_3 }}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji3.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Alto</span><br>
            <strong>{{ $denuncias_sentiment_4 }}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji4.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Urgente</span><br>
            <strong>{{ $denuncias_sentiment_5 }}</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji5.png') }}" alt="Emoji">
    </div>
</div> --}}
<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_denuncias }}</div>
            <div>Denuncias</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_denuncias }}</div>
            <div>Sin atender</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_denuncias }}</div>
            <div>En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_denuncias }}</div>
            <div>En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_denuncias }}</div>
            <div>Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_denuncias }}</div>
            <div>Cancelados</div>
        </div>
    </div>
</div>


@can('mi_perfil_mis_reportes_realizar_reporte_de_denuncia')
    <div class="mb-3 text-right">
        <a class="btn btn-primary" href="{{ asset('admin/inicioUsuario/reportes/denuncias') }}">Crear reporte</a>
    </div>
@endcan

@include('partials.flashMessages')
<div class="datatable-fix datatable-rds">
    <table class="datatable tabla_denuncias">
        <thead>
            <tr>
                <th colspan="6"></th>
                <th colspan="3" style="text-align:center; border:1px solid #ccc;">Denuncio</th>
                <th colspan="3" style="text-align:center; border:1px solid #ccc;">Denunciado</th>
            </tr>
            <tr>
                <th style="min-width:200px;">Folio</th>
                <th style="min-width:200px;">Anónimo</th>
                <th style="min-width:200px;">Estatus</th>
                <th style="min-width:200px;">Fecha de identificación</th>
                <th style="min-width:200px;">Fecha de recepción</th>
                <th style="min-width:200px;">Fecha de cierre</th>
                <th style="min-width:200px;">Nombre</th>
                <th style="min-width:200px;">Puesto</th>
                <th style="min-width:200px;">Área</th>
                <th style="min-width:200px;">Nombre</th>
                <th style="min-width:200px;">Puesto</th>
                <th style="min-width:200px;">Área</th>
                <th style="min-width:200px;">Descripción</th>
                <th style="min-width:200px;">Opciones</th>
            </tr>
        </thead>
    </table>
</div>


@foreach ($denuncias as $item)
    @php
        $sentimentLevel = $item->sentimientos_array['analisis_de_sentimientos'][0]['compound'];
    @endphp
    <div class="modal fade" id="sentimiento-modal-denuncias-{{ $item->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    @foreach ($item->sentimientos_array['palabras_clave'][0] as $palabra)
                                        {{ $palabra }},
                                    @endforeach
                                </span>
                            </div>
                            <div class="mb-2">
                                <strong>Categoría de la queja:</strong>

                                @if ($item->sentimientos_array['sentimientos_textblob'][0]['polarity'] >= 0.6)
                                    Polarizada,
                                @else
                                    Equilibrada,
                                @endif
                                @if ($item->sentimientos_array['sentimientos_textblob'][0]['subjectivity'] >= 0.6)
                                    subjetiva
                                @else
                                    objetiva
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-body">
                                <div class="d-flex gap-3 align-items-center">

                                    @if ($sentimentLevel >= -1 && $sentimentLevel < -0.6)
                                        <img src="{{ asset('img/centroAtencion/emoji5.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif
                                    @if ($sentimentLevel >= -0.6 && $sentimentLevel < -0.05)
                                        <img src="{{ asset('img/centroAtencion/emoji4.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif
                                    @if ($sentimentLevel >= -0.05 && $sentimentLevel < 0.05)
                                        <img src="{{ asset('img/centroAtencion/emoji3.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif
                                    @if ($sentimentLevel >= 0.05 && $sentimentLevel < 0.6)
                                        <img src="{{ asset('img/centroAtencion/emoji2.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif
                                    @if ($sentimentLevel >= 0.6 && $sentimentLevel <= 1)
                                        <img src="{{ asset('img/centroAtencion/emoji1.png') }}" alt="Emoji"
                                            style="width: 60px;">
                                    @endif

                                    <div>
                                        <strong style="font-size: 16px;">{{ $item->titulo }}</strong><br>
                                        <span>Prioridad de atención:</span>

                                        @if ($sentimentLevel >= -1 && $sentimentLevel < -0.6)
                                            <span class="span-sentiment-5">Muy Alta</span>
                                        @endif
                                        @if ($sentimentLevel >= -0.6 && $sentimentLevel < -0.05)
                                            <span class="span-sentiment-4">Alta</span>
                                        @endif
                                        @if ($sentimentLevel >= -0.05 && $sentimentLevel < 0.05)
                                            <span class="span-sentiment-3">Media</span>
                                        @endif
                                        @if ($sentimentLevel >= 0.05 && $sentimentLevel < 0.6)
                                            <span class="span-sentiment-2">Baja</span>
                                        @endif
                                        @if ($sentimentLevel >= 0.6 && $sentimentLevel <= 1)
                                            <span class="span-sentiment-1">Muy Baja</span>
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
                            @foreach ($item->sentimientos_array['frases_nominales_spacy'][0] as $frase)
                                <li>
                                    {{ $frase }}
                                </li>
                            @endforeach
                        </ul>

                        <h5 class="mt-5">Resumen</h5>
                        @if ($item->sentimientos_array['sentimientos_textblob'][0]['polarity'] >= 0.6)
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

                        @if ($item->sentimientos_array['sentimientos_textblob'][0]['subjectivity'] >= 0.6)
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
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
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
                },
                {

                    text: '<i class="fas fa-archive" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Archivo',
                    action: function(e, dt, node, config) {
                        window.location.href = '/admin/desk/denuncias-archivo';
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
            if (!$.fn.dataTable.isDataTable('.tabla_denuncias')) {
                window.tabla_denuncias_desk = $(".tabla_denuncias").DataTable({
                    ajax: '/admin/desk/denuncias',
                    buttons: dtButtons,
                    columns: [{
                            data: 'folio',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'anonimo',
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
                            data: 'fecha_creacion',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
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
                            data: 'name',
                            render: function(data, type, row, meta) {
                                let html = "";
                                if (row.anonimo == 'no') {
                                    html =
                                        `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.denuncio?.avatar}" title="${row.denuncio?.name}"></img>`;
                                }
                                return `${row.denuncio ? html: 'sin asignar'}`;
                            }
                        },
                        {
                            data: 'puesto',
                            render: function(data, type, row, meta) {
                                let html = "";
                                if (row.anonimo == 'no') {
                                    html = `${row.denuncio?.puesto}`;
                                }
                                return `${row.denuncio ? html: 'sin asignar'}`;
                            }
                        },
                        {
                            data: 'area',
                            render: function(data, type, row, meta) {
                                let html = "";
                                if (row.anonimo == 'no') {
                                    html = `${row.denuncio?.area?.area}`;
                                }
                                return `${row.denuncio ? html: 'sin asignar'}`;
                            }
                        },
                        {
                            data: 'name',
                            render: function(data, type, row, meta) {
                                let html =
                                    `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.denunciado?.avatar}" title="${row.denunciado?.name}"></img>`;

                                return html;
                            }
                        },
                        {
                            data: 'puesto',
                            render: function(data, type, row, meta) {
                                return `${row.denunciado.puesto}`;
                            }
                        },
                        {
                            data: 'area',
                            render: function(data, type, row, meta) {
                                return `${row.denunciado?.area?.area}`;
                            }
                        },
                        {
                            data: 'descipcion',
                            render: function(data, type, row, meta) {
                                return `${row.descripcion}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html =
                                    `
                			<div class="botones_tabla">
                                @can('centro_atencion_denuncias_editar')
                				<a href="/admin/desk/${data}/denuncias-edit/"><i class="fas fa-edit"></i></a>
                                @endcan

                                <button type="button" class="btn d-none" data-bs-toggle="modal" data-bs-target="#sentimiento-modal-denuncias-${data}">
                                    <i class="fa-regular fa-face-smile"></i>
                                </button>
                                `;


                                if ((row.estatus == 'cerrado') || (row.estatus == 'cancelado')) {

                                    html += `
                                            <button class="btn" onclick='ArchivarDenuncia("/admin/desk/${data}/archivarDenuncias"); return false;' style="margin-top:-10px">
                                                <i class="fas fa-archive" ></i></a>
                                            </button>
				       					</div>`;
                                }
                                return html;
                            }
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ]
                });
            }

            window.ArchivarDenuncia = function(url) {
                Swal.fire({
                    title: '¿Archivar denuncia?',
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
                                    tabla_denuncias_desk.ajax.reload(null, false);
                                    Swal.fire(
                                        'Denuncia Archivada',
                                        '',
                                        'success'
                                    )
                                }

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
                    let url = `/admin/desk/${incidente_id}/archivarDenuncias`;
                });
            });
        });
    </script>

    {{-- <script>
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
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar empleado',
                url: "{{asset('admin/inicioUsuario/reportes/denuncias')}}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                let {
                url
                } = config;
                window.location.href = url;
                }
            };


            let dtOverrideGlobals = {
                buttons: dtButtons,
                order:[
                            [0,'desc']
                        ]
            };
            let table = $('.tabla_denuncias').DataTable(dtOverrideGlobals);
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

    </script> --}}
@endsection
