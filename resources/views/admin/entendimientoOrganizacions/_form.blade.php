

        <div class="form-group col-sm-12 col-md-12 col-lg-12">
            <label for="analisis"><i class="fas fa-file-invoice iconos-crear"></i>Nombre del Ánalisis</label>
            <input class="form-control date" type="text" name="analisis" id="analisis" value="{{ old('analisis',$entendimientoOrganizacion->analisis) }}">
            @if($errors->has('analisis'))
                <div class="invalid-feedback">
                    {{ $errors->first('analisis') }}
                </div>
            @endif
        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="fecha"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha de Creación
                Inicio</label>
            <input class="form-control" type="date" id="fecha"
                name="fecha" value="{{ old('fecha',$entendimientoOrganizacion->fecha) }}">
            @if ($errors->has('fecha'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecha') }}
                </div>
            @endif
        </div>



        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="id_elabora"><i class="fas fa-users iconos-crear"></i>Elabora</label>
            <select class="form-control select2 {{ $errors->has('elaboro') ? 'is-invalid' : '' }}" name="id_elabora" id="id_elabora">
                @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}"{{old('id_elabora',$entendimientoOrganizacion->id_elabora)?'selected':''}}>
                            {{ $empleado->name }}
                        </option>

                    @endforeach
            </select>
            @if($errors->has('empleados'))
                <div class="invalid-feedback">
                    {{ $errors->first('area') }}
                </div>
            @endif
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

        <div class="form-group col-12 text-right"><br>
            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
