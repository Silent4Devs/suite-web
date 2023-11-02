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
                <div class="form-group col-12">
                    <div class="form-floating">
                        <input class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }} form"
                            type="text" name="nombrerequisito" id="nombrerequisito" placeholder="Fundamento"
                            value="{{ old('nombrerequisito', $matrizRequisitoLegale->nombrerequisito) }}" required>
                        @if ($errors->has('nombrerequisito'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombrerequisito') }}
                            </div>
                        @endif
                        <label class="" for="nombrerequisito">Nombre del requisito legal, regulatorio, contractual o
                            estatutario</label>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-floating">
                        <input class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }} form"
                            type="text" name="formacumple" id="formacumple"
                            value="{{ old('formacumple', $matrizRequisitoLegale->formacumple) }}"
                            placeholder="Cláusula, sección o
                        apartado
                        aplicable*">
                        @if ($errors->has('formacumple'))
                            <div class="invalid-feedback">
                                {{ $errors->first('formacumple') }}
                            </div>
                        @endif
                        <label for="formacumple">Cláusula, sección o
                            apartado
                            aplicable*</label>

                    </div>
                    <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.formacumple_helper') }}</span>
                </div>
                <div class="row" style="padding-right:0px;">
                    <div class="form-group col-md-6">
                        <div class="form-floating">
                            <input class="form-control date {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }} form"
                                type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                                value="{{ old('fechaexpedicion', $matrizRequisitoLegale->fechaexpedicion ? \Carbon\Carbon::parse($matrizRequisitoLegale->fechaexpedicion)->format('Y-m-d') : null) }}"
                                placeholder="Fecha de expedición">
                            @if ($errors->has('fechaexpedicion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechaexpedicion') }}
                                </div>
                            @endif
                            <label
                                for="fechaexpedicion">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion') }}</label>
                            <span
                                class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion_helper') }}</span>
                        </div>
                    </div>

                    <div class="form-group col-md-6" style="padding-right: 0px;">
                        <div class="form-floating">
                            <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }} form"
                                type="date" name="fechavigor" id="fechavigor" min="1945-01-01"
                                value="{{ old('fechavigor', $matrizRequisitoLegale->fechavigor ? \Carbon\Carbon::parse($matrizRequisitoLegale->fechavigor)->format('Y-m-d') : null) }}"
                                placeholder="Fecha de entrada en vigor" style="">
                            @if ($errors->has('fechavigor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechavigor') }}
                                </div>
                            @endif
                            <label for="fechavigor"
                                style="">{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}</label>
                            <span
                                class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor_helper') }}</span>
                        </div>
                    </div>

                </div>

                <div class="form-group col-sm-12">
                    <div class="form-floating">
                        <textarea class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }} form" type="text"
                            name="requisitoacumplir" id="requisitoacumplir" required>{{ old('requisitoacumplir', $matrizRequisitoLegale->requisitoacumplir) }}</textarea>
                        @if ($errors->has('requisitoacumplir'))
                            <div class="invalid-feedback">
                                {{ $errors->first('requisitoacumplir') }}
                            </div>
                        @endif
                        <label class="required" for="requisitoacumplir">Requisito(s) a
                            cumplir</label>
                        <span
                            class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir_helper') }}</span>
                    </div>
                </div>
                {{--
                <div class="form-group" style="margin-top:15px; width:100%; height:25px; background-color:#345183">
                    <p class="text-center text-light" style="font-size:11pt; width:100%; margin-left:370px; color:#ffffff;">
                        Verificación del Requisito</p>
                </div>

                <div class="form-group col-sm-6">
                    <label> <i class="fas fa-question-circle iconos-crear"></i>¿En cumplimiento?</label>
                    <select class="form-control {{ $errors->has('cumplerequisito') ? 'is-invalid' : '' }}"
                        name="cumplerequisito" id="cumplerequisito">
                        <option value disabled {{ old('cumplerequisito', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('cumplerequisito', $matrizRequisitoLegale->cumplerequisito) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('cumplerequisito'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cumplerequisito') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.cumplerequisito_helper') }}</span>
                </div>

                <div class="form-group col-sm-6">
                    <label for="fechaverificacion"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                        verificación</label>
                    <input class="form-control date {{ $errors->has('fechaverificacion') ? 'is-invalid' : '' }}"
                        type="date" name="fechaverificacion" id="fechaverificacion"
                        value="{{ old('fechaverificacion', $matrizRequisitoLegale->fechaverificacion) }}">
                    @if ($errors->has('fechaverificacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechaverificacion') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-12">
                    <label for="metodo"><i class="fab fa-searchengin iconos-crear"></i> Método utilizado de
                        verificación</label>
                    <textarea class="form-control {{ $errors->has('metodo') ? 'is-invalid' : '' }}" type="text"
                        name="metodo" id="metodo">{{ old('metodo', $matrizRequisitoLegale->metodo) }} </textarea>
                    @if ($errors->has('metodo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('metodo') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-12">
                    <label for="descripcion_cumplimiento"><i class="fas fa-clipboard-list iconos-crear"></i> Descripción del
                        cumplimiento/incumplimiento</label><i class="fas fa-info-circle"
                        style="font-size:12pt; float: right;"
                        title="Describir de que forma la organización está cumpliendo/incumpliendo este requisito."></i>
                    <textarea class="form-control {{ $errors->has('descripcion_cumplimiento') ? 'is-invalid' : '' }}"
                        type="text" name="descripcion_cumplimiento"
                        id="descripcion_cumplimiento">{{ old('descripcion_cumplimiento', $matrizRequisitoLegale->descripcion_cumplimiento) }} </textarea>
                    @if ($errors->has('descripcion_cumplimiento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion_cumplimiento') }}
                        </div>
                    @endif
                </div>



                <div class="row w-100 align-items-center" style="margin-left: 1px;">
                    @livewire('planes-implementacion-select',['planes_seleccionados'=>$planes_seleccionados])
                    <div class="pl-0 ml-0 col-2">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#planAccionModal">
                            <i class="mr-1 fas fa-plus-circle"></i> Crear
                        </button>
                    </div>
                    @livewire('plan-implementacion-create', ['referencia' => null,'modulo_origen'=>'Matríz de Requisitos
                    Legales'])
                </div>



                <div class="mb-3 col-sm-12">
                    <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Evidencia</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" {{ $errors->has('evidencia') ? 'is-invalid' : '' }}"
                            multiple id="evidencia" name="files[]"
                            {{ old('evidencia', $matrizRequisitoLegale->evidencia) }}>
                        @if ($errors->has('evidencia'))
                            <div class="invalid-feedback">
                                {{ $errors->first('evidencia') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3 col-10 d-flex justify-content-right">
                    <span class="float-right" type="button" class="pl-0 ml-0 btn text-primary" data-toggle="modal"
                        data-target="#largeModal">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar Documentos
                    </span>
                </div>


                <div class="form-group col-md-4">
                    <label for="id_reviso"><i class="fas fa-user-tie iconos-crear"></i>Revisó</label>
                    <select class="form-control {{ $errors->has('id_reviso') ? 'is-invalid' : '' }}" name="id_reviso"
                        id="id_reviso">
                        @foreach ($empleados as $id => $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('id_reviso', $matrizRequisitoLegale->id_reviso) == $empleado->id ? 'selected' : '' }}>

                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('empleados'))
                        <div class="invalid-feedback">
                            {{ $errors->first('empleados') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
                </div>




                <div class="form-group col-md-4">
                    <label for="id_puesto_reviso"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="puesto_reviso"></div>

                </div>


                <div class="form-group col-md-4">
                    <label for="id_area_reviso"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="area_reviso"></div>

                </div>

                <div class="form-group col-sm-12">
                    <label for="comentarios"><i class="fas fa-comment-dots iconos-crear"></i>Comentarios /
                        observaciones</label>
                    <textarea class="form-control {{ $errors->has('comentarios') ? 'is-invalid' : '' }}" type="text"
                        name="comentarios"
                        id="comentarios">{{ old('comentarios', $matrizRequisitoLegale->comentarios) }} </textarea>
                    @if ($errors->has('comentarios'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comentarios') }}
                        </div>
                    @endif
                </div> --}}


                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>




                {{-- <div class="modal" tabindex="-1" id="evidencia_activa">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Descargar Documentos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"> --}}

                {{-- @dump(json_decode($activo->documentos_relacionados)) --}}
                {{-- @if (json_decode($matrizRequisitoLegale->evidencia))
                                    <div class="list-group">
                                        @foreach (json_decode($matrizRequisitoLegale->evidencia) as $documento)

                                            <a class="list-group-item list-group-item-action" target="_blank"
                                                href="{{ asset('storage/matriz_evidencias' . '/' . $documento) }}">
                                                <i class="mr-2 fas fa-file"></i><span>{{ $documento }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <p>Sin archivos cargados</p>
                                @endif


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>



                        </div>
                    </div>
                </div> --}}




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
