@extends('layouts.admin')
<style>
    #card {
        /* UI Properties */
        height: 11rem;
        background: #5397D5 0% 0% no-repeat padding-box;
        border-radius: 8px;
        opacity: 1;
        margin: 0 auto;
    }

    .h2doc {
        position: relative;
        top: -129px;
        left: 8%;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal 600 var(--unnamed-font-size-20)/27px Segoe UI;
        letter-spacing: var(--unnamed-character-spacing-0);
        color: var(--unnamed-color-ffffff);
        text-align: left;
        font: normal normal 600 20px/27px Segoe UI;
        letter-spacing: 0px;
        color: #FFFFFF;
        opacity: 1;
    }

    .pdoc {
        position: relative;
        top: -129px;
        left: 8%;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) var(--unnamed-font-size-14)/19px Segoe UI;
        letter-spacing: var(--unnamed-character-spacing-0);
        color: var(--unnamed-color-ffffff);
        text-align: left;
        font: normal normal normal 14px/19px Segoe UI;
        letter-spacing: 0px;
        color: #FFFFFF;
        opacity: 1;
    }

    .imgdoc {
        width: 140px;
        height: 140px;
        position: relative;
        top: 20px;
        left: 15px;
        /* UI Properties */
        background: transparent url('img/icono_onboarding.png') 0% 0% no-repeat padding-box;
        opacity: 1;
    }

    .small {
        width: 80%;
        margin: 0 auto;
        /* Esto centra el div horizontalmente en la página */
    }

    #btn_cancelar {
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        border-radius: 4px;
        opacity: 1;
    }
</style>
@section('content')
    {{ Breadcrumbs::render('admin.politica-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Política del Sistema de Gestión</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <br>
                <h4>¿Qué es? Política del Sistema de Gestión</h4>
                <p>
                    Es una declaración oficial de la dirección de una organización que establece sus intenciones y
                    compromisos con respecto al sistema de gestión implementado en la organización.
                </p>
                <p>
                    La Política del Sistema de Gestión sirve como un documento fundamental para alinear a toda la
                    organización en torno a los objetivos y compromisos relacionados con la calidad, el medio ambiente u
                    otros ámbitos específicos.
                </p>
            </div>
        </div>
    </div>
    <div class="mt-4 card">
        <div class="card-body">
            <h5 class="col-12 titulo_general_funcion">Política del Sistema de Gestión</h5>
            <form method="POST" action="{{ route('admin.politica-sgsis.update', [$politicaSgsi->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group anima-focus">
                    <input class="form-control {{ $errors->has('nombre_politica') ? 'is-invalid' : '' }}"
                           name="nombre_politica" id="nombre_politica"
                           value="{{ old('nombre_politica', $politicaSgsi->nombre_politica) }}" required>
                    <label for="nombre_politica" class="asterisco">Nombre de la política*</label>
                </div>

                <div class="form-group anima-focus">
                    <textarea class="form-control {{ $errors->has('politicasgsi') ? 'is-invalid' : '' }}"
                              name="politicasgsi" id="politicasgsi" required>{{ old('politicasgsi', $politicaSgsi->politicasgsi) }}</textarea>
                    <label for="politicasgsi" class="asterisco">Política del Sistema de Gestión*</label>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 anima-focus">
                        <input class="form-control date {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }}"
                               type="date" name="fecha_publicacion" id="fecha_publicacion"
                               min="1945-01-01"
                               value="{{ old('fecha_publicacion', $fecha_publicacion) }}" required>
                        <label for="fecha_publicacion" class="asterisco">Fecha de publicación*</label>
                    </div>

                    <div class="form-group col-sm-6 anima-focus">
                        <input class="form-control date {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }}"
                               type="date" name="fecha_revision" id="fecha_revision"
                               min="1945-01-01"
                               value="{{ old('fecha_revision', $fecha_revision) }}" required>
                        <label for="fecha_revision" class="asterisco">Fecha de revisión*</label>
                    </div>
                </div>


                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.politica-sgsis.index') }}" class="btn btn-outline-primary"
                        style="text-decoration: none;">Cancelar</a>
                    <button id="preloaderBtn" class="btn btn-primary" type="button" disabled style="display: none;">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Procesando...
                    </button>
                    <button id="submitBtn" class="btn tb-btn-primary" type="submit" style="color: white">
                        Guardar y enviar a aprobación
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-body">
            <h5>Historial de Comentarios</h5>
            <br>
            <h6>Comentario del colaborador.</h6>
            <ol>
                @foreach ($comentarios as $c)
                    <li>{{ $c->comentario }}</li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection


@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const submitBtn = document.getElementById('submitBtn');
        const preloaderBtn = document.getElementById('preloaderBtn');

        submitBtn.addEventListener('click', function (e) {
            // Prevenir múltiples clics
            submitBtn.style.display = 'none'; // Ocultar el botón de envío
            preloaderBtn.style.display = 'inline-block'; // Mostrar el botón preloader
        });
    });
</script>

    <script>
        $(document).ready(function() {
            CKEDITOR.replace('politicasgsi', {
                toolbar: [{
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker'],
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                    }, {
                        name: 'clipboard',
                        groups: ['undo'],
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                            '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'Blockquote',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                    },
                    '/',
                ]
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function(e) {

            let reviso_politica = document.querySelector('#id_reviso_politica');
            let area_init = reviso_politica.options[reviso_politica.selectedIndex].getAttribute('data-area');
            let puesto_init = reviso_politica.options[reviso_politica.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto_init);
            document.getElementById('area_reviso').innerHTML = recortarTexto(area_init);
            reviso_politica.addEventListener('change', function(e) {
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
