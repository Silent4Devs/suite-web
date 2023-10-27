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
    <h5 class="col-12 titulo_general_funcion"> Registrar: Determinación de Alcance</h5>
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
            <form method="POST" action="{{ route('admin.alcance-sgsis.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="form-floating" style="font-size:5px:; color:#057BE2;">
                        <input class="form-control form"placeholder="Agrega un nombre al alcance" id="floatingTextarea"
                            id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                        <label for="floatingTextarea" style="color: #606060;">Nombre del alcance</label>
                    </div>
                </div>
                <div class="form-floating">
                    <input required class="form-control {{ $errors->has('alcancesgsi') ? 'is-invalid' : '' }} form"
                        name="alcancesgsi" id="alcancesgsi" value="{{ old('alcancesgsi') }}">
                    <label for="alcancesgi" style="color: #606060;">Alcance</label>
                </div>
        </div>

        <div class="row mt-2 ml-1 mb-4">
            <div class="form-floating col-md-6" style="width:565px;">
                <input required class="form-control {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }} form"
                    type="date" name="fecha_publicacion" id="fecha_publicacion" min="1945-01-01"
                    value="{{ old('fecha_publicacion') }}"style="font-size:5px:;color: #606060;">
                @if ($errors->has('fecha_publicacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_publicacion') }}
                    </div>
                @endif
                <label class="required ml-2" for="fecha_publicacion" style="color: #606060;">Fecha de Publicacion</label>
            </div>
            {{-- <div class="form-group col-sm-6">
                <label class="required" for="fecha_publicacion">
                    Fecha de
                    publicación</label>
                <input required class="form-control {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }}"
                    type="date" name="fecha_publicacion" id="fecha_publicacion" min="1945-01-01"
                    value="{{ old('fecha_publicacion') }}">
                @if ($errors->has('fecha_publicacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_publicacion') }}
                    </div>
                @endif
            </div> --}}

            {{-- <div class="form-group col-sm-4">
                        <label class="required" for="fecha_entrada"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                            entrada en
                            vigor</label>
                        <input required class="form-control {{ $errors->has('fecha_entrada') ? 'is-invalid' : '' }}"
                            type="date" name="fecha_entrada" id="fecha_entrada" min="1945-01-01"
                            value="{{ old('fecha_entrada') }}">
                        @if ($errors->has('fecha_entrada'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_entrada') }}
                            </div>
                        @endif
                    </div> --}}
            <div class="form-floating col-md-6" style="width:565px;">
                <input required class="form-control {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }} form"
                    type="date" name="fecha_revision" id="fecha_revision" min="1945-01-01"
                    value="{{ old('fecha_revision') }}">
                @if ($errors->has('fecha_publicacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_publicacion') }}
                    </div>
                @endif
                <label class="required ml-2" for="fecha_revision">Fecha
                    de
                    revisión</label>
            </div>

            {{-- <div class="form-group col-sm-6">
                <label class="required" for="fecha_revision">Fecha
                    de
                    revisión</label>
                <input required class="form-control {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }}"
                    type="date" name="fecha_revision" id="fecha_revision" min="1945-01-01"
                    value="{{ old('fecha_revision') }}">
                @if ($errors->has('fecha_revision'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_revision') }}
                    </div>
                @endif
            </div> --}}
        </div>
    </div>
    </form>
    </div>
    <div class="text-right form-group col-12">
        <a type="button" href="{{ route('admin.alcance-sgsis.index') }}" class="btn boton-cancelar">
            <div class="mt-2">Cancelar</div>
        </a>
        <button type="button" class="btn boton-enviar ml-1 mr-2" type="submit" style="font-size:14px;width:250px;">
            {{ trans('global.save') }} y enviar a aprobación
        </button>
    </div>
@endsection

@section('scripts')
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
