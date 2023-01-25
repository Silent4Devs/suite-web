@extends('layouts.admin')
@section('content')
    <style>
        .select2-search.select2-search--inline {
            margin-top: -20px !important;
        }

    </style>
    {{ Breadcrumbs::render('admin.matriz-requisito-legales.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Matriz de Requisitos Legales</h5>
    <div class="mt-4 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px">
        <h3 class="mb-1 text-center text-white"><strong>Registrar:</strong> Matriz de Requisitos Legales </h3>
    </div> --}}

        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-requisito-legales.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-12">
                    <p class="text-center text-light p-1" style="background-color:#345183; border-radius: 100px;">
                        Requisito Legal</p>
                </div>

                <div class="form-group col-12">
                    <label class="required" for="nombrerequisito"> <i class="fas fa-clipboard-list iconos-crear"></i>
                        Fundamento</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Nombre de la ley,norma,reglamento o documento donde se encuentra el requisito"></i>
                    <input required class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }}" type="text"
                        name="nombrerequisito" id="nombrerequisito" value="{{ old('nombrerequisito', '') }}">
                    @if ($errors->has('nombrerequisito'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombrerequisito') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-8">
                    <label for="formacumple"><i class="fas fa-file-invoice iconos-crear"></i> Apartado</label><i
                        class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Sección,artículo,fracción,fragmento,párrafo,,donde se indique el requisito"></i>
                    <input class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }}" type="text"
                        name="formacumple" id="formacumple" value="{{ old('formacumple', '') }}">
                    @if ($errors->has('formacumple'))
                        <div class="invalid-feedback">
                            {{ $errors->first('formacumple') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.formacumple_helper') }}</span>
                </div>

                <div class="form-group col-sm-4">
                    <label class="required"> <i class="fas fa-bars iconos-crear"></i> Tipo</label><i
                        class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Seleccionar el tipo de requisito según el origen de la obligación"></i>
                    <select required class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo" id="tipo">
                        <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MatrizRequisitoLegale::TIPO_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('tipo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo') }}
                        </div>
                    @endif
                </div>



                <div class="form-group col-sm-12">
                    <label for="medio"> <i class="fas fa-newspaper iconos-crear"></i> Medio de publicación</label><i
                        class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Medio digital (página web) o físico a través del cuál se publicó el requisito a cumplir. Ejemplo:Diario Oficial de la Federación."></i>
                    <input class="form-control {{ $errors->has('medio') ? 'is-invalid' : '' }}" type="text" name="medio"
                        id="medio" value="{{ old('medio', '') }}">
                    @if ($errors->has('medio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('medio') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-4">
                    <label for="fechaexpedicion"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de
                        publicación</label>
                    <input class="form-control {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }}"
                        type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                        value="{{ old('fechaexpedicion') }}">
                    @if ($errors->has('fechaexpedicion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechaexpedicion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion_helper') }}</span>
                </div>
                <div class="form-group col-sm-4">
                    <label for="fechavigor"> <i class="far fa-calendar-alt iconos-crear"></i>
                        {{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}</label>
                    <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }}" type="date"
                        name="fechavigor" id="fechavigor" min="1945-01-01"
                        value="{{ old('fechavigor') }}">
                    @if ($errors->has('fechavigor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechavigor') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor_helper') }}</span>
                </div>

                <div class="form-group col-sm-4">
                    <label class="required" for="periodicidad_cumplimiento"><i class="far fa-clock iconos-crear"></i>
                        Periodicidad de cumplimiento</label>
                    <select required class="form-control {{ $errors->has('periodicidad_cumplimiento') ? 'is-invalid' : '' }}"
                        name="periodicidad_cumplimiento" id="periodicidad_cumplimiento">
                        <option value disabled {{ old('periodicidad_cumplimiento', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MatrizRequisitoLegale::PERIODICIDAD_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('periodicidad_cumplimiento', '') === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('periodicidad_cumplimiento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('periodicidad_cumplimiento') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12">
                    <label class="required" for="requisitoacumplir"> <i
                            class="fas fa-clipboard-list iconos-crear"></i> Requisito(s) a cumplir</label>
                    <textarea required class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }}" name="requisitoacumplir"
                        id="requisitoacumplir">{{ old('requisitoacumplir') }}</textarea>
                    @if ($errors->has('requisitoacumplir'))
                        <div class="invalid-feedback">
                            {{ $errors->first('requisitoacumplir') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir_helper') }}</span>
                </div>

                <div class="form-group col-sm-12">
                    <label for="alcance"><i class="fas fa-binoculars iconos-crear"></i> Alcance y grado de
                        aplicabilidad</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Especificar el alcance y grado de aplicabilidad del requisito hacia la organización "></i>
                    <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" name="alcance"
                        id="alcance">{{ old('alcance') }}</textarea>
                    @if ($errors->has('alcance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alcance') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12">
                    <label for="cumplimiento_organizacion"><i class="fas fa-clipboard-check iconos-crear"></i> Forma en que la
                        organización cumple con el requisito</label><i class="fas fa-info-circle"
                        style="font-size:12pt; float: right;" title="Especificar"></i>
                    <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" name="cumplimiento_organizacion"
                        id="cumplimiento_organizacion">{{ old('cumplimiento_organizacion') }}</textarea>
                    @if ($errors->has('cumplimiento_organizacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cumplimiento_organizacion') }}
                        </div>
                    @endif
                </div>



                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
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
