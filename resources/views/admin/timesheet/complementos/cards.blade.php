<style>
    .card-complement {
        flex-direction: row;
        width: 220px;
        height: 60px;
        overflow: hidden;
        border-radius: 6px !important;
        position: relative;
    }

    .bg-objet {
        width: 40px;
        height: 80px;
        transition: 0.2s;
        position: absolute;
        z-index: 0;
    }

    .card-complement:hover .bg-objet {
        filter: brightness(0.8);
        width: 100%;
    }

    .card-comple-info {
        padding-left: 50px !important;
        box-sizing: border-box;
        position: relative;
        z-index: 1;
        color: #818181;
        transition: 0.2s;
    }

    .card-complement:hover .card-comple-info {
        color: #fff;
    }

    .option-fixed-admin {
        width: 90px;
        height: 150px;
        position: fixed;
        top: 50%;
        left: 0;
        margin-top: -80px;
        z-index: 10;
        background-color: #fff;
        border: 1px solid #bdbdbd;
        border-top-right-radius: 18px;
        border-bottom-right-radius: 18px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 10px;
        transition: 0.3s;
        transform: translateX(calc(-100% + 25px));
    }

    .option-fixed-admin:hover {
        transform: translateX(0px);
        border: 1px solid #25ACC1;
    }

    .option-fixed-admin img {
        width: 30px;
    }

    .option-fixed-admin button {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #6c6c6c !important;
        font-size: 10px;

        transition: 0.1s;
        opacity: 0;
    }

    .option-fixed-admin:hover button {
        transition: 0.3s;
        opacity: 1;
    }

    .option-fixed-admin img:hover {
        transition: 0.05s;
    }

    .option-fixed-admin i {
        font-size: 20px;
    }

    .option-fixed-admin:hover i {
        opacity: 0;
    }

    .modal-admin-time {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 999;
        background-color: #40475fe1;
        top: 0px;
        left: 0px;
        overflow: auto;

        transition: 0.6s;
        clip-path: circle(150.4% at 0 54%);
    }

    .modal-admin-time.invisible {
        clip-path: circle(0% at 0 50%);
    }

    /* .modal-admin-time>div {
        transform: translateY(0%);
        transition: 0.35s
    }

    .modal-admin-time.invisible>div {
        transform: translateY(-50%);
    } */
    .caja-cards-time-admin {
        width: fit-content;
        margin: auto;
        padding: 30px;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }

    .card-time-admin {
        width: 200px;
        border-radius: 12px;
    }

    .img-card-time-admin {
        width: 100%;
        height: 120px;
        overflow: hidden;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        position: relative;
        z-index: 1;
        margin-bottom: -15px;
        background-color: #000;
    }

    .img-card-time-admin img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.9;
        transform: scale(1.1);
        transition: 0.2s;
    }

    .card-time-admin:hover .img-card-time-admin img {
        transform: scale(1);
        opacity: 1;
    }

    .info-card-time-admin {
        width: 100%;
        height: 130px;
        background-color: #fff;
        text-align: center;
        display: grid;
        place-items: center;
        border-radius: 15px;
        box-shadow: 0px 0px 0px 10px #77c7ac;
    }

    .modal-config .info-card-time-admin {
        box-shadow: 0px 0px 0px 10px #ffaf7f;
    }

    .cards-reportes-config .info-card-time-admin {
        box-shadow: 0px 0px 0px 10px #ff7f7f;
    }

    .info-card-time-admin h5 {
        width: 80%;
        margin: auto;
        text-wrap: balance;
    }

    .cards-config-config {
        visibility: hidden;
        position: absolute;
        transform: translateY(200px);
        transition: 0.3s;
        opacity: 0;
    }

    .cards-config-config.active {
        visibility: visible;
        position: relative;
        transform: translateY(0px);
        opacity: 1;
    }

    .cards-reportes-config {
        visibility: hidden;
        position: absolute;
        transform: translateY(-200px);
        transition: 0.3s;
        opacity: 0;
    }

    .cards-reportes-config.active {
        visibility: visible;
        position: relative;
        transform: translateY(0px);
        opacity: 1;
    }
</style>
@php
    use App\Models\Timesheet;
    $times = Timesheet::where('empleado_id', auth()->user()->empleado->id)->get();

    $totales = $times->count();
    $borrador_contador = $times->where('estatus', 'papelera')->count();
    $pendientes_contador = $times->where('estatus', 'pendiente')->count();
    $aprobados_contador = $times->where('estatus', 'aprobado')->count();
    $rechazos_contador = $times->where('estatus', 'rechazado')->count();
@endphp
<div class="d-flex justify-content-between" style="gap: 10px; width: 95%; margin:auto;">
    <a href="{{ route('admin.timesheet-mis-registros', 'todos') }}#">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #DFF7FF;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;">Todos</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $totales }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.timesheet-mis-registros', 'papelera') }}#">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #DEDEDE;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;">Borradores</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $borrador_contador }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.timesheet-mis-registros', 'pendientes') }}#">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #FFD7A4;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;"> Pendientes</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $pendientes_contador }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.timesheet-mis-registros', 'aprobados') }}#">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #E2F6E1;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;"> Aprobados</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $aprobados_contador }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.timesheet-mis-registros', 'rechazos') }}#">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #F2ADAD;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;"> Rechazados</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $rechazos_contador }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
    </a>
</div>

<div class="option-fixed-admin">
    <button class="btn" onclick="document.querySelector('.modal-aprobador').classList.remove('invisible');">
        <img src="{{ asset('img/calendar-icon-time-person.svg') }}" alt="">
        Aprobador
    </button>
    <button class="btn" onclick="document.querySelector('.modal-config').classList.remove('invisible');">
        <img src="{{ asset('img/calendar-icon-time-config.svg') }}" alt="">
        Administrador
    </button>
    <i class="bi bi-chevron-compact-right"
        style="position: absolute; top: 50%; transform: translateY(-50%); right: 3px;"></i>
</div>

<div class="modal-admin-time modal-aprobador invisible">
    <button class="btn" style="position: absolute; right: 10px; top: 10px;"
        onclick="document.querySelector('.modal-aprobador').classList.add('invisible');">
        <i class="bi bi-x-lg text-white" style="font-size: 40px;"></i>
    </button>

    <h3 class="text-white text-center" style="font-size:30px; margin-top: 100px;">Aprobador</h3>

    <div class="caja-cards-time-admin" style="gap: 60px; margin-top: 100px;">
        <a href="{{ route('admin.timesheet-aprobaciones') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso7.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Pendientes de aprobar</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-aprobados') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso15.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Aprobados</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-rechazos') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso21.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Rechazados</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-reporte-aprobador', auth()->user()->empleado->id) }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso25.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Reportes</h5>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="modal-admin-time modal-config invisible">
    <button class="btn btn-close-time-config" style="position: absolute; right: 10px; top: 10px;"
        onclick="document.querySelector('.modal-config').classList.add('invisible');">
        <i class="bi bi-x-lg text-white" style="font-size: 40px;"></i>
    </button>

    <button class="btn btn-retreat-time-config d-none" style="position: absolute; right: 10px; top: 10px;"
        onclick="reportesCards()">
        <i class="bi bi-chevron-left text-white" style="font-size: 40px;"></i>
    </button>

    <h3 class="text-white text-center title-aprob-time-config" style="font-size:30px; margin-top: 100px;">
        Administrador
    </h3>
    <h3 class="text-white text-center title-report-time-config d-none" style="font-size:30px; margin-top: 100px;">
        Reportes</h3>

    <div class="caja-cards-time-admin cards-config-config active" style="gap: 60px; margin-top: 100px;">
        <a href="{{ route('admin.timesheet-inicio') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso12.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Configuración Timesheet</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-clientes') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso10.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Clientes</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-proyectos') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso14.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Proyectos</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-tareas') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso2.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Tareas</h5>
                </div>
            </div>
        </a>
        <a href="#" onclick="reportesCards()">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso27.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Reportes</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-dashboard') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso16.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Dashboard</h5>
                </div>
            </div>
        </a>
    </div>

    <div class="d-flex justify-content-center w-100 px-5 flex-wrap cards-reportes-config"
        style="gap: 60px; margin-top: 100px;">
        <a href="{{ route('admin.timesheet-reportes-registros') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso3.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Registros Timesheet</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-reportes-empleados') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso7.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Registros por área</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-reportes-proyectos') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso12.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Proyectos</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.timesheet-reportes-proyemp') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso22.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Registros Colaboradores Tareas</h5>
                </div>
            </div>
        </a>
    </div>
</div>

<script>
    function reportesCards() {
        document.querySelector('.cards-reportes-config').classList.toggle('active');
        document.querySelector('.cards-config-config').classList.toggle('active');
        document.querySelector('.title-aprob-time-config').classList.toggle('d-none');
        document.querySelector('.title-report-time-config').classList.toggle('d-none');

        document.querySelector('.btn-close-time-config').classList.toggle('d-none');
        document.querySelector('.btn-retreat-time-config').classList.toggle('d-none');
    }
</script>
