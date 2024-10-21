@extends('layouts.app')

@section('content')


    <!-- Sign Up Card row -->
    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3"><a href="#test1">Test 1</a></li>
                <li class="tab col s3"><a href="#test2">Test 2</a></li>
                <li class="tab col s3 disabled"><a href="#test3">Disabled Tab</a></li>
                <li class="tab col s3"><a href="#test4">Test 4</a></li>
            </ul>
        </div>
        <div id="test1" class="col s12">
            <div class="row">
                @include('contratos.fields')
                @include('bitacora.table')
            </div>
        </div>
        <div id="test2" class="col s12">Test 2</div>
        <div id="test3" class="col s12">Test 3</div>
        <div id="test4" class="col s12">Test 4</div>
    </div>
    <!-- End of Sign Up Card row -->
@endsection
