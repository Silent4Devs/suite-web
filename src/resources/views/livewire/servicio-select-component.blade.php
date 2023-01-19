<div id="tipo_competencia_select">
    <select class="form-control serviciodesc {{ $errors->has('tipo_id') ? 'is-invalid' : '' }}" name="servicio_id"
        id="tipo_id">
        <option value="" selected disabled>
           Selecciona una opción
        </option>
        @foreach ($servicios as $servicio)
            <option value="{{ $servicio->id }}"
                {{ old('servicio', $servicio->id) == $servicio_seleccionado ? 'selected' : '' }}>
                {{ $servicio->servicio }}</option>
        @endforeach
    </select>
    {{-- <small class="text-muted">Selecciona el servicio</small> --}}
</div>


<script>
    document.addEventListener('DOMContentLoaded', function(){
        Livewire.on('cerrarModal',()=>{
        console.log('cerrarModal');
        $('#tipoCompetenciaModal').modal('hide');
        document.querySelector('.modal-backdrop').style.display='none'
         });
    });

</script>
