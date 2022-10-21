@extends('layouts.admin')
@section('content')
    @include('partials.flashMessages')
    <div id="inicio_usuario" class="row" style="">
        <h5 class="col-12" style="color: #788BAC;margin-bottom: 30px">Planes de Acción</h5>
        <div class="col-lg-12 card p-0">
            <div class="card-body p-0">
                {{-- @livewire('kanban-tarea') --}}
                @livewire('kanban-lienzo', ['planAccionId' => $planAccionKanban->id, 'onlyRead' => false, 'empleadoFiltro' => null])
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endsection
