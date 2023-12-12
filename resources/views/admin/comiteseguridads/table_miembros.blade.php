 <table class="table">
        <thead class="head-light">
            <tr>
                <th scope="col-6">Colaborador</th>
                <th scope="col-6">Posición</th>
                <th scope="col-6">Responsabilidades</th>
                <th scope="col-6">Entrada en vigor</th>
                <th scope="col-6">Opciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <th style="min-width:130px;"><img class="img_empleado"
                            src="{{ asset('storage/empleados/imagenes') }}/{{ $data->asignacion ? $data->asignacion->avatar : 'user.png' }}"
                            title="{{ $data->asignacion->name }}"></th>
                    <th style="min-width:130px;">{{ $data->nombrerol }}</th>
                    <td style="min-width:100px;">{!!$data->responsabilidades!!}</td>
                    <td style="min-width:100px;">{{ $data->fechavigor }}</td>
                    <td style="min-width:40px;">
                        <i class="fas fa-edit" wire:click.prevent="$emit('editarParteInteresada',{{ $data->id }})">
                        </i>
                        <i class="fas fa-trash-alt text-danger" wire:click.prevent="$emit('eliminarParteInteresada',{{ $data->id }})"> </i>
                    </td>
                </tr>
            @endforeach

        </tbody>
</table>
