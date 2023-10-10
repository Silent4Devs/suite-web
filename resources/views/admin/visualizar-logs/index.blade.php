@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Visualizar Logs</h5>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>
    <div class="card-body datatable-fix">
        @livewire('visualizar-logs-component')
    </div>
@endsection
