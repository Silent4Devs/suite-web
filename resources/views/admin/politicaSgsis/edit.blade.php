@extends('layouts.admin')
<style>
<<<<<<< HEAD
    #card{
=======
    #card {
>>>>>>> origin/release/experiencia_usuario_s3
        /* UI Properties */
        height: 11rem;
        background: #5397D5 0% 0% no-repeat padding-box;
        border-radius: 8px;
        opacity: 1;
        margin: 0 auto;
    }
<<<<<<< HEAD
    .h2doc{
=======

    .h2doc {
>>>>>>> origin/release/experiencia_usuario_s3
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
<<<<<<< HEAD
    .pdoc{
=======

    .pdoc {
>>>>>>> origin/release/experiencia_usuario_s3
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
<<<<<<< HEAD
    .imgdoc{
=======

    .imgdoc {
>>>>>>> origin/release/experiencia_usuario_s3
        width: 140px;
        height: 140px;
        position: relative;
        top: 20px;
        left: 15px;
        /* UI Properties */
        background: transparent url('img/icono_onboarding.png') 0% 0% no-repeat padding-box;
        opacity: 1;
    }
<<<<<<< HEAD
    .small {
          width: 80%;
          margin: 0 auto; /* Esto centra el div horizontalmente en la página */
        }

    #btn_cancelar{
    background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
    border: 1px solid var(--unnamed-color-057be2);
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #057BE2;
    border-radius: 4px;
    opacity: 1;
=======

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
>>>>>>> origin/release/experiencia_usuario_s3
    }
</style>
@section('content')
    {{ Breadcrumbs::render('admin.politica-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Política del Sistema de Gestión</h5>
    <div class="mt-4 card" id="card">
<<<<<<< HEAD
        <img src="{{ url('politicas.png') }}" class="imgdoc" >
        <div class="small">
          <h2 class="h2doc">¿Qué es? Política del Sistema de Gestión</h2>
          <p class="pdoc">Es una declaración oficial de la dirección de una organización que establece sus intenciones y compromisos con respecto al sistema de gestión implementado en la organización. <br> <br> La Política del Sistema de Gestión sirve como un documento fundamental para alinear a toda la organización en torno a los objetivos y compromisos relacionados con la calidad, el medio ambiente u otros ámbitos específicos.</p>
=======
        <img src="{{ url('politicas.png') }}" class="imgdoc">
        <div class="small">
            <h2 class="h2doc">¿Qué es? Política del Sistema de Gestión</h2>
            <p class="pdoc">Es una declaración oficial de la dirección de una organización que establece sus intenciones y
                compromisos con respecto al sistema de gestión implementado en la organización. <br> <br> La Política del
                Sistema de Gestión sirve como un documento fundamental para alinear a toda la organización en torno a los
                objetivos y compromisos relacionados con la calidad, el medio ambiente u otros ámbitos específicos.</p>
>>>>>>> origin/release/experiencia_usuario_s3
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
<<<<<<< HEAD
                        {!! Form::label('nombre_politica', 'Nombre de la política*', ['class' => 'asterisco']) !!}
=======
                    {!! Form::label('nombre_politica', 'Nombre de la política*', ['class' => 'asterisco']) !!}
>>>>>>> origin/release/experiencia_usuario_s3
                </div>

                <div class="form-group anima-focus">
                    <textarea class="form-control {{ $errors->has('politicasgsi') ? 'is-invalid' : '' }}" name="politicasgsi"
                        id="politicasgsi" required>{{ old('politicasgsi', $politicaSgsi->politicasgsi) }}</textarea>
<<<<<<< HEAD
                        {!! Form::label('politicasgsi', 'Política del Sistema de Gestión*', ['class' => 'asterisco']) !!}
=======
                    {!! Form::label('politicasgsi', 'Política del Sistema de Gestión*', ['class' => 'asterisco']) !!}
>>>>>>> origin/release/experiencia_usuario_s3
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 anima-focus">
<<<<<<< HEAD
                        <input required class="form-control date  {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }}"
                            type="date" name="fecha_publicacion" id="fecha_publicacion" min="1945-01-01"
                            value="{{ old('fecha_publicacion', \Carbon\Carbon::parse($politicaSgsi->fecha_publicacion))->format('Y-m-d') }}">
                            {!! Form::label('fecha_publicacion', 'Fecha de publicación*', ['class' => 'asterisco']) !!}
=======
                        <input required
                            class="form-control date  {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }}"
                            type="date" name="fecha_publicacion" id="fecha_publicacion" min="1945-01-01"
                            value="{{ old('fecha_revision', $fecha_publicacion) }}">
                        {!! Form::label('fecha_publicacion', 'Fecha de publicación*', ['class' => 'asterisco']) !!}
>>>>>>> origin/release/experiencia_usuario_s3
                    </div>

                    <div class="form-group col-sm-6 anima-focus">
                        <input required class="form-control date {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }}"
                            type="date" name="fecha_revision" id="fecha_revision" min="1945-01-01"
<<<<<<< HEAD
                            value="{{ old('fecha_revision', \Carbon\Carbon::parse($politicaSgsi->fecha_revision))->format('Y-m-d') }}">
                            {!! Form::label('fecha_revision', 'Fecha de revision*', ['class' => 'asterisco']) !!}
=======
                            value="{{ old('fecha_revision', $fecha_revision) }}">
                        {!! Form::label('fecha_revision', 'Fecha de revision*', ['class' => 'asterisco']) !!}
>>>>>>> origin/release/experiencia_usuario_s3
                    </div>

                </div>

                <div class="text-right form-group col-12">
<<<<<<< HEAD
                    <a href="{{ route('admin.politica-sgsis.index') }}" class="btn" style="color: #5397D5" id="btn_cancelar">Cancelar</a>
=======
                    <a href="{{ route('admin.politica-sgsis.index') }}" class="btn" style="color: #5397D5"
                        id="btn_cancelar">Cancelar</a>
>>>>>>> origin/release/experiencia_usuario_s3
                    <button class="btn btn-primary" type="submit" style="color: white">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-body">
<<<<<<< HEAD
         <h5>Historial Comentarios Alta dirección</h5>
         <br>
         <h6>COMENTARIO DEL COLABORADOR</h6>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse blanditiis reiciendis eaque vitae velit odit amet magnam nulla quos, fugit eius neque iure labore rem voluptate repudiandae sed, accusantium soluta.</p>
        </div>
    </div>






=======
            <h5>Historial Comentarios Alta dirección</h5>
            <br>
            <h6>COMENTARIO DEL COLABORADOR</h6>
            <ol>
                @foreach ($comentarios as $c)
                    <li>{{ $c->comentario }}</li>
                @endforeach
            </ol>
        </div>
    </div>
>>>>>>> origin/release/experiencia_usuario_s3
@endsection


@section('scripts')
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
