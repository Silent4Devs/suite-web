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

        .form {
            background: #F8FAFC;
            border-radius: 4px;
            opacity: 1;
        }

        .titulo-matriz {
            text-align: left;
            font: 20px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        .radius {
            border-radius: 16px;
            box-shadow: none;
        }

        .titulo-card {
            text-align: left;
            font: 20px Roboto;
            color: #306BA9;
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

        .borde-color {
            border-radius: 8px;
            border-color: black;
            background-color: white;
        }

        .letra-etiqueta-flotante {
            font: 14px Roboto;
            color: #606060;
            text-align: left;
        }
    </style>

    {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Determinación de Alcance </h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <h4> ¿Qué es? Determinación de Alcance</h4>
                <p>
                    Define y documenta de manera detallada qué trabajo se llevará a cabo y qué no se incluirá dentro de los
                    límites del proyecto.
                </p>
                <p>
                    Es un paso crucial que establece las bases para la planificación y ejecución exitosa de un proyecto, ya
                    que ayuda a evitar
                    la expansión no controlada del proyecto y asegura que todas las partes involucradas tengan una
                    comprensión clara de lo que se espera.
                </p>
            </div>
        </div>
    </div>

    <div class="mt-4 card radius">

        <div class="card-body">
            <h5 class="titulo-card">Alcance</h5>
            <hr>
            <form method="POST" id="formularioAprobacion" action="{{ route('admin.alcance-sgsis.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group anima-focus">
                    <input
                    class="form-control form"
                    placeholder=""
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                    maxlength="255"
                    pattern="[a-zA-Z0-9\s\u00C0-\u024F\u1E00-\u1EFF\u0400-\u04FF\u0500-\u052F\u2DE0-\u2DFF\uA640-\uA69F\uA720-\uA7FF\uAB30-\uAB6F\uAC00-\uD7AF\u3040-\u309F\u30A0-\u30FF\u4E00-\u9FFF\u3400-\u4DBF\u20000-\u2A6DF\u2A700-\u2B73F\u2B740-\u2B81F\u2B820-\u2CEAF\u2CEB0-\u2EBEF]+"
                    title="Por favor, introduce un nombre válido con un máximo de 255 caracteres y caracteres de varios idiomas." >

                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                        {!! Form::label('nombre', 'Nombre del alcance*', ['class' => 'asterisco']) !!}
                </div>
                <div class="form-group anima-focus">
                    <input required  maxlength="255"  pattern="[a-zA-Z0-9\s\u00C0-\u024F\u1E00-\u1EFF\u0400-\u04FF\u0500-\u052F\u2DE0-\u2DFF\uA640-\uA69F\uA720-\uA7FF\uAB30-\uAB6F\uAC00-\uD7AF\u3040-\u309F\u30A0-\u30FF\u4E00-\u9FFF\u3400-\u4DBF\u20000-\u2A6DF\u2A700-\u2B73F\u2B740-\u2B81F\u2B820-\u2CEAF\u2CEB0-\u2EBEF]+"  class="form-control {{ $errors->has('alcancesgsi') ? 'is-invalid' : '' }} form"
                        name="alcancesgsi" id="alcancesgsi" value="{{ old('alcancesgsi') }}"placeholder="">
                        {!! Form::label('alcancesgsi', 'Alcance*', ['class' => 'asterisco']) !!}
                </div>
        </div>

        <div class="row mb-3" style="padding-left:18px; padding-right:18px;">
            <div class="form-group anima-focus col-sm-6">
                <input required class="form-control {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }} form"
                    type="date" name="fecha_publicacion" id="fecha_publicacion" min="1945-01-01"
                    value="{{ old('fecha_publicacion') }}" placeholder="">
                @if ($errors->has('fecha_publicacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_publicacion') }}
                    </div>
                @endif
                {!! Form::label('fecha_publicacion', 'Fecha de publicación*', ['class' => 'asterisco']) !!}

            </div>
            <div class="form-group anima-focus col-sm-6" style="">
                <input required class="form-control {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }} form"
                    placeholder="Fecha de publicación" type="date" name="fecha_revision" id="fecha_revision"
                    min="1945-01-01" value="{{ old('fecha_revision') }}" placeholder="">
                @if ($errors->has('fecha_revision'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_revision') }}
                    </div>
                @endif
                {!! Form::label('fecha_revision', 'Fecha de revision*', ['class' => 'asterisco']) !!}
            </div>
        </div>
    </div>
    </form>
    </div>
    <div class="text-right form-group col-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn boton-cancelar" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Cancelar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top: 150px;">
                <div class="modal-content text-center">
                    <div class="modal-body">
                        <img src="{{ asset('assets/safe.jpg') }}" alt="jpg" style="width: 59px;height: 59px;"
                            class="mt-5 mb-2 ml-2 img-fluid">
                        <div class="mt-3 mb-3" style="font:22px Segoe UI;font-weight: bold;">
                            ¿Estas seguro que deseas cancelar?</div>
                        <div>
                            <a href="{{ route('admin.alcance-sgsis.index') }}">
                                <button type="button" class="mt-2 btn boton-cancelar">Si,
                                    cancelar</button>
                            </a>
                        </div>
                        <div>
                            <button type="button" class="mt-1 mb-4 btn btn-link" style="font:14px Roboto;"
                                data-bs-dismiss="modal">Regresar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <a href="{{ route('admin.alcance-sgsis.index') }}"> --}}
        <button onclick="redirigirARuta()" type="button" class="btn btn-primary boton-enviar mr-2" data-bs-toggle="modal"
            data-bs-target="#aprobacion" style="font-size:14px;width:250px;">
            {{ trans('global.save') }} y enviar a aprobación
        </button>

        <!-- Modal -->
        <div class="modal fade" id="aprobacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="aprobacionLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top: 150px;">
                <div class="modal-content text-center">
                    <div class="modal-body">
                        <img src="{{ asset('assets/check.png') }}" alt="png"
                            style="margin-top:70px;width: 59px; height: 42px;" class="mb-2 ml-2 img-fluid">
                        <div class="mt-3" style="margin-bottom:100px; font:22px Segoe UI; font-weight: bold;">
                            ¡El Formulario ha sido creado con éxito!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function redirigirARuta() {

            document.getElementById('formularioAprobacion').submit();

            setTimeout(function() {
                window.location.href = "{{ route('admin.alcance-sgsis.index') }}";
            }, 3000); // 10000 milisegundos (10 segundos)
        }
    </script>
    <script>
        $(document).ready(function() {
            {
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
                    '/',


                    // {
                    //     name: 'others',
                    //     items: ['-']
                    // }
                ]
            });
        // $('.controles-select').select2({
        //     'theme': 'bootstrap4'
        // });

        });
    </script>

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
