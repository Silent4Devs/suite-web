<div class="col-12 text-center">
    <div class="header-text text-center">
        <h3>FOTOGRAFÍA</h3>
        <p>Da clic en el <span style="color:#3086AF">botón de play</span> para tomarte una foto, seguido de clic en el
            icono de cámara <i class="fas fa-camera"></i> para capturar
        </p>
    </div>
    <div class="input-group has-validation w-100">
        @include('visitantes.registro-visitantes.imagen-visitante')

    </div>
</div>
<div class="col-12" style="text-align: end">
    <button class="btn btn-primary" wire:click.prevent="increaseStep()">Siguiente</button>
</div>
