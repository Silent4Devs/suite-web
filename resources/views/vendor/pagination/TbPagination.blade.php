@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center">
        <p class="small text-muted mb-0">
            Mostrando {{ $paginator->lastItem() }} de {{ $paginator->total() }} resultados
        </p>

        <nav>
            <ul class="pagination mb-0">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="page-link">Anterior</button>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <button wire:click="gotoPage({{ $page }})" class="page-link">{{ $page }}</button>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="page-link">Siguiente</button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Siguiente</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
