<div>
    <x-loading-indicator />
    <button class="btn" style="border: 1px solid #8f8f8f;color:#8f8f8f;"
        wire:click.prevent="exportTo('{{ $tipo }}')">
        <i class="fas fa-file-excel"></i> Exportar a {{ $tipo }}</button>
</div>
