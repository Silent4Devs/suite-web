<div>
    <div class="form-group col-sm-12" wire:ignore>
        <label for="norma"><i class="fas fa-ruler-vertical iconos-crear"></i> Norma(s)</label>
        <select class="form-control" name="norma_id" wire:model.blur="norma_id" id="norma">
            <option value="0" selected>Selecciona una norma para mostrar sus clausulas</option>
            @foreach ($normas as $norma)
                <option value="{{ $norma->id }}" class="text-uppercase">{{ $norma->norma }}</option>
            @endforeach
        </select>
    </div>

    @if ($value)
        <div class="form-group col-sm-12">
            <label for="clausulas"><i class="far fa-file iconos-crear"></i> Cláusula(s)</label>
            <select class="form-control {{ $errors->has('clausulas') ? 'is-invalid' : '' }}" name="clausulas[]"
                id="clausulas" wire:model.blur="clausulas" multiple>
                <option value disabled>Selecciona una opción</option>
                @foreach ($clausulas as $clausula)
                    <option value="{{ $clausula->id }}">
                        {{ $clausula->nombre }}
                    </option>
                @endforeach
            </select>
            <span class="errors tipo_error"></span>
        </div>
    @endif

    <script>
        window.addEventListener('norma-updated', event => {
            $(document).ready(function() {
                $("#clausulas").select2({
                    theme: "bootstrap4",
                });
                console.log('norma-updated');

            });
        });
    </script>

</div>
