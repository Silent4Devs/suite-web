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
                        $cleanedUri = str_replace('admin/', '', $route['uri']);
                    @endphp
                    <li class="list-group-item text-black"><a style="color: black"
                            href="{{ url($route['uri']) }}">{{ ucfirst($cleanedUri) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($lugar == 'portal')
        <input class="h-100" type="text" placeholder="Ejem: Cargar mis horas en Timesheet" autocomplete="off"
            wire:model="search">

        <div class="caja-list-search-global scroll_estilo">
            <ul class="list-group">
                @foreach ($result as $route)
                    @php
                        $cleanedUri = str_replace('admin/', '', $route['uri']);
                    @endphp
                    <li class="list-group-item text-black"><a style="color: black"
                            href="{{ url($route['uri']) }}">{{ ucfirst($cleanedUri) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
