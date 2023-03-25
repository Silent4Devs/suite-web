<div class="form-group col-md-12">

    {{-- <label for="exampleInputEmail1"> <i class="fas fa-id-card iconos-crear"></i>3.¿Quién le proporciona esta
        información?</label> --}}
    <div class="row">
        @livewire('create-recursos-materiales', ['cuestionario_id' => $cuestionario_id])
    </div>

    <div class="row">
       
            <table class="table" width="100%">
                <thead class="head-light">
                    <tr>
                        <th scope="col-6">Escenario</th>
                        <th scope="col-6">Equipos de Cómputo</th>
                        <th scope="col-6">Impresoras / Fax</th>
                        <th scope="col-6">Teléfonos</th>
                        <th scope="col-6">Otro (Token, foliadora, etc.)</th>
                        <th scope="col-6">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <th style="min-width:200px;">
                                @if ($data->escenario == 1)
                                    <div style="text-align: left;">Operación Normal</div>
                                @elseif ($data->escenario == 2)
                                    <div style="text-align: left;">En Contingencia</div>
                                @else
                                    <div style="text-align: left;">{{ $data->escenario }}</div>
                                @endif

                            </th>
                            <th style="min-width:200px;">
                                <div style="text-align: left;">{{ $data->equipos }}</div>
                            </th>
                            <td style="min-width:150px;">
                                <div style="text-align: left;">{{ $data->impresoras }}</div>
                            </td>
                            <td style="min-width:100px;">
                                <div style="text-align: left;">{{ $data->telefono }}</div>
                            </td>
                            <td style="min-width:150px;">
                                <div style="text-align: left;">{{ $data->otro }}</div>
                            </td>

                            <td style="min-width:40px;">
                                <i class="fas fa-edit"
                                    wire:click.prevent="$emit('editarMateriales',{{ $data->id }})">
                                </i>
                                <i class="fas fa-trash-alt text-danger"
                                    wire:click.prevent="$emit('eliminarMateriales',{{ $data->id }})"> </i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       
    </div>


</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('cerrar-modal-materiales', (event) => {
            $('#modalMateriales').modal('hide');
            $('.modal-backdrop').hide();
            if (event.editar) {
                toastr.success('Editado con éxito');
            } else {
                toastr.success('Creado con éxito');
            }

        })
        Livewire.on('abrir-modal-materiales', () => {
            $('#modalMateriales').modal('show');
            $('.select2').select2({
                theme: 'bootstrap4'
            });

        })

    })
</script>
