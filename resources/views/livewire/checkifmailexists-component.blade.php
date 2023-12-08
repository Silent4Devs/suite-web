<div>
    <label class="required" for="email"><i class="far fa-envelope iconos-crear"></i>Correo
        electrónico</label>
    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="email"
        wire:model.debounce.700ms="empleadoemail" id="email" placeholder="example@tabantaj.com"
        value="{{ $empleadoemail }}" required>

    <p class="text-primary errores">{{ $disponiblemessage }}</p>

    <div wire:loading wire:target="empleadoemail">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <span class="text-primary">Verificando...</span>
    </div>
</div>
