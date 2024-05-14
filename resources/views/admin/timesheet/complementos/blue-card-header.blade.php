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
        <a href="{{ route('admin.timesheet-mis-registros') }}" class="line">
            <i class="material-symbols-outlined">calendar_clock</i>
            Mis registros
        </a>
    </div>
</div>
