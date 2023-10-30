@extends('layouts.admin')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .radius {
            border-radius: 16px;
            box-shadow: none;
        }

        .titulo-card {
            text-align: left;
            font: 20px Roboto;
            color: #606060;
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

        .boton-enviar {
            background-color: #057BE2;
            border-color: #057BE2;
            font: 14px Roboto;
            color: white;
            border-radius: 4px;
            width: 148px;
            height: 48px;
        }

        .form {
            background: #F8FAFC;
            border-radius: 4px;
            opacity: 1;
        }
    </style>
    {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Determinación de Alcance</h5>

    <div class="card radius" style="background-color: #5397D5;">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:140px; height:117px;"
                    class="mt-2 mb-2 ml-2 img-fluid">
            </div>
            <div class="col-md-10 mt-2">
                <div style="font:20px Segoe UI;color:white;" class="mr-2">
                    ¿Qué es? Determinación de Alcance
                </div>
                <div style="font: 14px Segoe UI;color:white;"class="mt-3 mr-2">
                    Define y documenta de manera detallada qué trabajo se llevará a cabo y qué no se incluirá dentro de los
                    límites del proyecto.
                </div>
                <div style="font: 12px Segoe UI;color:white;"class="mr-5 mt-3 mb-3">
                    Es un paso crucial que establece las bases para la planificación y ejecución exitosa de un proyecto, ya
                    que ayuda a evitar
                    la expansión no controlada del proyecto y asegura que todas las partes involucradas tengan una
                    comprensión clara de lo que se espera.
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 card radius">

        <div class="card-body">
            <h5 class="titulo-card">Alcance</h5>
            <hr>
            <form method="POST" action="{{ route('admin.alcance-sgsis.update', [$alcanceSgsi->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <div class="form-floating form" style="">
                        <input class="form-control form" placeholder="Agrega un nombre al alcance"id="nombre"
                            name="nombre"value="{{ old('nombre', $alcanceSgsi->nombre) }}" required>
                        <label for="nombre" style="color: #606060;">
                            Nombre de Alcance
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-3">
                        <textarea required class="form-control {{ $errors->has('alcancesgsi') ? 'is-invalid' : '' }} form" name="alcancesgsi"
                            id="alcancesgsi" style="height:200px;">{!! old('alcancesgsi', strip_tags($alcanceSgsi->alcancesgsi)) !!}</textarea>
                        @if ($errors->has('alcancesgsi'))
                            <div class="invalid-feedback">
                                {{ $errors->first('alcancesgsi') }}
                            </div>
                        @endif
                        <label for="alcancesgsi" style="color: #606060;">
                            Alcance
                        </label>
                    </div>
                    <div class="row">
                        <div class="form-floating col-sm-6">
                            <input required
                                class="form-control {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }} form"
                                type="date" name="fecha_publicacion" id="fecha_publicacion" min="1945-01-01"
                                value="{{ old('fecha_publicacion', \Carbon\Carbon::parse($alcanceSgsi->fecha_publicacion)->format('Y-m-d')) }}">
                            @if ($errors->has('fecha_publicacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_publicacion') }}
                                </div>
                            @endif
                            <label class="required" for="fecha_publicacion" style="color: #606060;">Fecha de
                                publicación</label>
                        </div>


                        <div class="form-floating col-sm-6 mb-3">
                            <input required
                                class="form-control {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }} form"
                                type="date" name="fecha_revision" id="fecha_revision" min="1945-01-01"
                                value="{{ old('fecha_revision', \Carbon\Carbon::parse($alcanceSgsi->fecha_revision)->format('Y-m-d')) }}">
                            @if ($errors->has('fecha_revision'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_revision') }}
                                </div>
                            @endif
                            <label class="required" for="fecha_revision" style="padding-right:26px;">Fecha
                                de revisión
                            </label>
                        </div>
                    </div>


                    <div class="text-right form-group col-12">
                        <a href="{{ route('admin.alcance-sgsis.index') }}" class="btn_cancelar">Cancelar</a>
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
            </form>
        </div>
    @endsection


    @section('scripts')
        {{-- <script>
            $(document).ready(function() {
                CKEDITOR.replace('alcancesgsi', {
                    toolbar: [
                        // {
                        //     name: 'styles',
                        //     items: ['Styles', 'Format', 'Font', 'FontSize']
                        // },
                        // {
                        //     name: 'colors',
                        //     items: ['TextColor', 'BGColor']
                        // },
                        // {
                        //     name: 'editing',
                        //     groups: ['find', 'selection', 'spellchecker'],
                        //     items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                        // }, {
                        //     name: 'clipboard',
                        //     groups: ['undo'],
                        //     items: ['Undo', 'Redo']
                        // },
                        // {
                        //     name: 'tools',
                        //     items: ['Maximize']
                        // },
                        // {
                        //     name: 'basicstyles',
                        //     groups: ['basicstyles', 'cleanup'],
                        //     items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                        //         '-',
                        //         'CopyFormatting', 'RemoveFormat'
                        //     ]
                        // },
                        // {
                        //     name: 'paragraph',
                        //     groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        //     items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        //         'Blockquote',
                        //         '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                        //         'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        //     ]
                        // },
                        // {
                        //     name: 'links',
                        //     items: ['Link', 'Unlink']
                        // },
                        // {
                        //     name: 'insert',
                        //     items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                        // },
                        // '/',


                        // // {
                        // //     name: 'others',
                        // //     items: ['-']
                        // // }
                    ]
                });
                // $('.controles-select').select2({
                //     'theme': 'bootstrap4'
                // });

            });
        </script> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function(e) {

                let reviso_alcance = document.querySelector('#id_reviso_alcance');
                let area_init = reviso_alcance.options[reviso_alcance.selectedIndex].getAttribute('data-area');
                let puesto_init = reviso_alcance.options[reviso_alcance.selectedIndex].getAttribute('data-puesto');

                document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto_init);
                document.getElementById('area_reviso').innerHTML = recortarTexto(area_init);
                reviso_alcance.addEventListener('change', function(e) {
                    e.preventDefault();
                    let area = this.options[this.selectedIndex].getAttribute('data-area');
                    let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                    document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto);
                    document.getElementById('area_reviso').innerHTML = recortarTexto(area);
                })

            })

            function recortarTexto(texto, length = 30) {
                let trimmedString = texto?.length > length ?
                    texto.substring(0, length - 3) + "..." :
                    texto;
                return trimmedString;
            }
        </script>
    @endsection
