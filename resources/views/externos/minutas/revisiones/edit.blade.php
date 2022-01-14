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
    @if ($revisionMinuta->estatus != 1)
        <div class="row w-100 justify-content-center">
            <div class="col-sm-9">
                <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
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
        <div class="m-0 row justify-content-center w-100" style="position: relative">
            <div class="workspace-reviwer w-100 d-flex justify-content-center">
                <div class="card w-100">
                    <h4 class="m-3 text-center text-white rounded bg-primary">Resumen</h4>
                    <div class="p-3 w-100 row">
                        <div class="col-sm-12 col-lg-6">
                            <label for="comentarios"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                    <path
                                        d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                </svg> Previsualizacion dla minuta: <strong>{{ $minuta->documento }}</strong>
                            </label>
                            <iframe src="{{ asset('storage/minutas/' . 'en aprobacion/' . $minuta->documento) }}"
                                class="w-100" style="height: 500px" frameborder="0"></iframe>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <form method="POST" id="form-revision">
                                <div class="form-group">
                                    <label for="comentarios"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                            <path
                                                d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                            <path
                                                d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                                        </svg> Comentarios <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="comentarios" rows="3"></textarea>
                                    <span id="comentarios-requridos" class="text-danger"></span>
                                </div>
                                <input id="revision" type="hidden" name="revision" value="{{ $revisionMinuta->id }}">
                                <button id="aprobar" class="btn btn-outline-success"><i class="mr-1 fas fa-thumbs-up"></i>
                                    Aprobar</button>
                                <button id="rechazar" class="btn btn-outline-danger"><i class="mr-1 fas fa-thumbs-down"></i>
                                    Rechazar</button>
                            </form>
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
                    title: 'Estás seguro de aprobar la minuta?',
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
                            url: "{{ route('minutas.revisiones.approve') }}",
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
                                        'Aprobaste la minuta',
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
                        "<strong>Nota:</strong> No has escrito los motivos por el cual estás rechazando la minuta";
                } else {
                    document.getElementById('comentarios-requridos').innerHTML = "";
                    Swal.fire({
                        title: 'Estás seguro de rechazar la minuta?',
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
                                url: "{{ route('minutas.revisiones.reject') }}",
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
                                            'Rechazaste la minuta',
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
