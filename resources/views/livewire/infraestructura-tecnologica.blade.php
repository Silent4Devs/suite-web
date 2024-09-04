<div class="form-group col-md-12">

    {{-- <label for="exampleInputEmail1"> <i class="fas fa-id-card iconos-crear"></i>3.¿Quién le proporciona esta
        información?</label> --}}

    <div class="row">
        @livewire('create-infraestructura-tecnologica', ['cuestionario_id' => $cuestionario_id])
    </div>

    <table class="table">
        <thead class="head-light">
            <tr>
                <th scope="col-6">Escenario</th>
                <th scope="col-4">Sistemas</th>
                <th scope="col-6">Aplicativos / Utilerías</th>
                <th scope="col-6">Bases&nbsp;de&nbsp;Datos</th>
                <th scope="col-6">Otro</th>
                <th scope="col-6">Opciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>

                    <th style="min-width:130px;">
                        @if ($data->escenario == 1)
                        <div style="text-align: left;">Operación Normal</div>
                        @elseif ($data->escenario == 2)
                        <div style="text-align: left;">En Contingencia</div>
                        @else
                        <div style="text-align: left;">{{$data->escenario}}</div>
                        @endif
                        
                    </th>
                    <td style="min-width:80px;">
                        <div style="text-align: left;">{{ $data->sistemas}}</div>
                    </td>
                    <td style="min-width:100px;">
                        <div style="text-align: left;">{{ $data->aplicativos }}</div>
                    </td>
                    <td style="min-width:100px;">
                        <div style="text-align: left;">{{ $data->base_datos }}</div>
                    </td>
                    <td style="min-width:50px;">
                        <div style="text-align: left;">{{ $data->otro }}</div>
                    </td>
                    <td style="min-width:40px;">
                        <i class="fas fa-edit"
                            wire:click.prevent="$emit('editarInfraestructura',{{ $data->id }})">
                        </i>
                        {{-- <i class="fas fa-project-diagram"
                            wire:click.prevent="$emit('agregarNormas',{{ $data->id }})"> </i> --}}
                        <i class="fas fa-trash-alt text-danger"
                            wire:click.prevent="$emit('eliminarInfraestructura',{{ $data->id }})"> </i>
                    </td>
                    {{-- <td> @livewire('edit-partes-interesadas',['id_requisito'=>$data->id])</td> --}}
                </tr>
            @endforeach

        </tbody>
    </table>


</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('cerrar-modal-infraestructura', (event) => {
            $('#modalInfraestructura').modal('hide');
            $('.modal-backdrop').hide();
            if (event.editar) {
                toastr.success('Editado con éxito');
            } else {
                toastr.success('Creado con éxito');
            }

        })
        Livewire.on('abrir-modal-infraestructura', () => {
            $('#modalInfraestructura').modal('show');
            $('.select2').select2({
                theme: 'bootstrap4'
            });

        })
      
    })
</script>
