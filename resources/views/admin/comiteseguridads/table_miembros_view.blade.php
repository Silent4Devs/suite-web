<table class=table table-bordered table-striped">
    <thead>
        <tr>
            <th scope="col" style="min-width: 150px;">Nombre del Rol</th>
            <th scope="col" style="min-width: 250px;">Nombre del Colaborador</th>
            <th scope="col" style="min-width: 150px;">Responsabilidades</th>
            <th scope="col" style="min-width: 100px;">Alta</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <th scope="row" style="text-align: left;"> {{ $data->nombrerol ?: 'No definido' }}</th>
                @if (!empty($data->asignacion->name))
                    <td> {{ $data->asignacion->name}}</td>
                @else
                    <td style="text-align: left;"> No definido </td>
                @endif
                @if ($data->responsabilidades)
                    <td style="text-align: left;">{!! $data->responsabilidades !!}</td>
                @else
                    <td style="text-align: left;">No definido</td>
                @endif
                <td style="text-align: left;">{{ $data->fechavigor ?: 'No definido' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
