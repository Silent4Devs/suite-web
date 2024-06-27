<div class="card">
    <div class="card-body">
        {{--  <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search" wire:model.lazy="search">
        </div>  --}}
        <div wire:loading wire:target='search'>
            Cargando...
        </div>
        <div class="d-flex justify-content-end">
            <a class="boton-transparente boton-sin-borde" href="{{ route('descarga-visualizar-logs') }}">
                <i class="fas fa-file-excel icon" style="font-size: 1.5rem;color:#0f6935"></i>
            </a> &nbsp;&nbsp;&nbsp;
        </div>
        <div class="table-responsive" wire:remove>
            <table class="table">
                <thead>
                    <tr>
                        <th style="vertical-align: top">
                            ID
                        </th>
                        <th style="vertical-align: top">
                            User
                        </th>
                        <th style="vertical-align: top">
                            Event
                        </th>
                        <th style="vertical-align: top">
                            Old Value
                        </th>
                        <th style="vertical-align: top">
                            New value
                        </th>
                        <th style="vertical-align: top">
                            URL
                        </th>
                        <th style="vertical-align: top">
                            Tags
                        </th>
                        <th style="vertical-align: top">
                            Fecha creación
                        </th>
                        <th style="vertical-align: top">
                            Fecha última actualización
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user->name ?? 'No user' }}</td>
                            <td>{{ $item->event }}</td>
                            <td>
                                <p>
                                    @foreach (json_decode($item->old_values, true) as $key => $value)
                                        @if ($key == 'remember_token')
                                            <strong>Remember token</strong>
                                        @elseif ($key == 'password')
                                            <strong>Password</strong>
                                            <br>
                                        @else
                                            <strong>{{ $key }}:</strong> {{ $value }}<br>
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                            <td>
                                <p>
                                    @foreach (json_decode($item->new_values, true) as $key => $value)
                                        @if ($key == 'remember_token')
                                            <strong>Remember token changed</strong>
                                        @elseif ($key == 'password changed')
                                            <strong>Password</strong>
                                            <br>
                                        @else
                                            <strong>{{ $key }}:</strong> {{ $value }}<br>
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                            <td>{{ $item->url }}</td>
                            <td>{{ $item->tags }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $articles->links() }}

</div>
