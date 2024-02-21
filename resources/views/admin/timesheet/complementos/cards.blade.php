@php
    use App\Models\Timesheet;
    $times = Timesheet::where('empleado_id', auth()->user()->empleado->id)->get();

    $totales = $times->count();
    $borrador_contador = $times->where('estatus', 'papelera')->count();
    $pendientes_contador = $times->where('estatus', 'pendiente')->count();
    $aprobados_contador = $times->where('estatus', 'aprobado')->count();
    $rechazos_contador = $times->where('estatus', 'rechazado')->count();
@endphp
<div class="box-caja-cards-times d-flex justify-content-between mb-4" style="gap: 20px; width: 95%; margin:auto;">
    <a href="{{ route('admin.timesheet-mis-registros', 'todos') }}#">
        <div class="card-complement">
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
        <div class="card-complement">
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
        <div class="card-complement">
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
        <div class="card-complement">
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
        <div class="card-complement">
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
