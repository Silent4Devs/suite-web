@extends('layouts.admin')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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
    </style>

    {{ Breadcrumbs::render('admin.matriz-requisito-legales.create') }}
    <h5 class="col-12 titulo-matriz">Editar: Matriz de Requisitos Legales</h5>
    <div class="card radius" style="background-color: #5397D5;">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:150px; height:137px;"
                    class="mt-3 mb-3 ml-3 img-fluid">
            </div>
            <div class="col-md-10 mt-3">
                <div style="font:20px Segoe UI;color:white;" class="mr-2">
                    ¿Qué es? Matriz de Requisitos Legales y Regulatorios
                </div>
                <div style="font: 14px Segoe UI;color:white;"class="mt-3 mr-2">
                    Es una herramienta utilizada en el ámbito empresarial y de gestión para
                    rastrear y gestionar los requisitos legales y regulaciones aplicables a una organización.
                </div>
                <div style="font: 12px Segoe UI;color:white;"class="mr-5 mt-3 mb-3">
                    Esta matriz tiene como objetivo principal ayudar a las empresas a garantizar que están
                    cumpliendo con todas las leyes, regulaciones y normativas relevantes que se aplican a sus
                    operaciones.
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 card" style="border-radius: 8px;">
        <div class="card-body pb-0">
            <form method="POST" class="row"
                action="{{ route('admin.matriz-requisito-legales.update', [$matrizRequisitoLegale->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-12">
                    <p class="titulo-card" style="">
                        Requisito Legal
                    </p>
                    <hr>
                </div>
                <div class="form-group col-12 anima-focus">
                        <input class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }} form"
                            type="text" name="nombrerequisito" id="nombrerequisito" placeholder=""
                            value="{{ old('nombrerequisito', $matrizRequisitoLegale->nombrerequisito) }}" required>
                        @if ($errors->has('nombrerequisito'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombrerequisito') }}
                            </div>
                        @endif
                        {!! Form::label('nombrerequisito', 'Nombre del requisito legal, regulatorio, contractual o estatutario*', ['class' => 'asterisco']) !!}
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="form-group col-md-12 anima-focus">
                        <input class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }} form"
                            type="text" name="formacumple" id="formacumple"
                            value="{{ old('formacumple', $matrizRequisitoLegale->formacumple) }}"
                            placeholder=""
                        required>
                        @if ($errors->has('formacumple'))
                            <div class="invalid-feedback">
                                {{ $errors->first('formacumple') }}
                            </div>
                        @endif
                        {!! Form::label('formacumple', 'Cláusula, sección o
                        apartado
                        aplicable*', ['class' => 'asterisco']) !!}
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="row" style="padding-right:0px;">
                    <div class="form-group col-md-6 anima-focus">
                            <input class="form-control date {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }} form"
                                type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                                value="{{ old('fechaexpedicion', $matrizRequisitoLegale->fechaexpedicion ? \Carbon\Carbon::parse($matrizRequisitoLegale->fechaexpedicion)->format('Y-m-d') : null) }}"
                                placeholder="" required>
                            @if ($errors->has('fechaexpedicion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechaexpedicion') }}
                                </div>
                            @endif
                            {!! Form::label('fechaexpedicion', 'Fecha de expedición*', ['class' => 'asterisco']) !!}
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="form-group col-md-6 anima-focus">
                            <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }} form"
                                type="date" name="fechavigor" id="fechavigor" min="1945-01-01"
                                value="{{ old('fechavigor', $matrizRequisitoLegale->fechavigor ? \Carbon\Carbon::parse($matrizRequisitoLegale->fechavigor)->format('Y-m-d') : null) }}"
                                placeholder="" style="" required>
                            @if ($errors->has('fechavigor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechavigor') }}
                                </div>
                            @endif
                            {!! Form::label('fechavigor', 'Fecha de entrada en vigor*', ['class' => 'asterisco']) !!}
                    </div>

                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="form-group col-sm-12 anima-focus">
                        <textarea class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }} form" type="text"
                            name="requisitoacumplir" id="requisitoacumplir" placeholder=" " required>{{ old('requisitoacumplir', $matrizRequisitoLegale->requisitoacumplir) }}</textarea>
                        @if ($errors->has('requisitoacumplir'))
                            <div class="invalid-feedback">
                                {{ $errors->first('requisitoacumplir') }}
                            </div>
                        @endif
                        {!! Form::label('requisitoacumplir', 'Requisitos a cumplir*', ['class' => 'asterisco']) !!}
                </div>



                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn_cancelar" style="text-decoration: none;">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>



                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                @if (count($matrizRequisitoLegale->evidencias_matriz))
                                    <!-- carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                        <ol class='carousel-indicators'>
                                            @foreach ($matrizRequisitoLegale->evidencias_matriz as $idx => $evidencia)
                                                <li data-target=#carouselExampleIndicators
                                                    data-slide-to={{ $idx }}></li>
                                            @endforeach

                                        </ol>
                                        <div class='carousel-inner'>
                                            @foreach ($matrizRequisitoLegale->evidencias_matriz as $idx => $evidencia)
                                                <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                    <iframe style="width:100%;height:300px;" seamless class='img-size'
                                                        src="{{ asset('storage/matriz_evidencias') }}/{{ $evidencia->evidencia }}"></iframe>
                                                </div>
                                            @endforeach


                                        </div>
                                        <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button'
                                            data-slide='prev'>
                                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Previous</span>
                                        </a>
                                        <a class='carousel-control-next' href='#carouselExampleIndicators' role='button'
                                            data-slide='next'>
                                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Next</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <h3 style="text-align:center" class="mt-3">Sin
                                            archivo agregado</h3>
                                        <img src="{{ asset('img/undrawn.png') }}" class="img-fluid "
                                            style="width:350px !important">
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cumple = document.getElementById('cumplerequisito');
            cumple.addEventListener('change', function(e) {
                let respuesta = e.target.value;
                if (respuesta == 'No') {
                    $("#plan_accion_select").show(1000);
                } else {
                    $("#plan_accion_select").hide(1000);
                }
            })

            let responsable = document.querySelector('#id_reviso');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_reviso').innerHTML = puesto_init;
            document.getElementById('area_reviso').innerHTML = area_init;
            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_reviso').innerHTML = puesto;
                document.getElementById('area_reviso').innerHTML = area;
            })
        })
    </script>
    <script type="text/javascript">
        Livewire.on('planStore', () => {

            $('#planAccionModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Plan de Acción creado con éxito');
        });
        window.initSelect2 = () => {
            $('.select2').select2({
                'theme': 'bootstrap4'
            });
        }

        initSelect2();

        Livewire.on('select2', () => {
            initSelect2();
        });
    </script>
@endsection
