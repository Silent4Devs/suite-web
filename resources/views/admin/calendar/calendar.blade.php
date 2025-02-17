@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('admin.system-calendar') }} --}}
    <h5 class="col-12 titulo_general_funcion"> Calendario de {{ $nombre_organizacion }} </h5>
    <div class="card">
        <div class="py-2 col-md-10 col-sm-9 card-body bg-primary align-self-center " style="margin-top:0px !important; "></div>
        <div class="card-body" style="height: 700px;">
            <div id='calendar'></div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('../js/global/calendar/index.global.js') }}"></script>
    <script src="{{ asset('../js/global/calendar/locales/locales-all.global.js') }}"></script>
    <script src="{{ asset('../js/global/TbCommonUtilities.js') }}"></script>
    <script src="{{ asset('../js/calendary/renderCalendary.js')}}"></script>

    <script>
        @php
            $facturasData = [];
            $cumpleData = [];
            $aniversarioData = [];
            $revisionesData = [];
        @endphp

        @foreach ($facturas as $facturas_iterado)
            @php
                $facturasData[] = [
                    'id' => 'facturas_iterado' . $facturas_iterado->id,
                    'calendarId' => '9',
                    'title' => $facturas_iterado->concepto,
                    'category' => 'allday',
                    'dueDateClass' => '',
                    'start' => \Carbon\Carbon::parse($facturas_iterado->fecha_recepcion)->format('Y-m-d'),
                    'end' => \Carbon\Carbon::parse($facturas_iterado->fecha_liberacion)->format('Y-m-d'),
                    'isReadOnly' => true,
                ];
            @endphp
        @endforeach

        @foreach ($cumples_aniversarios as $cumple)
            @php
                $cumpleData[] = [
                    'id' => 'cumple' . $cumple->id,
                    'calendarId' => '5',
                    'title' => $cumple->name,
                    'category' => 'allday',
                    'dueDateClass' => '',
                    'start' => $cumple->actual_birdthday,
                    'end' => $cumple->actual_birdthday,
                    'isReadOnly' => true,
                ];
            @endphp
        @endforeach

        @foreach ($cumples_aniversarios as $aniversario)
            @php
                $aniversarioData[] = [
                    'id' => $aniversario->id,
                    'calendarId' => '6',
                    'title' => $aniversario->name,
                    'category' => 'allday',
                    'dueDateClass' => '',
                    'start' => $aniversario->actual_aniversary,
                    'end' => $aniversario->actual_aniversary,
                    'isReadOnly' => true,
                ];
            @endphp
        @endforeach

        @foreach ($niveles_servicio as $revisiones)
                @php
                    $revisionesData[] =[
                        "id"=> $revisiones->id ,
                        "calendarId" => '11',
                        "title" => $revisiones->nombre_entregable ,
                        "category" => 'allday',
                        "dueDateClass" => '',
                        "start" => \Carbon\Carbon::parse($revisiones->plazo_entrega_inicio)->format('Y-m-d') ,
                        "end" => \Carbon\Carbon::parse($revisiones->plazo_entrega_termina)->format('Y-m-d'),
                        "isReadOnly" => true,
                    ];
                @endphp
            @endforeach

        @php
            $facturasJson = json_encode($facturasData);
            $cumpleJson = json_encode($cumpleData);
            $aniversarioJson = json_encode($aniversarioData);
            $revisionesJson = json_encode($revisionesData);
        @endphp

        ScheduleList = [
            @foreach ($recursos as $it_recursos)
                {
                    id: 'recursos{{ $it_recursos->id }}',
                    calendarId: '2',
                    title: '<i class="fas fa-graduation-cap i_calendar_cuadro"></i> Curso: {{ $it_recursos->cursoscapacitaciones }}',
                    category: 'time',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::parse($it_recursos->fecha_curso)->toDateTimeString() }}',
                    end: '{{ \Carbon\Carbon::parse($it_recursos->fecha_fin)->toDateTimeString() }}',
                    body: `
                        <font style="font-weight: bold;">Categoria:</font> ${@json($it_recursos->tipo)}<br>
                        <font style="font-weight: bold;">Inicio:</font> ${@json($it_recursos->fecha_curso)} horas<br>
                        <font style="font-weight: bold;">Fin:</font> ${@json($it_recursos->fecha_fin)} horas<br>
                        <font style="font-weight: bold;">Duración:</font> ${@json($it_recursos->duracion)} horas<br>
                        <font style="font-weight: bold;">Instructor:</font> ${@json($it_recursos->instructor)}<br>
                        <font style="font-weight: bold;">${@json($it_recursos->modalidad)=='presencial' ? 'Ubicación' : 'Link'}:</font> ${@json($it_recursos->ubicacion)}<br>
                    `,
                    isReadOnly: true,
                },
            @endforeach
            @foreach ($eventos as $evento)
                {
                    id: 'evento{{ $evento->id }}',
                    calendarId: '4',
                    title: '<i class="fas fa-cocktail i_calendar_cuadro"></i> Evento: {{ $evento->nombre }}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::parse(explode('-', $evento->fecha)[0])->format('Y-m-d') }}',
                    end: '{{ \Carbon\Carbon::parse(explode('-', $evento->fecha)[1])->format('Y-m-d') }}',
                    isReadOnly: true,
                    body: `
                        <font style="font-weight: bold;">Categoria:</font> ${@json($evento->tipo)}<br>
                        <font style="font-weight: bold;">Inicio:</font> ${@json($evento->fecha_curso)} horas<br>
                        <font style="font-weight: bold;">Fin:</font> ${@json($evento->fecha_fin)} horas<br>
                        <font style="font-weight: bold;">Duración:</font> ${@json($evento->duracion)} horas<br>
                        <font style="font-weight: bold;">Instructor:</font> ${@json($evento->instructor)}<br>
                        <font style="font-weight: bold;">${@json($evento->modalidad)=='presencial' ? 'Ubicación' : 'Link'}: </font>${@json($evento->modalidad)=='presencial' ? @json($evento->ubicacion) : '<a href="'+@json($evento->ubicacion)+'">'+@json($evento->ubicacion)+'</a> '} <br>
                    `,
                },
            @endforeach
            @foreach ($cumples_aniversarios as $cumple)
                {
                    id: 'cumple{{ $cumple->id }}',
                    calendarId: '5',
                    title: '<i class="fas fa-birthday-cake i_calendar_cuadro"></i> Cumpleaños de {{ $cumple->name }} ',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ $cumple->actual_birdthday }}',
                    end: '{{ $cumple->actual_birdthday }}',
                    isReadOnly: true,
                    body: `
                        <font style="font-weight: bold;">Cumpleaños:</font> ${@json(\Carbon\Carbon::parse($cumple->cumpleaños)->format('d-m'))}<br>
                        <font style="font-weight: bold;">Area:</font> ${@json($cumple->area ? $cumple->area->area : null)}<br>
                        <font style="font-weight: bold;">Puesto:</font> ${@json($cumple->puesto)}<br>

                    `,
                },
            @endforeach
            @foreach ($cumples_aniversarios as $aniversario)
                {
                    id: 'aniversario{{ $aniversario->id }}',
                    calendarId: '6',
                    title: '<i class="fas fa-award i_calendar_cuadro"></i> Aniversario de {{ $aniversario->name }}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ $aniversario->actual_aniversary }}',
                    end: '{{ $aniversario->actual_aniversary }}',
                    isReadOnly: true,
                    body: `
                        <font style="font-weight: bold;">Aniversario:</font> ${@json(\Carbon\Carbon::parse($aniversario->antiguedad)->format('d-m'))}<br>
                        <font style="font-weight: bold;">Area:</font> ${@json($aniversario->area ? $aniversario->area->area : null)}<br>
                        <font style="font-weight: bold;">Puesto:</font> ${@json($aniversario->puesto)}<br>

                    `,
                },
            @endforeach
            @foreach ($oficiales as $oficial)
                {
                    id: 'oficial{{ $oficial->id }}',
                    calendarId: '7',
                    title: '<i class="fas fa-drum i_calendar_cuadro"></i> Festivo: {{ $oficial->nombre }}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::parse(explode('-', $oficial->fecha)[0])->format('Y-m-d') }}',
                    end: '{{ \Carbon\Carbon::parse(explode('-', $oficial->fecha)[1])->format('Y-m-d') }}',
                    isReadOnly: true,
                },
            @endforeach
            @foreach ($contratos as $contrato)
                {
                    id: 'contrato{{ $contrato->id }}',
                    calendarId: '8',
                    title: '<i class="fas fa-drum i_calendar_cuadro"></i> Contrato: {{ $contrato->nombre_servicio }}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::parse($contrato->fecha_inicio)->format('Y-m-d') }}',
                    end: '{{ \Carbon\Carbon::parse($contrato->fecha_fin)->format('Y-m-d') }}',
                    isReadOnly: true,
                },
            @endforeach
            @foreach ($facturas as $facturas_iterado)
                {
                    id: 'facturas_iterado{{ $facturas_iterado->id }}',
                    calendarId: '9',
                    title: '<i class="fas fa-drum i_calendar_cuadro"></i> Factura: {{ $facturas_iterado->concepto }}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::parse($facturas_iterado->fecha_recepcion)->format('Y-m-d') }}',
                    end: '{{ \Carbon\Carbon::parse($facturas_iterado->fecha_liberacion)->format('Y-m-d') }}',
                    isReadOnly: true,
                },
            @endforeach
            @foreach ($niveles_servicio as $revisiones)
                {
                    id: 'revisiones{{ $revisiones->id }}',
                    calendarId: '11',
                    title: '<i class="fas fa-drum i_calendar_cuadro"></i> Revision de entregables: {{ $revisiones->nombre_entregable }}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::parse($revisiones->plazo_entrega_inicio)->format('Y-m-d') }}',
                    end: '{{ \Carbon\Carbon::parse($revisiones->plazo_entrega_termina)->format('Y-m-d') }}',
                    isReadOnly: true,
                },
            @endforeach
        ];
    </script>

    <script>
        var calendar;
        let eventsCalendar = [];
        let recursos = @json($recursos);
        let events = @json($eventos);
        let oficiales = @json($oficiales);
        let contratos = @json($contratos);
        var facturas = {!! $facturasJson !!};
        var cumple = {!! $cumpleJson !!};
        var aniversario = {!! $aniversarioJson !!};
        var revisiones = {!! $revisionesJson !!};
    </script>

    </script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $(".tui-full-calendar-weekday-schedule-title").attr("title", "");
        });
    </script>
@stop
