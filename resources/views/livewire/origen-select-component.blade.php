<div id="">
    <select class="form-control {{ $errors->has('origen_id') ? 'is-invalid' : '' }}" " name="origen_id" 
        id="origen_id">
    <option value="" selected disabled>
        Selecciona una opción
    </option>
    @foreach ($origenes as $origen )
        <option value="{{ $origen->id }}"
            {{ old('nombre', $origen->id) == $origen_seleccionado ? 'selected' : '' }}>
            {{ $origen->nombre }}
        </option>
    @endforeach
    </select>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        Livewire.on('cerrarModal',()=>{
        console.log('cerrarModal');
        $('#origenCambioModal').modal('hide');
        document.querySelector('.modal-backdrop').style.display='none'
         });
    });

</script>