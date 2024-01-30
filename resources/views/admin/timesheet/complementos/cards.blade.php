<style>
    .card-complement {
        flex-direction: row;
        width: 300px;
        overflow: hidden;
    }

    .bg-objet {
        width: 40px;
        height: 80px;
    }

    .option-fixed-admin {
        width: 50px;
        height: 150px;
        position: fixed;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        z-index: 10;
        background-color: #fff;
        border: 1px solid #25ACC1;
        border-top-right-radius: 18px;
        border-bottom-right-radius: 18px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 10px;
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
        transition: 1s;
    }

    .modal-admin-time.d-none {
        transition: display 1s;
    }

    .card-time-admin {
        width: 250px;
        border-radius: 12px;
    }

    .img-card-time-admin {
        width: 100%;
        height: 150px;
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
    }

    .info-card-time-admin {
        width: 100%;
        height: 150px;
        background-color: #fff;
        text-align: center;
        display: grid;
        place-items: center;
        border-radius: 20px;
        box-shadow: 0px 0px 0px 15px #77c7ac;
    }

    .info-card-time-admin h5 {
        width: 80%;
        margin: auto;
        text-wrap: balance;
    }
</style>
<div class="d-flex justify-content-between" style="gap: 25px; width: 95%; margin:auto;">
    <a href="{{ route('admin.timesheet') }}">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #D0DFA7;"></div>
            <div class="d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px; color:#818181;">Horas <br> Totales</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {40} </strong>
                    <small> Hrs </small>
                </span>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.timesheet') }}">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #FFD7A4;"></div>
            <div class="d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px; color:#818181;">Semanas <br> pendietnes</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {3} </strong>
                    <small> Hrs </small>
                </span>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.timesheet') }}">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #B8D6EE;"></div>
            <div class="d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px; color:#818181;">No <br> Aprobados</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {5} </strong>
                    <small> Hrs </small>
                </span>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.timesheet') }}">
        <div class="card card-complement">
            <div class="bg-objet" style="background-color: #DEDEDE;"></div>
            <div class="d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px; color:#818181;">Borradores</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {40} </strong>
                    <small> Hrs </small>
                </span>
            </div>
        </div>
    </a>
</div>

<div class="option-fixed-admin">
    <button class="btn" onclick="document.querySelector('.modal-aprobador').classList.remove('d-none');">
        <img src="{{ asset('img/calendar-icon-time-person.svg') }}" alt="">
    </button>
    <button class="btn" onclick="document.querySelector('.modal-config').classList.remove('d-none');">
        <img src="{{ asset('img/calendar-icon-time-config.svg') }}" alt="">
    </button>
</div>

<div class="modal-admin-time modal-aprobador d-none">
    <button class="btn" style="position: absolute; right: 10px; top: 10px;"
        onclick="document.querySelector('.modal-aprobador').classList.add('d-none');">
        <i class="bi bi-x-lg text-white" style="font-size: 40px;"></i>
    </button>

    <h3 class="text-white text-center" style="font-size:30px; margin-top: 200px;">Aprobador</h3>

    <div class="d-flex justify-content-center w-100 px-5" style="gap: 50px; margin-top: 100px;">
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
        <a href="#">
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

<div class="modal-admin-time modal-config d-none">
    <button class="btn" style="position: absolute; right: 10px; top: 10px;"
        onclick="document.querySelector('.modal-config').classList.add('d-none');">
        <i class="bi bi-x-lg text-white" style="font-size: 40px;"></i>
    </button>

    <h3 class="text-white text-center" style="font-size:30px; margin-top: 200px;">Administrador</h3>

    <div class="d-flex justify-content-center w-100 px-5 flex-wrap" style="gap: 50px; margin-top: 100px;">
        <a href="{{ route('admin.timesheet-aprobaciones') }}">
            <div class="card-time-admin">
                <div class="img-card-time-admin">
                    <img src="{{ asset('img/iso/iso12.webp') }}" alt="">
                </div>
                <div class="info-card-time-admin">
                    <h5>Pendientes de aprobar</h5>
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
        <a href="{{ route('admin.timesheet-reportes') }}">
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
</div>
