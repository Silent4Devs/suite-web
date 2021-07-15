@extends('externos.layout')
@section('nombre-vista')
    Sistema de revisiones de Tabantaj
@endsection

@section('content')
    <style>
        .cargando {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin-left: auto;
            margin-right: auto;
            margin-top: 250px;
            width: 200px;
            text-align: center;
        }

        .cargando p {
            margin: 0;
            font-weight: bold;
        }

        .enviando-respuesta {
            opacity: 0.6;
            pointer-events: none;
        }

        .lds-hourglass {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-hourglass:after {
            content: " ";
            display: block;
            border-radius: 50%;
            width: 0;
            height: 0;
            margin: 8px;
            box-sizing: border-box;
            border: 32px solid #000;
            border-color: #000 transparent #000 transparent;
            animation: lds-hourglass 1.2s infinite;
        }

        @keyframes lds-hourglass {
            0% {
                transform: rotate(0);
                animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
            }

            50% {
                transform: rotate(900deg);
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }

            100% {
                transform: rotate(1800deg);
            }
        }

    </style>
    @if ($revisionDocumento->estatus != 1)
        <div class="row w-100 justify-content-center">
            <div class="col-sm-9">
                <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                    <div class="row w-100">
                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                            <div class="w-40 ml-3">
                                <img src="{{ asset('img/cohete.png') }}" style=width:30px;>

                            </div>
                        </div>
                        <div class="col-11">
                            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Muchas gracias</p>
                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Su respuesta ha sido enviada al
                                solicitante
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mt-4 text-center card col-7 display:inline">
                    <img src="{{ asset('img/mensaje2.png') }}">
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center w-100" style="position: relative">
            <div class="workspace-reviwer w-100 d-flex justify-content-center">
                <div class="mt-4 col-8">
                    <div class="card">
                        <h4 class="m-3 text-center text-white rounded bg-primary">Resumen</h4>

                        <div class="d-flex justify-content-center align-items-center" style="font-size: 16pt; color:black">
                            <a href="{{ asset($path_documentos_aprobacion . '/' . $documento->archivo) }}">
                                <i class="mr-2 fas fa-cloud-download-alt"></i> Descargar {{ $documento->archivo }}
                            </a>
                        </div>
                        <iframe
                            src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset($path_documentos_aprobacion . '/TestWordDoc.doc') }}'
                            width='100%' height='100%' frameborder='0'>This is an embedded <a target='_blank'
                                href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank'
                                href='http://office.com/webapps'>Office Online</a>.</iframe>
                        {{-- <iframe
                    src="https://docs.google.com/gview?url=http%3A%2F%2Ftabantaj.test%2Fstorage%2FDocumentos+en+aprobacion%2Fprocedimientos%2FTestWordDoc.doc&embedded=true"></iframe> --}}

                        <div class="card-body">
                            <form method="POST" id="form-revision">
                                <div class="form-group">
                                    <label for="comentarios">Comentarios <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="comentarios" rows="3"></textarea>
                                    <span id="comentarios-requridos" class="text-danger"></span>
                                </div>
                                <input id="revision" type="hidden" name="revision" value="{{ $revisionDocumento->id }}">
                                <button id="aprobar" class="btn btn-outline-success"><i class="mr-1 fas fa-thumbs-up"></i>
                                    Aprobar</button>
                                <button id="rechazar" class="btn btn-outline-danger"><i class="mr-1 fas fa-thumbs-down"></i>
                                    Rechazar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="c_cargando" class="cargando d-none">
                <p>ENVIANDO...</p>
                <small>Esto puede demorar unos minutos</small>
                <div class="lds-hourglass"></div>
            </div>
        </div>
    @endif

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let btnAprobar = document.getElementById('aprobar');
            let btnRechazar = document.getElementById('rechazar');
            btnAprobar.addEventListener('click', function(e) {
                e.preventDefault();
                let comentarios = CKEDITOR.instances.comentarios.getData();
                let revision = document.getElementById('revision').value;
                Swal.fire({
                    title: 'Estás seguro de aprobar el documento?',
                    text: "No podrás cambiarlo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1BB93A',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, aprobar!',
                    cancelButtonText: 'Cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('revisiones.approve') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                revision,
                                comentarios
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                document.querySelector('.workspace-reviwer').classList
                                    .add('enviando-respuesta');
                                document.getElementById('c_cargando').classList.remove(
                                    'd-none');
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.approve) {
                                    window.location.reload();
                                    Swal.fire(
                                        'APROBADO!',
                                        'Aprobaste el documento',
                                        'success'
                                    )
                                }
                            }
                        });
                    }
                })
            });
            btnRechazar.addEventListener('click', function(e) {
                e.preventDefault();
                let comentarios = CKEDITOR.instances.comentarios.getData();
                let revision = document.getElementById('revision').value;
                if (!comentarios) {
                    document.getElementById('comentarios-requridos').innerHTML =
                        "<strong>Nota:</strong> No has escrito los motivos por el cual estás rechazando el documento";
                } else {
                    document.getElementById('comentarios-requridos').innerHTML = "";
                    Swal.fire({
                        title: 'Estás seguro de rechazar el documento?',
                        text: "No podrás cambiarlo!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#B9271B',
                        cancelButtonColor: '#1B52B9',
                        confirmButtonText: 'Sí, rechazar!',
                        cancelButtonText: 'Cancelar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('revisiones.reject') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    revision,
                                    comentarios
                                },
                                dataType: "JSON",
                                beforeSend: function() {
                                    document.querySelector('.workspace-reviwer')
                                        .classList.add('enviando-respuesta');
                                    document.getElementById('c_cargando').classList
                                        .remove(
                                            'd-none');
                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.reject) {
                                        window.location.reload();
                                        Swal.fire(
                                            'RECHAZADO!',
                                            'Rechazaste el documento',
                                            'success'
                                        )
                                    }

                                }
                            });
                        }
                    })
                }

            });

            CKEDITOR.replace('comentarios', {
                toolbar: [{
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'Bold', 'Italic'
                    ]
                }, {
                    name: 'clipboard',
                    items: ['Link', 'Unlink']
                }, ]
            });
        });
    </script>
@endsection
