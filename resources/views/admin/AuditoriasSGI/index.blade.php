@extends('layouts.admin')

@section('content')
{{ Breadcrumbs::render('admin.system-calendar') }}


<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css">
<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">

<link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/tui-calendar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/default.css') }}">

<style type="text/css">
    .Tarjetap {
        /* CSS proporcionado */
        /* Layout Properties */
        top: 140px;
        left: 286px;
        width: 1020px;
        height: 57px;
        display: flex;
        align-items: center;
        padding: 32px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 16px;
        opacity: 1;
    }

    .Tarjetap2 {
        top: 287px;
        left: 285px;
        width: 1020px;
        height: 57px;
        display: flex;
        align-items: center;
        padding: 32px;
        /* UI Properties */
        background: #FCF8C4 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 8px;
        opacity: 1;
        border-left: none;
        /* Quitar el borde del lado izquierdo */
    }

    .ojo-botones-o {
        top: 212px;
        left: 287px;
        width: 61px;
        height: 58px;
        margin: 16px 0px 0px 0px;
        background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
        background: #4BB3E8 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 8px 0px 0px 8px;
        opacity: 1;
        display: flex;
        justify-content: center;
    }

    .ojo-botones-a {
        top: 212px;
        left: 287px;
        width: 61px;
        height: 58px;
        margin: 16px 0px 0px 0px;
        background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
        background: #306BA9 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 8px 0px 0px 8px;
        opacity: 1;
        display: flex;
        justify-content: center;
    }

    .letra-tarjeta {
        /* Layout Properties */
        top: 393px;
        left: 366px;
        width: 143px;
        height: 39px;
        display: flex;
        align-items: center;
        padding: 32px;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal medium 16px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        color: var(--unnamed-color-464646);
        text-align: left;
        font: normal normal medium 16px/20px Roboto;
        letter-spacing: 0px;
        color: #464646;
        font-weight: bold;
        opacity: 1;
    }

    .letra-tarjeta2 {
        /* Layout Properties */
        top: 393px;
        left: 366px;
        width: 143px;
        height: 39px;
        display: flex;
        align-items: center;
        padding: 45px;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal medium 16px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        color: var(--unnamed-color-464646);
        text-align: left;
        font: normal normal medium 16px/20px Roboto;
        letter-spacing: 0px;
        color: #464646;
        font-weight: bold;
        opacity: 1;
    }

    .tarjetas-container {
        display: flex;
    }

    .botones {
        top: 212px;
        left: 287px;
        width: 160px;
        height: 58px;
        margin: 16px 0px 0px 0px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 0px 8px 8px 0px;
        opacity: 1;
    }

    .botones2 {
        top: 367px;
        left: 285px;
        width: 160px;
        height: 90px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 0px 16px 16px 0px;
        opacity: 1;
    }

    .datosconformidades {
        display: flex;
        justify-content: center;
        top: 367px;
        left: 285px;
        width: 61px;
        height: 90px;
        background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 8px 0px 0px 8px;
        border-right: 6px solid gray;
        border-right-style: solid;
        border-right-width: medium;
        opacity: 1;
    }

    .fondo-grafica {
        /* Layout Properties */
        top: 474px;
        left: 285px;
        width: 1020px;
        height: 474px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 2px 4px #0000001F;
        border-radius: 16px;
        opacity: 1;
    }

    .titulo-graficas {
        top: 515px;
        left: 313px;
        height: 24px;
        display: flex;
        padding: 32px 32px 25px 32px;
        /* UI Properties */
        text-align: left;
        font: normal normal normal 20px/24px Roboto;
        letter-spacing: 0px;
        color: #5A5A5A;
        opacity: 1;
    }

    .subtitulo {
        /* Layout Properties */
        margin: 6px 12px 20px 16px;
        top: 303px;
        left: 286px;
        height: 22px;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal medium 18px/22px var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        text-align: left;
        font: 18px Roboto;
        letter-spacing: 0px;
        color: #2567AE;
        opacity: 1;
        font-weight: bold;
    }

    .tarjetas {
        margin: 6px 0px 0px 0px;
        top: 344px;
        left: 287px;
        width: 225px;
        height: 80px;
        margin-left: 1px;
        opacity: 1;
        border-radius: 8px
    }

    .letra-tarjeta-MYA {
        margin-top: 15px;
        margin-left: 20px;
        text-align: left;
        font: 14px Roboto;
        letter-spacing: 0px;
        color: #FFFFFF;
        opacity: 1;
        display: flex;
        align-items: center;
    }

    .datos-letra-tarjeta-MYA {
        margin-left: 20px;
        text-align: left;
        font: 24px Roboto;
        letter-spacing: 0px;
        color: #FFFFFF;
        font-weight: bolder;
        opacity: 1;
        display: flex;
        align-items: center;
    }

    .display-grafica {
        top: 438px;
        left: 287px;
        width: 480px;
        height: 477px;
        margin: 20px 0px 40px 0px;
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 2px 4px #0000001F;
        border-radius: 16px;
        opacity: 1;
    }
    .filtro{
        /* Layout Properties */
        margin-left: 500px;
        top: 152px;
        left: 500px;
        width: 157px;
        height: 34px;
        /* UI Properties */
        border: 1px solid var(--unnamed-color-d5d5d5);
        background: #F8FAFC 0% 0% no-repeat padding-box;
        border: 1px solid #D5D5D5;
        border-radius: 4px;
        opacity: 1;
    }
    .letra-filtro{
        margin-top: 8px;
        margin-left: 15px;
        top: 152px;
        left: 500px;
        width: 157px;
        height: 34px;
        text-align: left;
        font: 14px Roboto;
        letter-spacing: 0px;
        color: #606060;
        opacity: 1;
    }
    .titulo-dashboard{
        margin: 6px 12px 24px 8px;
        top: 303px;
        left: 286px;
        height: 22px;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal medium 18px/22px var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        text-align: left;
        font: 24px Roboto;
        letter-spacing: 0px;
        color: #2567AE;
        opacity: 1;
        font-weight: bold;
    }
</style>


                    {{-- HTML DASHBOARD --}}

<div class="container">
    <h1 class="titulo-dashboard">Dashboard</h1>
    <div class="Tarjetap">
        Selecciona la Norma que desees monitorear
        <div class="form-group">
            <select class="form-control filtro">
                <option>ISO 270001</option>
            </select>
        </div>
    </div>
</div>

<div>
    <div class="row">
        {{-- MI PLAN ISO --}}
        <div class="col-md-3">
            <ul class="nav nav-tabs d-flex inline">
                <li class="active ojo-botones-o">
                    <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </li>
                <a class="botones" href="#mi-plan-iso" data-toggle="tab">
                    <h3 class="letra-tarjeta">Mi plan ISO</h3>
                </a>
            </ul>
        </div>
        {{-- RIESGOS --}}
        <div class="col-md-3">
            <ul class="nav nav-tabs d-flex inline">
                <li class="ojo-botones-o">
                    <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </li>
                <a class="botones" href="#riesgos" data-toggle="tab">
                    <h3 class="letra-tarjeta">Riesgos</h3>
                </a>
            </ul>
        </div>
        {{-- Auditorias --}}
        <div class="col-md-3">
            <ul class="nav nav-tabs d-flex inline">
                <li class="ojo-botones-a">
                    <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </li>
                <a class="botones" href="#auditorias" data-toggle="tab">
                    <h3 class="letra-tarjeta">Auditorias</h3>
                </a>
            </ul>
        </div>
        {{-- Mejoras y Acciones --}}
        <div class="col-md-3">
            <ul class="nav nav-tabs d-flex inline">
                <li class="ojo-botones-a">
                    <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </li>
                <a class="botones" href="#mejorasyacciones" data-toggle="tab">
                    <h3 class="letra-tarjeta">Mejoras y Acciones</h3>
                </a>
            </ul>
        </div>
    </div>
</div>
<div class="tab-content">
    {{-- MI PLAN ISO (TAB CONTENT)--}}
    <div class="tab-pane fade text-center" id="mi-plan-iso">
        <img src="{{asset('img/escuela/home/technical-issues-1.jpg')}}" alt="jpg" style="width:50%; max-width:400px;">
        <p></p>
    </div>
    {{-- RIESGOS (TAB CONTENT) --}}
    <div class="tab-pane fade text-center" id="riesgos">
        <img src="{{asset('img/escuela/home/technical-issues-2.jpg')}}" alt="jpg" style="width:50%; max-width:1000px;">
        <p></p>
    </div>
    {{-- AUDITORIAS (TAB CONTENT) --}}
    <div class="tab-pane fade" id="auditorias">
        <p></p>
        <p class="Tarjetap2">Selecciona el informe que desees consultar</p>
        <div class="tarjetas-container">
            <div class="d-flex inline m-3">
                <div class="datosconformidades">
                    <i class="fa-regular fa-eye fa-2xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </div>
                <div class="botones2">
                    <h3 class="letra-tarjeta2">Núm de No Conformidad Mayor</h3>
                </div>
            </div>
            <div class="d-flex inline m-3">
                <div class="datosconformidades">
                    <i class="fa-regular fa-eye fa-2xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </div>
                <div class="botones2">
                    <h3 class="letra-tarjeta2">Núm de No Conformidad Menor</h3>
                </div>
            </div>
            <div class="d-flex inline m-3">
                <div class="datosconformidades">
                    <i class="fa-regular fa-eye fa-2xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </div>
                <div class="botones2">
                    <h3 class="letra-tarjeta2">Observación</h3>
                </div>
            </div>
            <div class="d-flex inline m-3">
                <div class="datosconformidades">
                    <i class="fa-regular fa-eye fa-2xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </div>
                <div class="botones2">
                    <h3 class="letra-tarjeta2">Oportunidad de Mejora</h3>
                </div>
            </div>
        </div>
        <div class="fondo-grafica">
            <h1 class="titulo-graficas">Auditorias</h1>
        </div>
        <p></p>
        <div class="fondo-grafica">
            <h1 class="titulo-graficas">Calendario de auditorias</h1>
        </div>
        <p></p>
    </div>
    {{-- MEJORAS Y ACCIONES (TAB CONTENT) --}}
    <div class="tab-pane fade" id="mejorasyacciones">

        <p></p>
        <h1 class="subtitulo">Mejoras</h1>
        <div>
            <div class="row">
                <div class="d-flex inline col-md-3">
                    <div class="tarjetas" style="background: #28C2A3;">
                        <h3 class="letra-tarjeta-MYA" >En curso</h3>
                        <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($encursoCount, 2, '0', STR_PAD_LEFT) }}</h6>
                    </div>
                </div>
                <div class="d-flex inline col-md-3">
                    <div class="tarjetas" style="background: #FF9B65;">
                        <h3 class="letra-tarjeta-MYA" >En espera</h3>
                        <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($enesperaCount, 2, '0', STR_PAD_LEFT) }}</h6>
                    </div>
                </div>
                <div class="d-flex inline col-md-3">
                    <div class="tarjetas" style="background: #6C6C6C;">
                        <h3 class="letra-tarjeta-MYA" >Cerrados</h3>
                        <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($cerradoCount, 2, '0', STR_PAD_LEFT) }}</h6>
                    </div>
                </div>
                <div class="d-flex inline col-md-3">
                    <div class="tarjetas" style="background: #E66060;">
                        <h3 class="letra-tarjeta-MYA" >Sin atender</h3>
                        <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($sinatenderCount, 2, '0', STR_PAD_LEFT) }}</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-flex inline col-md-6">
                    <div class="display-grafica">
                        <h3 class="titulo-graficas">Total de las mejoras</h3>
                        <hr style="margin: 0px 32px 0px 32px;">
                        <div id="TM"></div>
                    </div>
                </div>
                <div class="d-flex inline col-md-6">
                    <div class="display-grafica">
                        <h3 class="titulo-graficas">Porcentaje de mejora</h3>
                        <hr style="margin: 0px 32px 0px 32px;">
                        <div id="PM"></div>
                    </div>
                </div>
            </div>
            <h1 class="subtitulo">Acciones Correctivas</h1>
            <div>
                <div class="row">
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #28C2A3;">
                            <h3 class="letra-tarjeta-MYA">En curso</h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($encursoCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #FF9B65;">
                            <h3 class="letra-tarjeta-MYA" >En espera </h3>
                            <h6 class="datos-letra-tarjeta-MYA" >{{ str_pad($enesperaCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #6C6C6C;">
                            <h3 class="letra-tarjeta-MYA" >Cerrados</h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($cerradoCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #E66060;">
                            <h3 class="letra-tarjeta-MYA" >Sin atender </h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($sinatenderCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex inline col-md-6">
                        <div class="display-grafica">
                            <h3 class="titulo-graficas">Total de las Acciones Correctivas</h3>
                            <hr style="margin: 0px 32px 0px 32px;">
                            <div id="TAC"></div>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-6">
                        <div class="display-grafica">
                            <h3 class="titulo-graficas">Porcentaje de Acciones Correctivas</h3>
                            <hr style="margin: 0px 32px 0px 32px;">
                            <div id="PAC"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('scripts')
        @parent
        <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
        <script src="https://uicdn.toast.com/tui.time-picker/v2.0.3/tui-time-picker.min.js"></script>
        <script src="https://uicdn.toast.com/tui.date-picker/v4.0.3/tui-date-picker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chance/1.0.13/chance.min.js"></script>
        <script src="https://cdn.plot.ly/plotly-2.26.0.min.js" charset="utf-8"></script>
        <script src="{{ asset('../js/calendar_tui/tui-calendar.js') }}"></script>
        <script src="{{ asset('../js/calendar_tui/calendar_agenda.js') }}"></script>
        <script src="{{ asset('../js/calendar_tui/schedules.js') }}"></script>
        {{-- <script>
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
        </script> --}}
        {{-- <script src="{{ asset('../js/calendar_tui/app.js') }}"></script>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {



                }, 5000);
            })
        </script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                $(".tui-full-calendar-weekday-schedule-title").attr("title", "");
            });
        </script> --}}

                        {{-- GRAFICA DE BARRAS TOTAL DE MEJORAS --}}

        <script>
            let data = [{
                x: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
                y: [{{$encursoCount}}, {{$enesperaCount}}, {{$cerradoCount}}, {{$sinatenderCount}}],
                type: 'bar',
                marker: {
                    color: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060'],
                },
                textfont: {
                    color: 'white',
                    size: 12
                },
                text: [{{$encursoCount}}, {{$enesperaCount}}, {{$cerradoCount}}, {{$sinatenderCount}}],
                textposition: 'auto'
            }];

            let layout = {
                height: 400,
                width: 460,
                bargap: 0.05, // Ajusta este valor para controlar el espacio entre las barras
                xaxis: {
                    showgrid: false // Desactiva las líneas de la cuadrícula vertical
                },
                yaxis: {
                    showgrid: true, // Activa las líneas de la cuadrícula horizontal
                    gridcolor: 'rgba(128,128,128,0.5)' // Establece el color de las líneas de la cuadrícula
                }
            };

            Plotly.newPlot('TM', data, layout);
        </script>

                    {{-- GRAFICA DE PASTEL PORCENTAJE DE MEJORA --}}

        <script>
            let datass = [{
                values: [{{$encursoCount}}, {{$enesperaCount}}, {{$cerradoCount}}, {{$sinatenderCount}}],
                labels: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
                hole: .45,
                type: 'pie',
                marker: {
                    colors: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060'],
                },
                textfont: {
                    color: 'white',
                    size: 12
                }
            }];

            let layoutss = {
                height: 400,
                width: 450
            };

            Plotly.newPlot('PM', datass, layoutss);
        </script>

                    {{-- GRAFICA DE BARRA TOTAL DE LAS ACCIONES CORRECTIVAS --}}

        <script>
            let datasss = [{
                x: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
                y: [{{$encursoCountAC}}, {{$enesperaCountAC}}, {{$cerradoCountAC}}, {{$sinatenderCountAC}}],
                type: 'bar',
                marker: {
                    color: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060']
                },
                textfont: {
                    color: 'white',
                    size: 12
                },
                text: [{{$encursoCountAC}}, {{$enesperaCountAC}}, {{$cerradoCountAC}}, {{$sinatenderCountAC}}], // Aquí se especifica el texto
                textposition: 'auto' // Establece la posición del texto (en este caso, se coloca automáticamente)
            }];

            let layoutsss = {
                height: 400,
                width: 450,
                bargap: 0.05, // Ajusta este valor para controlar el espacio entre las barras
                xaxis: {
                    showgrid: false // Desactiva las líneas de la cuadrícula vertical
                },
                yaxis: {
                    showgrid: true, // Activa las líneas de la cuadrícula horizontal
                    gridcolor: 'rgba(128,128,128,0.5)' // Establece el color de las líneas de la cuadrícula
                }
            };

            Plotly.newPlot('TAC', datasss, layoutsss);
        </script>

                    {{-- GRAFICA DE PASTEL PORCENTAJE DE ACCIONES CORRECTIVAS --}}

        <script>
            let datas = [{
                values: [{{$encursoCountAC}}, {{$enesperaCountAC}}, {{$cerradoCountAC}}, {{$sinatenderCountAC}}],
                labels: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
                hole: .45,
                type: 'pie',
                marker: {
                    colors: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060']
                },
                textfont: {
                    color: 'white',
                    size: 12
                }
            }];

            let layouts = {
                height: 400,
                width: 450
                // width: 480px;
                // height: 477px;
            };

            Plotly.newPlot('PAC', datas, layouts);
        </script>
        @stop
