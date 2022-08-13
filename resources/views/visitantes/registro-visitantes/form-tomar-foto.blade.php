<div class="col-12 text-center">
    <div class="header-text text-center">
        <h3>FOTOGRAFÍA</h3>
        <p>Da clic en el <span style="color:#3086AF">botón de play</span> para tomarte una foto
        </p>
    </div>
    <div class="input-group has-validation w-100">
        @include('visitantes.registro-visitantes.imagen-visitante')
        @error('imagen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-12" style="text-align: end">
    <button class="btn btn-primary" wire:click.prevent="increaseStep()">Siguiente</button>
</div>
