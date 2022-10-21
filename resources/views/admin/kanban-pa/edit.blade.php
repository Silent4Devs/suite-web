@extends('layouts.admin')
@section('content')
    @include('partials.flashMessages')
    <div id="inicio_usuario" class="row" style="">
        <h5 class="col-12" style="color: #788BAC;margin-bottom: 30px">Planes de Acción</h5>
        <div class="col-lg-12 card p-0">
            <div class="card-body p-0">
                @livewire('plan-accion-kanban-form', ['planAccionKanbanId' => $planAccionKanban->id, 'origen' => 'Planes Acción', 'requireRedirect' => true, 'edit' => true])
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
