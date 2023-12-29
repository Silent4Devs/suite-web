 <table class="table">
        <thead class="head-light">
            <tr>
                <th scope="col-6">Nombre del integrante</th>
                <th scope="col-6">Rol</th>
                <th scope="col-6">Descripción del rol</th>
                <th scope="col-6">Opciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr id="fila{{ $data->id }}">
                    <th style="min-width: 100px; text-align:start;">
                        <img class="img_empleado"
                            style="border-radius: 50%;"
                            src="{{ asset('storage/empleados/imagenes') }}/{{ $data->asignacion ? $data->asignacion->avatar : 'user.png' }}"
                            title="{{ $data->asignacion->name }}">
                    </th>
                    <th style="min-width:130px;">{{ $data->nombrerol }}</th>
                    <td style="min-width:100px;">{!!$data->responsabilidades!!}</td>
                    <td style="min-width:40px;">
                        {{-- <a href="{{ route('admin.comiteseguridads.edit', $data->id) }}"><i class="fas fa-edit"></i></a> --}}
                        <a href="{{ route('admin.comiteseguridads.deleteMember', $data->id) }}"> <i class="fas fa-trash-alt text-danger"></i></a>

                    </td>
                </tr>
            @endforeach
        </tbody>
</table>


