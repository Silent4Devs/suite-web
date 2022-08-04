<div>
    <x-loading-indicator />
    <button class="btn btn-success btn-sm" wire:click.prevent="exportTo('{{ $tipo }}')">Exportar a
        {{ $tipo }}</button>
</div>
