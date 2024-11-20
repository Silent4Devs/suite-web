@extends('layouts.admin')
@section('content')
    @livewire('analisis-riesgos.logs-template-risk-analysis', ['templateId' => $id])
@endsection
