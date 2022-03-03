<div>
    <div class="row">
        <div class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="operacional"><i class="fas fa-project-diagram iconos-crear"></i>Operacional</label>
            <select class="form-control select2 {{ $errors->has('operacional') ? 'is-invalid' : '' }}" wire:model='OperacionalId' name="operacional" >
                <option value="" selected>Selecciona</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="cumplimiento"><i class="fas fa-check iconos-crear"></i>Cumplimiento</label>
            <select class="form-control select2 {{ $errors->has('cumplimiento') ? 'is-invalid' : '' }}" wire:model='cumplimiento_id' name="cumplimiento">
                <option value="" selected>Selecciona</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="legal"><i class="fas fa-gavel iconos-crear"></i>Legal</label>
            <select class="form-control select2 {{ $errors->has('legal') ? 'is-invalid' : '' }}" wire:model='legal_id' name="legal">
                <option value="" selected>Selecciona</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

    </div>

    <div class="row">

        <div class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="reputacional"><i class="fas fa-newspaper iconos-crear"></i>Reputacional</label>
            <select class="form-control select2 {{ $errors->has('reputacional') ? 'is-invalid' : '' }}" wire:model='reputacional_id' name="reputacional">
                <option value="" selected>Selecciona</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>



        <div class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="tecnologico"><i class="fas fa-laptop iconos-crear"></i>Tecnológico</label>
            <select class="form-control select2 {{ $errors->has('tecnologico') ? 'is-invalid' : '' }}" wire:model='tecnologico_id' name="tecnologico">
                <option value="" selected>Selecciona</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="valor"><i class="fas fa-bullseye iconos-crear"></i>Valor del impacto</label>
            <input class="form-control mt-2 {{ $errors->has('valor') ? 'is-invalid' : '' }}" type="number" wire:model='valor_id'  name="valor"
            value="{{ old('valor', '') }}">
            @if ($errors->has('valor'))
                <div class="invalid-feedback">
                    {{ $errors->first('valor') }}
                </div>
            @endif
        </div>

    </div>
</div>
