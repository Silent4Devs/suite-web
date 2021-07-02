@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                <img style='height:200px' src="{{asset('images/1.png')}}" alt="" class="img-fluid">
                </div>
                <div class="card-body">
                    <p>Sede: Torre Murano</p>
                   <p> Dirección: Periférico 142, San Pedro Garza, ciudad de México, C.P. 01000.</p>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <img style='height:200px' src="{{asset('images/2.png')}}" alt="" class="img-fluid">
                </div>
                <div class="card-body">
                    <p>Sede: Torre Murano</p>
                    <p> Dirección: Periférico 142, San Pedro Garza, ciudad de México, C.P. 01000.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <img style='height:200px' src="{{asset('images/3.png')}}" alt="" class="img-fluid">
                </div>
                <div class="card-body">
                    <p>Sede: Torre Murano</p>
                    <p> Dirección: Periférico 142, San Pedro Garza, ciudad de México, C.P. 01000.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
