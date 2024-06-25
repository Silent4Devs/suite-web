<div class="w-100 h-100">
    @if ($lugar == 'header')
        <div class="d-flex align-items-center">
            <div class="caja-buscador-header" wire:loading.remove>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" class="" placeholder="Buscar ..." wire:model="search">
            </div>

            <div class="spinner-border text-red ml-2" role="status" wire:loading wire:target="search">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="caja-list-search-global scroll_estilo">
            <ul class="list-group">
                @foreach ($result as $route)
                    @php
                        $cleanedUri = preg_replace('/^(admin|Contract_manager)\/?/', '', $route['uri']);
                        $cleanedUri = str_replace('-', ' ', $cleanedUri);
                    @endphp
                    @if (strpos($cleanedUri, 'File manager') === false)
                        <li class="list-group-item text-black">
                            <a style="color: black" href="{{ url($route['uri']) }}">{{ ucfirst($cleanedUri) }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
    @if ($lugar == 'portal')
        <input class="h-100" type="text" placeholder="Ejem: Cargar mis horas en Timesheet" autocomplete="off"
            wire:model.lazy="search"  wire:click.prevent="askAsisten">
            {{-- <button wire:click='askAsistenText'>Guardar</button> --}}

            <div class="container mt-5 position-relative">
                @if ($respuesta = $this->respuesta['response'] ?? null)
                    <div class="alert alert-dismissible position-absolute w-100" style="top: -3rem; z-index: 1050; background-color: #fff3cd; color: #000; font-size: 1.25rem; text-align: justify; padding: 1rem;">
                        <p class="mb-0">{{ $respuesta }}</p>
                    </div>
                @endif
            </div>

        <div class="caja-list-search-global scroll_estilo">
            <ul class="list-group">
                @foreach ($result as $route)
                    @php
                        $cleanedUri = preg_replace('/^(admin|Contract_manager|)\/?/', '', $route['uri']);
                        $cleanedUri = str_replace('-', ' ', $cleanedUri);
                    @endphp
                    @if (strpos($cleanedUri, 'File manager') === false)
                        <li class="list-group-item text-black">
                            <a style="color: black" href="{{ url($route['uri']) }}">{{ ucfirst($cleanedUri) }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
</div>
