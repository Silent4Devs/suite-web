@extends('layouts.admin')
@section('content')
    <style>
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
    <h5 class="col-12 titulo-matriz">Matriz de Requisitos Legales y Regulatorios</h5>
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
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px">
        <h3 class="mb-1 text-center text-white"><strong>Registrar:</strong> Matriz de Requisitos Legales </h3>
    </div> --}}

        <div class="card-body pb-0">
            <form method="POST" action="{{ route('admin.matriz-requisito-legales.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-12">
                    <p class="titulo-card" style="">
                        Requisito Legal
                    </p>
                    <hr>
                </div>

                <div class="form-group col-12">
                    <div class="form-floating">
                        <input required class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }} form "
                            type="text" name="nombrerequisito" id="nombrerequisito"
                            value="{{ old('nombrerequisito', '') }}" style="height:55px;"
                            placeholder="Nombre del requisito legal, regulatorio, contractual o estatutario">
                        @if ($errors->has('nombrerequisito'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombrerequisito') }}
                            </div>
                        @endif
                        <label style="color:#606060;font-size:14px;" for="nombrerequisito">
                            Nombre del requisito legal, regulatorio, contractual o estatutario</label>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <div class="form-floating">
                        <input type="text"
                            class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }} form"
                            name="formacumple" id="formacumple" value="{{ old('formacumple', '') }}"
                            aria-describedby="textExample1" placeholder="Cláusula, sección o apartado aplicable*"
                            style="height:55px;" />
                        <label class="" style="color:#606060;font-size:14px;" for="formacumple">Cláusula, sección o
                            apartado
                            aplicable*</label>
                    </div>
                </div>

                @if ($errors->has('formacumple'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formacumple') }}
                    </div>
                @endif

                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.formacumple_helper') }}</span>
        </div>

        <div class="row" style="padding-left:24px; padding-right:24px;">
            <div class="col-sm-6">
                <div class="form-floating">
                    <input class="form-control {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }} form"
                        type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                        value="{{ old('fechaexpedicion') }}">
                    @if ($errors->has('fechaexpedicion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechaexpedicion') }}
                        </div>
                    @endif
                    <label for="fechaexpedicion"></i> Fecha de
                        publicación</label>
                </div>
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion_helper') }}</span>
            </div>
            <div class="col-sm-6">
                <div class="form-floating">
                    <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }} form"
                        type="date" name="fechavigor" id="fechavigor" min="1945-01-01" value="{{ old('fechavigor') }}">
                    @if ($errors->has('fechavigor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechavigor') }}
                        </div>
                    @endif
                    <label for="fechavigor">
                        {{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}</label>
                </div>
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor_helper') }}</span>
            </div>
        </div>


        <div class="form-group col-sm-12 mt-4">
            <div class="form-floating" style="padding-left:6px;padding-right:6px;">
                <textarea required class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }} form"
                    style="height:200px;" name="requisitoacumplir" placeholder="Descripción del requisito a cumplir*"
                    id="requisitoacumplir">{{ old('requisitoacumplir') }}</textarea>
                @if ($errors->has('requisitoacumplir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requisitoacumplir') }}
                    </div>
                @endif
                <label style="color:#606060;font-size:14px;" for="requisitoacumplir">
                    Descripción del requisito a cumplir*</label>
            </div>
        </div>
        </form>
        <button type="button" class="btn btn-light mr-auto mb-3"
            style="background-color: white; border-color:white; color:#057BE2;">
            Añadir nuevo Requisito
            <i class="fa-solid fa-plus" style="color: #057BE2;"></i>
        </button>
    </div>
    </div>
    <div class="text-right form-group col-12">
        <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir_helper') }}
        </span>
        <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn boton-cancelar">
            <div class="mt-2">Cancelar</div>
        </a>
        <button class="btn boton-enviar ml-2 mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
@endsection
@section('styles')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet">

    <!-- Otros estilos que puedas tener aquí -->
    <link href="tu-archivo-de-estilos.css" rel="stylesheet">
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
