<div>
    <div class="card">
        <div class="card-body black-text">
            <div>
                @include('livewire.evaluacion-servicio.table')
            </div>
            <br>
            <div>
                @include("livewire.evaluacion-servicio.$view", ['evauacion_props' => $evaluacion_props])
            </div>
        </div>
    </div>
</div>
