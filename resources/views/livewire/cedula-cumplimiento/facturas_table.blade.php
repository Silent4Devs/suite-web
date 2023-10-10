<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>No. Factura</th>
                <th>Concepto</th>
                <th>Hallazgo/Comentario</th>
                <th>Cumplimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facturas as $factura)
                <tr>
                    <td>{{ $factura->no_factura }}</td>
                    <td>{{ $factura->concepto }}</td>
                    <td>{{ $factura->hallazgos_comentarios }}</td>
                    <td><span style="color: {{ $factura->cumple == 1 ? 'green' : 'red' }}"
                            class="fas fa-{{ $factura->cumple == 1 ? 'check' : 'times' }}"></span>
                        {{ $factura->cumple == 1 ? 'Cumple' : 'No Cumple' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
