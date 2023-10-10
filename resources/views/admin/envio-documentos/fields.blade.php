<div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
    DETALLES DE LA SOLICITUD
</div>
<!-- Categoria Field -->
<div class="row">
    <div class="form-group col-sm-6">
        <fieldset disabled>
            <label for="disabledTextInput"><i
                    class="fa-solid fa-calendar-check iconos-crear"></i>Estatus:</label>
            <input type="text" class="form-control"  value="{{ $solicitud->status ?: 'Por asignar' }}"
                style="text-align: center">
        </fieldset>
    </div>
    <div class="form-group col-sm-6">
        <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Fecha de solicitud:</label>
        <input type="text" class="form-control" name="fecha_solicitud" style="text-align: center"
            value="{{ $fecha_solicitud  }}" readonly>
    </div>

</div>
<!-- Categoria Field -->
<div class="row">
    <div class="form-group col-sm-6">
        <fieldset disabled>
            <label for="disabledTextInput"><i
                    class="fa-solid fa-calendar-check iconos-crear"></i>Coordinador(a):</label>
            <input type="text" class="form-control" value="{{ $operadores->coordinador->name ?: 'No definido' }}"
                style="text-align: center">
        </fieldset>
    </div>
    <div class="form-group col-sm-6">
        <fieldset disabled>
            <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Mensajero(a):</label>
            <input type="text" class="form-control" value="{{ $operadores->mensajero->name ?: 'No definido' }}"
                style="text-align: center">
        </fieldset>
    </div>
</div>
<div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
    DETALLES DEL DESTINO
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <i class="fa-solid fa-file-circle-check iconos-crear"></i>{!! Form::label('destinatario', 'Nombre de quien recibe:', ['class' => 'required']) !!}
        {!! Form::text('destinatario', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese nombre del destinatario',
        ]) !!}
        @error('destinatario')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col-sm-6">
        <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>{!! Form::label('telefono', 'Teléfono de quien recibe:', ['class' => 'required']) !!}
        {!! Form::text('telefono', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese numero telefonico del destinatario',
            'id' => 'fecha_fin',
        ]) !!}
        @error('telefono')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

</div>
<div class="row">
    <div class="form-group col-sm-6">
        <i class="fa-solid fa-file-circle-check iconos-crear"></i>{!! Form::label('lugar', 'Lugar:', ['class' => 'required']) !!}
        {!! Form::text('lugar', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese lugar de referencia',
            
        ]) !!}
        @error('lugar')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col-sm-6">
        <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>{!! Form::label('descripcion', 'Dirección:', ['class' => 'required']) !!}
        {!! Form::text('descripcion', null, [
            'class' => 'form-control',
            'placeholder' => 'Ingrese direccion exacta',
        ]) !!}
        @error('direccion')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

</div>

<div class="row">
    <div class="form-group col-sm-6">
        <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>{!! Form::label('fecha_limite', 'Fecha limite:', ['class' => 'required']) !!}
        {!! Form::date('fecha_limite', null, [
            'class' => 'form-control',
        ]) !!}
         @error('fecha_limite')
         <small class="text-danger">{{ $message }}</small>
     @enderror
      
    </div>
    <div class="form-group col-sm-3">
        <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Horario desde:</label>
            <input type="time" class="form-control" name="hora_recepcion_inicio"  value="{{ old('hora_recepcion_inicio', $solicitud->hora_recepcion_inicio) }}">
    </div>
    <div class="form-group col-sm-3">
        <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Hasta:</label>
            <input type="time" class="form-control" name="hora_recepcion_fin"  value="{{ old('hora_recepcion_fin', $solicitud->hora_recepcion_fin) }}">
    </div>
    

</div>



<x-loading-indicator />


<!-- Descripcion Field -->
<div class="row">
    <div class="form-group col-sm-12">
        <label for="exampleFormControlTextarea1"> <i
                class="fas fa-file-alt iconos-crear"></i>{!! Form::label('notas', 'Notas:') !!}</label>
        <textarea class="form-control" name="notas" rows="2">{{ old('notas', $solicitud->notas) }}</textarea>
    </div>
</div>

<input type="hidden" value="{{ auth()->user()->empleado ? explode(' ', auth()->user()->empleado->id)[0] : '' }}"
    name="id_solicita">
<input type="hidden" value="{{ $operadores->coordinador->id }}" name="id_coordinador">
<input type="hidden" value="{{ $operadores->mensajero->id }}" name="id_mensajero">

<!-- Submit Field -->
<div class="text-right form-group col-12">
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger" id="enviar" type="submit">
        {{ trans('global.save') }}
    </button>
</div>

{{-- @section('scripts')
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
@endsection --}}
