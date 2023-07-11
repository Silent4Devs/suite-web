<div>
    <x-loading-indicator />
    <div class="row" wire:ignore>
        <div class="col-md-6 form-group" style="padding-left:0px !important;">
            <label class="form-label">Estatus</label>
            <select class="form-control" wire:model="estatus">
                <option selected value="0">Todos</option>
                <option value="proceso">En Proceso</option>
                <option value="terminado">Terminados</option>
                <option value="cancelado">Cancelados</option>
            </select>
        </div>
        <div class="col-md-6 form-group" style="padding-left:0px !important;">
        <label class="form-label">Proyecto</label>
        <select class="form-control" wire:model="proy_id" id="proyectos">
            <option value="0" selected>Seleccione un proyecto</option>
            @foreach ($lista_proyectos as $pro)
                <option value="{{ $pro->id }}">{{ $pro->proyecto }}</option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 form-group" style="padding-left:0px !important;">
        <label class="form-label">Areas</label>
        <select class="form-control" wire:model="area_id">
            <option value="todas">Todas</option>
            @foreach ($lista_areas as $area)
                <option value="{{ $area->area->id }}">{{ $area->area->area }}</option>
            @endforeach
        </select>
        </div>
    </div>
    <div wire:ignore>
        <canvas id="graf-proyectos-area"></canvas>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('renderAreas', (datos_areas) => {
            console.log(datos_areas);
            let grafica_proyectos = new Chart(document.getElementById('graf-proyectos-area'), {
                type: 'horizontalBar',
        data: {
            labels: datos_areas.map(item => item.area),
            datasets: [{
                    type: "horizontalBar",
                    backgroundColor: "#61CB5C",
                    label: "Horas Invertidas",
                    data: datos_areas.map(item => item.total_horas_area),
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#F48C16",
                    label: "Tareas del Proyecto",
                    data: datos_areas.map(item => item.tareas),
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
            ]
        },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                layout: {
                    padding: {
                        top: 20
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'start',
                    labels: {
                        fontColor: "black",
                        boxWidth: 20,
                        padding: 10
                    }
                },
                plugins: {
                    datalabels: {
                        color: '#fff',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            }
        });
    });
});
</script>
