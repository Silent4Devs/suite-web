<div>
    <div id="tipo_competencia_select">
        <select class="form-control serviciodesc {{ $errors->has('tipo_control_acceso_id') ? 'is-invalid' : '' }}" name="tipo_control_acceso_id"
            id="tipo">
            <option value="" selected disabled>
               Selecciona una opción
            </option>
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo->id }}"
                    {{ old('nombre', $tipo->id) == $tipo_seleccionado ? 'selected' : '' }}>
                    {{ $tipo->nombre }}</option>
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
</div>
