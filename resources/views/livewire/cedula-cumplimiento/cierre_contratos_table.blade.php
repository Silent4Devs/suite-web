<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Aspectos para validación de cierre</th>
                <th>Cumple</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cierre_contratos as $cierre_contrato)
                <tr>
                    <td>{{ $cierre_contrato->aspectos }}</td>
                    <td>
                        @if ($cierre_contrato->cumple)
                            <div style="display: flex; align-items: center">
                                <i class="material-icons green-text">check</i>
                                <span>Cumple</span>
                            </div>
                        @else
                            <div style="display: flex; align-items: center">
                                <i class="material-icons red-text">close</i>
                                <span> No cumple</span>
                            </div>
                        @endif
                    </td>
                    <td>{{ $cierre_contrato->observaciones }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
