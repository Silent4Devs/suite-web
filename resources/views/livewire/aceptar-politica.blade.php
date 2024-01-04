<div class="aceptar-politica">
    <x-loading-indicator />
    <style type="text/css">
    .aceptar-politica {
        color: #666;
        font-size: 11pt;
        font-weight: bold;
    }

    .aceptar-politica i {
        font-size: 13pt;
        transition: 0.1s;
        color: #00AAFF;
    }

    .aceptar-politica:hover,
    .aceptado {
        color: #345183;
    }

    .aceptar-politica:hover .aceptar i {
        transform: scale(1.1);
    }
    </style>
    @if(!$acepto_politica)
    <label class="aceptar" wire:click="aceptar({{$id_politica}})"><i class="far fa-check-square"></i> Acepto
        politica</label>
    @else
    <label class="aceptado"><i class="fas fa-check-square"></i> Politicas aceptada</label>
    @endif
</div>
