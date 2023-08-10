<div class="col l12 m12 s12">

    <div class="card hoverable">
        <div class="card-content">
        <!-- No Contrato Field -->
        <div class="row mb-4">
            <div class="input-field col s12 m4">
                <small>No. de Contrato:</small>
                {!! Form::number('no_contrato', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Nombre Proveedor Field -->
            <div class="input-field col s12 m4">
                <small>Nombre del Proveedor:</small>
                {!! Form::text('nombre_proveedor', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Area Field -->
            <div class="input-field col s12 m4">
                <small>Área</small>
                {!! Form::text('area', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Nombre Servicio Field -->
            <div class="input-field col s12 m4">
                <small>Nombre del Servicio</small>

                {!! Form::text('nombre_servicio', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Clasificacion Field -->
            <div class="input-field col s12 m4">
                <small>Clasificacion</small>
                {!! Form::text('clasificacion', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Administrador Field -->
            <div class="input-field col s12 m4">
                <small>Administrador</small>

                {!! Form::text('administrador', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Fase Field -->
            <div class="input-field col s12 m4">
                <small>Fase</small>
                {!! Form::text('fase', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Estatus Field -->
            <div class="input-field col s12 m4">
                <small class="active">Estatus*</small>
                <div class="display-flex ml-4">
                    <select class="validate" required="" aria-required="true" name="estatus">
                        <option value="" disabled selected>Escoga una opción</option>
                        <option value="Inicio">Inicio</option>
                        <option value="Ejecución">Ejecución</option>
                        <option value="Conclusión">Conclusión</option>
                    </select>
                </div>
                <div class="display-flex ml-4">
                    <label class="red-text">{{ $errors->first('Type') }}</label>
                </div>

            </div>

            <!-- Vigencia Contrato Field -->
            <div class="input-field col s12 m4">
                <small>Vigencia del Contrato</small>
                {!! Form::text('vigencia_contrato', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Pmp Asignado Field -->
            <div class="input-field col s12 m4">
                <small>PMP Asignado</small>
                {!! Form::text('pmp_asignado', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Submit Field -->
            <div class="row mb-3">
                <div class="col s12">
                    <div class="form-group col-sm-12 right">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('contratos.index') }}" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
