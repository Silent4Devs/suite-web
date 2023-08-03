@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisisdebrechas-2022.index') !!}">Análisis de Riesgo 2022</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Editar: Análisis de Brechas ISO 27001:2022</h5>
    <div class="mt-4 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Análisis de Riesgo</h3>
        </div> --}}

        <div class="card-body">
            <form method="POST" action="{{ route('admin.analisisdebrechas-2022.update', [$analisisBrecha->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="py-1 text-center form-group col-12"
                    style="background-color:#345183; border-radius:100px; color: white;">DATOS GENERALES</div>


                <div class="form-group">
                    <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="nombre" class="required"><i class="fas fa-table iconos-crear"></i>Nombre</label>
                        <input required class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            name="nombre" id="nombre" value="{{ old('nombre', $analisisBrecha->nombre) }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div>


                    <div class="form-group col-md-4 col-sm-12">
                        <label for="fecha"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha</label>
                        <input required class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text"
                            id="fecha" value="{{ date('d-m-Y') }}" min="1945-01-01"
                            disabled>
                        @if ($errors->has('fecha'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha') }}
                            </div>
                        @endif
                    </div>
                    {{ Form::hidden('fecha', date('Y-m-d')) }}

                    <div class="form-group col-md-4 col-sm-4">
                        <label class="required" for="estatus"><i class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                        <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus"
                            id="estatus" required>
                            <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\AnalisisDeRiesgo::EstatusSelect as $key => $label)
                                <option value="{{ $key }}" {{ $key == $analisisBrecha->estatus ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('estatus'))
                            <div class="invalid-feedback">
                                {{ $errors->first('estatus') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="id_elaboro" class="required">
                            <i class="fas fa-user-tie iconos-crear"></i>Elaboró</label>
                        <select required class="form-control {{ $errors->has('id_elaboro') ? 'is-invalid' : '' }}"
                            name="id_elaboro" id="id_elaboro">
                            <option value="">Seleccione una opción</option>
                            @foreach ($empleados as $id => $empleado)
                                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                    data-area="{{ $empleado->area->area }}"
                                    {{ old('id_elaboro', $analisisBrecha->id_elaboro) == $empleado->id ? 'selected' : '' }}>

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


                    <div class="form-group col-md-4 col-sm-12 col-lg-4">
                        <label for="id_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="id_puesto" readonly></div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12 col-lg-4">
                        <label for="id_area"><i class="fas fa-street-viewa iconos-crear"></i>Área</label>
                        <div class="form-control" id="id_area" readonly></div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 lg-4 col-sm-12">
                        <label for="porcentaje_implementacion"><i class="fas fa-percentage iconos-crear"></i>%
                            Implementacion</label>
                            <div class="form-control" readonly>{{$cuentas}} %</div>

                    </div>
                </div>

                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.analisisdebrechas-2022.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script type=text/javascript>
        $('#id_elaboro').change(function() {
            var elaboroID = $(this).val();
            if (elaboroID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/getEmployeeData') }}?id=" + elaboroID,
                    success: function(res) {
                        if (res) {
                            $("#id_puesto").empty();
                            $("#id_puesto").attr("value", res.puesto);
                            $("#id_area").empty();
                            $("#id_area").attr("value", res.area);
                        } else {
                            $("#id_puesto").empty();
                            $("#id_area").empty();
                        }
                    }
                });
            } else {
                $("#id_puesto").empty();
                $("#id_area").empty();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let elaboro = document.querySelector('#id_elaboro');
            let area_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-area');
            let puesto_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-puesto');

            document.getElementById('id_puesto').innerHTML = recortarTexto(puesto_init);
            document.getElementById('id_area').innerHTML = recortarTexto(area_init);
            elaboro.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('id_puesto').innerHTML = recortarTexto(puesto);
                document.getElementById('id_area').innerHTML = recortarTexto(area);
            })

            function recortarTexto(texto, length = 30)
            {
                let trimmedString = texto?.length > length ?
                    texto.substring(0, length - 3) + "..." :
                    texto;
                return trimmedString;
            }
        });
    </script>
@endsection
