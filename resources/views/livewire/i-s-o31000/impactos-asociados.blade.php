<div>
    <div class="row">
        <div wire:ignore class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="estrategico"><i class="fas fa-chess-knight iconos-crear"></i>Estratégico</label>
            <select class="form-control select2 {{ $errors->has('estrategico') ? 'is-invalid' : '' }}"
                name="estrategico" wire:model.live="estrategico" id="estrategico">
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="1" {{ $estrategico == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $estrategico == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $estrategico == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $estrategico == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $estrategico == 5 ? 'selected' : '' }}>5</option>
            </select>
            @if ($errors->has('estrategico'))
                <div class="invalid-feedback">
                    {{ $errors->first('estrategico') }}
                </div>
            @endif
        </div>
        <div wire:ignore class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="operacional"><i class="fas fa-project-diagram iconos-crear"></i>Operacional</label>
            <select class="form-control select2 {{ $errors->has('operacional') ? 'is-invalid' : '' }}"
                name="operacional" wire:model.live="operacional" id="operacional">
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="1" {{ $operacional == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $operacional == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $operacional == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $operacional == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $operacional == 5 ? 'selected' : '' }}>5</option>
            </select>
            @if ($errors->has('operacional'))
                <div class="invalid-feedback">
                    {{ $errors->first('operacional') }}
                </div>
            @endif
        </div>
        <div wire:ignore class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="cumplimiento"><i class="fas fa-check iconos-crear"></i>Cumplimiento</label>
            <select class="form-control select2 {{ $errors->has('cumplimiento') ? 'is-invalid' : '' }}"
                name="cumplimiento" wire:model.live="cumplimiento" id="cumplimiento">
                <option value="" selected disabled>Selecciona</option>
                <option value="1" {{ $cumplimiento == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $cumplimiento == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $cumplimiento == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $cumplimiento == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $cumplimiento == 5 ? 'selected' : '' }}>5</option>
            </select>
            @if ($errors->has('cumplimiento'))
                <div class="invalid-feedback">
                    {{ $errors->first('cumplimiento') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div wire:ignore class="form-group col-sm-4 col-md-3 col-lg-3">
            <label for="legal"><i class="fas fa-gavel iconos-crear"></i>Legal</label>
            <select class="form-control select2 {{ $errors->has('legal') ? 'is-invalid' : '' }}" name="legal"
                id="legal" wire:model.live="legal">
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="1" {{ $legal == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $legal == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $legal == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $legal == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $legal == 5 ? 'selected' : '' }}>5</option>
            </select>
            @if ($errors->has('legal'))
                <div class="invalid-feedback">
                    {{ $errors->first('legal') }}
                </div>
            @endif
        </div>
        <div wire:ignore class="form-group col-sm-4 col-md-3 col-lg-3">
            <label for="reputacional"><i class="fas fa-newspaper iconos-crear"></i>Reputacional</label>
            <select class="form-control select2 {{ $errors->has('reputacional') ? 'is-invalid' : '' }}"
                name="reputacional" id="reputacional" wire:model.live="reputacional">
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="1" {{ $reputacional == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $reputacional == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $reputacional == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $reputacional == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $reputacional == 5 ? 'selected' : '' }}>5</option>
            </select>
            @if ($errors->has('reputacional'))
                <div class="invalid-feedback">
                    {{ $errors->first('reputacional') }}
                </div>
            @endif
        </div>
        <div wire:ignore class="form-group col-sm-4 col-md-3 col-lg-3">
            <label for="tecnologico"><i class="fas fa-laptop iconos-crear"></i>Tecnológico</label>
            <select class="form-control select2 {{ $errors->has('tecnologico') ? 'is-invalid' : '' }}"
                name="tecnologico" id="tecnologico" wire:model.live="tecnologico">
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="1" {{ $tecnologico == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $tecnologico == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $tecnologico == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $tecnologico == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $tecnologico == 5 ? 'selected' : '' }}>5</option>
            </select>
            @if ($errors->has('tecnologico'))
                <div class="invalid-feedback">
                    {{ $errors->first('tecnologico') }}
                </div>
            @endif
        </div>
        <div wire:ignore.self class="form-group col-sm-4 col-md-3 col-lg-3">
            <label for="valor"><i class="fas fa-bullseye iconos-crear"></i>Valor del impacto</label>
            <input class="form-control mt-2 {{ $errors->has('valor') ? 'is-invalid' : '' }}" type="number"
                name="valor" value="{{ old('valor', '') }}" id="valor" wire:model="valor"
                style="background: {{ $colorReglaTipo }};color:{{ $colorTextoTipo }};" readonly>
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
        $('#estrategico').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('estrategico', data.id);
        });
        $('#operacional').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('operacional', data.id);
        });
        $('#cumplimiento').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('cumplimiento', data.id);
        });
        $('#legal').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('legal', data.id);
        });
        $('#reputacional').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('reputacional', data.id);
        });
        $('#tecnologico').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('tecnologico', data.id);
        });
    })
</script>
