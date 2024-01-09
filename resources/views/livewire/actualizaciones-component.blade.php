<div class="card-body datatable-fix">
    <button type="button" class="btn btn-primary" wire:click='RevisarActualizaciones'
        wire:loading.attr="disabled">Comprobar</button>
    <div wire:loading wire:target="RevisarActualizaciones">
        Cargando ...
    </div>
</div>
