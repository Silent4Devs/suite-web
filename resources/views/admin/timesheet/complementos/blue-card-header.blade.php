<style>
    .caja-calendar-semana {
        background-color: #6F8FB8;
        padding: 0px 20px;
        padding-top: 5px;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        width: 95%;
        height: 80px;
        margin: auto;
        color: #fff;
    }

    .links-blue-card {
        display: flex;
    }

    .links-blue-card a {
        font-size: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0px 20px;
    }

    .links-blue-card a.line {
        border-left: 1px solid #fff;
    }

    .links-blue-card i {
        font-size: 35px;
    }
</style>
<div class="d-flex align-items-center justify-content-between card-mobile caja-calendar-semana" wire:ignore
    style="position: relative">
    <div class="d-flex">
        @yield('first-blue-card-header')
    </div>
    <div class="links-blue-card">
        <a href="{{ route('admin.timesheet-create') }}">
            <i class="material-symbols-outlined">calendar_month</i>
        </a>
        <a href="{{ route('admin.timesheet-papelera') }}" class="line">
            <i class="material-symbols-outlined">edit_calendar</i>
            Horas en borrador
        </a>
        <a href="{{ route('admin.timesheet') }}" class="line">
            <i class="material-symbols-outlined">calendar_clock</i>
            Mis registros
        </a>
    </div>
</div>
