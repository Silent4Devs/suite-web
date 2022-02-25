

        <div class="form-group col-sm-12 col-md-12 col-lg-12">
            <label for="analisis"><i class="fas fa-file-invoice iconos-crear"></i>Nombre del Análisis</label>
            <input class="form-control date" type="text" name="analisis" id="analisis" value="{{ old('analisis',$entendimientoOrganizacion->analisis) }}">
            @if($errors->has('analisis'))
                <div class="invalid-feedback">
                    {{ $errors->first('analisis') }}
                </div>
            @endif
        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="fecha"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha de Creación</label>
            <input class="form-control" type="date" id="fecha"
                name="fecha" value="{{ old('fecha',$entendimientoOrganizacion->fecha) }}">
            @if ($errors->has('fecha'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecha') }}
                </div>
            @endif
        </div>





        <div class="form-group col-sm-12 col-md-6 col-lg-6">
        <label for="id_elabora"><i class="fas fa-user-tie iconos-crear"></i>Colaborador</label>
        <select class="form-control  {{ $errors->has(' id_elabora') ? 'is-invalid' : '' }}"
            name="id_elabora" id="id_elabora">
            <option value="">Seleccione una opción</option>
            @foreach ($empleados as $empleado)
                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                    data-area="{{ $empleado->area->area }}">
                    {{ $empleado->name }}
                </option>
            @endforeach
        </select>
        @if ($errors->has(' id_elabora'))
            <div class="invalid-feedback">
                {{ $errors->first(' id_elabora') }}
            </div>
        @endif
    </div>


        <div class="form-group col-md-6">
            <label for="id_puesto_asignada"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
            <div class="form-control" id="puesto_asignada" readonly></div>

        </div>


        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="id_area_asignada"><i class="fas fa-street-view iconos-crear"></i>Área</label>
            <div class="form-control" id="area_asignada" readonly></div>

        </div>



        <div class="form-group col-md-6 col-sm-6 col-12">
            <label for="fortalezas"> <i class="fas fa-thumbs-up iconos-crear"></i> Fortalezas</label>
            <textarea class="form-control fortalezas {{ $errors->has('fortalezas') ? 'is-invalid' : '' }}" name="fortalezas"
                id="fortalezas">{{ old('fortalezas', $entendimientoOrganizacion->fortalezas) }}</textarea>
            @if ($errors->has('fortalezas'))
                <div class="invalid-feedback">
                    {{ $errors->first('fortalezas') }}
                </div>
            @endif
        </div>

        <div class="form-group col-md-6 col-sm-6 col-12">
            <label for="debilidades"> <i class="fas fa-thumbs-down iconos-crear"></i> Debilidades</label>
            <textarea class="form-control debilidades {{ $errors->has('debilidades') ? 'is-invalid' : '' }}"
                name="debilidades"
                id="debilidades">{{ old('debilidades', $entendimientoOrganizacion->debilidades) }}</textarea>
            @if ($errors->has('debilidades'))
                <div class="invalid-feedback">
                    {{ $errors->first('debilidades') }}
                </div>
            @endif
        </div>

        <div class="form-group col-md-6 col-sm-6 col-12">
            <label for="oportunidades"> <i class="fas fa-lightbulb iconos-crear"></i> Oportunidades</label>
            <textarea class="form-control oportunidades {{ $errors->has('oportunidades') ? 'is-invalid' : '' }}"
                name="oportunidades"
                id="oportunidades">{{ old('oportunidades', $entendimientoOrganizacion->oportunidades) }}</textarea>
            @if ($errors->has('oportunidades'))
                <div class="invalid-feedback">
                    {{ $errors->first('oportunidades') }}
                </div>
            @endif
        </div>

        <div class="form-group col-md-6 col-sm-6 col-12">
            <label for="amenazas"><i class="fas fa-bomb iconos-crear"></i> Amenazas</label>
            <textarea class="form-control amenazas {{ $errors->has('amenazas') ? 'is-invalid' : '' }}" name="amenazas"
                id="amenazas">{{ old('amenazas', $entendimientoOrganizacion->amenazas) }}</textarea>
            @if ($errors->has('amenazas'))
                <div class="invalid-feedback">
                    {{ $errors->first('amenazas') }}
                </div>
            @endif
        </div>

        <div class="text-right form-group col-12"><br>
            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>

@section('scripts')

    <script>

        document.addEventListener('DOMContentLoaded', function(e) {

            let asignado = document.querySelector('#id_elabora');
            let area_init = asignado.options[asignado.selectedIndex].getAttribute('data-area');
            let puesto_init = asignado.options[asignado.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_asignada').innerHTML = puesto_init;
            document.getElementById('area_asignada').innerHTML = area_init;
            asignado.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_asignada').innerHTML = puesto;
            document.getElementById('area_asignada').innerHTML = area;
        })

        })



    </script>

@endsection
