@extends('layouts.admin')
@section('content')
    {{--  <div class="container">  --}}
    <h5 class="col-12 titulo_general_funcion">Visualizar Logs</h5>
    @livewire('visualizar-logs-component')
    {{--  </div>  --}}
@endsection
