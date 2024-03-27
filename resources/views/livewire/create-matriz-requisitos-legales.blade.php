<div>
    <style>
        textarea {
            height: 225px !important;
        }

        .btn:focus {
            box-shadow: none !important;
            outline: none !important;
        }

        .select2-search.select2-search--inline {
            margin-top: -20px !important;
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

        .boton-cancel {
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

        .form {
            background: #F8FAFC;
            border-radius: 4px;
            opacity: 1;
        }

        .letra-etiqueta-flotante {
            font: 14px Roboto;
            color: #606060;
            text-align: left;
        }

        .btn {
            box-shadow: none !important;
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
    {{ Breadcrumbs::render('admin.matriz-requisito-legales.create') }}
    <x-loading-indicator />
    <h5 class="col-12 titulo_general_funcion">Matriz de Requisitos Legales y Regulatorios</h5>
        <div class="card card-body" style="background-color: #5397D5; color: #fff;">
            <div class="d-flex" style="gap: 25px;">
                <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
                <div>
                    <br>
                    <h4>¿Qué es? Matriz de Requisitos Legales y Regulatorios</h4>
                    <p>
                        Es una herramienta utilizada en el ámbito empresarial y de gestión para
                        rastrear y gestionar los requisitos legales y regulaciones aplicables a una organización.
                    </p>
                    <p>
                        Esta matriz tiene como objetivo principal ayudar a las empresas a garantizar que están
                        cumpliendo con todas las leyes, regulaciones y normativas relevantes que se aplican a sus
                        operaciones.
                    </p>
                </div>
            </div>
        </div>
        @if (session('mensajeError'))
        <div class="alert alert-danger">
            {{ session('mensajeError') }}
        </div>
        @endif

    <form wire:submit.prevent='save'>
        <div class="mt-4 card" style="border-radius: 8px;">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="form-group col-11" style="margin-bottom:0px;">
                        <p class="titulo-card" style="margin-bottom:0px;">
                            Requisito Legal
                        </p>
                    </div>
                    <div class="mb-3">
                        <hr>
                    </div>
                    <div class="form-group col-12 anima-focus">
                        <input required
                            class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }} form "
                            type="text" name="nombrerequisito" id="nombrerequisito"
                            value="{{ old('nombrerequisito', '') }}" placeholder=""
                            wire:model.defer='alcance.nombrerequisito' maxlength="255">
                        {!! Form::label('nombrerequisito', 'Nombre del requisito legal, regulatorio, contractual o estatutario*', [
                            'class' => 'asterisco',
                        ]) !!}
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="form-group col-sm-6 anima-focus">
                        <input type="text"
                            class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }} form"
                            name="formacumple" id="formacumple" value="{{ old('formacumple', '') }}"
                            aria-describedby="textExample1" placeholder="" wire:model.defer='alcance.formacumple'
                            required maxlength="255" />
                        {!! Form::label(
                            'formacumple',
                            'Cláusula,
                                                                                                                                                                                                                                sección o
                                                                                                                                                                                                                                apartado
                                                                                                                                                                                                                                aplicable*',
                            ['class' => 'asterisco'],
                        ) !!}
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-sm-6 anima-focus">
                                <input
                                    class="form-control {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }} form"
                                    type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                                    value="{{ old('fechaexpedicion') }}" wire:model.defer='alcance.fechaexpedicion'
                                    required>
                                {!! Form::label('fechaexpedicion', 'Fecha de expedición*', ['class' => 'asterisco']) !!}
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="form-group col-sm-6 anima-focus">
                                <input
                                    class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }} form"
                                    type="date" name="fechavigor" id="fechavigor" min="1945-01-01"
                                    value="{{ old('fechavigor') }}" wire:model.defer='alcance.fechavigor' required>
                                {!! Form::label('fechavigor', 'Fecha de entrada en vigor*', ['class' => 'asterisco']) !!}
                            </div>
                        </div>

                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="form-group col-sm-12 mt-4 anima-focus h-300">
                        <textarea required class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }} form"
                            style="height: 225px !important; width: 100%;" name="requisitoacumplir" placeholder="" id="requisitoacumplir"
                            wire:model.defer='alcance.requisitoacumplir'>{{ old('requisitoacumplir') }}</textarea>
                        {!! Form::label('requisitoacumplir', 'Descripción del requisito a cumplir*', ['class' => 'asterisco']) !!}
                    </div>

                    @if ($bandera)
                        <button type="button" class="btn mb-3 miFormulario" onclick="ocultarDiv()"
                            style="color: #057BE2; width:15rem; position: relative; right: .5rem;"
                            wire:click.prevent="addAlcance1">
                            Añadir nuevo Requisito
                            <i class="fa-solid fa-plus" style="color: #057BE2;"></i>
                        </button>
                    @endif

                </div>
            </div>
        </div>



        @foreach ($alcance_s1 as $key => $p)
            <div class="mt-4 card" style="border-radius: 8px;">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="form-group col-11" style="margin-bottom:0px;">
                            <p class="titulo-card" style="margin-bottom:0px;">
                                Requisito Legal
                            </p>
                        </div>
                        <div class="form-group col-1"style="margin-bottom:0px;">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn" style="background-color: white; box-shadow:none;"
                                data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $key }}">
                                <i class="fa-regular fa-trash-can fa-2xl" style="color: #606060;"></i>
                            </button>
                        </div>
                        <div class="mb-3">
                            <hr>
                        </div>
                        <div class="form-group col-12 anima-focus">
                            <input required
                                class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }} form "
                                type="text" name="nombrerequisito.{{ $key }}"
                                id="nombrerequisito.{{ $key }}" value="{{ old('nombrerequisito', '') }}"
                                placeholder=" " wire:model.defer='alcance_s1.{{ $key }}.nombrerequisito'
                                maxlength="255">
                            {!! Form::label('nombrerequisito', 'Nombre del requisito legal, regulatorio, contractual o estatutario*', [
                                'class' => 'asterisco',
                            ]) !!}
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="form-group col-sm-6 anima-focus">
                            <input type="text"
                                class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }} form"
                                name="formacumple" id="formacumple" value="{{ old('formacumple', '') }}"
                                aria-describedby="textExample1" placeholder=" " style="height:55px;"
                                wire:model.defer='alcance_s1.{{ $key }}.formacumple' required
                                maxlength="255" />
                            {!! Form::label(
                                'formacumple',
                                'Cláusula,
                                                                                                                                                                                                                                                                    sección o
                                                                                                                                                                                                                                                                    apartado
                                                                                                                                                                                                                                                                    aplicable*',
                                ['class' => 'asterisco'],
                            ) !!}
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="col-12">
                            <div class="row">
                                <div class="form-group col-sm-6 anima-focus">
                                    <input
                                        class="form-control {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }} form"
                                        type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                                        value="{{ old('fechaexpedicion') }}"
                                        wire:model.defer='alcance_s1.{{ $key }}.fechaexpedicion' required>
                                    {!! Form::label(
                                        'fechaexpedicion',
                                        'Fecha de
                                                                                                                                                                                                                                                                                                                                            publicación*',
                                        ['class' => 'asterisco'],
                                    ) !!}
                                </div>
                                <br>
                                <br>
                                <br>
                                <div class="form-group col-sm-6 anima-focus">
                                    <input
                                        class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }} form"
                                        type="date" name="fechavigor" id="fechavigor" min="1945-01-01"
                                        value="{{ old('fechavigor') }}"
                                        wire:model.defer='alcance_s1.{{ $key }}.fechavigor' required>
                                    {!! Form::label(
                                        'fechavigor',
                                        'Fecha de
                                                                                                                                                                                                                                                                                                                                            publicación*',
                                        ['class' => 'asterisco'],
                                    ) !!}
                                </div>
                            </div>

                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="form-group col-sm-12 mt-4 anima-focus h-300">
                            <textarea required class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }} form"
                                style="height: 225px !important;" name="requisitoacumplir.{{ $key }}" placeholder=""
                                id="requisitoacumplir.{{ $key }}" wire:model.defer='alcance_s1.{{ $key }}.requisitoacumplir'>{{ old('requisitoacumplir') }}</textarea>
                            {!! Form::label('requisitoacumplir', 'Descripción del requisito a cumplir*', ['class' => 'asterisco']) !!}
                        </div>


                        <button type="button" class="btn mb-3 nuevo-requisito-btn" wire:click.prevent="addAlcance1"
                            style="color: #057BE2; width:15rem; position: relative; right: .5rem;">
                            Añadir nuevo Requisito
                            <i class="fa-solid fa-plus" style="color: #057BE2;"></i>
                        </button>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal_{{ $key }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="margin-top: 150px;">
                                <div class="modal-content text-center">
                                    <div class="modal-body">
                                        <div class="mt-5 mb-3" style="font:20px Segoe UI;color:#306BA9;">
                                            ¿Estás seguro que deseas eliminar este elemento?
                                        </div>
                                        <i class="mt-5 mb-5 fa-regular fa-trash-can fa-2xl"
                                            style="color: #606060;"></i>
                                        <div class="row mb-5 mt-2">
                                            <div class="col-md-6" style="padding-left: 50px;">
                                                <button type="button" class="btn btn-outline-primary"
                                                    style="width: 175px;
                                                    height: 39px;font:14px Roboto;border: 1px solid;color:#057BE2;border-radius:6px;"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                            <div class="col-md-6"
                                                style="
                                            padding-right: 50px;">
                                                <button type="button" data-bs-dismiss="modal"
                                                    class="btn btn-primary"
                                                    style="width: 175px;
                                                    height: 39px;box-shadow:none;border-radius:6px;"
                                                    wire:click.prevent="removeAlcance1({{ $key }})">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-right form-group col-12">
            <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir_helper') }}
            </span>
            <a href="#" class="btn" id="btn_cancelar" style="color:#057BE2; height:3rem;"
                onclick="confirmarCancelar()">
                <div class="mt-2">Cancelar</div>
            </a>
            <button class="btn boton-enviar ml-2 mr-2" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </form>
</div>
{{-- @endsection --}}


<script>
    document.addEventListener('livewire:load', function() {
        Livewire.hook('element.updated', (el, component) => {
            // Después de actualizar el componente, verifica si hay nuevos requisitos
            const btns = el.querySelectorAll('.nuevo-requisito-btn');

            btns.forEach(btn => {
                const tarjeta = btn.getAttribute('data-tarjeta');
                const tarjetaEl = el.querySelector(`[data-tarjeta="${tarjeta}"]`);

                if (tarjetaEl && tarjetaEl.querySelector('.btn')) {
                    // Oculta el botón en la tarjeta actual y muestra en las nuevas
                    tarjetaEl.querySelector('.btn').style.display = 'none';
                }
            });
        });
    });
</script>

<script>
    function confirmarCancelar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Realmente deseas cancelar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#ffffff',
            cancelButtonText: '<span style="color: #057BE2; border: 1px solid var(--unnamed-color-057be2); border-radius: 4px; opacity: 1;">Cancelar</span>',
            confirmButtonText: 'Sí, estoy seguro'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirige si el usuario hace clic en "Sí, estoy seguro"
                window.location.href = "{{ route('admin.matriz-requisito-legales.index') }}";
            }
        });
    }
</script>
