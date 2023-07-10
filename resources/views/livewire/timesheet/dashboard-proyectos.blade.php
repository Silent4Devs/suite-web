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
            <option value="0">Todas</option>
            @foreach ($lista_areas as $area)
                <option value="{{ $area->area->id }}">{{ $area->area->area }}</option>
            @endforeach
        </select>
        </div>
    </div>
    {{-- <canvas id="graf-proyectos-area"></canvas> --}}
</div>

<script>
            // console.log({{$lista_proyectos}});
    document.addEventListener('DOMContentLoaded', function() {
        // console.log('test');
        // const areas_labels = (datos_areas) => {
        //     const areas = array.filter(item => item.area === area)
        //     chart.data.labels = areas.map(item => item['area'])
        //     chart.data.datasets[0].data = areas.map(item => item['times_aprobados'])
        //     chart.data.datasets[1].data = areas.map(item => item['times_pendientes'])
        //     chart.data.datasets[2].data = areas.map(item => item['times_rechazados'])
        //     chart.data.datasets[3].data = areas.map(item => item['times_papelera'])
        //     chart.update()
        // }
        // $('#proyectos').on('change', function(event) {
            // if (event.target.value != 'todas') {
            //     areas_labels(event.target.value)
            // } else {
            //     chart.data.labels = array.map(item => item['area'])
            //     chart.data.datasets[0].data = array.map(item => item['times_aprobados'])
            //     chart.data.datasets[1].data = array.map(item => item['times_pendientes'])
            //     chart.data.datasets[2].data = array.map(item => item['times_rechazados'])
            //     chart.data.datasets[3].data = array.map(item => item['times_papelera'])
            //     chart.update()
            // }
        // });
        Livewire.on('renderAreas', (datos_areas) => {
            console.log(datos_areas);
        });
    });
</script>

{{-- // $('#areas-graf-registros-general').on('change', function(event) {
    //     if (event.target.value === 'todas') {
    //         graf_general.data.datasets[0].data = [{{ $counters['aprobados_contador'] }},
    //             {{ $counters['rechazos_contador'] }},
    //             {{ $counters['pendientes_contador'] }}, {{ $counters['borrador_contador'] }}
    //         ]
    //         graf_general.update()
    //     } else {
    //         const area = array.filter(item => item.area == event.target.value)
    //         graf_general.data.datasets[0].data = [
    //             area[0].times_aprobados,
    //             area[0].times_rechazados,
    //             area[0].times_pendientes,
    //             area[0].times_papelera
    //         ]
    //         graf_general.update();
    //     }
    // }); --}}


{{--</div> --}}
