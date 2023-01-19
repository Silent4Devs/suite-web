<!-- Categoria Field -->
<div class="row">
    <div class="form-group col-sm-6">
        <label for="inputState" class="required"><i class="bi bi-collection-fill iconos-crear"></i>Nombre del permiso a
            solicitar:</label>
        <select id="permiso_id" class="form-control" name="permiso_id">
            <option selected>Seleccione...</option>
            @foreach ($permisos as $permiso)
                <option value="{{ $permiso->id }}" data-dias='{{ $permiso->dias }}'  data-tipo='{{ $permiso->tipo_permiso }}'>{{ $permiso->nombre }}</option>
            @endforeach
        </select>
        @error('permiso_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col-sm-6">
        <i class="bi bi-calendar-week-fill iconos-crear"></i>{!! Form::label('tipo_permiso', 'Tipo de permiso:') !!}
        {!! Form::text('tipo_permiso', null, [
            'class' => 'form-control',
            'readonly',
            'id' => 'tipo_permiso',
            'style' => 'text-align:center',
        ]) !!}

    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <i class="bi bi-calendar-week-fill iconos-crear"></i>{!! Form::label('dias_solicitados', 'Días Otorgados:') !!}
        {!! Form::number('dias_solicitados', null, [
            'class' => 'form-control',
            'placeholder' => '0',
            'readonly',
            'id' => 'dias_solicitados',
            'style' => 'text-align:center',
        ]) !!}

    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <i class="fa-solid fa-file-circle-check iconos-crear"></i>{!! Form::label('fecha_inicio', 'Fecha de inicio:', ['class' => 'required']) !!}
        {!! Form::date('fecha_inicio', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese el la fecha en que inican su vacaciones...',
            'id' => 'fecha_inicio',
        ]) !!}
        @error('fecha_inicio')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col-sm-6">
        <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>{!! Form::label('fecha_fin', 'Fecha de fin:', ['class' => 'required']) !!}
        {!! Form::date('fecha_fin', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese el la fecha en que terminan su vacaciones...',
            'id' => 'fecha_fin',
        ]) !!}
        @error('fecha_fin')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

</div>
<x-loading-indicator/>


<!-- Descripcion Field -->
<div class="row">
    <div class="form-group col-sm-12">
        <label for="exampleFormControlTextarea1"> <i
                class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Comentarios para el aprobador:') !!}</label>
        <textarea class="form-control" id="edescripcion" name="descripcion" rows="2">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
    </div>
</div>

<input type="hidden" value="{{ auth()->user()->empleado ? explode(' ', auth()->user()->empleado->id)[0] : '' }}"
    name="empleado_id">
<input type="hidden" value="{{ $autoriza }}" name="autoriza">
<!-- Submit Field -->
<div class="text-right form-group col-12">
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger" id="enviar"  type="submit">
        {{ trans('global.save') }}
    </button>
</div>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(e) {

            function sumarDias(fecha, dias) {
                fecha.setDate(fecha.getDate() + Number(dias));
                console.log(fecha);
                return fecha.toISOString().slice(0, 10);;
            }

            let permiso = document.querySelector('#permiso_id');
            let inicio = document.querySelector('#fecha_inicio');

            permiso.addEventListener('change', (e) => {
                let dias_init = e.target.options[e.target.selectedIndex].getAttribute('data-dias');
                document.getElementById('dias_solicitados').value = dias_init;
                let tipo = e.target.options[e.target.selectedIndex].getAttribute('data-tipo');
                if(tipo == 1){
                    tipo="Permisos conforme a la ley";
                }else if( tipo == 2){
                    tipo="Permisos otorgados por la empresa";
                }else{
                    tipo="No definido";
                }
                document.getElementById('tipo_permiso').value = tipo;
                console.log(tipo);
                if (inicio.value != '') {
                    let dias = document.getElementById('dias_solicitados').value;
                    var d = new Date(inicio.value.replaceAll('-', '/'));
                    let sumar_dias = sumarDias(d, dias - 1);
                    document.getElementById('fecha_fin').value = sumar_dias;
                }
            })
            inicio.addEventListener('change', (e) => {
                let dias = document.getElementById('dias_solicitados').value;
                var d = new Date(e.target.value.replaceAll('-', '/'));
                let sumar_dias = sumarDias(d, dias - 1);
                document.getElementById('fecha_fin').value = sumar_dias;

            })
            document.getElementById('enviar').addEventListener('click',(e)=>{
                document.getElementById('loaderComponent').style.display='block';
            })
        })
    </script>
@endsection
