<div class="row m-0 w-100 justify-content-center">
    <div class="col-sm-12 col-lg-4 col-4 text-center header-text border rounded py-5">
        <h3 style="color: #3086AF">¡TE HAS REGISTRADO CON ÉXITO!</h3>
        @include('visitantes.registro-visitantes._visitante-registrado', [
            'visitante' => $visitanteFake,
            'mostrarQrIngreso' => false,
            'urlQrIngreso' => '',
            'mostrarQrSalida' => false,
            'urlQrSalida' => '',
        ])
    </div>
    <div class="col-12 mt-3" style="text-align: end">
        <button class="btn btn-primary" wire:click.prevent="guardarRegistroVisitante()">Finalizar</button>
    </div>
</div>
