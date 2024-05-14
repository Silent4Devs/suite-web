<div class="aceptar-alcance">
    <x-loading-indicator />
    <style type="text/css">
    .aceptar-alcance {
        color: #666;
        font-size: 11pt;
        font-weight: bold;
    }

    .aceptar-alcance i {
        font-size: 13pt;
        transition: 0.1s;
        color: #00AAFF;
    }

    .aceptar-alcance:hover,
    .aceptado {
        color: #345183;
    }

    .aceptar-alcance:hover .aceptar i {
        transform: scale(1.1);
    }
    </style>
    @if(!$acepto_alcance)
    <label class="aceptar" wire:click="aceptar({{$id_alcance}})"><i class="far fa-check-square"></i> Acepto
        alcance</label>
    @else
    <label class="aceptado"><i class="fas fa-check-square"></i> Alcance aceptada</label>
    @endif
</div>
