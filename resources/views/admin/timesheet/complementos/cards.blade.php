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

    .modal-aprobador {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 999;
        background-color: #40475f;
        top: 0px;
        left: 0px;
    }

    .card-option-aprob {}
</style>
<div class="d-flex justify-content-between " style="gap: 25px;">
    <a href="">
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
    <a href="">
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
    <a href="">
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
    <a href="">
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
    <button class="btn">
        <img src="{{ asset('img/calendar-icon-time-person.svg') }}" alt="">
    </button>
    <button class="btn">
        <img src="{{ asset('img/calendar-icon-time-config.svg') }}" alt="">
    </button>
</div>

<div class="modal-aprobador">
    <h3 class="text-white text-center" style="font-size:20px;">Aprobador</h3>

    <div class="d-flex justify-content-center w-100 px-5 mt-5" style="gap: 20px;">
        <div class="card-option-aprob">

        </div>
    </div>
</div>
