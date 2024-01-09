<div>
    @if ($lugar == 'header')
        <div class="d-flex align-items-center mb-3">
            <div class="caja-buscador-header" wire:loading.remove>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" class="form-control" placeholder="Buscar ..." wire:model="search">
            </div>

            <div class="spinner-border text-red ml-2" role="status" wire:loading wire:target="search">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div>
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
