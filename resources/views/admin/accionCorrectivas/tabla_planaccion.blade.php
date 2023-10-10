<p>Total de registro encontrados en la acción:
    @if(empty($Count))
        0
    @else
        {{$Count}}
    @endif
</p>
<table class="table" id="editplanact" style="font-size: 12px;">
    <thead class="thead-dark">
    <tr>
        <th scope="col">NO</th>
        <th scope="col">Actividad</th>
        <th scope="col">Fecha compromiso</th>
        <th scope="col">Estado</th>
        <th scope="col">Responsable</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($Planaccion))
        @foreach($Planaccion as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->actividad}}</td>
                <td>{{$item->fechacompromiso}}</td>
                <td>{{$item->estatus}}</td>
                <td>{{$item->responsable_id}}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endif
    </tbody>
</table>
