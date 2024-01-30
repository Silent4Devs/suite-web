<style>
    .caja-calendar-semana {
        background-color: #487fba;
        padding: 0px 20px;
        padding-top: 5px;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        width: 95%;
        margin: auto;
        color: #fff;
    }

    .semanas-tras-time-text {
        color: #fff;
    }

    .caja-calendar-semana label,
    .caja-calendar-semana label i {
        color: #fff;
    }

    .caja-calendar-semana .anima-focus label {
        background-color: #487fba;
        color: #fff;
    }

    .caja-calendar-semana .anima-focus input {
        color: #fff !important;
        height: 30px !important;
    }

    .caja-calendar-semana * {
        font-size: 12px;
    }
</style>
<div class="d-flex align-items-center justify-content-between card-mobile caja-calendar-semana" wire:ignore
    style="position: relative">
    <div class="d-flex">
        @yield('first-blue-card-header')
    </div>
    <div>
        more op
    </div>
</div>
