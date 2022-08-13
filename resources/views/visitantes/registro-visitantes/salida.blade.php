@extends('layouts.visitantes')

@section('content')
    <div style="background: #f1f1f1">
        @livewire('visitantes.registrar-salida')
    </div>
@endsection
@section('scripts')
    @parent
@endsection
