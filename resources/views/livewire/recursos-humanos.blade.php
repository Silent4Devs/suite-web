<div class="form-group col-md-12">

    {{-- <label for="exampleInputEmail1"> <i class="fas fa-id-card iconos-crear"></i>3.¿Quién le proporciona esta
        información?</label> --}}

    <div class="row">
        @livewire('create-recursos-humanos', ['cuestionario_id' => $cuestionario_id])
    </div>
    
    <div class="row">
        <table class="table table-responsive" width="100%">
            <thead class="head-light">
                <tr>
                    <th scope="col-6">Escenario</th>
                    <th scope="col-6">Empresa / Área</th>
                    <th scope="col-6">Nombre(s)</th>
                    <th scope="col-4">Apellido. Pat</th>
                    <th scope="col-4">Apellido. Mat</th>
                    <th scope="col-6">Puesto</th>
                    <th scope="col-4">Rol</th>
                    <th scope="col-4">Tel/Ext.</th>
                    <th scope="col-6">Correo</th>
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
                                <div style="text-align: left;">{{ $data->escenario }}</div>
                            @endif

                        </th>
                        <th style="min-width:150px;">
                            <div style="text-align: left;">{{ $data->empresa }}</div>
                        </th>
                        <td style="min-width:150px;">
                            <div style="text-align: left;">{{ $data->nombre }}</div>
                        </td>
                        <td style="min-width:100px;">
                            <div style="text-align: left;">{{ $data->a_paterno }}</div>
                        </td>
                        <td style="min-width:100px;">
                            <div style="text-align: left;">{{ $data->a_materno }}</div>
                        </td>
                        <td style="min-width:150px;">
                            <div style="text-align: left;">{{ $data->puesto }}</div>
                        </td>
                        <td style="min-width:50px;">
                            <div style="text-align: left;">{{ $data->rol }}</div>
                        </td>
                        <td style="min-width:50px;">
                            <div style="text-align: left;">{{ $data->tel }}</div>
                        </td>
                        <td style="min-width:50px;">
                            <div style="text-align: left;">{{ $data->correo }}</div>
                        </td>
                        <td style="min-width:40px;">
                            <i class="fas fa-edit" wire:click.prevent="$emit('editarRecursos',{{ $data->id }})">
                            </i>
                            <i class="fas fa-trash-alt text-danger"
                                wire:click.prevent="$emit('eliminarRecursos',{{ $data->id }})"> </i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('cerrar-modal-recursos', (event) => {
            $('#modalRecursos').modal('hide');
            $('.modal-backdrop').hide();
            if (event.editar) {
                toastr.success('Editado con éxito');
            } else {
                toastr.success('Creado con éxito');
            }

        })
        Livewire.on('abrir-modal-recursos', () => {
            $('#modalRecursos').modal('show');
            $('.select2').select2({
                theme: 'bootstrap4'
            });

        })

    })
</script>
