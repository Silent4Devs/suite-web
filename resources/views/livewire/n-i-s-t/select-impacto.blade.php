<div>
    <div class="row" wire:ignore>
        <div class="form-group col-sm-6 col-md-6 col-lg-6">
            <label for="severidad"><i class="fas fa-gavel iconos-crear"></i>Severidad de la
                Vulnerabilidad</label>
            <select class="form-control select2 {{ $errors->has('severidad') ? 'is-invalid' : '' }}" name="severidad"
                id="severidad" wire:model.live="severidad">
                <option value="" selected disabled>Selecciona</option>
                <option value="1" {{ $severidad == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $severidad == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $severidad == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $severidad == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $severidad == 5 ? 'selected' : '' }}>5</option>
            </select>
        </div>

        <div class="form-group col-sm-6 col-md-6 col-lg-6" wire:ignore>
            <label for="probabilidad"><i class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
            <select class="form-control select2 {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}"
                name="probabilidad" id="probabilidad" wire:model.live="probabilidad">
                <option value="" selected disabled>Selecciona</option>
                <option value="1" {{ $probabilidad == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $probabilidad == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $probabilidad == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $probabilidad == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $probabilidad == 5 ? 'selected' : '' }}>5</option>
                <option value="6" {{ $probabilidad == 6 ? 'selected' : '' }}>6</option>
                <option value="7" {{ $probabilidad == 7 ? 'selected' : '' }}>7</option>
                <option value="8" {{ $probabilidad == 8 ? 'selected' : '' }}>8</option>
                <option value="9" {{ $probabilidad == 9 ? 'selected' : '' }}>9</option>
                <option value="10" {{ $probabilidad == 10 ? 'selected' : '' }}>10</option>

            </select>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-6 col-md-6 col-lg-6" wire:ignore>
            <label for="impacto_num"><i class="fas fa-exclamation-triangle iconos-crear"></i>Impacto</label>
            <select class="form-control select2 {{ $errors->has('impacto_num') ? 'is-invalid' : '' }}"
                name="impacto_num" id="impacto_num" wire:model.live="impacto">
                <option value="" selected disabled>Selecciona</option>
                <option value="1" {{ $impacto == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $impacto == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $impacto == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $impacto == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $impacto == 5 ? 'selected' : '' }}>5</option>
                <option value="6" {{ $impacto == 6 ? 'selected' : '' }}>6</option>
                <option value="7" {{ $impacto == 7 ? 'selected' : '' }}>7</option>
                <option value="8" {{ $impacto == 8 ? 'selected' : '' }}>8</option>
                <option value="9" {{ $impacto == 9 ? 'selected' : '' }}>9</option>
                <option value="10" {{ $impacto == 10 ? 'selected' : '' }}>10</option>
            </select>
        </div>

        <div class="form-group col-sm-6 col-md-6 col-lg-6" wire:ignore.self>
            <label for="valor"><i class="fas fa-exclamation-circle iconos-crear"></i>Valor del impacto</label>
            <input class="form-control mt-2 {{ $errors->has('valor') ? 'is-invalid' : '' }}" type="number"
                name="valor" id="valor" value="{{ old('valor', '') }}" wire:model="valor" readonly
                style="background: {{ $colorReglaTipo }};color:{{ $colorTextoTipo }};">
            @if ($errors->has('valor'))
                <div class="invalid-feedback">
                    {{ $errors->first('valor') }}
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#severidad').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('severidad', data.id);
        });
        $('#probabilidad').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('probabilidad', data.id);
        });
        $('#impacto_num').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('impacto', data.id);
        });
    })
</script>
